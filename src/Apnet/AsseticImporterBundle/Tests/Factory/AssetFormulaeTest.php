<?php

/**
 * Test Asset formulae
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Tests\Factory;

use Apnet\AsseticImporterBundle\Factory\AssetFormulae;

/**
 * Test Asset formulae
 */
class AssetFormulaeTest extends \PHPUnit_Framework_TestCase
{

  /**
   * Test object
   *
   * @return null
   */
  public function testObject()
  {
    $object = new AssetFormulae();

    $this->assertEquals(array(), $object->getInputs());
    $this->assertEquals(array(), $object->getFilters());
    $this->assertEquals(array(), $object->getOptions());

    $objectInputs = $object->setInputs(array(1, 2, 3));
    $this->assertEquals($object, $objectInputs);
    $this->assertEquals(array(1, 2, 3), $object->getInputs());

    $objectFilters = $object->setFilters(array(4, 5, 6));
    $this->assertEquals($object, $objectFilters);
    $this->assertEquals(array(4, 5, 6), $object->getFilters());

    $objectOptions = $object->setOptions(array(7, 8, 9, "asdf" => "qwerty"));
    $this->assertEquals($object, $objectOptions);
    $this->assertEquals(array(7, 8, 9, "asdf" => "qwerty"), $object->getOptions());

    $this->assertTrue($object->hasOption("asdf"));
    $this->assertEquals("qwerty", $object->getOption("asdf"));

    $this->assertFalse($object->hasOption("qqq"));
    $this->assertNull($object->getOption("qqq"));
  }
}
