<?php
/**
 * This file is part of the AJ General Libraries Bundles
 *
 * Copyright (C) 2010-2014 Antonio J. García Lagar <aj@garcialagar.es>
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

        $this->assertTrue($this->container->hasParameter('ajgl_csv.reader.default_type'));
        $this->assertTrue($this->container->hasParameter('ajgl_csv.writer.default_type'));
        $this->assertTrue($this->container->hasDefinition('ajgl_csv'));

        $this->assertSame('php', $this->container->getParameter('ajgl_csv.reader.default_type'));
        $this->assertSame('php', $this->container->getParameter('ajgl_csv.writer.default_type'));

        $definition = $this->container->getDefinition('ajgl_csv');
        $this->assertSame(
            'Ajgl\Csv\Csv',
            $definition->getClass()
        );

        $calls = $definition->getMethodCalls();
        $this->assertCount(2, $calls);
        foreach ($calls as $call) {
            switch ($call[0]) {
                case 'setDefaultReaderType':
                    $this->assertSame(array('%ajgl_csv.reader.default_type%'), $call[1]);
                    break;
                case 'setDefaultWriterType':
                    $this->assertSame(array('%ajgl_csv.writer.default_type%'), $call[1]);
                    break;
                default:
                    $this->fail("Unexpected method call '{$call[0]}'");
            }
        }
    }
}
