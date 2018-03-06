<?php

namespace App\Application\Page\CommandHandler\CreatePage;

use App\Application\Common\CommandHandler\Command;

class CreatePageCommand implements Command
{
    /** @var string */
    private $userId;

    /** @var string */
    private $siteId;

    /** @var string */
    private $content;

    /** @var int */
    private $status;

    private function __construct(string $userId, string $siteId, string $content, ?int $status)
    {
        $this->userId = $userId;
        $this->siteId = $siteId;
        $this->content = $content;
        $this->status = $status;
    }

    public static function instance(
        string $userId,
        string $siteId,
        string $content,
        int $status = null
    ): CreatePageCommand {
        return new self($userId, $siteId, $content, $status);
    }

    /**
     * @return string
     */
    public function userId(): string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function siteId(): string
    {
        return $this->siteId;
    }

    /**
     * @return string
     */
    public function content(): string
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function status(): int
    {
        return $this->status;
    }
}
