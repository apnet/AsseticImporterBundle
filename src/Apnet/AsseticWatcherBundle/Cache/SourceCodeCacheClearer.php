<?php

/**
 * SourceCode watchers cache clearer
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticWatcherBundle\Cache;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\CacheClearer\CacheClearerInterface;
use Apnet\AsseticWatcherBundle\Factory\SourceCodeCache;

/**
 * SourceCode watchers cache clearer
 */
class SourceCodeCacheClearer implements CacheClearerInterface
{

  /**
   * @var SourceCodeCache
   */
  private $_cache;

  /**
   * Public constructor
   *
   * @param SourceCodeCache $cache SourceCode cache
   */
  public function __construct(SourceCodeCache $cache)
  {
    $this->_cache = $cache;
  }

  /**
   * {@inheritdoc}
   */
  public function clear($cacheDir)
  {
    $watcherCache = $cacheDir . "/" . $this->_cache->getDir();
    if (is_dir($watcherCache)) {
      $filesystem = new Filesystem();
      $filesystem->remove($watcherCache);
    }
  }

}
