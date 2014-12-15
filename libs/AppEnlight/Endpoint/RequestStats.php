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
 *
 * Request to api is a list of metrics.
 * Each entry is a dictionary(array) of values.
 * At minimum request must contain:
 * - a list with at least one entry
 * - each entry should be a metrics dictionary for separate time interval
 *   (grouped per minute) holding request stats for each
 *   view/controller of application.
 * - each request stat needs to be a pair of ["view_name", {view_stats}]
 *   formed in format outlined above, *_calls keys contain number of calls
 *   that were executed during requests for corresponding layer,
 *   keys that do not contain *_calls will hold the time in seconds
 *   that application spent executing code/waiting
 *   for data in a given application layer.
 *
 * https://api.appenlight.com/api/reports?protocol_version=0.5
 * @link https://appenlight.com/page/api/0.5/metrics
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
   * @param Metric $metrics
   * @return \AppEnlight\Endpoint\RequestStats
   */
  public function addMetric(Metric $metrics) {
    $this->_metrics[] = $metrics->toArray();
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
   * @return \AppEnlight\Endpoint\Reports
   */
  public function clearData() {
    unset($this->_metrics);
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
