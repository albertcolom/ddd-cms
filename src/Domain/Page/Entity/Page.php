<?php

namespace App\Domain\Page\Entity;

use App\Domain\Page\ValueObject\PageIdentity;
use App\Domain\Site\Entity\Site;
use App\Domain\User\Entity\User;

class Page
{
    const STATUS_PUBLISH = 1;
    const STATUS_DRAFT = 0;

    /** @var PageIdentity */
    private $id;

    /** @var User */
    private $user;

    /** @var Site */
    private $site;

    /** @var string */
    private $content;

    /** @var int */
    private $status;

    /** @var \DateTime */
    private $createdOn;

    private function __construct(PageIdentity $id, User $user, Site $site, string $content)
    {
        $this->id = $id;
        $this->user = $user;
        $this->site = $site;
        $this->content = $content;
        $this->status = self::STATUS_DRAFT;
        $this->createdOn = new \DateTime();
    }

    public static function instance(PageIdentity $id, User $user, Site $site, string $content): Page
    {
        return new self($id, $user, $site, $content);
    }

    /**
     * @return PageIdentity
     */
    public function id(): PageIdentity
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function user(): User
    {
        return $this->user;
    }

    /**
     * @return Site
     */
    public function site(): Site
    {
        return $this->site;
    }

    /**
     * @return string
     */
    public function content(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function status() : int
    {
        return $this->status;
    }

    public function setPublish()
    {
        $this->status = self::STATUS_PUBLISH;
    }

    public function setDraft()
    {
        $this->status = self::STATUS_DRAFT;
    }

    /**
     * @return \DateTime
     */
    public function createdOn(): \DateTime
    {
        return $this->createdOn;
    }
}
