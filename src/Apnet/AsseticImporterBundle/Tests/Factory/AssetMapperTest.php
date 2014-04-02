<?php

/**
 * Test Asset mapper
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Tests\Factory;

use Apnet\AsseticImporterBundle\Factory\AssetMapper;

/**
 * Test Asset mapper
 */
class AssetMapperTest extends \PHPUnit_Framework_TestCase
{

  /**
   * Test object
   *
   * @return null
   */
  public function testObject()
  {
    $mapper = new AssetMapper();
    $mapper->add("/tmp", "asdf");

    $mapperTwo = $mapper->add("/etc", "qwerty");
    $this->assertEquals($mapper, $mapperTwo);

    $actual = array();
    foreach ($mapper as $key => $value) {
      $actual[$key] = $value;
    }

    $itemOne = array("/tmp", "asdf");
    $itemTwo = array("/etc", "qwerty");

    $this->assertEquals(
      array($itemOne, $itemTwo), $actual
    );

    $this->assertEquals(2, sizeof($mapper));
    $this->assertEquals($itemOne, $mapper->item(0));
    $this->assertEquals($itemTwo, $mapper->item(1));
    $this->assertNull($mapper->item(2));
  }

}
