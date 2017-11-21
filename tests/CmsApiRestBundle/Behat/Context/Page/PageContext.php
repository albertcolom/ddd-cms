<?php

namespace Tests\CmsApiRestBundle\Behat\Context\Page;

use Tests\CmsApiRestBundle\Behat\Context\FeatureContext;

class PageContext extends FeatureContext
{
    /**
     * @Given /^a list of page persisted$/
     */
    public function aListOfPagePersisted()
    {
        $files = [
            __DIR__.'/../../Fixtures/page.yml'
        ];

        $this->setUpDatabase();
        $this->loadDoctrineFixtures($files);
    }
}
