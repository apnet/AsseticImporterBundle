<?php

/**
 * Source files watcher interface
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Factory\Watcher;

/**
 * Source files watcher interface
 */
interface WatcherInterface
{

  /**
   * Get watcher type
   *
   * @return string
   */
  public function getType();

}
