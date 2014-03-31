<?php

/**
 * Test simple lexer for config.rb file
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Tests\Factory\Importer\Lexer;

use Apnet\AsseticImporterBundle\Lexer\CompassConfigLexer;

/**
 * Test simple lexer for config.rb file
 */
class CompassConfigLexerTest extends \PHPUnit_Framework_TestCase
{

  /**
   * Test lexer
   *
   * @return null
   */
  public function testLexer()
  {
    $tokens = $this->_getTokens(
      implode(
        PHP_EOL,
        array(
          "# comment",
          "v1='qwe':\"asd\" false 1 1.2"
        )
      )
    );
    foreach ($tokens as $key => $value) {
      $tokens[$key] = array($value["value"], $value["type"]);
    }

    $this->assertEquals(
      array(
        array("v1", CompassConfigLexer::T_IDENTIFIER),
        array("=", CompassConfigLexer::T_EQUALS),
        array("qwe", CompassConfigLexer::T_STRING),
        array(":", CompassConfigLexer::T_COLON),
        array("asd", CompassConfigLexer::T_STRING),
        array("false", CompassConfigLexer::T_FALSE),
        array("1", CompassConfigLexer::T_NUMERIC),
        array("1.2", CompassConfigLexer::T_NUMERIC),
      ),
      $tokens
    );
  }

  /**
   * Get parsed tokens
   *
   * @param string $input Input
   *
   * @return array
   */
  private function _getTokens($input)
  {
    $tokens = array();

    $lexer = new CompassConfigLexer();
    $lexer->setInput($input);
    $lexer->moveNext();

    while ($lexer->lookahead) {
      $tokens[] = $lexer->lookahead;
      $lexer->moveNext();
    }
    return $tokens;
  }

}
