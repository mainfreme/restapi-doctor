<?php

namespace App\Infrastructure\Queue;

use Illuminate\Support\Facades\Queue;
use App\Jobs\ProcessPatientDocumentJob;

class QueueService
{
    public function dispatch($event): void
    {
        Queue::push(new ProcessPatientDocumentJob($event->document));
    }
}
