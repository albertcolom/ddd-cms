<?php

namespace CmsBundle\Application\User\CommandHandler\GetUser;

use CmsBundle\Application\Common\CommandHandler\Command;

class GetUserCommand implements Command
{
    /** @var string  */
    private $id;

    private function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @param string $id
     * @return GetUserCommand
     */
    public static function instance(string $id): GetUserCommand
    {
        return new self($id);
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }
}
