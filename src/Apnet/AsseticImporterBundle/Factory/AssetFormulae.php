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
  private $_inputs;

  /**
   * @var array
   */
  private $_filters;

  /**
   * @var array
   */
  private $_options;

  /**
   * Public constructor
   */
  public function __construct()
  {
    $this->_inputs = array();
    $this->_filters = array();
    $this->_options = array();
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
    $this->_filters = $filters;

    return $this;
  }

  /**
   * Get filters
   *
   * @return array
   */
  public function getFilters()
  {
    return $this->_filters;
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
    $this->_inputs = $inputs;

    return $this;
  }

  /**
   * Get inputs
   *
   * @return array
   */
  public function getInputs()
  {
    return $this->_inputs;
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
    $this->_options = $options;

    return $this;
  }

  /**
   * Get options
   *
   * @return array
   */
  public function getOptions()
  {
    return $this->_options;
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
    return isset($this->_options[$name]);
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
      $option = $this->_options[$name];
    } else {
      $option = null;
    }
    return $option;
  }

}
