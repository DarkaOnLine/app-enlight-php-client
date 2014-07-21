<?php

/**
 * @link: https://github.com/aztech/app-enlight-php-client
 * @link: http://appenlight.com
 * @package AppEnlight
 *
 * @author Tomasz Suchanek <tomasz.suchanek@gmail.com>
 */

namespace AppEnlight;

/**
 * Base class for all endpoints
 */
abstract class Endpoint {

  /**
   * Converts endpoint data to JSON
   * @return string JSON
   */
  public function toJSON() {
    return json_encode($this->toArray());
  }

  /**
   * Get enpoint part of the url
   * https://api.appenlight.com/api/ENDPOINT?protocol_version=0.4&public_api_key=XXXX
   * @return string
   */
  abstract public function getUrlEndpoint();

  /**
   * Clear data
   */
  abstract public function clearData();
}
