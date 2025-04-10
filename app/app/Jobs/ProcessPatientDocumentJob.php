<?php

namespace App\Jobs;

use App\Domain\Document\Entity\PatientDocument;
use App\Models\Document as DocumentModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProcessPatientDocumentJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public PatientDocument $document)
    {
    }

    public function handle(): void
    {
        try {
            $finalPath = $this->storageFile();

            if (NULL === $finalPath) {
                Log::error("Temporary file not found: {$this->document->path}");
                throw new \Exception("Plik tymczasowy nie został znaleziony.");
            }

            DocumentModel::create([
                'doctor_id' => $this->document->doctorId,
                'patient_id' => $this->document->patientId,
                'original_name' => $this->document->originalName,
                'file_path' => $finalPath,
            ]);
        } catch (\Exception $e) {
            Log::error("Błąd przetwarzania dokumentu pacjenta: {$e->getMessage()}", [
                'patient_id' => $this->document->patientId,
                'original_name' => $this->document->originalName,
                'exception' => $e,
            ]);

            throw $e;
        }
    }

    /**
     * @return string|null
     */
    private function storageFile(): ?string
    {
        $tempPath = $this->document->path;

        $targetDir = "patient_documents/{$this->document->doctorId}/{$this->document->patientId}";
        $filename = Str::uuid() . '.pdf';
        $finalPath = "{$targetDir}/{$filename}";

        if (Storage::exists($tempPath)) {
            Storage::makeDirectory($targetDir);
            Storage::move($tempPath, $finalPath);

            return $finalPath;
        }

        return NULL;
    }
}
