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
 * Report endpoint data validator
 * @todo not used yet
 */
class Report extends Validator {

  const REPORT_FIELDS = 'report';
  const REPORT_DETAILS_FIELDS = 'report-details';
  const REQUEST_FIELDS = 'request';
  const REQUEST_STAT_FIELDS = 'request-stats';
  const SLOW_CALL_FIELDS = 'slow-call';
  const TRACEBACK_FIELDS = 'traceback';

  public function __construct($apiVersion) {
    parent::__construct($apiVersion);
  }

  public function validate($report) {
    if (empty($report)) {
      throw new ValidationException("Report can't be empty.");
    }
    if (!isset($report['error']) && !isset($report['report_details'])) {
      throw new ValidationException("Report needs to cointain at least key field 'error' and 'report_details.");
    }
    if (!is_array($report['report_details'])) {
      throw new ValidationException("Field 'report_details' is not an array.");
    }
    if (array_diff_key(array_keys($report), $this->getSupportedFields(self::REPORT_FIELDS))) {
      $supportedKeys = implode(', ', $this->getSupportedFields(self::REPORT_FIELDS));
      throw new ValidationException("Unsussported report key(s) found. Supported keys are {$supportedKeys}");
    }
    foreach ($report['report_details'] as $reportDetail) {
      if (!isset($reportDetail['url']) && !isset($reportDetail['request_id'])) {
        throw new ValidationException("Single request detail needs to contain at least following keys 'url', 'request_id'.");
      }
      if (array_diff_key(array_keys($reportDetail), $this->getSupportedFields(self::REPORT_DETAILS_FIELDS))) {
        $supportedKeys = implode(', ', $this->getSupportedFields(self::REPORT_DETAILS_FIELDS));
        throw new ValidationException("Unsussported report details key(s) found. Supported keys are {$supportedKeys}");
      }
    }
  }

  public function getSupportedFields($set) {
    switch ($set) {
      case self::REPORT_FIELDS:
        return array(
          'http_status' => true,
          'priority' => true,
          'error' => true,
          'server' => true,
          'traceback' => true,
          'report_details' => true,
          'occurences' => true,
          'client' => true,
          'group_string' => true
        );
      case self::REPORT_DETAILS_FIELDS:
        return array(
          'username' => true,
          'url' => true,
          'ip' => true,
          'start_time' => true,
          'end_time' => true,
          'message' => true,
          'request_id' => true,
          'request' => true,
          'slow_calls' => true,
          'request_stats' => true,
          'traceback' => true
        );
      case self::REQUEST_FIELDS:
        return array(
          'REQUEST_METHOD' => true,
          'PATH_INFO' => true,
          'POST' => true
        );
      case self::SLOW_CALL_FIELDS:
        return array(
          'duration' => true,
          'timestamp' => true,
          'type' => true,
          'subtype' => true,
          'parameters' => true,
          'statement' => true
        );
      case self::TRACEBACK_FIELDS:
        return array(
          'cline' => true,
          'file' => true,
          'fn' => true,
          'line' => true,
          'vars' => true
        );
      default:
        break;
    }
  }

}
