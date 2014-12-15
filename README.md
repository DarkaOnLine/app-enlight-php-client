App Enlight PHP Client
======================

IMPORTANT: This library is under development. You can use it for productive application on your own risk!

PHP Client for AppEnlight (previously known as Errormator).

App Enlight main goal is to monitor your application. This API client for PHP provides an easy to use interface to send to App Enlight:
- logs;
- error reports;
- slow requests (with metrics).

Requirements
============
- PHP 5.3.2+ with cURL extension available;
- OpenSSL Support for HTTPS curl requests (if you would like to use http, this is not required);
- (optional) enabled mod_unique_id model in httpd.conf http://httpd.apache.org/docs/2.2/mod/mod_unique_id.html;

Installation
============
To install this API in your application copy all folders to a location accessible by your application. 
Then whenever you want to use the App Enlight PHP client you should use the namespace:

```php
use AppEnlight;
```

Framework integrations
======================
You can use this PHP client in any PHP application but it will require from you a little effort to integrate the client with your application. 
If you are using [Yii framework](http://yiiframework.com/)you are really lucky guy :) This PHP client is delivered with extension allowing to use client within Yii Framework with minimal effort. 
If you like to add support for other frameworks, please feel free to contact me.

Pass your application API key
=============================
The most important, before you initialize client, is to pass your private API key generated in App Enlight dashboard for your application. If you like, you can set the other settings to according to your needs.
Note that you can ommit other settings and client will still work. Below example shows all available settings

```php
    $settings = new \AppEnlight\Settings();
    $settings->setApiKey('123APIKEY');
    $settings->setClient('php');
    $settings->setScheme('https');
    $settings->setUrl('api.appenlight.com/api');
    $settings->setVersion('0.5');
    return $settings;
```

Create client
=============
Once settings are defined, you can pass them to client.

```php
$client = new \AppEnlight\Client($settings);
```

Send log data
=============
Once the client is created you need to decide what kind of information you would like to send. You can choose from two endpoints:
- log,
- reports.

First is very simple and is used to store logs comming from your application. 

```php
    use \AppEnlight\Endpoint\Logs;
    use \AppEnlight\Endpoint\Data\Log;

    $uuid = $client->getUUID();

    /* add just 1 log */
    $aeLog = new Log();
    $aeLog->setMessage("Test message");
    $aeLog->setLogLevel('error');
    $aeLog->setNamespace('application.site.signin');
    $aeLog->setDate('2014-07-21T00:15:38.955371');
    $aeLog->setRequestId($uuid);
    $aeLog->setServer('localhost');
    $client->addLog($aeLog);
    $client->setEndpoint($aeLogs);
```

Send repot data
===============
You can send multiple reports within one request. Each report may consist different set of data. You can send information about slow calls including traceback, error information, etc.

Below example shows how to send simple report

```php
    use \AppEnlight;
    use \AppEnlight\Endpoint;
    use \AppEnlight\Endpoint\Data;
    use \AppEnlight\Endpoint\Data\Report;
    
    //get client
    $client = new Client($settings);

    //prepare report detail data 
    $report = new Report();
    $report->setUsername('test user');
    $report->setUrl('http://localhost');
    $report->setIp('127.0.0.1');
    $report->setUserAgent('Chrome');
    $report->setMessage('Very serious error');
    $report->setRequestId($client->getUUID());
    $report->setRequestStats(new RequestStats());
    
    //analyse trace returned by exception
    $trace = $exception->getTrace();
    foreach($trace as $t) {
      $aeTrace = new Traceback();
      $aeTrace->setFile(isset($t['file']) ? $t['file'] : 'unknown');
      $aeTrace->setFn(isset($t['class']) ? "{$t['class']}->{$t['function']}" : $t['function']);
      $aeTrace->setLine(isset($t['line']) ? $t['line'] : 0);
      $reportDetail->addTraceback($aeTrace);
    }
    
    $report->setRequest(new Request(););
  
    $report->setError('Very dangerouse error');
    $report->setHttpStatus(500);

    $client->addReport($report);
    $client->send();
```    

Update from version 0.4 to 0.5
==============================
Note that API in version 0.5 has been changed comparing to version 0.4. 
Briefly, report grouping has been changed and since version 0.5 content of report_details became part of single report.
For more details compare documentation Reports endpoint for version [0.4](https://appenlight.com/page/api/0.5/reports) with [0.5](https://appenlight.com/page/api/0.5/reports)

Todo
====
- add documentation how to use extension in Yii;
