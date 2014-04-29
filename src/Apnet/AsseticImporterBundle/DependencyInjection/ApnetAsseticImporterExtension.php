<?php

/**
 * This is the class that loads and manages your bundle configuration
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class ApnetAsseticImporterExtension extends Extension
{

  /**
   * {@inheritdoc}
   */
  public function load(array $configs, ContainerBuilder $container)
  {
    $configuration = new Configuration();
    $config = $this->processConfiguration($configuration, $configs);

    foreach ($config["assets"] as $assetName => $asset) {
      $importer = $asset["importer"];
      if (is_null($importer)) {
        $importer = "path";
      }

      $importerDefinition = new DefinitionDecorator("assetic.importer_" . $importer);

      $sourcePath = $asset["source"];
      if (is_null($asset["target"])) {
        $targetPath = $assetName;
      } else {
        $targetPath = $asset["target"];
      }
      $importerDefinition->setArguments(
        array($sourcePath, $targetPath)
      );

      $tagAttributes = array();
      if ($importer == "path") {
        $tagName = "apnet.assetic.asset_mapper";
      } else {
        $tagName = "apnet.assetic.config_mapper";
        if ($asset["watcher"]) {
          $tagAttributes["watcher"] = $importer;
        }
      }
      $importerDefinition->addTag($tagName, $tagAttributes);

      $container->setDefinition(
        "apnet.assetic.importer.config." . $importer, $importerDefinition
      );
    }

    $loader = new Loader\YamlFileLoader(
      $container,
      new FileLocator(__DIR__ . '/../Resources/config')
    );
    $loader->load('services.yml');
    $loader->load('path.yml');
    $loader->load('compass.yml');
    $loader->load('pre.yml');
  }
}
