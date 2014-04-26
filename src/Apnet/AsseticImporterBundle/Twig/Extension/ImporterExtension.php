<?php

namespace Apnet\AsseticImporterBundle\Twig\Extension;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Apnet\AsseticImporterBundle\Factory\Resource\CollectionResourceInterface;
use Symfony\Bundle\TwigBundle\Extension\AssetsExtension;

class ImporterExtension extends \Twig_Extension
{

  /**
   * @var bool
   */
  private $_useController;

  /**
   * @var Router
   */
  private $_router;

  /**
   * @var CollectionResourceInterface
   */
  private $_res;

  /**
   * @var AssetsExtension
   */
  private $_assets;

  /**
   * Public constructor
   *
   * @param bool $useController Use controller
   */
  public function __construct($useController)
  {
    $this->_useController = $useController;
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
    if ($this->_useController) {
      $path = $this->_router->generate(
        "_assetic_" . $this->_res->getFormulaeName($path),
        $parameters
      );
    } else {
      $path = $this->_assets->getAssetUrl(
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
   * @param Router $router Router
   *
   * @return null
   */
  public function setRouter(Router $router)
  {
    $this->_router = $router;
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
    $this->_res = $res;
  }

  /**
   * Set TwigBundle AssetsExtension
   *
   * @param AssetsExtension $assetsExtension Assets extension
   *
   * @return null
   */
  public function setAssetsExtension(AssetsExtension $assetsExtension)
  {
    $this->_assets = $assetsExtension;
  }

}
