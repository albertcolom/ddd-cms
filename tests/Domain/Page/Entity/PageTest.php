<?php

namespace App\Tests\Domain\Site\Entity;

use App\Domain\Page\Entity\Page;
use App\Domain\Page\ValueObject\PageIdentity;
use App\Domain\Site\Entity\Site;
use App\Domain\User\Entity\User;
use PHPUnit\Framework\TestCase;

class PageTest extends TestCase
{
    /** @var Page */
    private $page;

    /** @var User */
    private $userMock;

    /** @var Site */
    private $siteMock;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->userMock = $this->createMock(User::class);
        $this->siteMock = $this->createMock(Site::class);
        $this->page = Page::instance(
            PageIdentity::instance(),
            $this->userMock,
            $this->siteMock,
            'Some content'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->userMock = null;
        $this->siteMock = null;
        $this->page = null;
    }

    /**
     * @test
     */
    public function itShouldGetExpectedValues()
    {
        $this->assertNotEmpty($this->page->id());
        $this->assertEquals('Some content', $this->page->content());
        $this->assertEquals(Page::STATUS_DRAFT, $this->page->status());
        $this->assertInstanceOf(User::class, $this->page->user());
        $this->assertInstanceOf(Site::class, $this->page->site());
        $this->assertInstanceOf(\DateTime::class, $this->page->createdOn());
    }

    /**
     * @test
     */
    public function itShouldChangeStatusDraftToPublish()
    {
        $this->page->setPublish();
        $this->assertEquals(Page::STATUS_PUBLISH, $this->page->status());
    }

    /**
     * @test
     */
    public function itShouldChangeStatusPublishToDraft()
    {
        $this->page->setPublish();
        $this->page->setDraft();
        $this->assertEquals(Page::STATUS_DRAFT, $this->page->status());
    }

    /**
     * @test
     */
    public function itShouldGetThrowInvalidArgumentExceptionWhenGetInvalidIdentity()
    {
        $this->expectException(\InvalidArgumentException::class);

        Page::instance(
            PageIdentity::instanceFromId('invalid-UUID'),
            $this->userMock,
            $this->siteMock,
            'Some content'
        );
    }
}
