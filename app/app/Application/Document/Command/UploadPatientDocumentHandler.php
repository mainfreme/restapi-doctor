<?php

namespace App\Application\Document\Command;

use App\Application\Service\DocumentValidator;
use App\Application\Service\AuthorizationService;
use App\Infrastructure\Document\Storage\DocumentStorage;
use App\Infrastructure\Queue\QueueService;
use App\Domain\Document\Entity\PatientDocument;
use App\Domain\Document\Event\PatientDocumentUploaded;
use Illuminate\Validation\ValidationException;

class UploadPatientDocumentHandler
{
    public function __construct(
        private DocumentValidator    $validator,
        private AuthorizationService $auth,
        private DocumentStorage      $storage,
        private QueueService         $queue,
    )
    {
    }

    /**
     * @throws ValidationException
     */
    public function __invoke(UploadPatientDocumentCommand $command)
    {
        $this->auth->ensureDoctorHasAccess($command->doctorId, $command->patientId);
        $this->validator->validate($command->document);

        $path = $this->storage->storeTemporary($command->document);

        $document = new PatientDocument($path, $command->document->getClientOriginalName(), $command->patientId, $command->doctorId);

        $this->queue->dispatch(new PatientDocumentUploaded($document));
    }
}
