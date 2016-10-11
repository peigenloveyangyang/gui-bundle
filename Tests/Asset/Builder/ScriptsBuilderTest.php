<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\Bundle\GuiBundle\Tests\Asset\Builder;

use org\bovigo\vfs\vfsStream;
use Phlexible\Bundle\GuiBundle\Asset\Builder\ScriptsBuilder;
use Phlexible\Bundle\GuiBundle\Asset\Finder\ResourceFinderInterface;
use Phlexible\Bundle\GuiBundle\Asset\MappedAsset;
use Phlexible\Bundle\GuiBundle\Compressor\CompressorInterface;

/**
 * @covers \Phlexible\Bundle\GuiBundle\Asset\Builder\ScriptsBuilder
 */
class ScriptsBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        // @TODO: Need to resolve the hard coded scripts...
        $this->markTestSkipped();

        $root = vfsStream::setup();

        $finder = $this->prophesize(ResourceFinderInterface::class);
        $finder->findByType('phlexible/scripts')->willReturn(array());

        $compressor = $this->prophesize(CompressorInterface::class);

        $builder = new ScriptsBuilder($finder->reveal(), $compressor->reveal(), $root->url(), false);

        $result = $builder->build();

        $this->assertFileExists($root->getChild('gui.js')->url());
        $this->assertFileExists($root->getChild('gui.js.map')->url());

        $expected = new MappedAsset($root->getChild('gui.js')->url(), $root->getChild('gui.js.map')->url());
        $this->assertEquals($expected, $result);
    }
}
