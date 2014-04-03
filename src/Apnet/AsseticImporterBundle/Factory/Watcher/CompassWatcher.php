<?php

/**
 * Compass source files watcher
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Factory\Watcher;

use Apnet\AsseticImporterBundle\Parser\ParserInterface;

/**
 * Compass source files watcher
 */
class CompassWatcher implements WatcherInterface
{

  /**
   * @var ParserInterface
   */
  private $_parser;

  /**
   * Public constructor
   *
   * @param ParserInterface $parser Config parser
   */
  public function __construct(ParserInterface $parser)
  {
    $this->_parser = $parser;
  }

  /**
   * {@inheritdoc}
   */
  public function getType()
  {
    return "compass";
  }

}
