<?php

/**
 * Adds services tagged as watchers to list
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticWatcherBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\Resource\FileResource;

/**
 * Adds services tagged as watchers to list
 */
class SourceCodePass implements CompilerPassInterface
{

  /**
   * {@inheritdoc}
   */
  public function process(ContainerBuilder $container)
  {
    $watcher = $container->getDefinition('apnet.assetic.source_watcher');

    $parameterBag = $container->getParameterBag();
    $configs = $container->findTaggedServiceIds('apnet.assetic.config_mapper');
    foreach ($configs as $id => $tagAttributes) {
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
