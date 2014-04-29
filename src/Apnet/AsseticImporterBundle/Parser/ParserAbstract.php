<?php

/**
 * Parser common abstract
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Parser;

/**
 * Parser common abstract
 */
abstract class ParserAbstract implements ParserInterface
{

  /**
   * {@inheritdoc}
   */
  public function load($path)
  {
    return $this->parse(
      file_get_contents($path)
    );
  }
}
