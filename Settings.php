<?php

/**
 * @link: https://github.com/aztech/app-enlight-php-client
 * @link: http://appenlight.com
 * @package AppEnlight
 *
 * @author Tomasz Suchanek <tomasz.suchanek@gmail.com>
 */

namespace AppEnlight;

/**
 * AppEnlight application settings
 */
class Settings {

  /**
   * @var string
   */
  protected $_apiKey;

  /**
   * @var string
   */
  protected $_client = "php";

  /**
   * @var boolean
   */
  protected $_debug = false;

  /**
   * @var string
   */
  protected $_scheme = "https";

  /**
   * @var string
   */
  protected $_url = "api.appenlight.com/api";

  /**
   * @var string
   */
  protected $_version = "0.4";

  /**
   * @return string
   */
  public function getApiKey() {
    return $this->_apiKey;
  }

  /**
   * @return string
   */
  public function getClient() {
    return $this->_client;
  }

  /**
   * @return boolean
   */
  public function getDebug() {
    return $this->_debug;
  }

  /**
   * @return string
   */
  public function getScheme() {
    return $this->_scheme;
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
  public function getVersion() {
    return $this->_version;
  }

  /**
   * @param string $apiKey
   * @return \Settings
   */
  public function setApiKey($apiKey) {
    $this->_apiKey = $apiKey;
    return $this;
  }

  /**
   * @param string $client
   * @return \Settings
   */
  public function setClient($client) {
    $this->_client = $client;
    return $this;
  }

  /**
   * @param boolean $debug
   * @return \Settings
   */
  public function setDebug($debug) {
    $this->_debug = (boolean) $debug;
    return $this;
  }

  /**
   * @param string $scheme
   * @return \Settings
   */
  public function setScheme($scheme) {
    $this->_scheme = $scheme;
    return $this;
  }

  /**
   * @param string $url
   * @return \Settings
   */
  public function setUrl($url) {
    $this->_url = $url;
    return $this;
  }

  /**
   * @param string $version
   * @return \Settings
   */
  public function setVersion($version) {
    $this->_version = $version;
    return $this;
  }

}
