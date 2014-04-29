<?php

/**
 * Manage SourceCode cache files.
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticWatcherBundle\Factory;

use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\Config\Resource\DirectoryResource;
use Symfony\Component\Config\ConfigCache;

/**
 * Manage SourceCode cache files.
 */
class SourceCodeCache
{

  /**
   * @var string
   */
  private $cacheDir;

  /**
   * @var string
   */
  private $dir = "assetic.apnet";

  /**
   * @var ConfigCache[]
   */
  private $cacheList;

  /**
   * Public constructor
   *
   * @param string $cacheDir Kernel cache dir
   */
  public function __construct($cacheDir)
  {
    $this->cacheDir = $cacheDir;
    $this->cacheList = array();
  }

  /**
   * Checks if the cache is still fresh.
   *
   * @param string $configPath Path to config file
   * @param array  $files      List of files or directories
   *
   * @return bool
   */
  public function isFresh($configPath, array $files)
  {
    $action = true;

    $cache = $this->getCache($configPath);
    if ($cache->isFresh()) {
      $cachedResources = include($cache);
      sort($files);
      if ($cachedResources == $files) {
        $action = false;
      }
    }
    return $action;
  }

  /**
   * Write cache for $configPath
   *
   * @param string $configPath Path to config file
   * @param array  $files      List of files or directories
   *
   * @return bool
   */
  public function write($configPath, array $files)
  {
    $resources = array();

    sort($files);
    foreach ($files as $path) {
      if (is_dir($path)) {
        $resources[] = new DirectoryResource($path);
      } elseif (is_file($path)) {
        $resources[] = new FileResource($path);
      }
    }

    $code = "<?php return " . var_export($files, true) . ";";

    $this->getCache($configPath)
      ->write($code, $resources);
  }

  /**
   * Get service directory inside kernel.cache_dir
   *
   * @return string
   */
  public function getDir()
  {
    return $this->dir;
  }

  /**
   * Get ConfigCache fot config files
   *
   * @param string $configPath Path to config file
   *
   * @return ConfigCache
   */
  private function getCache($configPath)
  {
    if (!isset($this->cacheList[$configPath])) {
      $cachePath = $this->getCachePath($configPath);
      $this->cacheList[$configPath] = new ConfigCache($cachePath, true);
    }

    return $this->cacheList[$configPath];
  }

  /**
   * Get cachedir path, if a folder does not exists - create it
   *
   * @param string $configPath Path to config file
   *
   * @return string
   */
  private function getCachePath($configPath)
  {
    return implode(
      "/",
      array(
        $this->cacheDir, $this->getDir(), md5($configPath) . ".php"
      )
    );
  }
}
