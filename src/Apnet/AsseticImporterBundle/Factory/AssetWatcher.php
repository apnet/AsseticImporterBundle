<?php

/**
 * Asset watcher
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Factory;

/**
 * Asset watcher
 */
class AssetWatcher
{

  /**
   * @var Watcher\WatcherInterface[]
   */
  private $_watchers = array();

  /**
   * Public constructor
   */
  public function __construct()
  {
    $this->_watchers = array();
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
   * @param string $config Path to config file
   * @param string $name   Watcher name
   *
   * @return null
   */
  public function addConfig($config, $name)
  {
    if (isset($this->_watchers[$name])) {
      $watcher = $this->_watchers[$name];
      // @todo add $config to watcher
    }
  }

}
