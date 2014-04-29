<?php

/**
 * Importer from path
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Factory\Importer;

use Apnet\AsseticImporterBundle\Factory\AssetMapper;

/**
 * Importer from path
 */
class PathImporter
{

  /**
   * Add asset mapper from file or directory path
   *
   * @param string $sourcePath File or directory path
   * @param string $targetPath Target path
   *
   * @return AssetMapper
   */
  public function load($sourcePath, $targetPath)
  {
    $mapper = new AssetMapper();
    $mapper->map($sourcePath, $targetPath);

    return $mapper;
  }
}
