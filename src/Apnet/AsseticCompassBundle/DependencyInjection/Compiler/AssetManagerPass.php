<?php

/**
 * Adds services tagged as assets to the asset manager.
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticCompassBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Adds services tagged as assets to the asset manager.
 */
class AssetManagerPass implements CompilerPassInterface
{

  /**
   * {@inheritdoc}
   */
  public function process(ContainerBuilder $container)
  {
    $collection = $container->getDefinition('apnet.assetic.compass_resource');

    foreach ($container->findTaggedServiceIds('apnet.assetic.resource') as $id => $attributes) {
      $collection->addMethodCall('addResource', array(new Reference($id)));
    }
  }

}
