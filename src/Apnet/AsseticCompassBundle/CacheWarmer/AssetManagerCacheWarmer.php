<?php

/**
 * The AssetManagerCacheWarmer warms up the formula loader.
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticCompassBundle\CacheWarmer;

use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;
use Apnet\AsseticCompassBundle\Factory\AssetManager;

/**
 * The AssetManagerCacheWarmer warms up the formula loader.
 */
class AssetManagerCacheWarmer implements CacheWarmerInterface
{

  /**
   * Public constructor
   */
  public function __construct()
  {

  }

  /**
   * {@inheritdoc}
   */
  public function warmUp($cacheDir)
  {

  }

  /**
   * {@inheritdoc}
   */
  public function isOptional()
  {
    return true;
  }

}