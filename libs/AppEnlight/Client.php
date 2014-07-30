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
use AppEnlight\Endpoint\Logs;
use AppEnlight\Endpoint\Reports;
use AppEnlight\Endpoint\RequestStats;
use AppEnlight\Endpoint\Data\Log;
use AppEnlight\Endpoint\Data\Report;

/**
 * AppEnlight PHP Client
 */
class Client {

  const SEND_LOGS = 'logs';
  const SEND_REPORTS = 'reports';
  const SEND_METRICS = 'metrics';

  /**
   * @var resource
   */
  private $_curl;

  /**
   * @var \AppEnlight\Endpoint\Logs
   */
  private $_logs;

  /**
   * @var \AppEnlight\Endpoint\ReuqestStats
   */
  private $_requestStats;

  /**
   * @var \AppEnlight\Endpoint\Reports
   */
  private $_reports;

  /**
   * Settings to be used by client
   * @var Settings
   */
  protected $_settings;

  /**
   * @param Settings $settings
   */
  public function __construct($settings) {
    $this->setSettings($settings);
    $this->_logs = new Logs();
    $this->_reports = new Reports();
    $this->_requestStats = new RequestStats();
  }

  /**
   * @param \AppEnlight\Endpoint\Data\Log $log
   * @return \AppEnlight\Client
   */
  public function addLog(Log $log) {
    $this->_logs->addLog($log);
    return $this;
  }

  /**
   * @param \AppEnlight\Metric $metric
   * @param string $server
   * @param string $timestamp
   * @return \AppEnlight\Client
   */
  public function addMetric(Metric $metric, $server = null, $timestamp = null) {
    if ($server !== null) {
      $this->_requestStats->setServer($server);
    }
    if ($timestamp !== null) {
      $this->_requestStats->setTimestamp($timestamp);
    }
    $this->_requestStats->addMetric($metric);
    return $this;
  }

  /**
   * @param \AppEnlight\Endpoint\Data\Report $report
   * @return \AppEnlight\Client
   */
  public function addReport(Report $report) {
    $this->_reports->addReport($report);
    return $this;
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
   * All access to the API is secured by https protocol.
   * All data is expected to be sent via json payloads with header Content-Type: application/json
   * All requests are normally authenticated by passing headers:
   * X-errormator-api-key: APIKEY - server side requests
   *
   * Each endpoint is defined following:
   * https://api.appenlight.com/api/ENDPOINT?protocol_version=0.4
   *
   * @param string $endpoint
   * @return boolean|object
   */
  public function send($endpoint) {

    if (!isset($this->_curl)) {
      $this->_curl = curl_init();
    }

    curl_setopt($this->_curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'X-errormator-api-key: ' . $this->_settings->getApiKey()));
    curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($this->_curl, CURLOPT_POST, true);
    curl_setopt($this->_curl, CURLOPT_HEADER, false);

    switch ($endpoint) {
      case self::SEND_LOGS:
        curl_setopt($this->_curl, CURLOPT_URL, $this->buildUrl($this->_logs));
        $jsonData = $this->_logs->toJSON();
        $this->_logs->clearData();
        break;
      case self::SEND_REPORTS:
        curl_setopt($this->_curl, CURLOPT_URL, $this->buildUrl($this->_reports));
        $jsonData = $this->_reports->toJSON();
        $this->_reports->clearData();
        break;
      case self::SEND_REQUEST_STATS:
        curl_setopt($this->_curl, CURLOPT_URL, $this->buildUrl($this->_requestStats));
        $jsonData = $this->_requestStats->toJSON();
        $this->_requestStats->clearData();
        break;
      default:
        $jsonData = null;
    }

    if ($jsonData !== null) {
      curl_setopt($this->_curl, CURLOPT_POSTFIELDS, $this->obfuscateSecureData($jsonData));
      $response = curl_exec($this->_curl);
      if (mb_strlen($response) > 2 && mb_strcut($response, 0, 2) === 'OK') {
        return true;
      } else {
        return json_decode($response);
      }
    } else {
      return false;
    }
  }

  /**
   * @return boolean|object
   */
  public function sendLogs() {
    return $this->send(self::SEND_LOGS);
  }

  /**
   * @return boolean|object
   */
  public function sendMetrics() {
    return $this->send(self::SEND_METRICS);
  }

  /**
   * @return boolean|object
   */
  public function sendReports() {
    return $this->send(self::SEND_REPORTS);
  }

  /**
   * @param \AppEnlight\Endpoint $endpoint
   * @return type
   */
  public function buildUrl(Endpoint $endpoint) {
    $scheme = $this->_settings->getScheme();
    $url = $this->_settings->getUrl();
    $version = $this->_settings->getVersion();
    return "{$scheme}://{$url}/{$endpoint->getUrlEndpoint()}?protocol_version={$version}";
  }

  public function obfuscateSecureData($jsonData) {
    $blacklist = implode("|", array(
      "password",
      "passwd",
      "pwd",
      "pass",
      "auth_tkt",
      "auth",
      "secret",
      "csrf",
      "session",
      "config",
      "settings",
      "environ",
      "xsrf"
    ));
    return preg_replace('#(\"(' . $blacklist . ')\"):(\"[^\"]+)#', '${1}:"***"', $jsonData);
  }

  /**
   * @return string
   */
  public function getUUID() {
    if (isset($_SERVER['UNIQUE_ID'])) {
      return (string) $_SERVER['UNIQUE_ID'];
    } elseif (function_exists('com_create_guid') === true) {
      return trim(com_create_guid(), '{}');
    } else {
      return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
          // 32 bits for "time_low"
          mt_rand(0, 0xffff), mt_rand(0, 0xffff),
          // 16 bits for "time_mid"
          mt_rand(0, 0xffff),
          // 16 bits for "time_hi_and_version",
          // four most significant bits holds version number 4
          mt_rand(0, 0x0fff) | 0x4000,
          // 16 bits, 8 bits for "clk_seq_hi_res",
          // 8 bits for "clk_seq_low",
          // two most significant bits holds zero and one for variant DCE1.1
          mt_rand(0, 0x3fff) | 0x8000,
          // 48 bits for "node"
          mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
      );
    }
  }

}
