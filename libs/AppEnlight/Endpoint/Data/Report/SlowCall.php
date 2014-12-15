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
 * Slow call part of report details
 */
class SlowCall {

  /**
   * @var timestamp
   */
  protected $_start;

  /**
   * @var timestamp
   */
  protected $_end;

  /**
   * @var string
   */
  protected $_type;

  /**
   * @var string
   */
  protected $_subtype;

  /**
   * @var array
   */
  protected $_parameters;

  /**
   * @var string
   */
  protected $_statement;

  /**
   * @param timestamp $start
   * @return \AppEnlight\Endpoint\Data\Report\SlowCall
   */
  public function setStart($start) {
    $this->_start = $start;
    return $this;
  }

  /**
   * @param timestamp $end
   * @return \AppEnlight\Endpoint\Data\Report\SlowCall
   */
  public function setEnd($end) {
    $this->_end = $end;
    return $this;
  }

  /**
   * @param string $type
   * @return \AppEnlight\Endpoint\Data\Report\SlowCall
   */
  public function setType($type) {
    $this->_type = $type;
    return $this;
  }

  /**
   * @param string $subtype
   * @return \AppEnlight\Endpoint\Data\Report\SlowCall
   */
  public function setSubtype($subtype) {
    $this->_subtype = $subtype;
    return $this;
  }

  /**
   * @param array $parameters
   * @return \AppEnlight\Endpoint\Data\Report\SlowCall
   */
  public function setParameters($parameters) {
    $this->_parameters = $parameters;
    return $this;
  }

  /**
   * @param string $statement
   * @return \AppEnlight\Endpoint\Data\Report\SlowCall
   */
  public function setStatement($statement) {
    $this->_statement = $statement;
    return $this;
  }

  /**
   * @return float
   */
  public function getStart() {
    return $this->_start;
  }

  /**
   * @return timestamp
   */
  public function getEnd() {
    return $this->_end;
  }

  /**
   * @return string
   */
  public function getType() {
    return $this->_type;
  }

  /**
   * @return string
   */
  public function getSubtype() {
    return $this->_subtype;
  }

  /**
   * @return array
   */
  public function getParameters() {
    return $this->_parameters;
  }

  /**
   * @return string
   */
  public function getStatement() {
    return $this->_statement;
  }

  /**
   * @return array
   */
  public function toArray() {
    return array(
      'start' => $this->getStart(),
      'end' => $this->getEnd(),
      'type' => $this->getType(),
      'subtype' => $this->getSubtype(),
      'parameters' => $this->getParameters(),
      'statement' => $this->getStatement(),
    );
  }

}
