<?php

/**
 * Test compass importer
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Tests\Factory\Importer;

use Apnet\AsseticImporterBundle\Factory\Importer\CompassImporter;
use Apnet\AsseticImporterBundle\Parser\CompassConfig\Parser as CompassConfigParser;

/**
 * Test compass importer
 */
class CompassImporterTest extends \PHPUnit_Framework_TestCase
{

  /**
   * Test load asset mapper
   *
   * @return null
   */
  public function testLoad()
  {
    $parser = new CompassConfigParser();
    $importer = new CompassImporter($parser);

    $mapper = $importer->load(__DIR__ . "/_compass/config.rb", "qwerty");

    $this->assertEquals(1, sizeof($mapper->getFormulae()));
    $asset = $mapper->item(0);

    $this->assertEquals(
      array(__DIR__ . "/_compass/css/style.css"), $asset->getInputs()
    );
    $this->assertEquals(
      array(), $asset->getFilters()
    );
    $this->assertEquals(
      array("output" => "qwerty/css/style.css"), $asset->getOptions()
    );
  }
}
