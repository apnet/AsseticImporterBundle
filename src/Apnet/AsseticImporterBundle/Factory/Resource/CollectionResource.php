<?php

/**
 * A collection resource
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Factory\Resource;

use Apnet\AsseticImporterBundle\Factory\AssetMapper;
use Symfony\Component\Finder;

/**
 * A collection resource
 */
class CollectionResource implements CollectionResourceInterface
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
    return 'apnet_assetic_importer';
  }

  /**
   * {@inheritdoc}
   */
  public function addAssetMapper(AssetMapper $mapper)
  {
    $items = array();

    foreach ($mapper as $data) {
      list($sourcePath, $targetPath) = $data;

      if (file_exists($sourcePath)) {
        if (is_file($sourcePath)) {
          $items[$targetPath] = $sourcePath;
        } elseif (is_dir($sourcePath)) {
          $finder = new Finder\Finder();

          foreach ($finder->in($sourcePath)->files() as $file) {
            /* @var $file Finder\SplFileInfo */
            $fileTargetPath = $targetPath . "/" . $file->getRelativePathname();
            $items[$fileTargetPath] = $file->getPathname();
          }
        }
      }
    }

    foreach ($items as $target => $source) {
      $inputs = array($source);

      $name = $this->getFormulaeName($target);
      $options = array("name" => $name, "output" => $target);
      $this->_formulae[$name] = array($inputs, array(), $options);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getFormulaeName($target)
  {
    $target = trim($target, "/");

    return "importer_" . md5($target);
  }

}
