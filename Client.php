<?php

/**
 * @link: https://github.com/aztech/app-enlight-php-client
 * @link: http://appenlight.com
 * @package AppEnlight
 *
 * @author Tomasz Suchanek <tomasz.suchanek@gmail.com>
 */

namespace AppEnlight;

use AppEnlight\Settings;
use AppEnlight\Endpoint;

/**
 * AppEnlight PHP Client
 */
class Client {

  /**
   * @var resource
   */
  private $_curl;

  /**
   * Settings to be used by client
   * @var Settings
   */
  protected $_settings;

  /**
   * Selected endpoint, e.g. Logs, Reports
   * @var Endpoint
   */
  protected $_endpoint;

  /**
   * @param Settings $settings
   */
  public function __construct($settings) {
    $this->setSettings($settings);
  }

  /**
   * @return \AppEnlight\Endpoint
   */
  public function getEndpoint() {
    return $this->_endpoint;
  }

  /**
   * @return \AppEnlight\Settings
   */
  public function getSettings() {
    return $this->_settings;
  }

  /**
   * @param \AppEnlight\Settings $settings
   * @return \AppEnlight\Client
   */
  public function setSettings(Settings $settings) {
    $this->_settings = $settings;
    return $this;
  }

  /**
   * @param \AppEnlight\Endpoint $endpoint
   * @return \AppEnlight\Client
   */
  public function setEndpoint(Endpoint $endpoint) {
    $this->_endpoint = $endpoint;
    return $this;
  }

  /**
   * All access to the API is secured by https protocol.
   * All data is expected to be sent via json payloads with header Content-Type: application/json
   * All requests are normally authenticated by passing headers:
   * X-errormator-api-key: APIKEY - server side requests
   *
   * Each endpoint is defined following:
   * https://api.appenlight.com/api/ENDPOINT?protocol_version=0.4
   *
   * @todo: add support for public key if provided
   * @return boolean|object
   */
  public function send() {

    if (!isset($this->_endpoint)) {
      throw new ClientException("Can't send data. Endpoint is not set");
    }

    if (!isset($this->_curl)) {
      $this->_curl = curl_init();
    }

    curl_setopt($this->_curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'X-errormator-api-key: ' . $this->_settings->getApiKey()));
    curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($this->_curl, CURLOPT_POST, true);
    curl_setopt($this->_curl, CURLOPT_HEADER, false);
    curl_setopt($this->_curl, CURLOPT_URL, $this->buildUrl());
    curl_setopt($this->_curl, CURLOPT_POSTFIELDS, $this->_endpoint->toJson());

    $response = curl_exec($this->_curl);
    if (mb_strlen($response) > 2 && mb_strcut($response, 0, 2) === 'OK') {
      return true;
    } else {
      return json_decode($response);
    }
  }

  /**
   * @return string
   */
  public function buildUrl() {
    $scheme = $this->_settings->getScheme();
    $url = $this->_settings->getUrl();
    $version = $this->_settings->getVersion();
    return "{$scheme}://{$url}/{$this->_endpoint->getUrlEndpoint()}?protocol_version={$version}";
  }

  /**
   * @return string
   */
  public function getUUID() {
    return (string) $_SERVER['UNIQUE_ID'];
  }

  /**
   * @param type $max
   * @return integer
   */
  public function randomMcrypt($max = 0xffff) {
    $int = current(unpack('S', mcrypt_create_iv(2, MCRYPT_DEV_URANDOM)));
    $factor = $max / 0xffff;
    return round($int * $factor);
  }

}
