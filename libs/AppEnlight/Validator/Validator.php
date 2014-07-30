<?php

/**
 * @link: https://github.com/aztech/app-enlight-php-client
 * @link: http://appenlight.com
 * @package AppEnlight
 *
 * @author Tomasz Suchanek <tomasz.suchanek@gmail.com>
 */

namespace AppEnlight\Validator;

use AppEnlight\Validator\ValidationException;

/**
 * Base class for all validators
 * @todo not used yet
 */
abstract class Validator {

  /**
   * Just in case to distinguish different version of the API
   * @var type
   */
  protected $_apiVersion;

  /**
   *
   * @param string $apiVersion
   */
  public function __construct($apiVersion) {
    if (empty($apiVersion)) {
      throw new ValidationException("Please provide api version.");
    }
    $this->_apiVersion = $apiVersion;
  }

}
