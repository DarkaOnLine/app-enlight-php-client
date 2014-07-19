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
 * https://api.appenlight.com/api/reports?protocol_version=0.4
 */
class Reports extends Endpoint {

  /**
   * @var array
   */
  protected $_reports;

  /**
   * @param \AppEnlight\Endpoint\Report $report
   * @return \AppEnlight\Endpoint\Reports
   */
  public function addReport(Report $report) {
    $this->_reports[] = $report->toArray();
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
