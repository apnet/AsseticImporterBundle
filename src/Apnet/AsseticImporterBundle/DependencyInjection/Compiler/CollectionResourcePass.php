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
    $obj = $container->getDefinition("apnet.assetic.importer.compass_project1");
    $obj->getProperties();

    $collection = $container->getDefinition('apnet.assetic.importer_resource');

    $mappers = $container->findTaggedServiceIds('apnet.assetic.asset_mapper');
    foreach ($mappers as $id => $tagAttributes) {
      foreach ($tagAttributes as $attr) {
        if (isset($attr["config"])) {
          $config = $attr["config"];
          $mapper = $container->getDefinition($id);
          $arguments = $mapper->getArguments();

          if (isset($arguments[$config])) {
            $configPath = $container->getParameterBag()
              ->resolveValue($arguments[$config]);

            if (file_exists($configPath)) {
              $configResource = new FileResource($configPath);
              $container->addResource($configResource);
            }
          }
        }
        $collection->addMethodCall('addAssetMapper', array(new Reference($id)));
      }
    }
  }

}
