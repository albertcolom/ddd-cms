<?php

namespace CmsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Loader\NativeLoader;

class LoadFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $loader = new NativeLoader();

        $files = [
            __DIR__.'/user.yml',
            __DIR__.'/site.yml',
            __DIR__.'/page.yml'
        ];

        $objectSet = $loader->loadFiles($files);

        foreach ($objectSet->getObjects() as $object) {
            $manager->persist($object);
            $manager->flush();
        }
    }
}
