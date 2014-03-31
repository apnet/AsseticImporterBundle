<?php

/**
 * Parser interface
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Parser;

/**
 * Parser interface
 */
interface ParserInterface
{

  /**
   * Parse input text and return project config data
   *
   * @param string $input Input text
   *
   * @return array
   */
  public function parse($input);

}
