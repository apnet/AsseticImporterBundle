<?php

/**
 * Simple lexer for config.rb file
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Lexer;

use Doctrine\Common\Lexer\AbstractLexer;

/**
 * Simple lexer for config.rb file
 *
 * @see Doctrine\Common\Annotations\DocLexer
 */
class CompassConfigLexer extends AbstractLexer
{

  const T_NONE                = 1;
  const T_NUMERIC             = 2;
  const T_STRING              = 3;

  const T_IDENTIFIER          = 100;
  const T_EQUALS              = 105;
  const T_FALSE               = 106;
  const T_TRUE                = 110;
  const T_COLON               = 112;

  protected $_noCase = array(
    '='  => self::T_EQUALS,
    ':'  => self::T_COLON,
  );

  protected $_withCase = array(
    'true'  => self::T_TRUE,
    'false' => self::T_FALSE,
  );

  /**
   * {@inheritdoc}
   */
  protected function getCatchablePatterns()
  {
    return array(
      '[a-z_][a-z0-9_]*',
      '(?:[+-]?[0-9]+(?:[\.][0-9]+)*)?',
      '"(?:[^"]|"")*"',
      "'(?:[^']|'')*'",
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getNonCatchablePatterns()
  {
    return array(
      '#.*', '\s+', '\*+', '(.)',
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getType(&$value)
  {
    $type = self::T_NONE;

    if ($value[0] === '"' || $value[0] === "'") {
      $value = substr($value, 1, -1);
      return self::T_STRING;
    }

    if (isset($this->_noCase[$value])) {
      return $this->_noCase[$value];
    }

    $lowerValue = strtolower($value);
    if (isset($this->_withCase[$lowerValue])) {
      return $this->_withCase[$lowerValue];
    }

    if (ctype_alpha($value[0])) {
      return self::T_IDENTIFIER;
    }

    if (is_numeric($value)) {
      return self::T_NUMERIC;
    }

    return $type;
  }

}
