<?php

/**
 * Test compass importer
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Tests\Factory\Importer;

use Apnet\AsseticImporterBundle\Factory\Importer\CompassImporter;
use Apnet\AsseticImporterBundle\Parser\CompassConfigParser;

/**
 * Test compass importer
 */
class CompassImporterTest extends \PHPUnit_Framework_TestCase {

  public function testLoad()
  {
    $parser = new CompassConfigParser();
    $importer = new CompassImporter($parser);

    $mapper = $importer->load(__DIR__ . "/_compass/config.rb", "qwerty");

    $this->assertEquals(4, sizeof($mapper));
    $this->assertEquals(
      array(__DIR__ . "/_compass/css", "qwerty/css"),
      $mapper->item(0)
    );
  }

}
