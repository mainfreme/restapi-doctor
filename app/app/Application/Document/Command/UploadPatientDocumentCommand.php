<?php

namespace App\Application\Document\Command;

use Illuminate\Http\UploadedFile;

class UploadPatientDocumentCommand
{
    public function __construct(
        public readonly int          $doctorId,
        public readonly int          $patientId,
        public readonly UploadedFile $document,
    )
    {
    }
}
