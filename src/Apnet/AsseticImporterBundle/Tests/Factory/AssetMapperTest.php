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
    $fileOne = dirname(__FILE__) . "/_mapper/file1.txt";
    $dirOne = dirname(__FILE__) . "/_mapper/dir1";
    $fileTwo = $dirOne . "/file2.txt";

    $mapper = new AssetMapper();
    $mapper->map($fileOne, "asdf");
    $mapper->map($dirOne, "zxcv");

    $itemOne = $mapper->item(0);
    $this->assertEquals(
      array($fileOne), $itemOne->getInputs()
    );
    $this->assertEquals(array(), $itemOne->getFilters());
    $this->assertEquals(
      array("output" => "asdf"), $itemOne->getOptions()
    );

    $itemTwo = $mapper->item(1);
    $this->assertEquals(
      array($fileTwo), $itemTwo->getInputs()
    );
    $this->assertEquals(array(), $itemTwo->getFilters());
    $this->assertEquals(
      array("output" => "zxcv/file2.txt"), $itemTwo->getOptions()
    );

    $this->assertEquals(
      array($itemOne, $itemTwo), $mapper->getFormulae()
    );
  }

}
