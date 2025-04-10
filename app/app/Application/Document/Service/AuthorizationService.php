<?php

namespace App\Application\Service;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AuthorizationService
{
    public function ensureDoctorHasAccess(int $doctorId, int $patientId): void
    {
        if (!auth()->user()->patients()->where('id', $patientId)->exists()) {
            throw new AccessDeniedHttpException("Access denied to patient.");
        }
    }
}
