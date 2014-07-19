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
   * @var string
   */
  protected $_requestMethod;

  /**
   * @var string
   */
  protected $_pathInfo;

  /**
   * @var string
   */
  protected $_post;

  /**
   * @return string
   */
  public function getRequestMethod() {
    return $this->_requestMethod;
  }

  /**
   * @return string
   */
  public function getPathInfo() {
    return $this->_pathInfo;
  }

  /**
   * @return string
   */
  public function getPost() {
    return $this->_post;
  }

  /**
   *
   * @param string $requestMethod
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\Request
   */
  public function setRequestMethod($requestMethod) {
    $this->_requestMethod = $requestMethod;
    return $this;
  }

  /**
   * @param string $pathInfo
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\Request
   */
  public function setPathInfo($pathInfo) {
    $this->_pathInfo = $pathInfo;
    return $this;
  }

  /**
   * @param string $post
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\Request
   */
  public function setPost($post) {
    $this->_post = $post;
    return $this;
  }

  /**
   * @return array
   */
  public function toArray() {
    return array(
      "REQUEST_METHOD" => $this->getRequestMethod(),
      "PATH_INFO" => $this->getPathInfo(),
      "POST" => $this->getPost()
    );
  }

}
