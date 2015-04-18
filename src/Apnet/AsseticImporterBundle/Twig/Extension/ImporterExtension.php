<?php

namespace Apnet\AsseticImporterBundle\Twig\Extension;

use Symfony\Component\Routing\RouterInterface;
use Apnet\AsseticImporterBundle\Factory\Resource\CollectionResourceInterface;
use Symfony\Bridge\Twig\Extension\AssetExtension;

/**
 * Twig extension
 */
class ImporterExtension extends \Twig_Extension
{

  /**
   * @var bool
   */
  private $useController;

  /**
   * @var RouterInterface
   */
  private $router;

  /**
   * @var CollectionResourceInterface
   */
  private $res;

  /**
   * @var AssetExtension
   */
  private $assets;

  /**
   * Public constructor
   *
   * @param bool $useController Use controller
   */
  public function __construct($useController)
  {
    $this->useController = $useController;
  }

  /**
   * {@inheritdoc}
   */
  public function getFunctions()
  {
    return array(
      new \Twig_SimpleFunction('imported_asset', array($this, 'importedAsset')),
    );
  }

  /**
   * Return absolute path to imported asset
   *
   * @param string $path       Target import path
   * @param array  $parameters Parameters
   *
   * @return string
   */
  public function importedAsset($path, $parameters = array())
  {
    if ($this->useController) {
      $path = $this->router->generate(
        "_assetic_" . $this->res->getFormulaeName($path),
        $parameters
      );
    } else {
      $path = $this->assets->getAssetUrl(
        ltrim($path, "/")
      );
    }

    return $path;
  }

  /**
   * {@inheritdoc}
   */
  public function getName()
  {
    return 'apnet_importer_extension';
  }

  /**
   * Set router
   *
   * @param RouterInterface $router Router
   *
   * @return null
   */
  public function setRouter(RouterInterface $router)
  {
    $this->router = $router;
  }

  /**
   * Set collection resource
   *
   * @param CollectionResourceInterface $res Collection resource
   *
   * @return null
   */
  public function setCollectionResource(CollectionResourceInterface $res)
  {
    $this->res = $res;
  }

  /**
   * Set Twig AssetExtension
   *
   * @param AssetExtension $assetExtension Assets extension
   *
   * @return null
   */
  public function setAssetsExtension(AssetExtension $assetExtension)
  {
    $this->assets = $assetExtension;
  }
}
