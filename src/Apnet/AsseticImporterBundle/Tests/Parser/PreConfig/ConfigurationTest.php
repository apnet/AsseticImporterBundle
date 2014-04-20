<?php

/**
 * PreImporter configuration
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Tests\Parser\PreConfig;

use Apnet\AsseticImporterBundle\Parser\PreConfig\Configuration;
use Symfony\Component\Config\Definition\Processor;

/**
 * PreImporter configuration
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{

  /**
   * Test configuration class
   *
   * @param array $input    Input data
   * @param array $expected Expected result
   *
   * @return null
   * @dataProvider providerConfig
   */
  public function testConfig(array $input, array $expected)
  {
    $configuration = new Configuration();
    $processor = new Processor();

    $actual = $processor->processConfiguration($configuration, $input);
    $this->assertEquals($expected, $actual);
  }

  /**
   * Provider for testConfig
   *
   * @return array
   */
  public function providerConfig()
  {
    $input = array();
    $expected = array();

    // #0
    $input[] = array(
    );
    $expected[] = array(
    );

    // #1
    $input[] = array(
      "assets" => array(
      )
    );
    $expected[] = array(
    );

    // #2
    $input[] = array(
      "assets" => array(
        "qwe" => array(
          "filters" => array("qwe", "asd")
        )
      )
    );
    $expected[] = array(
      "qwe" => array(
        "inputs" => array(),
        "filters" => array("qwe", "asd"),
        "options" => array()
      ),
    );

    // #3
    $input[] = array(
      "assets" => array(
        "qwe" => array(
          "inputs" => array("rty", "fgh")
        )
      )
    );
    $expected[] = array(
      "qwe" => array(
        "inputs" => array("rty", "fgh"),
        "filters" => array(),
        "options" => array()
      ),
    );

    // #4
    $input[] = array(
      "assets" => array(
        "qwe" => array(
          "options" => array(
            "key1" => "value1",
            "key2" => "value2",
          )
        )
      )
    );
    $expected[] = array(
      "qwe" => array(
        "inputs" => array(),
        "filters" => array(),
        "options" => array(
          "key1" => "value1",
          "key2" => "value2",
        )
      ),
    );

    return array(
      array($input[0], $expected[0]),
      array($input[1], $expected[1]),
      array($input[2], $expected[2]),
      array($input[3], $expected[3]),
      array($input[4], $expected[4]),
    );
  }

}
