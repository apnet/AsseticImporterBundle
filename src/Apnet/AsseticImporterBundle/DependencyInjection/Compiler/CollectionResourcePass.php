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
use Symfony\Component\Config\Resource\FileResource;

/**
 * Adds services tagged as assets to the resource collection
 */
class CollectionResourcePass implements CompilerPassInterface
{

  /**
   * {@inheritdoc}
   */
  public function process(ContainerBuilder $container)
  {
    $collection = $container->getDefinition('apnet.assetic.importer_resource');

    $assets = $container->findTaggedServiceIds('apnet.assetic.asset_mapper');
    foreach ($assets as $id => $tagAttributes) {
      $collection->addMethodCall('addAssetMapper', array(new Reference($id)));
    }

    $watcher = $container->getDefinition('apnet.assetic.asset_watcher');

    $parameterBag = $container->getParameterBag();
    $configs = $container->findTaggedServiceIds('apnet.assetic.config_mapper');
    foreach ($configs as $id => $tagAttributes) {
      $collection->addMethodCall('addAssetMapper', array(new Reference($id)));

      $configPath = $parameterBag->resolveValue(
        $container->getDefinition($id)->getArgument(0)
      );

      $configResource = new FileResource($configPath);
      $container->addResource($configResource);
      foreach ($tagAttributes as $attr) {
        if (isset($attr["watcher"])) {
          $watcher->addMethodCall('addConfig', array($configPath, $attr["watcher"]));
        }
      }
    }
  }

}
