<?php
/**
 * This file is part of the AJ General Libraries Bundles
 *
 * Copyright (C) 2010-2013 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Bundle\CsvBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Ajgl\Bundle\CsvBundle\DependencyInjection\AjglCsvExtension;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class AjglCsvExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerBuilder
     */
    protected $container;

    /**
     * @var AjglCsvExtension
     */
    protected $extension;

    protected function setUp()
    {
        $this->container = new ContainerBuilder();
        $this->extension = new AjglCsvExtension();
    }

    public function testCsvServiceDefinition()
    {
        $this->extension->load(array(), $this->container);

        $this->assertTrue($this->container->hasParameter('ajgl_csv.class'));
        $this->assertTrue($this->container->hasDefinition('ajgl_csv'));

        $this->assertSame('Ajgl\Csv\Csv', $this->container->getParameter('ajgl_csv.class'));

        $definition = $this->container->getDefinition('ajgl_csv');
        $this->assertSame(
            '%ajgl_csv.class%',
            $definition->getClass()
        );
        $this->assertSame(
            '%ajgl_csv.class%',
            $definition->getFactoryClass()
        );
        $this->assertSame('create', $definition->getFactoryMethod());
    }
}
