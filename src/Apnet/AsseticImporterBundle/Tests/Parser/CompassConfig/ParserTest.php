<?php

/**
 * Test simple parser for config.rb file
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Tests\Importer\Parser\CompassConfig;

use Apnet\AsseticImporterBundle\Parser\CompassConfig\Parser as CompassConfigParser;
use Apnet\AsseticImporterBundle\Parser\ParserInterface;

/**
 * Test simple parser for config.rb file
 */
class ParserTest extends \PHPUnit_Framework_TestCase
{

  /**
   * Test class
   *
   * @return null
   */
  public function testInstance()
  {
    $parser = new CompassConfigParser();
    $this->assertTrue($parser instanceof ParserInterface);
  }

  /**
   * Test parse function
   *
   * @param string $input Input data
   * @param array  $data  Expected parsed data
   *
   * @return null
   * @dataProvider parseDataProvider
   */
  public function testParse($input, array $data)
  {
    $parser = new CompassConfigParser();

    $this->assertEquals($data, $parser->parse($input));
  }

  /**
   * Data provider for testParse
   *
   * @return array
   */
  public function parseDataProvider()
  {
    $input = array();
    $input[0] = <<<EOF
require 'bootstrap'
# comment
var1='a'
var2="b"
var3=:var1
var4=1
var5=1.2
vae
var6=2
EOF;

    $data = array();
    $data[0] = array(
      "var1" => "a",
      "var2" => "b",
      "var3" => "a",
      "var4" => 1,
      "var5" => 1.2
    );

    return array(
      array($input[0], $data[0])
    );
  }
}
