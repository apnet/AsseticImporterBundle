<?php

/**
 * SourceCode watchers cache warmer
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticWatcherBundle\Cache;

use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;
use Apnet\AsseticWatcherBundle\Factory\SourceCodeWatcher;

/**
 * SourceCode watchers cache warmer
 */
class SourceCodeCacheWarmer implements CacheWarmerInterface
{

  /**
   * @var SourceCodeWatcher
   */
  private $_watcher;

  /**
   * Public constructor
   *
   * @param SourceCodeWatcher $watcher SourceCode watcher
   */
  public function __construct(SourceCodeWatcher $watcher)
  {
    $this->_watcher = $watcher;
  }

  /**
   * {@inheritdoc}
   */
  public function warmUp($cacheDir)
  {
    $this->_watcher->compile();
  }

  /**
   * {@inheritdoc}
   */
  public function isOptional()
  {
    return true;
  }
}
