<?php

/**
 * A collection resource interface
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Factory\Resource;

use Assetic\Factory\Resource\ResourceInterface;
use Apnet\AsseticImporterBundle\Factory\AssetMapper;

/**
 * A collection resource interface
 */
interface CollectionResourceInterface extends ResourceInterface
{

  /**
   * Add asset mapper
   *
   * @param AssetMapper $mapper Asset mapper object
   *
   * @return null
   */
  public function addAssetMapper(AssetMapper $mapper);

  /**
   * Get formulae name option
   *
   * @param string $target Target path
   *
   * @return string
   */
  public function getFormulaeName($target);
}
