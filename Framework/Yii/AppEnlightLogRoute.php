<?php

/**
 * @link: https://github.com/aztech/app-enlight-php-client
 * @link: http://appenlight.com
 * @package AppEnlight
 *
 * @author Tomasz Suchanek <tomasz.suchanek@gmail.com>
 */

/**
 * Log route to callect logs in AppEnlight
 * @todo check all fields
 */
class AppEnlightLogRoute extends CLogRoute {

  protected function processLogs($logs) {

    $client = Yii::app()->getComponent('appenlight')->getClient();
    $logs = new \AppEnlight\Endpoint\Logs();

    $servername = Yii::app()->getRequest()->serverName;
    $uuid = $client->getUUID();

    foreach ($logs as $log) {
      $aeLog = new \AppEnlight\Endpoint\Data\Log();
      $aeLog->setMessage($log[0]);
      $aeLog->setLogLevel($log[1]);
      $aeLog->setNamespace($log[2]);
      $aeLog->setDate($log[3]);
      $aeLog->setRequestId($uuid);
      $aeLog->setServer($servername);
      $logs->addLog($aeLog);
      unset($aeLog);
    }

    $client->send();
  }

}
