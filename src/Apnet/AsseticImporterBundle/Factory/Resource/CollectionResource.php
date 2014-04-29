<?php

/**
 * A collection resource
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Factory\Resource;

use Apnet\AsseticImporterBundle\Factory\AssetMapper;

/**
 * A collection resource
 */
class CollectionResource implements CollectionResourceInterface
{

  /**
   * @var array
   */
  private $formulae;

  /**
   * Public constructor
   */
  public function __construct()
  {
    $this->formulae = array();
  }

  /**
   * {@inheritdoc}
   */
  public function isFresh($timestamp)
  {
    return true;
  }

  /**
   * {@inheritdoc}
   */
  public function getContent()
  {
    return $this->formulae;
  }

  /**
   * {@inheritdoc}
   */
  public function __toString()
  {
    return 'apnet_assetic_importer';
  }

  /**
   * {@inheritdoc}
   */
  public function addAssetMapper(AssetMapper $mapper)
  {
    foreach ($mapper->getFormulae() as $data) {
      $inputs = $data->getInputs();
      if (!sizeof($inputs)) {
        throw new \RuntimeException("Inputs was not set");
      }
      $filters = $data->getFilters();
      $options = $data->getOptions();
      if (!isset($options["output"])) {
        throw new \RuntimeException("'output' option was not set");
      }
      $name = $this->getFormulaeName($options["output"]);
      $options["name"] = $name;
      $this->formulae[$name] = array($inputs, $filters, $options);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getFormulaeName($target)
  {
    $target = trim($target, "/");

    return "importer_" . md5($target);
  }
}
