<?php

namespace App\Domain\Document\Entity;

class PatientDocument
{
    public function __construct(
        public readonly string $path,
        public readonly string $originalName,
        public readonly int    $patientId,
        public readonly int    $doctorId,
    )
    {
    }
}
