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
class PathImporterTest extends \PHPUnit_Framework_TestCase
{

  /**
   * Test load asset mapper
   *
   * @return null
   */
  public function testLoad()
  {
    $importer = new PathImporter();

    $mapper = $importer->load(__DIR__ . "/_compass/css", "qwerty");

    $this->assertEquals(1, sizeof($mapper->getFormulae()));
    $asset = $mapper->item(0);

    $this->assertEquals(
      array(__DIR__ . "/_compass/css/style.css"), $asset->getInputs()
    );
    $this->assertEquals(
      array(), $asset->getFilters()
    );
    $this->assertEquals(
      array("output" => "qwerty/style.css"), $asset->getOptions()
    );
  }

}
