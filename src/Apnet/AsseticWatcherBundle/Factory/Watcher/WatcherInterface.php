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
   * Get dependencies
   *
   * @param string $configPath Path to config file
   *
   * @return array
   */
  public function getChildren($configPath);

  /**
   * Run compilation
   *
   * @param string $configPath Path to config file
   *
   * @return null
   */
  public function compile($configPath);

  /**
   * Get watcher type
   *
   * @return string
   */
  public function getType();

}
