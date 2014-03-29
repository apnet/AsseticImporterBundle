<?php

/**
 * A collection resource
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticCompassBundle\Factory\Resource;

use Assetic\Factory\Resource\ResourceInterface;
use Apnet\AsseticCompassBundle\Factory\AssetResource;
use Symfony\Component\Finder;

/**
 * A collection resource
 */
class CollectionResource implements ResourceInterface
{

  /**
   * @var array
   */
  private $_formulae;

  /**
   * Public constructor
   */
  public function __construct()
  {
    $this->_formulae = array();
  }

  /**
   * {@inheritdoc}
   */
  public function isFresh($timestamp)
  {
    return true;
  }

  /**
   * {@inheritdoc}
   */
  public function getContent()
  {
    return $this->_formulae;
  }

  /**
   * {@inheritdoc}
   */
  public function __toString()
  {
    return 'apnet_assetic_compass';
  }

  /**
   * Add single item to collection
   *
   * @param string $sourcePath Absolute path to asset
   * @param string $targetPath Relative target path
   *
   * @return null
   */
  public function addItem($sourcePath, $targetPath)
  {
    $name = md5($sourcePath);
    $this->_formulae[$name] = array(
      array($sourcePath), array(), array("output" => $targetPath)
    );
  }

  /**
   * Add asset to manager
   *
   * @param AssetResource $resource Asset resource
   *
   * @return null
   */
  public function addResource(AssetResource $resource)
  {
    $sourcePath = $resource->getSourcePath();
    $targetPath = $resource->getTargetPath();

    if (!file_exists($sourcePath)) {
      return;
    } elseif (is_file($sourcePath)) {
      $this->addItem($sourcePath, $targetPath);
    } elseif (is_dir($sourcePath)) {
      $finder = new Finder\Finder();

      foreach ($finder->in($sourcePath)->files() as $file) {
        /* @var $file Finder\SplFileInfo */
        $this->addItem(
          $file->getPathname(), $targetPath . "/" . $file->getRelativePathname()
        );
      }
    }
  }
}
