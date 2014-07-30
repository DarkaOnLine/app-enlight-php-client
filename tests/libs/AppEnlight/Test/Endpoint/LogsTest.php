<?php

namespace AppEnlight\Test\Endpoint;

use AppEnlight\Client;
use AppEnlight\Settings;
use AppEnlight\Endpoint\Data\Log;

class LogsTest extends PHPUnit_Framework_TestCase {

  public function testMinimumSetup() {
    $settings = new Settings();
    $settings->setApiKey('953ca95742ee4fd6aab51c3d95c02a2d');
    $client = new Client($settings);
    $log = new Log();
    $log->setLogLevel('ERROR');
    $log->setMessage('Very bad error');
    $client->addLog($log);
    $this->assertTrue($client->sendLogs());
  }

}
