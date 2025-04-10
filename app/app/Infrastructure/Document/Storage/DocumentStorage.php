<?php

namespace App\Infrastructure\Document\Storage;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class DocumentStorage
{
    public function storeTemporary(UploadedFile $file): string
    {
        return $file->store('tmp/patient_documents');
    }
}
