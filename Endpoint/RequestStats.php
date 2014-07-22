<?php

/**
 * @link: https://github.com/aztech/app-enlight-php-client
 * @link: http://appenlight.com
 * @package AppEnlight
 *
 * @author Tomasz Suchanek <tomasz.suchanek@gmail.com>
 */

namespace AppEnlight\Endpoint;

use AppEnlight\Endpoint;
use AppEnlight\Helper;
use AppEnlight\Endpoint\Data\Metric;

/**
 * Wrapper class for metrics endpoint
 * https://api.appenlight.com/api/reports?protocol_version=0.4
 * @link https://appenlight.com/page/api/0.4/interface#metrics-api-endpoint
 */
class RequestStats extends Endpoint {

  /**
   * @var stirng
   */
  protected $_timestamp;

  /**
   * @var string
   */
  protected $_server;

  /**
   * @var Metric[]
   */
  protected $_metrics;

  /**
   * @param \AppEnlight\Endpoint\Data\Metric $metrics
   * @return \AppEnlight\Endpoint\RequestStats
   */
  public function addMetric(Metric $metrics) {
    $this->_metrics[] = $metrics->toArray();
    return $this;
  }

  /**
   * @return \AppEnlight\Endpoint\RequestStats
   */
  public function clearData() {
    unset($this->_requestStats);
    return $this;
  }

  /**
   * @return string
   */
  public function getTimestamp() {
    return (string) $this->_timestamp;
  }

  /**
   * @return string
   */
  public function getServer() {
    return (string) $this->_server;
  }

  /**
   * @return array
   */
  public function getMetrics() {
    return $this->_metrics;
  }

  /**
   * @param string|integer|\DateTime|null $timestamp
   * @return \AppEnlight\Endpoint\RequestStats
   */
  public function setTimestamp($timestamp) {
    $this->_timestamp = Helper::getDate($timestamp);
    return $this;
  }

  /**
   * @param string $server
   * @return \AppEnlight\Endpoint\RequestStats
   */
  public function setServer($server) {
    $this->_server = $server;
    return $this;
  }

  /**
   * @return string
   */
  public function getUrlEndpoint() {
    return 'request_stats';
  }

  /**
   * @return array
   */
  public function toArray() {
    return array(
      "metrics" => $this->getMetrics(),
      "server" => $this->getServer(),
      "timestamp" => $this->getTimestamp()
    );
  }

}
