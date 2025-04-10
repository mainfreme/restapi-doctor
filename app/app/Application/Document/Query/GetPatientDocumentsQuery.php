<?php

namespace App\Application\Document\Query;

class GetPatientDocumentsQuery
{
    public function __construct(
        public readonly int $doctorId,
        public readonly int $patientId,
    )
    {
    }
}
