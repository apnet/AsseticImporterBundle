<?php

/**
 * Adds services tagged as assets to the resource collection
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Adds services tagged as assets to the resource collection
 */
class CollectionResourcePass implements CompilerPassInterface
{

  private $_mapperTags = array(
    'apnet.assetic.asset_mapper',
    'apnet.assetic.config_mapper'
  );

  /**
   * {@inheritdoc}
   */
  public function process(ContainerBuilder $container)
  {
    $collection = $container->getDefinition('apnet.assetic.importer_resource');

    foreach ($this->_mapperTags as $tag) {
      $assets = $container->findTaggedServiceIds($tag);
      foreach ($assets as $id => $tagAttributes) {
        $collection->addMethodCall('addAssetMapper', array(new Reference($id)));
      }
    }
  }

}
