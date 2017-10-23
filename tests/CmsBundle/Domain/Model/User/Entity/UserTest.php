<?php

namespace Tests\CmsBundle\Cms\Domain\Model\User\Entity;

use CmsBundle\Cms\Domain\Model\User\Entity\User;
use CmsBundle\Cms\Domain\Model\User\ValueObject\UserIdentity;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldCorrectBuildAndGetExpectedValues()
    {
        $user = User::instance(
            UserIdentity::instance(),
            $name ='user.name',
            $email = 'valid_mail@gmail.com'
        );

        $this->assertNotEmpty($user->id());
        $this->assertEquals($name, $user->name());
        $this->assertEquals($email, $user->email());
        $this->assertInstanceOf(\DateTime::class, $user->createdOn());
    }

    /**
     * @test
     */
    public function itShouldGetThrowInvalidArgumentExceptionWhenGetInvalidIdentity()
    {
        $this->expectException(\InvalidArgumentException::class);

        User::instance(
            UserIdentity::instanceFromId('invalid-UUID'),
            'user.name',
            'valid_mail@gmail.com'
        );
    }

    /**
     * @test
     */
    public function itShouldGetThrowInvalidArgumentExceptionWhenGetInvalidEmail()
    {
        $this->expectException(\InvalidArgumentException::class);

        User::instance(
            UserIdentity::instance(),
            'user.name',
            'valid_mail.com'
        );
    }
}
