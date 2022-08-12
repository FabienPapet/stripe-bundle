<?php

namespace Fpt\StripeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $tree = new TreeBuilder('fpt_stripe');
        /** @phpstan-ignore-next-line */
        $tree->getRootNode()
            ->children()
                ->arrayNode('credentials')
                    ->children()
                        ->scalarNode('publishable_key')->isRequired()->end()
                        ->scalarNode('secret_key')->isRequired()->end()
                    ->end()
                ->end()
                ->arrayNode('webhook')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('check_signature')->defaultTrue()->end()
                        ->scalarNode('signature_key')->treatNullLike('')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $tree;
    }
}
