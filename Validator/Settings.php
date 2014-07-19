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
 * AppEnlight Client settings validator
 * @todo not used yet
 */
class Settings {

  /**
   * Validates settings
   * @param array $settings
   * @return boolean
   * @throws ValidationException
   */
  public function validate($settings) {
    if (!isset($settings['apiVersion'])) {
      throw new ValidationException("Please provide api version");
    }
    if (!isset($settings['apiKey']) && !isset($settings['publicApiKey'])) {
      throw new ValidationException("Please provide api key or public api key");
    }
    if (!isset($settings['url'])) {
      throw new ValidationException("Please provide AppEnlight url.");
    }
    if (!isset($settings['scheme']) || !in_array($settings['scheme'], array('http', 'https'))) {
      throw new ValidationException("Please provide valid protocol.");
    }
    return true;
  }

}
