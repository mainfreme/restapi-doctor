<?php

namespace App\Application\Document\Query;

use Illuminate\Support\Facades\DB;
use App\Application\Service\AuthorizationService;

class GetPatientDocumentsHandler
{
    public function __construct(private AuthorizationService $auth)
    {
    }

    public function __invoke(GetPatientDocumentsQuery $query): array
    {
        $this->auth->ensureDoctorHasAccess($query->doctorId, $query->patientId);

        return DB::table('patient_documents')
            ->where('patient_id', $query->patientId)
            ->select('id', 'original_name', 'created_at', 'path')
            ->orderByDesc('created_at')
            ->get()
            ->toArray();
    }
}
