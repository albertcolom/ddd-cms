<?php

namespace App\Application\Site\CommandHandler\GetSite;

use App\Application\Common\CommandHandler\Command;

class GetSiteCommand implements Command
{
    /** @var string  */
    private $id;

    private function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @param string $id
     * @return GetSiteCommand
     */
    public static function instance(string $id): GetSiteCommand
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
