<?php

/**
 * @link: https://github.com/aztech/app-enlight-php-client
 * @link: http://appenlight.com
 * @package AppEnlight
 *
 * @author Tomasz Suchanek <tomasz.suchanek@gmail.com>
 */

namespace AppEnlight\Endpoint\Data;

/**
 * Single log in logs endpoint
 */
class Log {

  /**
   * @var string
   */
  protected $_logLevel;

  /**
   * @var string
   */
  protected $_message;

  /**
   * @var string
   */
  protected $_namespace;

  /**
   * @var string
   */
  protected $_requestId;

  /**
   * @var string
   */
  protected $_server;

  /**
   * @var string
   */
  protected $_date;

  /**
   * @return string
   */
  public function getLogLevel() {
    return $this->_logLevel;
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
  public function getNamespace() {
    return $this->_namespace;
  }

  /**
   * @return string
   */
  public function getRequestId() {
    return $this->_requestId;
  }

  /**
   * @return string
   */
  public function getServer() {
    return $this->_server;
  }

  /**
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
    $this->_logLevel = $logLevel;
    return $this;
  }

  /**
   * @param string $message
   * @return \AppEnlight\Endpoint\Data\Log
   */
  public function setMessage($message) {
    $this->_message = $message;
    return $this;
  }

  /**
   * @param string $namespace
   * @return \AppEnlight\Endpoint\Data\Log
   */
  public function setNamespace($namespace) {
    $this->_namespace = $namespace;
    return $this;
  }

  /**
   * @param string $requestId
   * @return \AppEnlight\Endpoint\Data\Log
   */
  public function setRequestId($requestId) {
    $this->_requestId = $requestId;
    return $this;
  }

  /**
   * @param string $server
   * @return \AppEnlight\Endpoint\Data\Log
   */
  public function setServer($server) {
    $this->_server = $server;
    return $this;
  }

  /**
   * @param string $date
   * @return \AppEnlight\Endpoint\Data\Log
   */
  public function setDate($date=null) {
    if ($date === null){
        $this->_date = gmdate ('Y-M-d\TH:i:s.u');
    }
    $this->_date = $date;
    return $this;
  }

  /**
   * @return array
   */
  public function toArray() {
    return array(
      "log_level" => $this->getLogLevel(),
      "message" => $this->getMessage(),
      "namespace" => $this->getNamespace(),
      "request_id" => $this->getRequestId(),
      "server" => $this->getServer(),
      "date" => $this->getDate(),
    );
  }

}
