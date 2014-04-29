<?php

/**
 * Asset formulae
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Factory;

/**
 * Asset formulae
 */
class AssetFormulae
{

  /**
   * @var array
   */
  private $inputs;

  /**
   * @var array
   */
  private $filters;

  /**
   * @var array
   */
  private $options;

  /**
   * Public constructor
   */
  public function __construct()
  {
    $this->inputs = array();
    $this->filters = array();
    $this->options = array();
  }

  /**
   * Set filters
   *
   * @param array $filters Filters
   *
   * @return $this
   */
  public function setFilters(array $filters)
  {
    $this->filters = $filters;

    return $this;
  }

  /**
   * Get filters
   *
   * @return array
   */
  public function getFilters()
  {
    return $this->filters;
  }

  /**
   * Set inputs
   *
   * @param array $inputs Inputs
   *
   * @return $this
   */
  public function setInputs(array $inputs)
  {
    $this->inputs = $inputs;

    return $this;
  }

  /**
   * Get inputs
   *
   * @return array
   */
  public function getInputs()
  {
    return $this->inputs;
  }

  /**
   * Set options
   *
   * @param array $options Options
   *
   * @return $this
   */
  public function setOptions(array $options)
  {
    $this->options = $options;

    return $this;
  }

  /**
   * Get options
   *
   * @return array
   */
  public function getOptions()
  {
    return $this->options;
  }

  /**
   * Is option exists
   *
   * @param string $name Option name
   *
   * @return bool
   */
  public function hasOption($name)
  {
    return isset($this->options[$name]);
  }

  /**
   * Get option by name
   *
   * @param string $name Option name
   *
   * @return string
   */
  public function getOption($name)
  {
    if ($this->hasOption($name)) {
      $option = $this->options[$name];
    } else {
      $option = null;
    }
    return $option;
  }
}
