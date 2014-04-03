<?php

namespace Apnet\AsseticImporterBundle\Twig\Extension;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Routing\RouteCollection;
use Apnet\AsseticImporterBundle\Factory\Resource\CollectionResourceInterface;

class ImporterExtension extends \Twig_Extension
{

  /**
   * @var RouteCollection
   */
  private $_router;

  /**
   * @var CollectionResourceInterface
   */
  private $_res;

  /**
   * Public constructor
   *
   * @param Router                      $router Router
   * @param CollectionResourceInterface $res    Resource collection
   */
  public function __construct(Router $router, CollectionResourceInterface $res)
  {
    $this->_router = $router;
    $this->_res = $res;
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
    return $this->_router->generate(
      "_assetic_" . $this->_res->getFormulaeName($path),
      $parameters
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getName()
  {
    return 'apnet_importer_extension';
  }

}
