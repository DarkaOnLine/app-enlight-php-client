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

/**
 * Single log in logs endpoint
 */
class Log {

  /**
   * Contains severity level for log entry
   * @var string
   */
  protected $_logLevel;

  /**
   * Contains actual log message body
   * @var string
   */
  protected $_message;

  /**
   * Identifies the origin of log message
   * @var string
   */
  protected $_namespace;

  /**
   * Contains UUID identifier of request that generated the report,
   * can be used to corellate log entries with reports/same transaction
   * @var string
   */
  protected $_requestId;

  /**
   * Specifies the name of machine or instance that the application is running on
   * @var string
   */
  protected $_server;

  /**
   * Contains the log creation time of in UTC - will be used
   * to calculate request duration, default: current UTC time of report arrival
   * @var string
   */
  protected $_date;

  /**
   * Contains severity level for log entry
   * @return string
   */
  public function getLogLevel() {
    return $this->_logLevel;
  }

  /**
   * Contains actual log message body
   * @return string
   */
  public function getMessage() {
    return $this->_message;
  }

  /**
   * Identifies the origin of log message
   * @return string
   */
  public function getNamespace() {
    return $this->_namespace;
  }

  /**
   * Contains UUID identifier of request that generated the report,
   * can be used to corellate log entries with reports/same transaction
   * @return string
   */
  public function getRequestId() {
    return $this->_requestId;
  }

  /**
   * Specifies the name of machine or instance that the application is running on
   * @return string
   */
  public function getServer() {
    return $this->_server;
  }

  /**
   * Contains the log creation time of in UTC - will be used
   * to calculate request duration, default: current UTC time of report arrival
   * @return string
   */
  public function getDate() {
    return $this->_date;
  }

  /**
   * @param string $logLevel
   * @return \AppEnlight\Endpoint\Data\Log
   */
  public function setLogLevel($logLevel) {
    $this->_logLevel = (string) $logLevel;
    return $this;
  }

  /**
   * @param string $message
   * @return \AppEnlight\Endpoint\Data\Log
   */
  public function setMessage($message) {
    $this->_message = (string) $message;
    return $this;
  }

  /**
   * @param string $namespace
   * @return \AppEnlight\Endpoint\Data\Log
   */
  public function setNamespace($namespace) {
    $this->_namespace = (string) $namespace;
    return $this;
  }

  /**
   * @param string $requestId
   * @return \AppEnlight\Endpoint\Data\Log
   */
  public function setRequestId($requestId) {
    $this->_requestId = (string) $requestId;
    return $this;
  }

  /**
   * @param string $server
   * @return \AppEnlight\Endpoint\Data\Log
   */
  public function setServer($server) {
    $this->_server = (string) $server;
    return $this;
  }

  /**
   * @param string|integer|\DateTime|null $date
   * @return \AppEnlight\Endpoint\Data\Log
   */
  public function setDate($date = null) {
    $this->_date = Helper::getDate($date);
    return $this;
  }

  /**
   * @return array
   */
  public function toArray() {
    return array(
      "log_level" => substr($this->getLogLevel(), 0, 10),
      "message" => substr($this->getMessage(), 0, 4096),
      "namespace" => substr($this->getNamespace(), 0, 128),
      "request_id" => substr($this->getRequestId(), 0, 40),
      "server" => substr($this->getServer(), 0, 128),
      "date" => $this->getDate(),
    );
  }

}
