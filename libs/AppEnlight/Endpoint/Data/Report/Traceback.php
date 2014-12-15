<?php

/**
 * @link: https://github.com/aztech/app-enlight-php-client
 * @link: http://appenlight.com
 * @package AppEnlight
 *
 * @author Tomasz Suchanek <tomasz.suchanek@gmail.com>
 */

namespace AppEnlight\Endpoint\Data\Report;

/**
 * Traceback part of report details
 */
class Traceback {

  /**
   * @var string
   */
  protected $_cline;

  /**
   * @var string
   */
  protected $_file;

  /**
   * @var string
   */
  protected $_fn;

  /**
   * @var integer
   */
  protected $_line;

  /**
   * @var array
   */
  protected $_vars;

  /**
   * @return string
   */
  public function getCline() {
    return $this->_cline;
  }

  /**
   * @return string
   */
  public function getFile() {
    return $this->_file;
  }

  /**
   * @return string
   */
  public function getFn() {
    return $this->_fn;
  }

  /**
   * @return integer
   */
  public function getLine() {
    return $this->_line;
  }

  /**
   * @return string
   */
  public function getVars() {
    return $this->_vars;
  }

  /**
   * @param string $cline
   * @return \AppEnlight\Endpoint\Data\Report\Traceback
   */
  public function setCline($cline) {
    $this->_cline = $cline;
    return $this;
  }

  /**
   * @param string $file
   * @return \AppEnlight\Endpoint\Data\Report\Traceback
   */
  public function setFile($file) {
    $this->_file = $file;
    return $this;
  }

  /**
   * @param string $fn
   * @return \AppEnlight\Endpoint\Data\Report\Traceback
   */
  public function setFn($fn) {
    $this->_fn = $fn;
    return $this;
  }

  /**
   *
   * @param integer $line
   * @return \AppEnlight\Endpoint\Data\Report\Traceback
   */
  public function setLine($line) {
    $this->_line = (int) $line;
    return $this;
  }

  /**
   *
   * @param array $vars
   * @return \AppEnlight\Endpoint\Data\Report\Traceback
   */
  public function setVars($vars) {
    $this->_vars = $vars;
    return $this;
  }

  /**
   * @return array
   */
  public function toArray() {
    return array(
      'cline' => $this->getCline(),
      'file' => $this->getFile(),
      'fn' => $this->getFn(),
      'line' => $this->getLine(),
      'vars' => $this->getVars(),
    );
  }

}
