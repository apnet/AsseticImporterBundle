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
   * @param string $configPath Path to config file
   * @param string $name       Watcher name
   *
   * @return null
   */
  public function addConfig($configPath, $name)
  {
    if (isset($this->_watchers[$name])) {
      $this->_watchers[$name]->addConfigPath($configPath);
    }
  }

  /**
   * Compile watchers' files
   *
   * @return null
   */
  public function compile()
  {
    // @todo compile watchers' files. Use "Caching based on resources"
    // http://symfony.com/doc/current/components/config/caching.html
  }

}
