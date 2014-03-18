<?php
/**
 * This file is part of the AJ General Libraries Bundles
 *
 * Copyright (C) 2010-2014 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Bundle\Csv\Tests\DependencyInjection;

use Ajgl\Bundle\CsvBundle\DependencyInjection\Configuration;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Configuration
     */
    private $configuration;

    protected function setUp()
    {
        parent::setUp();

        $this->configuration = new Configuration();
    }

    public function testDefaultConfiguration()
    {
        $builder = $this->configuration->getConfigTreeBuilder();
        $node = $builder->buildTree();
        $this->assertInstanceOf('Symfony\Component\Config\Definition\ArrayNode', $node);
        $children = $node->getChildren();

        $this->assertArrayHasKey('reader_default_type', $children);
        $this->assertInstanceOf('Symfony\Component\Config\Definition\EnumNode', $children['reader_default_type']);
        $this->assertSame(array('php', 'rfc'), $children['reader_default_type']->getValues());
        $this->assertSame('php', $children['reader_default_type']->getDefaultValue());

        $this->assertArrayHasKey('writer_default_type', $children);
        $this->assertInstanceOf('Symfony\Component\Config\Definition\EnumNode', $children['writer_default_type']);
        $this->assertSame(array('php', 'rfc'), $children['writer_default_type']->getValues());
        $this->assertSame('php', $children['writer_default_type']->getDefaultValue());
    }
}
