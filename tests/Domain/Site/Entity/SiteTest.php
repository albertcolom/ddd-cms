<?php

namespace App\Tests\Domain\Site\Entity;

use App\Domain\Site\Entity\Site;
use App\Domain\Site\ValueObject\SiteIdentity;
use PHPUnit\Framework\TestCase;

class SiteTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldCorrectBuildAndGetExpectedValues()
    {
        $site = Site::instance(
            SiteIdentity::instance(),
            $name = 'site.name',
            $description = 'Some description'
        );

        $this->assertNotEmpty($site->id());
        $this->assertEquals($name, $site->name());
        $this->assertEquals($description, $site->description());
        $this->assertInstanceOf(\DateTime::class, $site->createdOn());
    }

    /**
     * @test
     */
    public function itShouldGetThrowInvalidArgumentExceptionWhenGetInvalidIdentity()
    {
        $this->expectException(\InvalidArgumentException::class);

        Site::instance(
            SiteIdentity::instanceFromId('invalid-UUID'),
            'site.name',
            'some description'
        );
    }
}
