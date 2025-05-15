<?php

namespace App\Application\Service;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;


class DocumentValidator
{
    protected ?MessageBag $errors = null;

    public function validate(UploadedFile $file): bool
    {
        $maxSizeMB = (int) config('filesystems.max_document_size_mb', 5);
        $maxSizeKB = $maxSizeMB * 1024;

        $validator = Validator::make(
            ['document' => $file],
            [
                'document' => [
                    'required',
                    'file',
                    'mimes:pdf',
                    'max:'.$maxSizeKB,
                ],
            ]
        );

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }

        return true;
    }

    public function errors(): ?MessageBag
    {
        return $this->errors;
    }
}
