<?php

namespace MarijnKoesen\CodeGeneratorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('marijn_koesen_code_generator');

        $rootNode
            ->children()
                ->arrayNode('modules')
                    ->prototype('scalar')
                    ->validate()
                        ->ifTrue(function ($v) {return !$v;})
                        ->thenUnset()
                    ->end()
                ->end()
            ->end()
        ;

        // TODO refactor this, reuse the validation,  do this in a loop if possible, unit test this etc
        $rootNode
            ->children()
                ->arrayNode('defaultModules')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('codegenerator\generator\InputGenerator')
                            ->defaultTrue()
                            ->validate()
                                ->ifTrue(function ($v) {return !$v;})
                                ->thenUnset()
                            ->end()
                        ->end()

                        ->scalarNode('codegenerator\generator\ClassGenerator')
                            ->defaultTrue()
                            ->validate()
                                ->ifTrue(function ($v) {return !$v;})
                                ->thenUnset()
                            ->end()
                        ->end()

                        ->scalarNode('codegenerator\generator\DoctrineGenerator')
                            ->defaultTrue()
                            ->validate()
                                ->ifTrue(function ($v) {return !$v;})
                                ->thenUnset()
                            ->end()
                        ->end()

                        ->scalarNode('codegenerator\generator\MapperGenerator')
                            ->defaultTrue()
                            ->validate()
                                ->ifTrue(function ($v) {return !$v;})
                                ->thenUnset()
                            ->end()
                        ->end()

                        ->scalarNode('codegenerator\generator\MockGenerator')
                            ->defaultTrue()
                            ->validate()
                                ->ifTrue(function ($v) {return !$v;})
                                ->thenUnset()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
