<?php

/**
 * Source files watcher
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticWatcherBundle\Factory\Watcher;

use Apnet\AsseticImporterBundle\Parser\ParserInterface;
use Assetic\FilterManager;
use Assetic\Asset\AssetCollection;
use Assetic\Asset\FileAsset;

class PreWatcher implements WatcherInterface
{

  /**
   * @var ParserInterface
   */
  private $_parser;

  /**
   * @var FilterManager
   */
  private $_filterManager;

  /**
   * Public constructor
   *
   * @param ParserInterface $parser        Config parser
   * @param FilterManager   $filterManager Asset Factory
   */
  public function __construct(ParserInterface $parser, FilterManager $filterManager)
  {
    $this->_parser = $parser;
    $this->_filterManager = $filterManager;
  }

  /**
   * {@inheritdoc}
   */
  public function getChildren($configPath)
  {
    $children = array();
    $parameters = $this->_loadConfig($configPath);
    foreach ($parameters as $asset) {
      foreach ($asset["inputs"] as $file) {
        if (substr($file, 0, 1) !== "/") { // Unix style
          $file = dirname($configPath) . "/" . $file;
        }
        $children[] = $file;
      }
    }
    return $children;
  }

  /**
   * {@inheritdoc}
   */
  public function compile($configPath)
  {
    $sourceRoot = dirname($configPath);

    $parameters = $this->_loadConfig($configPath);
    foreach ($parameters as $asset) {
      if (!isset($asset["options"]["output"])) {
        continue;
      }
      $destination = $sourceRoot . "/" . $asset["options"]["output"];
      unset($asset["options"]["output"]);

      $assets = array();
      foreach ($asset["inputs"] as $input) {
        $assets[] = new FileAsset($sourceRoot . "/" . $input);
      }

      $filters = array();
      foreach ($asset["filters"] as $filter) {
        $filters[] = $this->_filterManager->get($filter);
      }
      $collection = new AssetCollection($assets, $filters);

      file_put_contents($destination, $collection->dump());
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getType()
  {
    return "pre";
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
