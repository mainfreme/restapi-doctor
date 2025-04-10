<?php

namespace App\Application\Bus;

class CommandBus
{
    public function dispatch(object $command): void
    {
        app()->call($command);
    }
}
