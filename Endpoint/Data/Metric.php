<?php

namespace AppEnlight\Endpoint\Data;

class Metric {

  /**
   * @var string
   */
  protected $_viewName;

  /**
   * @var float
   */
  protected $_custom;

  /**
   * @var integer
   */
  protected $_customCalls;

  /**
   * @var float
   */
  protected $_main;

  /**
   * @var float
   */
  protected $_nosql;

  /**
   * @var integer
   */
  protected $_nosqlCalls;

  /**
   * @var float
   */
  protected $_remote;

  /**
   * @var integer
   */
  protected $_remoteCalls;

  /**
   * @var integer
   */
  protected $_requests;

  /**
   * @var float
   */
  protected $_sql;

  /**
   * @var integer
   */
  protected $_sqlCalls;

  /**
   * @var float
   */
  protected $_tmpl;

  /**
   * @var integer
   */
  protected $_tmplCalls;

  /**
   * @var float
   */
  protected $_unknown;

  /**
   * @return string
   */
  public function getViewName() {
    return (string) $this->_viewName;
  }

  /**
   * @return float
   */
  public function getCustom() {
    return (float) $this->_custom;
  }

  /**
   * @return integer
   */
  public function getCustomCalls() {
    return (int) $this->_customCalls;
  }

  /**
   * @return float
   */
  public function getMain() {
    return (float) $this->_main;
  }

  /**
   * @return float
   */
  public function getNosql() {
    return (float) $this->_nosql;
  }

  /**
   * @return integer
   */
  public function getNosqlCalls() {
    return (int) $this->_nosqlCalls;
  }

  /**
   * @return float
   */
  public function getRemote() {
    return (float) $this->_remote;
  }

  /**
   * @return integer
   */
  public function getRemoteCalls() {
    return (int) $this->_remoteCalls;
  }

  /**
   * @return integer
   */
  public function getRequests() {
    return (int) $this->_requests;
  }

  /**
   * @return float
   */
  public function getSql() {
    return (float) $this->_sql;
  }

  /**
   * @return integer
   */
  public function getSqlCalls() {
    return (int) $this->_sqlCalls;
  }

  /**
   * @return float
   */
  public function getTmpl() {
    return (float) $this->_tmpl;
  }

  /**
   * @return integer
   */
  public function getTmplCalls() {
    return (int) $this->_tmplCalls;
  }

  /**
   * @return float
   */
  public function getUnknown() {
    return (float) $this->_unknown;
  }

  /**
   * @param string $viewName
   * @return \AppEnlight\Endpoint\Data\Metric
   */
  public function setViewName($viewName) {
    $this->_viewName = (string) $viewName;
    return $this;
  }

  /**
   * @param float $custom
   * @return \AppEnlight\Endpoint\Data\Metric
   */
  public function setCustom($custom) {
    $this->_custom = (float) $custom;
    return $this;
  }

  /**
   * @param integer $customCalls
   * @return \AppEnlight\Endpoint\Data\Metric
   */
  public function setCustomCalls($customCalls) {
    $this->_customCalls = (int) $customCalls;
    return $this;
  }

  /**
   * @param float $main
   * @return \AppEnlight\Endpoint\Data\Metric
   */
  public function setMain($main) {
    $this->_main = (float) $main;
    return $this;
  }

  /**
   * @param float $nosql
   * @return \AppEnlight\Endpoint\Data\Metric
   */
  public function setNosql($nosql) {
    $this->_nosql = (float) $nosql;
    return $this;
  }

  /**
   * @param integer $nosqlCalls
   * @return \AppEnlight\Endpoint\Data\Metric
   */
  public function setNosqlCalls($nosqlCalls) {
    $this->_nosqlCalls = (int) $nosqlCalls;
    return $this;
  }

  /**
   * @param float $remote
   * @return \AppEnlight\Endpoint\Data\Metric
   */
  public function setRemote($remote) {
    $this->_remote = (float) $remote;
    return $this;
  }

  /**
   * @param integer $remoteCalls
   * @return \AppEnlight\Endpoint\Data\Metric
   */
  public function setRemoteCalls($remoteCalls) {
    $this->_remoteCalls = (int) $remoteCalls;
    return $this;
  }

  /**
   * @param integer $requests
   * @return \AppEnlight\Endpoint\Data\Metric
   */
  public function setRequests($requests) {
    $this->_requests = (int) $requests;
    return $this;
  }

  /**
   * @param float $sql
   * @return \AppEnlight\Endpoint\Data\Metric
   */
  public function setSql($sql) {
    $this->_sql = (float) $sql;
    return $this;
  }

  /**
   * @param intger $sqlCalls
   * @return \AppEnlight\Endpoint\Data\Metric
   */
  public function setSqlCalls($sqlCalls) {
    $this->_sqlCalls = (int) $sqlCalls;
    return $this;
  }

  /**
   * @param float $tmpl
   * @return \AppEnlight\Endpoint\Data\Metric
   */
  public function setTmpl($tmpl) {
    $this->_tmpl = (float) $tmpl;
    return $this;
  }

  /**
   * @param integer $tmplCalls
   * @return \AppEnlight\Endpoint\Data\Metric
   */
  public function setTmplCalls($tmplCalls) {
    $this->_tmplCalls = (int) $tmplCalls;
    return $this;
  }

  /**
   * @param float $unknown
   * @return \AppEnlight\Endpoint\Data\Metric
   */
  public function setUnknown($unknown) {
    $this->_unknown = (float) $unknown;
    return $this;
  }

  /**
   * @return array
   */
  public function toArray() {
    return array(
      $this->getViewName(),
      array(
        "custom" => $this->getCustom(),
        "custom_calls" => $this->getCustomCalls(),
        "main" => $this->getMain(),
        "nosql" => $this->getNosql(),
        "nosql_calls" => $this->getNosqlCalls(),
        "remote" => $this->getRemote(),
        "remote_calls" => $this->getRemoteCalls(),
        "requests" => $this->getRequests(),
        "sql" => $this->getSql(),
        "sql_calls" => $this->getSqlCalls(),
        "tmpl" => $this->getTmpl(),
        "tmpl_calls" => $this->getTmplCalls(),
        "unknown" => $this->getUnknown()
      )
    );
  }

}
