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
 * Helper class
 */
abstract class Helper {

  const DATE_FORMAT = 'Y-M-d\TH:i:s.u';

  /**
   * Converts date to given format self::DATE_FORMAT
   * @param string|integer|\DateTime|null $date
   * @return string
   */
  public static function getDate($date = null) {
    if ($date === null || empty($date)) {
      return gmdate(self::DATE_FORMAT);
    } elseif (is_int($date)) {
      return gmdate(self::DATE_FORMAT, $date);
    } elseif ($date instanceof \DateTime) {
      return $date->format(self::DATE_FORMAT);
    } else {
      return $date;
    }
  }

}
