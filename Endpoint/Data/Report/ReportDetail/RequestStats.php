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
 * Request stats part of report detail
 */
class RequestStats {

  /**
   * @var float
   */
  protected $_main;

  /**
   * @var float
   */
  protected $_nosql;

  /**
   * @var float
   */
  protected $_nosql_calls;

  /**
   * @var float
   */
  protected $_remote;

  /**
   * @var float
   */
  protected $_remote_calls;

  /**
   * @var float
   */
  protected $_sql;

  /**
   * @var float
   */
  protected $_sql_calls;

  /**
   * @var float
   */
  protected $_tmpl;

  /**
   * @var float
   */
  protected $_tmpl_calls;

  /**
   * @var float
   */
  protected $_unknown;

  /**
   *
   * @return float
   */
  public function getMain() {
    return $this->_main;
  }

  /**
   * @return float
   */
  public function getNosql() {
    return (float) $this->_nosql;
  }

  /**
   * @return float
   */
  public function getNosql_calls() {
    return (float) $this->_nosql_calls;
  }

  /**
   * @return float
   */
  public function getRemote() {
    return (float) $this->_remote;
  }

  /**
   * @return float
   */
  public function getRemote_calls() {
    return (float) $this->_remote_calls;
  }

  /**
   * @return float
   */
  public function getSql() {
    return (float) $this->_sql;
  }

  /**
   * @return float
   */
  public function getSql_calls() {
    return (float) $this->_sql_calls;
  }

  /**
   * @return float
   */
  public function getTmpl() {
    return (float) $this->_tmpl;
  }

  /**
   * @return float
   */
  public function getTmpl_calls() {
    return (float) $this->_tmpl_calls;
  }

  /**
   * @return float
   */
  public function getUnknown() {
    return (float) $this->_unknown;
  }

  /**
   * @param float $main
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\RequestStat
   */
  public function setMain($main) {
    $this->_main = $main;
    return $this;
  }

  /**
   * @param float $nosql
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\RequestStat
   */
  public function setNosql($nosql) {
    $this->_nosql = $nosql;
    return $this;
  }

  /**
   * @param float $nosql_calls
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\RequestStat
   */
  public function setNosql_calls($nosql_calls) {
    $this->_nosql_calls = $nosql_calls;
    return $this;
  }

  /**
   * @param float $remote
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\RequestStat
   */
  public function setRemote($remote) {
    $this->_remote = $remote;
    return $this;
  }

  /**
   * @param float $remote_calls
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\RequestStat
   */
  public function setRemote_calls($remote_calls) {
    $this->_remote_calls = $remote_calls;
    return $this;
  }

  /**
   *
   * @param float $sql
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\RequestStat
   */
  public function setSql($sql) {
    $this->_sql = $sql;
    return $this;
  }

  /**
   * @param float $sql_calls
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\RequestStat
   */
  public function setSql_calls($sql_calls) {
    $this->_sql_calls = $sql_calls;
    return $this;
  }

  /**
   * @param float $tmpl
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\RequestStat
   */
  public function setTmpl($tmpl) {
    $this->_tmpl = $tmpl;
    return $this;
  }

  /**
   * @param float $tmpl_calls
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\RequestStat
   */
  public function setTmpl_calls($tmpl_calls) {
    $this->_tmpl_calls = $tmpl_calls;
    return $this;
  }

  /**
   * @param float $unknown
   * @return \AppEnlight\Endpoint\Data\Report\ReportDetail\RequestStat
   */
  public function setUnknown($unknown) {
    $this->_unknown = $unknown;
    return $this;
  }

  /**
   * @return array
   */
  public function toArray() {
    return array(
      "main" => $this->getMain(),
      "nosql" => $this->getNosql(),
      "nosql_calls" => $this->getNosql_calls(),
      "remote" => $this->getRemote(),
      "remote_calls" => $this->getRemote_calls(),
      "sql" => $this->getSql(),
      "sql_calls" => $this->getSql_calls(),
      "tmpl" => $this->getTmpl(),
      "tmpl_calls" => $this->getTmpl_calls(),
      "unknown" => $this->getUnknown(),
    );
  }

}
