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

    $mapper2 = $mapper->add("/etc", "qwerty");
    $this->assertEquals($mapper, $mapper2);

    $actual = array();
    foreach ($mapper as $key => $value) {
      $actual[$key] = $value;
    }

    $item0 = array("/tmp", "asdf");
    $item1 = array("/etc", "qwerty");

    $this->assertEquals(
      array($item0, $item1), $actual
    );

    $this->assertEquals(2, sizeof($mapper));
    $this->assertEquals($item0, $mapper->item(0));
    $this->assertEquals($item1, $mapper->item(1));
    $this->assertNull($mapper->item(2));
  }

}
