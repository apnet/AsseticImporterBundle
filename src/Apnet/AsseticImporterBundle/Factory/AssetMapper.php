<?php

/**
 * Asset mapper
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Factory;

/**
 * Asset mapper
 */
class AssetMapper implements \IteratorAggregate, \Countable
{

  /**
   * @var array
   */
  private $_relations;

  /**
   * Public constructor
   */
  public function __construct()
  {
    $this->_relations = array();
  }

  /**
   * Add new relation between source and target paths
   *
   * @param string $sourcePath Source path
   * @param string $targetPath Target path
   *
   * @return $this
   */
  public function add($sourcePath, $targetPath)
  {
    $this->_relations[] = array($sourcePath, $targetPath);

    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getIterator()
  {
    return new \ArrayIterator($this->_relations);
  }

  /**
   * {@inheritdoc}
   */
  public function count()
  {
    return sizeof($this->_relations);
  }

  /**
   * Return paths relation
   *
   * @param integer $offset Item offset
   *
   * @return array
   */
  public function item($offset)
  {
    if (isset($this->_relations[$offset])) {
      $item = $this->_relations[$offset];
    } else {
      $item = null;
    }
    return $item;
  }

}
