<?php

namespace Publicator\Bundle\AppsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('publicator');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('api_key')
                    ->info('Publicator api key')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('secret_key')
                    ->info('Publicator secret key')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('api_rpc_url')
                    ->info('Publicator apps JSON-RPC server url')
                    ->defaultValue('https://apps.publicator.me/v1')
                    ->cannotBeEmpty()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
