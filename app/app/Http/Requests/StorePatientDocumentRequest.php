<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        $doctor = auth()->user();
        $patient = $this->route('patient');

        return $patient && $doctor && $patient->doctor_id === $doctor->id;
    }

    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                'mimes:pdf',
                'max:' . config('custom.max_document_size_mb') * 1024,
            ],
        ];
    }
}
