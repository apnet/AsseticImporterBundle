<?php

/**
 * Compass source files watcher
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticWatcherBundle\Factory\Watcher;

use Apnet\AsseticImporterBundle\Parser\ParserInterface;
use Symfony\Component\Process\Process;

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
    $this->_config = array();
  }

  /**
   * {@inheritdoc}
   */
  public function getChildren($configPath)
  {
    $config = $this->_parser->load($configPath);

    $children = array();
    if (isset($config["sass_dir"])) {
      $children[] = dirname($configPath) . "/" . $config["sass_dir"];
    }
    return $children;
  }

  /**
   * {@inheritdoc}
   */
  public function compile($configPath)
  {
    $process = new Process("compass compile", dirname($configPath));
    $process->run();
    if (!$process->isSuccessful()) {
      throw new WatcherCompileException($process->getErrorOutput());
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getType()
  {
    return "compass";
  }

}
