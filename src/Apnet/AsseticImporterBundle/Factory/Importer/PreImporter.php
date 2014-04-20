<?php

/**
 * PreImporter internal assets
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Factory\Importer;

use Apnet\AsseticImporterBundle\Factory\AssetMapper;
use Apnet\AsseticImporterBundle\Parser\ParserInterface;

/**
 * PreImporter internal assets
 */
class PreImporter
{

  /**
   * @var ParserInterface
   */
  private $_parser;

  /**
   * Public constructor
   *
   * @param ParserInterface $parser Config parser
   */
  public function __construct(ParserInterface $parser)
  {
    $this->_parser = $parser;
  }

  /**
   * Add asset mapper from config.rb
   *
   * @param string $configPath Path to config.rb
   * @param string $targetPath TargetPath
   *
   * @return AssetMapper
   */
  public function load($configPath, $targetPath)
  {
    $mapper = new AssetMapper();
    $configDir = dirname($configPath);

    $parameters = $this->_loadConfig($configPath);
    foreach ($parameters as $asset) {
      $options = $asset["options"];
      if (isset($options["output"])) {
        $mapper->map(
          $configDir . "/" . $options["output"],
          $targetPath . "/" . $options["output"]
        );
      }
    }

    return $mapper;
  }

  /**
   * Load config
   *
   * @param string $configPath Path to .yml file
   *
   * @return array
   */
  protected function _loadConfig($configPath)
  {
    return $this->_parser->load($configPath);
  }

}
