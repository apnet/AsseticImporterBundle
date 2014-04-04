<?php

/**
 * Adds services tagged as watchers to list
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Adds services tagged as watchers to list
 */
class SourceCodeWatcherPass implements CompilerPassInterface
{

  /**
   * {@inheritdoc}
   */
  public function process(ContainerBuilder $container)
  {
    $collection = $container->getDefinition('apnet.assetic.source_watcher');

    $assets = $container->findTaggedServiceIds('apnet.assetic.source_watcher');
    foreach ($assets as $id => $tagAttributes) {
      $collection->addMethodCall('addWatcher', array(new Reference($id)));
    }
  }

}
