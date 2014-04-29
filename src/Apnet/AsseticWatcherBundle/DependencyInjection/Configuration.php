<?php

/**
 * Bundle configuration
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticWatcherBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Bundle configuration
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class Configuration implements ConfigurationInterface
{

  /**
   * {@inheritdoc}
   */
  public function getConfigTreeBuilder()
  {
    $treeBuilder = new TreeBuilder();
    $rootNode = $treeBuilder->root('apnet_assetic_watcher');

    $rootNode
      ->children()
      /**/->scalarNode('compiler_root')->defaultNull()->end()
      /**/->booleanNode('enabled')->defaultFalse()->end()
      ->end();

    return $treeBuilder;
  }
}
