<?php
/**
 * This file is part of the AJ General Libraries Bundles
 *
 * Copyright (C) 2010-2014 Antonio J. García Lagar <aj@garcialagar.es>
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
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ajgl_csv');

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
}
