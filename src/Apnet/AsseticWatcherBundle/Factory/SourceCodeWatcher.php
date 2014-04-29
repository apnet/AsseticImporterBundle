<?php

/**
 * Asset watcher
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticWatcherBundle\Factory;

use Symfony\Component\Filesystem\Filesystem;

/**
 * Asset watcher
 */
class SourceCodeWatcher
{

  /**
   * @var Watcher\WatcherInterface[]
   */
  private $watchers = array();

  /**
   * @var array
   */
  private $configs = array();

  /**
   * @var SourceCodeCache
   */
  private $cache;

  /**
   * @var string
   */
  private $root;

  /**
   * @var string
   */
  private $env;

  /**
   * @var bool
   */
  private $enabled;

  /**
   * Public constructor
   *
   * @param SourceCodeCache $cache Cache factory
   */
  public function __construct(SourceCodeCache $cache)
  {
    $this->watchers = array();
    $this->configs = array();
    $this->cache = $cache;
    $this->root = null;
    $this->env = null;
    $this->enabled = true;
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
      $this->root = $path;
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
    $this->env = $env;
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
    $this->enabled = !!$enabled;
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

    $this->watchers[$type] = $watcher;
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
    if (!$this->root) {
      return;
    }
    $config = realpath($config);

    $filesystem = new Filesystem();
    $relativePath = $filesystem->makePathRelative($config, $this->root);
    if (substr($relativePath, 0, 2) == "..") {
      return;
    }

    if (!isset($this->configs[$watcher])) {
      $this->configs[$watcher] = array();
    }
    $this->configs[$watcher][] = $config;
  }

  /**
   * Compile watchers' files
   *
   * @return null
   */
  public function compile()
  {
    if (!$this->enabled || $this->env !== "dev") {
      return;
    }
    foreach ($this->watchers as $name => $watcher) {
      if (isset($this->configs[$name])) {
        foreach ($this->configs[$name] as $configPath) {
          $files = $watcher->getChildren($configPath);
          if ($this->cache->isFresh($configPath, $files)) {
            $watcher->compile($configPath);
            $this->cache->write($configPath, $files);
          }
        }
      }
    }
  }
}
