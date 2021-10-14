<?php

namespace Lotriss\Eav\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Lotriss\Eav\Service\EavConfig;

class LotrissEavExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);
        $eavConfig = $config['attributes_config'];
        $definition = $container->getDefinition(EavConfig::class);

        $definition->setArgument('$eavConfigData', $eavConfig);
    }

    public function getAlias(): string
    {
        return 'eav';
    }
}
