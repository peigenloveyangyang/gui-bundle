<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\Bundle\GuiBundle\Tests\Menu;

use Phlexible\Bundle\GuiBundle\Menu\MenuItem;
use Phlexible\Bundle\GuiBundle\Menu\MenuItemCollection;

/**
 * Menu item collection test
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class MenuItemCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testMerge()
    {
        $items = new MenuItemCollection();
        $items->set('foo', new MenuItem('foo'));
        $mergeItems = new MenuItemCollection();
        $mergeItems->set('foo', new MenuItem('mergeFoo'));
        $mergeItems->set('bar', new MenuItem('bar'));

        $items->merge($mergeItems);

        $this->assertCount(2, $items);
        $this->assertSame('mergeFoo', $items->getItems()['foo']->getHandle());

    }

    public function testToArray()
    {
        $items = new MenuItemCollection();
        $items->set('main', new MenuItem('foo'));
        $items->set('sub', new MenuItem('bar', 'main', array('a', 'b')));

        $data = $items->toArray();

        $this->assertSame(array(array('name' => 'main', 'handle' => 'foo'), array('name' => 'sub', 'handle' => 'bar', 'roles' => array('a', 'b'))), $data);
    }
}
