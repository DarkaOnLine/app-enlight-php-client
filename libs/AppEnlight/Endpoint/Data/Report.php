<?php

/**
 * @link: https://github.com/aztech/app-enlight-php-client
 * @link: http://appenlight.com
 * @package AppEnlight
 *
 * @author Tomasz Suchanek <tomasz.suchanek@gmail.com>
 */

namespace AppEnlight\Endpoint\Data;

use AppEnlight\Helper;
use AppEnlight\Endpoint\Data\Report\RequestExtra;
use AppEnlight\Endpoint\Data\Report\Tag;
use AppEnlight\Endpoint\Data\Report\Request;
use AppEnlight\Endpoint\Data\Report\RequestStats;
use AppEnlight\Endpoint\Data\Report\SlowCall;
use AppEnlight\Endpoint\Data\Report\Traceback;

/**
 * Single report in reports endpoint
 */
class Report {

  /**
   * Contains information about what kind of client accessed the API
   * @var string
   */
  protected $_client = 'app-enlight-php-client';

  /**
   * Language that the report is generated for - can impact indexing/UI looks
   * @var string
   */
  protected $_language = 'php';

  /**
   * Language that the report is generated for - can impact indexing/UI looks
   * @var string
   */
  protected $_viewName;

  /**
   * Language that the report is generated for - can impact indexing/UI looks
   * @var string
   */
  protected $_server;

  /**
   * Language that the report is generated for - can impact indexing/UI looks
   * @var integer
   */
  protected $_priority = 5;

  /**
   * @var string
   */
  protected $_error;

  /**
   * Language that the report is generated for - can impact indexing/UI looks
   * @var integer
   */
  protected $_occurences = 1;

  /**
   * Language that the report is generated for - can impact indexing/UI looks
   * @var integer
   */
  protected $_httpStatus = 200;

  /**
   * Language that the report is generated for - can impact indexing/UI looks
   * @var string
   */
  protected $_username;

  /**
   * Contains full request url including get params
   * @var string
   */
  protected $_url;

  /**
   * Contains full request url including get params
   * @var string
   */
  protected $_ip;

  /**
   * Contains the starting time of request in UTC - will be used to calculate request duration, default: current UTC time of report arrival
   * @var timestamp
   */
  protected $_startTime;

  /**
   * Contains the finish time of request in UTC - will be used to calculate request duration
   * @var timestamp
   */
  protected $_endTime;

  /**
   * Contains the finish time of request in UTC - will be used to calculate request duration
   * @var string
   */
  protected $_userAgent;

  /**
   * Contains custom message attached to report
   * @var string
   */
  protected $_message;

  /**
   * Contains UUID identifier of this report, can be used to corellate log entries with reports - default: generated UUID
   * @var string
   */
  protected $_requestId;

  /**
   * Contains a dictionary object that holds keys and values for HTTP and CGI vars of report's request
   * @var Request
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
   * Contains a list of key/value pairs that are used to annotate reports with extra information
   * @var RequestExtra[]
   */
  protected $_extra;

  /**
   * Contains a list of key/value pairs that are used to tag requests for later searching
   * @var Tag[]
   */
  protected $_tags;

  /**
   * @var array
   */
  protected $_traceback;

  /**
   * Adds dictionary describing slow calls for this request
   * @param SlowCall $slowCall
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function addSlowCall(SlowCall $slowCall) {
    $this->_slowCalls[] = $slowCall->toArray();
    return $this;
  }

  /**
   * Contains a dictionary holding current request statistics,
   * where "main" is the total time of whole request
   * @param RequestStats $requestStats
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function addRequestStat(RequestStats $requestStats) {
    $this->_requestStats[] = $requestStats->toArray();
    return $this;
  }

  /**
   * Adds key/value pair that are used to annotate reports with extra information
   * @param RequestExtra $extra
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function addExtra(RequestExtra $extra) {
    $this->_extra[] = $extra->toArray();
    return $this;
  }

  /**
   * Adds key/value pair that are used to tag requests for later searching
   * @param Tag $tag
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function addTag(Tag $tag) {
    $this->_tags[] = $tag->toArray();
    return $this;
  }

  /**
   * Adds dictionary describing lines of exception traceback, having optionally attached framelocal variables to them
   * @param Traceback $traceback
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function addTraceback(Traceback $traceback) {
    $this->_traceback[] = $traceback->toArray();
    return $this;
  }

  /**
   * Contains information about what kind of client accessed the API
   * @return strin
   */
  public function getClient() {
    return $this->_client;
  }

  /**
   * Language that the report is generated for - can impact indexing/UI looks
   * @return type
   */
  public function getLanguage() {
    return $this->_language;
  }

  /**
   * Specifies the view/code block executed for transaction/web request - used by default in grouping
   * @return string
   */
  public function getViewName() {
    return $this->_viewName;
  }

  /**
   * Specifies the name of machine or instance that the application is running on - can be used in grouping
   * @return string
   */
  public function getServer() {
    return $this->_server;
  }

  /**
   * Base priority level for the report - default value: 5
   * @return integer
   */
  public function getPriority() {
    return $this->_priority;
  }

  /**
   * Contains the error/exception text for the report,
   * if not present the reports are being classified as slowness reports
   * instead exception reports
   * @return error
   */
  public function getError() {
    return $this->_error;
  }

  /**
   * Base counter of occurences for the report
   * Default value: 1
   * @return integer
   */
  public function getOccurences() {
    return $this->_occurences;
  }

  /**
   * Request HTTP status for the report
   * Default value: 200
   * @return string
   */
  public function getHttpStatus() {
    return $this->_httpStatus;
  }

  /**
   * Contains identifier of user that the request failed for
   * @return string
   */
  public function getUsername() {
    return $this->_username;
  }

  /**
   * Contains full request url including get params
   * @return string
   */
  public function getUrl() {
    return $this->_url;
  }

  /**
   * Contains IP address of the client that executed the request
   * @return string
   */
  public function getIp() {
    $ip = $this->_ip;
    if (!isset($ip)) {
      if (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
      } else {
        $ip = gethostbyname(gethostname());
      }
    }
    return $this->_ip;
  }

  /**
   * Contains the starting time of request in UTC - will be used to calculate request duration,
   * default: current UTC time of report arrival
   * @return timestamp
   */
  public function getStartTime() {
    return $this->_startTime;
  }

  /**
   * Contains the finish time of request in UTC - will be used to calculate request duration
   * @return timestamp
   */
  public function getEndTime() {
    return $this->_endTime;
  }

  /**
   * Contains the user agent of client that initiated the request
   * @return string
   */
  public function getUserAgent() {
    return $this->_userAgent;
  }

  /**
   * Contains custom message attached to report
   * @return string
   */
  public function getMessage() {
    return $this->_message;
  }

  /**
   * Contains UUID identifier of this report, can be used to corellate log entries with reports
   * default: generated UUID
   * @return string
   */
  public function getRequestId() {
    return $this->_requestId;
  }

  /**
   * Contains a dictionary object that holds keys and values for HTTP and CGI vars of report's request
   * @return array
   */
  public function getRequest() {
    return $this->_request;
  }

  /**
   * Contains a list of dictionaries describing slow calls for this request
   * @return array
   */
  public function getSlowCalls() {
    return $this->_slowCalls;
  }

  /**
   * Contains a dictionary holding current request statistics, where "main" is the total time of whole request
   * @return array
   */
  public function getRequestStats() {
    return $this->_requestStats;
  }

  /**
   * Contains a list of key/value pairs that are used to annotate reports with extra information
   * @return array
   */
  public function getExtra() {
    return $this->_extra;
  }

  /**
   * Contains a list of key/value pairs that are used to tag requests for later searching
   * @return array
   */
  public function getTags() {
    return $this->_tags;
  }

  /**
   * @return boolean
   */
  public function hasError() {
    return isset($this->_error);
  }

  /**
   * Contains a list of dictionaries describing lines of exception traceback,
   * having optionally attached framelocal variables to them
   * @return array
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
  public function hasExtra() {
    return isset($this->_extra);
  }

  /**
   * @return boolean
   */
  public function hasTags() {
    return isset($this->_tags);
  }

  /**
   * @return boolean
   */
  public function hasTraceback() {
    return isset($this->_traceback);
  }

  /**
   * @param string $client
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function setClient($client) {
    $this->_client = (string) $client;
    return $this;
  }

  /**
   * @param string $language
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function setLanguage($language) {
    $this->_language = (string) $language;
    return $this;
  }

  /**
   * @param string $viewName
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function setViewName($viewName) {
    $this->_viewName = (string) $viewName;
    return $this;
  }

  /**
   * @param string $server
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function setServer($server) {
    $this->_server = (string) $server;
    return $this;
  }

  /**
   * @param string $priority
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function setPriority($priority) {
    $this->_priority = (int) $priority;
    return $this;
  }

  /**
   * @param string $error
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function setError($error) {
    $this->_error = (string) $error;
    return $this;
  }

  /**
   * @param integer $occurences
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function setOccurences($occurences) {
    $this->_occurences = (int) $occurences;
    return $this;
  }

  /**
   * @param string $httpStatus
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function setHttpStatus($httpStatus) {
    $this->_httpStatus = (string) $httpStatus;
    return $this;
  }

  /**
   * @param string $username
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function setUsername($username) {
    $this->_username = (string) $username;
    return $this;
  }

  /**
   * @param string $url
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function setUrl($url) {
    $this->_url = (string) $url;
    return $this;
  }

  /**
   * @param string $ip
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function setIp($ip) {
    $this->_ip = (string) $ip;
    return $this;
  }

  /**
   * @param string|integer|\DateTime|null $startTime
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function setStartTime($startTime = null) {
    $this->_startTime = Helper::getDate($startTime);
    return $this;
  }

  /**
   * @param string|integer|\DateTime|null $endTime
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function setEndTime($endTime = null) {
    $this->_endTime = Helper::getDate($endTime);
    return $this;
  }

  /**
   * @param string $userAgent
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function setUserAgent($userAgent) {
    $this->_userAgent = (string) $userAgent;
    return $this;
  }

  /**
   * @param string $message
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function setMessage($message) {
    $this->message = (string) $message;
    return $this;
  }

  /**
   * @param string $requestId
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function setRequestId($requestId) {
    $this->_requestId = (string) $requestId;
    return $this;
  }

  /**
   * @param Request $request
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function setRequest(Request $request) {
    $this->_request = $request->toArray();
    return $this;
  }

  /**
   * @return array
   */
  public function toArray() {
    $report = array();
    $report['client'] = $this->getClient();
    $report['language'] = $this->getLanguage();
    $report['view_name'] = substr($this->getViewName(), 0, 128);
    $report['server'] = substr($this->getServer(), 0, 128);
    $report['priority'] = $this->getPriority();
    if ($this->hasError()) {
      $report['error'] = substr($this->getError(), 0, 512);
    }
    $report['occurences'] = $this->getOccurences();
    $report['http_status'] = $this->getHttpStatus();
    $report['username'] = substr($this->getUsername(), 0, 255);
    $report['url'] = substr($this->getUrl(), 0, 1024);
    $report['ip'] = substr($this->getIp(), 0, 39);
    $report['start_time'] = $this->getStartTime();
    $report['end_time'] = $this->getEndTime();
    $report['user_agent'] = substr($this->getUserAgent(), 0, 512);
    $report['message'] = substr($this->getMessage(), 0, 2048);
    $report['request_id'] = substr($this->getRequestId(), 0, 40);
    $report['request'] = $this->getRequest();
    if ($this->hasSlowCalls()) {
      $report['slow_calls'] = $this->getSlowCalls();
    }
    if ($this->hasRequestStats()) {
      $report['request_stats'] = $this->getRequestStats();
    }
    if ($this->hasExtra()) {
      $report['extra'] = $this->getExtra();
    }
    if ($this->hasTags()) {
      $report['tags'] = $this->getTags();
    }
    if ($this->hasTraceback()) {
      $report['traceback'] = $this->getTraceback();
    }
    return $report;
  }

}
