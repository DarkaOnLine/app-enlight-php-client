<?php

/**
 * @link: https://github.com/aztech/app-enlight-php-client
 * @link: http://appenlight.com
 * @package AppEnlight
 *
 * @author Tomasz Suchanek <tomasz.suchanek@gmail.com>
 */

namespace AppEnlight\Endpoint\Data;

use AppEnlight\Endpoint\Data\Report\ReportDetail;

/**
 * Single report in reports endpoint
 */
class Report {

  /**
   * @var string
   */
  protected $_client = 'php';

  /**
   * @var string
   */
  protected $_server;

  /**
   * @var integer
   */
  protected $_priority = 1;

  /**
   * @var string
   */
  protected $_error;

  /**
   * @var integer
   */
  protected $_occurences = 1;

  /**
   * @var integer
   */
  protected $_httpStatus;

  /**
   * @var array
   */
  protected $_reportDetails = array();

  /**
   * @param \AppEnlight\Endpoint\ReportDetail $detail
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function addReportDetails(ReportDetail $detail) {
    $this->_reportDetails[] = $detail->toArray();
    return $this;
  }

  /**
   * @return string
   */
  public function getClient() {
    return $this->_client;
  }

  /**
   * @return string
   */
  public function getServer() {
    return $this->_server;
  }

  /**
   * @return inteter
   */
  public function getPriority() {
    return (int) $this->_priority;
  }

  /**
   * @return string
   */
  public function getError() {
    return (string) $this->_error;
  }

  /**
   * @return integer
   */
  public function getOccurences() {
    return (int) $this->_occurences;
  }

  /**
   * @return integer
   */
  public function getHttpStatus() {
    return (int) $this->_httpStatus;
  }

  /**
   * @return array
   */
  public function getReportDetails() {
    return isset($this->_reportDetails) ? $this->_reportDetails : array();
  }

  /**
   * @param string $client
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function setClient($client) {
    $this->_client = $client;
    return $this;
  }

  /**
   * @param string $server
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function setServer($server) {
    $this->_server = $server;
    return $this;
  }

  /**
   * @param integer $priority
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
<<<<<<< HEAD
    $this->_error = (string) $error;
=======
    $this->_error = $error;
>>>>>>> origin/master
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
   * @param integer $httpStatus
   * @return \AppEnlight\Endpoint\Data\Report
   */
  public function setHttpStatus($httpStatus) {
    $this->_httpStatus = (int) $httpStatus;
    return $this;
  }

  /**
   * @return string
   */
  public function getUrlEndpoint() {
    return "reports";
  }

  /**
   * @return array
   */
  public function toArray() {
    return array(
      "client" => $this->getClient(),
      "server" => $this->getServer(),
      "priority" => $this->getPriority(),
      "error" => $this->getError(),
      "occurences" => $this->getOccurences(),
      "http_status" => $this->getHttpStatus(),
      "report_details" => $this->getReportDetails()
    );
  }

}
