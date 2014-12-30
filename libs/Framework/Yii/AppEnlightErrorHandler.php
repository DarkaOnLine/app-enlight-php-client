<?php

/**
 * @link: https://github.com/aztech/app-enlight-php-client
 * @link: http://appenlight.com
 * @package AppEnlight
 *
 * @author Tomasz Suchanek <tomasz.suchanek@gmail.com>
 */

/**
 * Error handler for Appenlight
 * @todo implement handleException
 * @todo ensure that handleError and handleException do not report the same issue twice
 */
class AppEnlightErrorHandler extends CErrorHandler {

  protected function handleException($exception) {

    /* @var $client \AppEnlight\Client */
    $appEnlight = Yii::app()->getComponent('appenlight');

    /* initialziation */
    $client = $appEnlight->getClient();
    $appRequest = Yii::app()->getRequest();
    $appController = Yii::app()->getController();
    if (!$appController && Yii::app() instanceof CConsoleApplication) {
      $appCommand = Yii::app()->getCommand();
    }

    $category = 'exception.' . get_class($exception);
    if ($exception instanceof CHttpException) {
      $category.='.' . $exception->statusCode;
    }

    /* report to be sent */
    $report = new AppEnlight\Endpoint\Data\Report();
    $report->setUsername($appEnlight->getUsername());

    /* get view name from action */
    if (isset($appController)) {
      $viewName = $appController->getViewPath();
    } elseif (isset($appCommand)) {
      $viewName = $appCommand->getCommandPath();
    } else {
      $viewName = 'application.console';
    }
    $report->setViewName($viewName);

    /* getUrl doesn't exists in ConsoleApplication and causes errors */
    if (Yii::app() instanceof CConsoleApplication) {
      $report->setUrl($appEnlight->getHostName());
    } else {
      $report->setUrl($appEnlight->getHostName() . $appRequest->getUrl());
    }

    $report->setUserAgent($appRequest->getUserAgent());
    $report->setMessage($exception->__toString());
    $report->setRequestId($client->getUUID());

    $report->setError($exception->getMessage());
    $report->setHttpStatus($exception instanceof CHttpException ? $exception->statusCode : 500);

    $this->_processTrace($exception, $report);

    /* request is filled automatically */
    $request = new AppEnlight\Endpoint\Data\Report\Request();
    $report->setRequest($request);

    $client->addReport($report);
    $client->sendReports();

    parent::handleException($exception);
  }

  /**
   * @param Exception $exception
   * @param AppEnlight\Endpoint\Data\Report\Report $report
   */
  protected function _processTrace(Exception $exception, AppEnlight\Endpoint\Data\Report $report) {

    $trace = $exception->getTrace();

    foreach ($trace as $t) {
      $aeTrace = new \AppEnlight\Endpoint\Data\Report\Traceback();
      $aeTrace->setFile(isset($t['file']) ? $t['file'] : 'unknown');
      $aeTrace->setFn(isset($t['class']) ? "{$t['class']}->{$t['function']}" : $t['function']);
      $aeTrace->setLine(isset($t['line']) ? $t['line'] : 0);
      $aeArgs = array();
      foreach ($t['args'] as $arg) {
        $aeArgs[] = $arg;
      }
      $aeTrace->setVars(CJSON::encode($aeArgs));
      $report->addTraceback($aeTrace);
      unset($aeTrace);
    }
  }

}
