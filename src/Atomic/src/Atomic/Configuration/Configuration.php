<?php
namespace Atomic\Configuration;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('atomic');

         $rootNode
            ->children()
                ->scalarNode('template_dir')
                    ->defaultValue('templates')
                ->end()           
                ->scalarNode('cache_dir')
                    ->defaultValue('cache')
                ->end()                  
                ->booleanNode('debug')
                    ->defaultFalse()
                ->end()
                ->booleanNode('auto_reload')
                    ->defaultFalse()
                ->end()                 
            ->end()
        ->end()
        ;

    return $treeBuilder;
    }
}