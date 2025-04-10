<?php

namespace App\Domain\Document\Event;

use App\Domain\Document\Entity\PatientDocument;

class PatientDocumentUploaded
{
    public function __construct(public PatientDocument $document) {}
}
