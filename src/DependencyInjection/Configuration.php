<?php

namespace Lotriss\Eav\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('eav');
        $rootNode = $treeBuilder->getRootNode();
        $rootNode
            ->fixXmlConfig('attribute_config')
            ->children()
            ->arrayNode('enabled_entities')
            ->info('Entities to process')
            ->scalarPrototype()
            ->end()
            ->end()
            ->arrayNode('attributes_config')
            ->info('Attribute list for entities')
            ->arrayPrototype()
            ->children()
            ->scalarNode('code')->end()
            ->enumNode('type')
            ->values(['int', 'varchar', 'text', 'decimal', 'datetime', 'bool', 'json'])
            ->end()
            ->booleanNode('required')->defaultFalse()->end()
            ->booleanNode('unique')->defaultFalse()->end()
            ->scalarNode('label')->end()
            ->enumNode('search_type')
            ->defaultValue('none')
            ->values(['equal', 'like', 'compare_operations', 'none'])
            ->end()
            ->arrayNode('options')
            ->scalarPrototype()->end()
            ->end()
            ->scalarNode('entity_class')
            ->isRequired()
            ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
