<?php

/*
 * AJGL CSV Bundle
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgl\Bundle\CsvBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('ajgl_csv');
        $rootNode = $this->getRootNode($treeBuilder, 'ajgl_csv');

        $rootNode
            ->children()
                ->enumNode('reader_default_type')
                    ->values(array('php', 'rfc'))
                    ->defaultValue('php')
                ->end()
                ->enumNode('writer_default_type')
                    ->values(array('php', 'rfc'))
                    ->defaultValue('php')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }

    private function getRootNode(TreeBuilder $treeBuilder, $name)
    {
        // BC layer for symfony/config 4.1 and older
        if (!\method_exists($treeBuilder, 'getRootNode')) {
            return $treeBuilder->root($name);
        }
        return $treeBuilder->getRootNode();
    }
}
