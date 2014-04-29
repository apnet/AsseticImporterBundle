<?php

/**
 * Bundle configuration
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\DependencyInjection;

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
    $rootNode = $treeBuilder->root('apnet_assetic_importer');

    $rootNode
      ->children()
      /**/->arrayNode('assets')
      /*  */->addDefaultChildrenIfNoneSet(array())
      /*  */->requiresAtLeastOneElement()
      /*  */->useAttributeAsKey('name')
      /*  */->prototype('array')
      /*    */->children()
      /*      */->scalarNode('source')->isRequired()->end()
      /*      */->scalarNode('target')->defaultNull()->end()
      /*      */->scalarNode('importer')->defaultValue('path')->end()
      /*      */->booleanNode('watcher')->defaultFalse()->end()
      /*    */->end()
      /*  */->end()
      /**/->end()
      ->end();

    return $treeBuilder;
  }
}
