<?php

namespace CmsBundle\Cms\Application\Model\Common\CommandHandler;

interface CommandHandler
{
    public function handle(Command $command);
}
