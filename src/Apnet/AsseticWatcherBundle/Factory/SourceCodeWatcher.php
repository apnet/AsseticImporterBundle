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
   * @var string
   */
  private $_root;

  /**
   * @var string
   */
  private $_env;

  /**
   * @var bool
   */
  private $_enabled;

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
    $this->_root = null;
    $this->_env = null;
    $this->_enabled = true;
  }

  /**
   * Set compiler root
   *
   * @param string $path Path
   *
   * @return null
   */
  public function setCompilerRoot($path)
  {
    $path = realpath($path);
    if (is_dir($path)) {
      $this->_root = $path;
    }
  }

  /**
   * Set environment
   *
   * @param string $env Environment
   *
   * @return null
   */
  public function setEnv($env)
  {
    $this->_env = $env;
  }

  /**
   * Set enabled
   *
   * @param bool $enabled Enabled
   *
   * @return null
   */
  public function setEnabled($enabled)
  {
    $this->_enabled = !!$enabled;
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
    if (!is_null($this->_root) && strpos($config, $this->_root) !== 0) {
      return;
    }
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
    if (!$this->_enabled || $this->_env !== "dev") {
      return;
    }
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
