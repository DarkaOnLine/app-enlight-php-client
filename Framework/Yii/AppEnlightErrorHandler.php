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

    $client = Yii::app()->getComponent('appenlight')->getClient();

    $category = 'exception.' . get_class($exception);
    if ($exception instanceof CHttpException) {
      $category.='.' . $exception->statusCode;
    }

    $appRequest = Yii::app()->getRequest();

    $request = new AppEnlight\Endpoint\Data\Report\ReportDetail\Request();
    $request->setRequestMethod($appRequest->getRequestType());
    $request->setPathInfo($appRequest->getPathInfo());
    $request->setPost($_POST);

    $reportDetails = new AppEnlight\Endpoint\Data\Report\ReportDetail();
    $reportDetails->setUsername(Yii::app()->user->isGuest ? 'guest' : Yii::app()->user->name);
    $reportDetails->setUrl($appRequest->hostInfo . $appRequest->url);
    $reportDetails->setIp(gethostname());
    $reportDetails->setUserAgent($appRequest->getUserAgent());
    $reportDetails->setMessage($exception->getMessage());
    $reportDetails->setRequestId($client->getUUID());
    $reportDetails->setRequestStats(new \AppEnlight\Endpoint\Data\Report\ReportDetail\RequestStats);
    $this->_processTrace($exception, $reportDetails);
    $reportDetails->setRequest($request);

    $report = new AppEnlight\Endpoint\Data\Report();
    $report->setError($exception->__toString());
    $report->setHttpStatus($exception instanceof CHttpException ? $exception->statusCode : 500);
    $report->addReportDetails($reportDetails);

    $reports = new AppEnlight\Endpoint\Reports();
    $reports->addReport($report);

    $client->setEndpoint($reports);
    $client->send();

    parent::handleException($exception);
  }

  /**
   * @param Exception $exception
   * @param AppEnlight\Endpoint\Data\Report\ReportDetail $reportDetail
   */
  protected function _processTrace(Exception $exception, AppEnlight\Endpoint\Data\Report\ReportDetail $reportDetail) {

    $trace = $exception->getTrace();

    foreach ($trace as $t) {
      $aeTrace = new \AppEnlight\Endpoint\Data\Report\ReportDetail\Traceback();
      $aeTrace->setFile(isset($t['file']) ? $t['file'] : 'unknown');
      $aeTrace->setFn(isset($t['class']) ? "{$t['class']}->{$t['function']}" : $t['function']);
      $aeTrace->setLine(isset($t['line']) ? $t['line'] : 0);
      foreach ($t['args'] as $arg) {
        $aeArgs[] = array(gettype($arg), $arg);
      }
      $aeTrace->setVars($aeArgs);
      $reportDetail->addTraceback($aeTrace);
      unset($aeTrace);
    }
  }

}
