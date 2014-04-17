<?php

/**
 * Path watcher
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticWatcherBundle\Factory\Watcher;

/**
 * Path watcher with no action
 */
class PathWatcher implements WatcherInterface
{

  /**
   * {@inheritdoc}
   */
  public function getChildren($configPath)
  {
    return array();
  }

  /**
   * {@inheritdoc}
   */
  public function compile($configPath)
  {

  }

  /**
   * {@inheritdoc}
   */
  public function getType()
  {
    return "path";
  }

}
