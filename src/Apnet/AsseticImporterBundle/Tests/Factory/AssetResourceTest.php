<?php

/**
 * Test Asset resource
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Tests\Factory;

use Apnet\AsseticImporterBundle\Factory\AssetResource;

/**
 * Test Asset resource
 */
class AssetResourceTest extends \PHPUnit_Framework_TestCase
{

  /**
   * Test client
   *
   * @return null
   */
  public function testObject()
  {
    $resource = new AssetResource("/tmp", "asdf");

    $this->assertEquals("/tmp", $resource->getSourcePath());
    $this->assertEquals("asdf", $resource->getTargetPath());
  }

}
