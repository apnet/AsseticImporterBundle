<?php

/**
 * Simple parser for config.rb file
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Parser;

use Apnet\AsseticImporterBundle\Lexer\CompassConfigLexer;

/**
 * Simple parser for config.rb file
 */
class CompassConfigParser implements ParserInterface
{

  /**
   * {@inheritdoc}
   */
  public function parse($input)
  {
    $lexer = new CompassConfigLexer();
    $lexer->setInput($input);

    $config = array();
    while ($lexer->moveNext()) {
      if ($lexer->lookahead["type"] != CompassConfigLexer::T_IDENTIFIER) {
        break;
      } else {
        $name = $lexer->lookahead["value"];
      }

      if (!$lexer->moveNext()) {
        break;
      } elseif ($name == 'require') {
        if ($lexer->lookahead["type"] == CompassConfigLexer::T_STRING) {
          continue;
        } else {
          break;
        }
      } elseif ($lexer->lookahead["type"] != CompassConfigLexer::T_EQUALS) {
        break;
      } elseif (!$lexer->moveNext()) {
        break;
      } elseif ($lexer->lookahead["type"] == CompassConfigLexer::T_COLON) {

        if (!$lexer->moveNext()) {
          break;
        } elseif ($lexer->lookahead["type"] != CompassConfigLexer::T_IDENTIFIER) {
          break;
        } else {
          $configName = $lexer->lookahead["value"];
          if (isset($config["$configName"])) {
            $value = $config["$configName"];
          } else {
            continue;
          }
        }

      } else {

        switch ($lexer->lookahead["type"]) {
          case CompassConfigLexer::T_TRUE:
            $value = true;
            break;
          case CompassConfigLexer::T_FALSE:
            $value = false;
            break;
          case CompassConfigLexer::T_STRING:
            $value = $lexer->lookahead["value"];
            break;
          case CompassConfigLexer::T_NUMERIC:
            $value = 1 * $lexer->lookahead["value"];
            break;
          default:
            break 2;
        }

      }

      $config[$name] = $value;
    }
    return $config;
  }

  /**
   * {@inheritdoc}
   */
  public function load($path)
  {
    // @todo validate $path
    return $this->parse(
      file_get_contents($path)
    );
  }

}
