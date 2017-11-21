<?php

namespace Tests\CmsApiRestBundle\Behat\Context\Site;

use Tests\CmsApiRestBundle\Behat\Context\FeatureContext;

class SiteContext extends FeatureContext
{
    /**
     * @Given /^a list of site persisted$/
     */
    public function aListOfSitePersisted()
    {
        $files = [
            __DIR__.'/../../Fixtures/site.yml'
        ];

        $this->setUpDatabase();
        $this->loadDoctrineFixtures($files);
    }
}
