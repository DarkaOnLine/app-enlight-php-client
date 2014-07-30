<?php

/**
 * @link: https://github.com/aztech/app-enlight-php-client
 * @link: http://appenlight.com
 * @package AppEnlight
 *
 * @author Tomasz Suchanek <tomasz.suchanek@gmail.com>
 */

namespace AppEnlight\Validator;

use AppEnlight\Validator\Validator;
use AppEnlight\Validator\ValidationException;

/**
 * Log endpoint data validator
 * @todo not used yet
 */
class Log extends Validator {

  /**
   * @param array $logs
   * @return boolean
   * @throws ValidationException
   */
  public function validate($logs) {
    if (empty($logs)) {
      throw new ValidationException("Please add at least one entry into the log");
    }
    if (is_array($logs)) {
      foreach ($logs as $log) {
        $this->_validateKeys($log);
      }
    } else {
      throw new ValidationException("Unsupported data type. Please use arrays to provide log entries.");
    }
    return true;
  }

  /**
   * Check:
   * - if at least log_leve land message is set in the log entry
   * - if log_level is no longer than 10 characters
   * @param array $data
   * @param string $version in case next releases will need anot
   * @throws ValidationException
   */
  protected function _validateKeys($data) {
    if (!isset($data['log_level'])) {
      throw new ValidationException("Please set 'log_level' value in every log entry.");
    }
    if (!isset($data['message']) || empty($data['message'])) {
      throw new ValidationException("Message can't be empty.");
    }
    if (mb_strlen($data['log_level']) > 10) {
      throw new ValidationException("Value {$data['log_level']} in 'log_level' has more than 10 characters. ");
    }
  }

}
