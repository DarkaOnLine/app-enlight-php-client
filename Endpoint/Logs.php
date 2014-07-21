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
use \AppEnlight\Endpoint\Data\Log;

/**
 * Wrapper class for logs enpoint
 * https://api.appenlight.com/api/logs?protocol_version=0.4
 */
class Logs extends Endpoint {

  /**
   * @var array
   */
  protected $_logs;

  /**
   * @param \AppEnlight\Endpoint\Data\Log $log
   * @return \AppEnlight\Client
   */
  public function addLog(Log $log) {
    $this->_logs[] = $log->toArray();
    return $this;
  }

  /**
   * @return \AppEnlight\Endpoint\Logs
   */
  public function clearData() {
    unset($this->_logs);
    return $this;
  }

  /**
   * @return string
   */
  public function getUrlEndpoint() {
    return 'logs';
  }

  /**
   * @return array
   */
  public function toArray() {
    return $this->_logs;
  }

}
