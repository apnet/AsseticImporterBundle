<?php

/**
 * Asset watcher
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticWatcherBundle\Factory;

/**
 * Asset watcher
 */
class SourceCodeWatcher
{

  /**
   * @var Watcher\WatcherInterface[]
   */
  private $_watchers = array();

  /**
   * @var array
   */
  private $_configs = array();

  /**
   * @var SourceCodeCache
   */
  private $_cache;

  /**
   * Public constructor
   *
   * @param SourceCodeCache $cache Cache factory
   */
  public function __construct(SourceCodeCache $cache)
  {
    $this->_watchers = array();
    $this->_configs = array();
    $this->_cache = $cache;
  }

  /**
   * Add named watcher instance
   *
   * @param Watcher\WatcherInterface $watcher Watcher instance
   *
   * @return null
   */
  public function addWatcher(Watcher\WatcherInterface $watcher)
  {
    $type = $watcher->getType();

    $this->_watchers[$type] = $watcher;
  }

  /**
   * Add config path to watch
   *
   * @param string $config  Path to config file
   * @param string $watcher Watcher name
   *
   * @return null
   */
  public function addConfig($config, $watcher)
  {
    if (!isset($this->_configs[$watcher])) {
      $this->_configs[$watcher] = array();
    }
    $this->_configs[$watcher][] = $config;
  }

  /**
   * Compile watchers' files
   *
   * @return null
   */
  public function compile()
  {
    foreach ($this->_watchers as $name => $watcher) {
      if (isset($this->_configs[$name])) {
        foreach ($this->_configs[$name] as $configPath) {
          $files = $watcher->getChildren($configPath);
          if ($this->_cache->isFresh($configPath, $files)) {
            $watcher->compile($configPath);
            $this->_cache->write($configPath, $files);
          }
        }
      }
    }
  }

}
