<?php

/**
 * @link: https://github.com/aztech/app-enlight-php-client
 * @link: http://appenlight.com
 * @package AppEnlight
 *
 * @author Tomasz Suchanek <tomasz.suchanek@gmail.com>
 */

namespace AppEnlight\Endpoint\Data\Report;

use AppEnlight\Endpoint\Data\Report\ReportDetail\Request;
use AppEnlight\Endpoint\Data\Report\ReportDetail\RequestStats;
use AppEnlight\Endpoint\Data\Report\ReportDetail\SlowCall;
use AppEnlight\Endpoint\Data\Report\ReportDetail\Traceback;

/**
 * Report detail part of single report
 */
class ReportDetail {

  /**
   * @var string
   */
  protected $_username;

  /**
   * @var string
   */
  protected $_url;

  /**
   * @var string
   */
  protected $_ip;

  /**
   * @var timestamp
   */
  protected $_startTime;

  /**
   * @var timestamp
   */
  protected $_endTime;

  /**
   * @var string
   */
  protected $_userAgent;

  /**
   *
   * @var string
   */
  protected $_message;

  /**
   * @var string
   */
  protected $_requestId;

  /**
   * @var array
   */
  protected $_request;

  /**
   * @var array
   */
  protected $_requestStats;

  /**
   * @var array
   */
  protected $_slowCalls;

  /**
   * @var array
   */
  protected $_traceback;

  /**
   * @param \AppEnlight\Endpoint\Data\Report\ReportDetail\SlowCall $slowCall
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail
   */
  public function addSlowCall(SlowCall $slowCall) {
    $this->_slowCalls[] = $slowCall->toArray();
    return $this;
  }

  /**
   * @param \AppEnlight\Endpoint\Data\Report\ReportDetail\Traceback $traceback
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail
   */
  public function addTraceback(Traceback $traceback) {
    $this->_traceback[] = $traceback->toArray();
    return $this;
  }

  /**
   * @return string
   */
  public function getUsername() {
    return $this->_username;
  }

  /**
   * @return string
   */
  public function getUrl() {
    return $this->_url;
  }

  /**
   * @return string
   */
  public function getIp() {
    return $this->_ip;
  }

  /**
   * @return timestamp
   */
  public function getStartTime() {
    return $this->_startTime;
  }

  /**
   * @return timestamp
   */
  public function getEndTime() {
    return $this->_endTime;
  }

  /**
   * @return string
   */
  public function getUserAgent() {
    return $this->_userAgent;
  }

  /**
   * @return string
   */
  public function getMessage() {
    return $this->_message;
  }

  /**
   * @return string
   */
  public function getRequestId() {
    return $this->_requestId;
  }

  /**
   * @return AppEnlight\Endpoint\Data\Report\ReportDetail\Request
   */
  public function getRequest() {
    return $this->_request;
  }

  /**
   * @return AppEnlight\Endpoint\Data\Report\ReportDetail\RequestStats
   */
  public function getRequestStats() {
    return $this->_requestStats;
  }

  /**
   * @return AppEnlight\Endpoint\Data\Report\ReportDetail\SlowCalls[]
   */
  public function getSlowCalls() {
    return $this->_slowCalls;
  }

  /**
   * @return AppEnlight\Endpoint\Data\Report\ReportDetail\Traceback[]
   */
  public function getTraceback() {
    return $this->_traceback;
  }

  /**
   * @return boolean
   */
  public function hasSlowCalls() {
    return isset($this->_slowCalls);
  }

  /**
   * @return boolean
   */
  public function hasRequestStats() {
    return isset($this->_requestStats);
  }

  /**
   * @return boolean
   */
  public function hasTraceback() {
    return isset($this->_traceback);
  }

  /**
   * @param string $username
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail
   */
  public function setUsername($username) {
    $this->_username = $username;
    return $this;
  }

  /**
   * @param string $url
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail
   */
  public function setUrl($url) {
    $this->_url = $url;
    return $this;
  }

  /**
   * @param string $ip
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail
   */
  public function setIp($ip) {
    $this->_ip = $ip;
    return $this;
  }

  /**
   * @param string $startTime
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail
   */
  public function setStartTime($startTime=null) {
      if ($startTime === null){
          $this->_startTime = gmdate ('Y-M-d\TH:i:s.u');
      }
      else{
          $this->_startTime = $startTime;
      }
    return $this;
  }

  /**
   * @param string $endTime
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail
   */
  public function setEndTime($endTime=null) {
      if ($endTime === null){
          $this->_endTime = gmdate ('Y-M-d\TH:i:s.u');
      }
      else{
          $this->_endTime = $endTime;
      }
    return $this;
  }

  /**
   * @param string $userAgent
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail
   */
  public function setUserAgent($userAgent) {
    $this->_userAgent = $userAgent;
    return $this;
  }

  /**
   * @param string $message
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail
   */
  public function setMessage($message) {
    $this->_message = $message;
    return $this;
  }

  /**
   * @param string $requestId
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail
   */
  public function setRequestId($requestId) {
    $this->_requestId = $requestId;
    return $this;
  }

  /**
   *
   * @param \AppEnlight\Endpoint\Data\Report\ReportDetail\Request $request
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail
   */
  public function setRequest(Request $request) {
    $this->_request = $request->toArray();
    return $this;
  }

  /**
   * @param \AppEnlight\Endpoint\Data\Report\AppEnlight\Endpoint\Data\Report\ReportDetail\RequestStats $requestStats
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail
   */
  public function setRequestStats(RequestStats $requestStats) {
    $this->_requestStats = $requestStats->toArray();
    return $this;
  }

  /**
   * @return array
   */
  public function toArray() {
    $details = array(
      "username" => $this->getUsername(),
      "url" => $this->getUrl(),
      "ip" => $this->getIp(),
      "start_time" => $this->getStartTime(),
      "end_time" => $this->getEndTime(),
      "user_agent" => $this->getUserAgent(),
      "message" => $this->getMessage(),
      "request_id" => $this->getRequestId(),
      "request" => $this->getRequest()
    );
    if ($this->hasSlowCalls()) {
      $details["slow_calls"] = $this->getSlowCalls();
    }
    if ($this->hasRequestStats()) {
      $details["request_stats"] = $this->getRequestStats();
    }
    if ($this->hasTraceback()) {
      $details["traceback"] = $this->getTraceback();
    }
    return $details;
  }

}
