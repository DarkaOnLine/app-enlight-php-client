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
 *
 * Request to api is a list of log messages.
 * Each entry is a dictionary(array) of values.
 * At minimum request must contain:
 * - a list with at least one entry
 * - entry should contain following keys: message
 * - whole HTTP body of API request needs to be less than 1024kb
 *
 * https://api.appenlight.com/api/logs?protocol_version=0.5
 * @link https://appenlight.com/page/api/0.5/logs
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
