<?php

namespace App\Application\Common\CommandHandler;

interface CommandHandler
{
    public function handle(Command $command);
}
