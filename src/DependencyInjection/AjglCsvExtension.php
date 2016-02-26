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

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class AjglCsvExtension extends Extension
{
    public function load(array $config, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $config);

        $container->setParameter('ajgl_csv.reader.default_type', $config['reader_default_type']);
        $container->setParameter('ajgl_csv.writer.default_type', $config['writer_default_type']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        if (method_exists('Symfony\Component\DependencyInjection\Definition', 'getFactoryClass')) {
            $loader->load('csv.legacy.xml');
        } else {
            $loader->load('csv.xml');
        }

        $csvDefinition = $container->getDefinition('ajgl_csv');
        $csvDefinition->addMethodCall('setDefaultReaderType', array('%ajgl_csv.reader.default_type%'));
        $csvDefinition->addMethodCall('setDefaultWriterType', array('%ajgl_csv.writer.default_type%'));
    }
}
