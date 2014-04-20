<?php

/**
 * Importer from Compass project
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Factory\Importer;

use Apnet\AsseticImporterBundle\Factory\AssetMapper;
use Apnet\AsseticImporterBundle\Parser\ParserInterface;

/**
 * Importer from Compass project
 */
class CompassImporter
{

  /**
   * @var ParserInterface
   */
  private $_parser;

  /**
   * @var array
   */
  protected $_dirs = array(
    "css_dir", "images_dir", "javascripts_dir", "fonts_dir"
  );

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

    $parameters = $this->_parser->load($configPath);
    foreach ($parameters as $key => $value) {
      if (in_array($key, $this->_dirs)) {
        $mapper->map(
          $configDir . "/" . $value,
          $targetPath . "/" . $value
        );
      }
    }

    return $mapper;
  }

}
