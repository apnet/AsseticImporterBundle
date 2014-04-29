<?php

/**
 * Asset mapper
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Factory;

use Symfony\Component\Finder;

/**
 * Asset mapper
 */
class AssetMapper
{

  /**
   * @var AssetFormulae[]
   */
  private $formulae;

  /**
   * Public constructor
   */
  public function __construct()
  {
    $this->formulae = array();
  }

  /**
   * Add new formulae
   *
   * @param AssetFormulae $formulae Formulae
   *
   * @return $this
   */
  public function append(AssetFormulae $formulae)
  {
    $this->formulae[] = $formulae;

    return $this;
  }

  /**
   * Map files from source to target path
   *
   * @param string $sourcePath Source path
   * @param string $targetPath Target path
   *
   * @return null
   */
  public function map($sourcePath, $targetPath)
  {
    if (file_exists($sourcePath)) {
      $items = array();
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

      foreach ($items as $target => $source) {
        $formulae = new AssetFormulae();
        $formulae->setInputs(
          array($source)
        );
        $formulae->setOptions(
          array("output" => $target)
        );

        $this->append($formulae);
      }
    }
  }

  /**
   * Get formulae list
   *
   * @return AssetFormulae[]
   */
  public function getFormulae()
  {
    return $this->formulae;
  }

  /**
   * Return paths relation
   *
   * @param integer $offset Item offset
   *
   * @return AssetFormulae|null
   */
  public function item($offset)
  {
    if (isset($this->formulae[$offset])) {
      $item = $this->formulae[$offset];
    } else {
      $item = null;
    }
    return $item;
  }
}
