<?php

/**
 * @link: https://github.com/aztech/app-enlight-php-client
 * @link: http://appenlight.com
 * @package AppEnlight
 *
 * @author Tomasz Suchanek <tomasz.suchanek@gmail.com>
 */

namespace AppEnlight\Endpoint\Data\Report\ReportDetail;

/**
 * Slow call part of report details
 */
class SlowCall {

  /**
   * @var float
   */
  protected $_duration;

  /**
   * @var timestamp
   */
  protected $_timestamp;

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
   * @param float $duration
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\SlowCall
   */
  public function setDuration($duration) {
    $this->_duration = $duration;
    return $this;
  }

  /**
   * @param timstamp $timestamp
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\SlowCall
   */
  public function setTimestamp($timestamp) {
    $this->_timestamp = $timestamp;
    return $this;
  }

  /**
   * @param string $type
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\SlowCall
   */
  public function setType($type) {
    $this->_type = $type;
    return $this;
  }

  /**
   * @param string $subtype
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\SlowCall
   */
  public function setSubtype($subtype) {
    $this->_subtype = $subtype;
    return $this;
  }

  /**
   * @param array $parameters
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\SlowCall
   */
  public function setParameters($parameters) {
    $this->_parameters = $parameters;
    return $this;
  }

  /**
   * @param string $statement
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\SlowCall
   */
  public function setStatement($statement) {
    $this->_statement = $statement;
    return $this;
  }

  /**
   * @return float
   */
  public function getDuration() {
    return (float) $this->_duration;
  }

  /**
   * @return timestamp
   */
  public function getTimestamp() {
    return $this->_timestamp;
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
      'duration' => $this->getDuration(),
      'timestamp' => $this->getTimestamp(),
      'type' => $this->getType(),
      'subtype' => $this->getSubtype(),
      'parameters' => $this->getParameters(),
      'statement' => $this->getStatement(),
    );
  }

}
