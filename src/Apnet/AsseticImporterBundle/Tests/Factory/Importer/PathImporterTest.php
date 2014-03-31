<?php

/**
 * Test path importer
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Tests\Factory\Importer;

use Apnet\AsseticImporterBundle\Factory\Importer\PathImporter;

/**
 * Test path importer
 */
class PathImporterTest extends \PHPUnit_Framework_TestCase {

  public function testLoad()
  {
    $importer = new PathImporter();

    $mapper = $importer->load(__DIR__, "qwerty");

    $this->assertEquals(1, sizeof($mapper));
    $this->assertEquals(
      array(__DIR__, "qwerty"), $mapper->item(0)
    );
  }

}
