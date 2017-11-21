<?php

namespace Tests\CmsApiRestBundle\Behat\Context\User;

use Tests\CmsApiRestBundle\Behat\Context\FeatureContext;

class UserContext extends FeatureContext
{
    /**
     * @Given /^a list of user persisted$/
     */
    public function aListOfUserPersisted()
    {
        $files = [
            __DIR__.'/../../Fixtures/user.yml'
        ];

        $this->setUpDatabase();
        $this->loadDoctrineFixtures($files);
    }
}
