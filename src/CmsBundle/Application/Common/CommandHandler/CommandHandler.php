<?php

namespace CmsBundle\Application\Common\CommandHandler;

interface CommandHandler
{
    public function handle(Command $command);
}
