<?php

/**
 * Loads collected formulae.
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticCompassBundle\Factory\Loader;

use Assetic\Factory\Loader\FormulaLoaderInterface;
use Assetic\Factory\Resource\ResourceInterface;
use Apnet\AsseticCompassBundle\Factory\Resource\CollectionResource;

/**
 * Loads collected formulae.
 */
class CollectionLoader implements FormulaLoaderInterface
{

  /**
   * {@inheritdoc}
   */
  public function load(ResourceInterface $resource)
  {
    return $resource instanceof CollectionResource ? $resource->getContent() : array();
  }

}
