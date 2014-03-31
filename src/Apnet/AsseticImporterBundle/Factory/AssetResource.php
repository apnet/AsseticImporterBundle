<?php

/**
 * File or directory resource
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Factory;

/**
 * File or directory resource
 */
class AssetResource
{

  /**
   * @var string
   */
  private $_sourcePath;

  /**
   * @var string
   */
  private $_targetPath;

  /**
   * Public constructor
   *
   * @param string $sourcePath Real path
   * @param string $targetPath Relative assetic path
   */
  public function __construct($sourcePath, $targetPath)
  {
    $this->_sourcePath = $sourcePath;
    $this->_targetPath = $targetPath;
  }

  /**
   * Get source path
   *
   * @return string
   */
  public function getSourcePath()
  {
    return $this->_sourcePath;
  }

  /**
   * Get target path
   *
   * @return string
   */
  public function getTargetPath()
  {
    return $this->_targetPath;
  }

}
