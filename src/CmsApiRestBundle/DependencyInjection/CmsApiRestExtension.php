<?php

namespace CmsApiRestBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class CmsApiRestExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config/services')
        );

        $finder = Finder::create();
        $finder->files()->in(__DIR__ . '/../Resources/config/services')->name('*.yml');

        /** @var SplFileInfo $file */
        foreach ($finder as $file) {
            $loader->load($file->getRelativePathname());
        }
    }
}
