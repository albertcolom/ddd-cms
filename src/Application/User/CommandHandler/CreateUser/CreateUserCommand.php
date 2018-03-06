<?php

namespace App\Application\User\CommandHandler\CreateUser;

use App\Application\Common\CommandHandler\Command;

class CreateUserCommand implements Command
{
    /** @var string  */
    private $name;

    /** @var string  */
    private $email;

    /**
     * @param string $name
     * @param string $email
     */
    private function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @param string $name
     * @param string $email
     * @return CreateUserCommand
     */
    public static function instance(string $name, string $email): createUserCommand
    {
        return new self($name, $email);
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }
}
