<?php

/**
 * PreImporter configuration
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Parser\PreConfig;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * PreImporter configuration
 */
class Configuration implements ConfigurationInterface
{

  /**
   * {@inheritdoc}
   */
  public function getConfigTreeBuilder()
  {
    $treeBuilder = new TreeBuilder();

    $treeBuilder->root('assets')
      ->defaultValue(array())
      ->useAttributeAsKey('name')
      ->prototype("array")
      /**/->children()
      /*  */->arrayNode('inputs')
      /*    */->defaultValue(array())
      /*    */->prototype('scalar')->end()
      /*  */->end()
      /*  */->arrayNode('filters')
      /*    */->defaultValue(array())
      /*    */->prototype('scalar')->end()
      /*  */->end()
      /*  */->arrayNode('options')
      /*    */->defaultValue(array())
      /*    */->useAttributeAsKey('name')
      /*    */->prototype('variable')->end()
      /*  */->end()
      /**/->end()
      ->end();

    return $treeBuilder;
  }

}
