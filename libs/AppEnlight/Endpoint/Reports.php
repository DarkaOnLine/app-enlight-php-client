<?php

/**
 * @link: https://github.com/aztech/app-enlight-php-client
 * @link: http://appenlight.com
 * @package AppEnlight
 *
 * @author Tomasz Suchanek <tomasz.suchanek@gmail.com>
 */

namespace AppEnlight\Endpoint;

use \AppEnlight\Endpoint;
use \AppEnlight\Endpoint\Data\Report;

/**
 * Wrapper class for reports enpoint
 *
 * A report is a dictionary(array) of values, some of values
 * that you can send can be data structures like dictionaries/lists.
 * At minimum error report request must contain:
 * - a list with at least one report
 * - a single report needs to contain at least one of keys: url or view_name
 *
 * https://api.appenlight.com/api/reports?protocol_version=0.5
 * @link https://appenlight.com/page/api/0.5/reports
 */
class Reports extends Endpoint {

  /**
   * @var array
   */
  protected $_reports;

  /**
   * @param Report $report
   * @return \AppEnlight\Endpoint\Reports
   */
  public function addReport(Report $report) {
    $this->_reports[] = $report->toArray();
    return $this;
  }

  /**
   * @return \AppEnlight\Endpoint\Reports
   */
  public function clearData() {
    unset($this->_reports);
    return $this;
  }

  /**
   * @return string
   */
  public function getUrlEndpoint() {
    return 'reports';
  }

  /**
   * @return array
   */
  public function toArray() {
    return $this->_reports;
  }

}
