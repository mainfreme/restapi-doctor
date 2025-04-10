<?php

namespace App\Application\Service;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class DocumentValidator
{
    public function validate(UploadedFile $file): void
    {
        $maxSizeMB = (int) env('MAX_DOCUMENT_SIZE_MB', 10);
        $maxSizeKB = $maxSizeMB * 1024;

        $validator = Validator::make(
            ['document' => $file],
            [
                'document' => [
                    'required',
                    'file',
                    'mimes:pdf',
                    'max:{$maxSizeKB}',
                ],
            ]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
