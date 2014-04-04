<?php

/**
 * Source files watcher interface
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticWatcherBundle\Factory\Watcher;

/**
 * Source files watcher interface
 */
interface WatcherInterface
{

  /**
   * Set config path
   *
   * @param string $configPath Path to config file
   *
   * @return null
   */
  public function addConfigPath($configPath);

  /**
   * Get watcher type
   *
   * @return string
   */
  public function getType();

}
