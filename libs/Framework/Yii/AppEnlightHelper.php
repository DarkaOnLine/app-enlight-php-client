<?php

/**
 * @link: https://github.com/aztech/app-enlight-php-client
 * @link: http://appenlight.com
 * @package AppEnlight
 *
 * @author Tomasz Suchanek <tomasz.suchanek@gmail.com>
 */

/**
 * AppEnlight helper class for Yii
 */
class AppEnlightHelper {

  /**
   * If console application is running there is no information
   * about server name. Therefore gethostname() function is used
   * @return string
   */
  public static function getHostName() {
    if (Yii::app() instanceof CConsoleApplication) {
      return gethostname();
    } else {
      return Yii::app()->getRequest()->getHostInfo();
    }
  }

  /**
   * Get username. In case the console application is running
   * "console" user name is returned. If user is logged in,
   * his name is returned. Otherwise "guest" is returned
   * @return string
   */
  public static function getUsername() {
    if (Yii::app() instanceof CConsoleApplication) {
      return 'console';
    } else {
      return Yii::app()->user->isGuest ? 'guest' : Yii::app()->user->name;
    }
  }

}
