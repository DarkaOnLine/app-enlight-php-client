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
 * Request part of report detail
 */
class Request {

  /**
   * @var array
   */
  protected $_cookies;

  /**
   * @var array
   */
  protected $_files;

  /**
   * @var array
   */
  protected $_getData;

  /**
   *
   * @var array
   */
  protected $_postData;

  /**
   * @var array
   */
  protected $_requestData;

  /**
   * @var string
   */
  protected $_requestMethod;

  /**
   * @var array
   */
  protected $_server;

  /**
   * @var array
   */
  protected $_session;

  /**
   * @return array
   */
  public function getCookies() {
    return isset($this->_cookies) ? $this->_cookies : $_COOKIE;
  }

  /**
   * @return array
   */
  public function getFiles() {
    return isset($this->_files) ? $this->_files : $_FILES;
  }

  /**
   * @return array
   */
  public function getGetData() {
    return isset($this->_getData) ? $this->_getData : $_GET;
  }

  /**
   * @return array
   */
  public function getPostData() {
    return isset($this->_postData) ? $this->_postData : $_POST;
  }

  /**
   * @return array
   */
  public function getRequestData() {
    return $this->_requestData;
  }

  /**
   * @return string
   */
  public function getRequestMethod() {
    return $this->_requestMethod;
  }

  /**
   * @return array
   */
  public function getServer() {
    return isset($this->_server) ? $this->_server : $_SERVER;
  }

  /**
   * @return array
   */
  public function getSession() {
    return isset($this->_session) ? $this->_session : $_SESSION;
  }

  /**
   * @return boolean
   */
  public function hasRequestData() {
    return isset($this->_requestData);
  }

  /**
   * @param array $cookies
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\Request
   */
  public function setCookies($cookies) {
    $this->_cookies = $cookies;
    return $this;
  }

  /**
   * @param array $files
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\Request
   */
  public function setFiles($files) {
    $this->_files = $files;
    return $this;
  }

  /**
   * @param array $getData
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\Request
   */
  public function setGetData($getData) {
    $this->_getData = $getData;
    return $this;
  }

  /**
   * @param array $postData
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\Request
   */
  public function setPostData($postData) {
    $this->_postData = $postData;
    return $this;
  }

  /**
   * @param array $requestData
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\Request
   */
  public function setRequestData($requestData) {
    $this->_requestData = $requestData;
    return $this;
  }

  /**
   * @param string $requestMethod
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\Request
   */
  public function setRequestMethod($requestMethod) {
    $this->_requestMethod = $requestMethod;
    return $this;
  }

  /**
   * @param array $server
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\Request
   */
  public function setServer($server) {
    $this->_server = $server;
    return $this;
  }

  /**
   * @param array $session
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\Request
   */
  public function setSession($session) {
    $this->_session = $session;
    return $this;
  }

  /**
   * @return array
   */
  public function toArray() {
    $requestData = $this->hasRequestData() ? $this->getRequestData() : array();
    $requestData['COOKIES'] = $this->getCookies();
    $requestData['FILES'] = $this->getFiles();
    $requestData['POST'] = $this->getPostData();
    $requestData['GET'] = $this->getGetData();
    $requestData['REQUEST_METHOD'] = $this->getRequestMethod();
    $requestData['SERVER'] = $this->getServer();
    $requestData['SESSION'] = $this->getSession();
    return $requestData;
  }

}
