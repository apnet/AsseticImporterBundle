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
  private $_cacheDir;

  /**
   * @var string
   */
  private $_dir = "assetic.apnet";

  /**
   * @var ConfigCache[]
   */
  private $_cacheList;

  /**
   * Public constructor
   *
   * @param string $cacheDir Kernel cache dir
   */
  public function __construct($cacheDir)
  {
    $this->_cacheDir = $cacheDir;
    $this->_cacheList = array();
  }

  /**
   * Refresh cache for $configPath if it is not fresh
   *
   * @param string $configPath Path to config file
   * @param array  $files      List of files or directories
   *
   * @return bool
   */
  public function refresh($configPath, array $files)
  {
    $action = true;

    $cache = $this->_getCache($configPath);
    if ($cache->isFresh()) {
      $cachedResources = include($cache);
      if ($cachedResources == $files) {
        $action = false;
      }
    }
    if ($action) {
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
      $cache->write($code, $resources);
    }

    return $action;
  }

  /**
   * Get service directory inside kernel.cache_dir
   *
   * @return string
   */
  public function getDir()
  {
    return $this->_dir;
  }

  /**
   * Get ConfigCache fot config files
   *
   * @param string $configPath Path to config file
   *
   * @return ConfigCache
   */
  private function _getCache($configPath)
  {
    if (!isset($this->_cacheList[$configPath])) {
      $cachePath = $this->_getCachePath($configPath);
      $this->_cacheList[$configPath] = new ConfigCache($cachePath, true);
    }

    return $this->_cacheList[$configPath];
  }

  /**
   * Get cachedir path, if a folder does not exists - create it
   *
   * @param string $configPath Path to config file
   *
   * @return string
   */
  private function _getCachePath($configPath)
  {
    return implode(
      "/",
      array(
        $this->_cacheDir, $this->getDir(), md5($configPath) . ".php"
      )
    );
  }

}
