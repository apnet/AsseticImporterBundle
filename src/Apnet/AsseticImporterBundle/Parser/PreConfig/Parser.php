<?php

/**
 * Parser for PreImporter .yml files
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Parser\PreConfig;

use Apnet\AsseticImporterBundle\Parser\ParserAbstract;
use Symfony\Component\Yaml;
use Symfony\Component\Config\Definition\Processor;

/**
 * Parser for PreImporter .yml files
 */
class Parser extends ParserAbstract
{

  /**
   * {@inheritdoc}
   */
  public function parse($input)
  {
    $yml = new Yaml\Parser();
    $data = $yml->parse($input);

    $configuration = new Configuration();
    $processor = new Processor();

    return $processor->processConfiguration($configuration, $data);
  }

}
