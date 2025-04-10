<?php

namespace App\Http\Controllers\Api;

use App\Application\Document\Command\UploadPatientDocumentCommand;
use App\Application\Bus\CommandBus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    public function __construct(private CommandBus $bus)
    {
    }

    public function store(Request $request)
    {
        try {
            $command = new UploadPatientDocumentCommand(
                doctorId: $request->user()->id,
                patientId: $request->input('patient_id'),
                document: $request->file('document'),
            );

            $this->bus->dispatch($command);

            return response()->json(['message' => 'Dokument jest przetwarzany.']);
        } catch (\Exception $e) {
            Log::error("Błąd przy ładowaniu dokumentu: {$e->getMessage()}");

            return response()->json(['error' => 'Wystąpił błąd podczas przetwarzania dokumentu. Spróbuj ponownie.'], 500);
        }
    }
}
