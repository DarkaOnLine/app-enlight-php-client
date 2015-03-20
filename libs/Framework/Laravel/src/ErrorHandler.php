<?php namespace AppEnlight\Laravel;

use AppEnlight\Client;
use AppEnlight\Endpoint\Data\Report;
use AppEnlight\Endpoint\Data\Report\Request as AppEnlightRequest;
use AppEnlight\Endpoint\Data\Report\Traceback;
use AppEnlight\Settings;
use Exception;
use Request;

class ErrorHandler {

    /**
     * @var \AppEnlight\Settings
     */
    protected $settings;

    /**
     * @var \Exception
     */
    protected $exception;


    /**
     * @var array
     */
    protected $config;

    public function __construct($config, Exception $exception){

        //Set settings
        $settings = new Settings();
        $settings->setApiKey($config['api_key']);
        $settings->setScheme($config['scheme']);
        $settings->setVersion($config['version']);

        $this->settings = $settings;
        $this->config = $config;
        $this->exception = $exception;
        $this->_processException();
    }

    /**
     *
     */
    protected function _processException(){

        $client = new Client($this->settings);

        /* report to be sent */
        $report = new Report();

        //Setting report parameters
        $report->setUrl(Request::server()['HTTP_HOST'] . Request::server()['REQUEST_URI']);
        $report->setServer($this->config['server_name']);
        $report->setUserAgent(Request::server()['HTTP_USER_AGENT'] );
        $report->setMessage($this->exception->getMessage());
        $report->setRequestId($client->getUUID());
        $report->setError($this->exception->getMessage());
        $report->setHttpStatus($this->exception->getCode());

        //Process trace data
        $this->_processTrace($report);

        // Set request data
        $request = new AppEnlightRequest();
        $report->setRequest($request);

        //Send it
        $client->addReport($report);
        $client->sendReports();
    }

    /**
     * @param Exception $exception
     * @param Report $report
     */
    protected function _processTrace( Report $report) {

        foreach ($this->exception->getTrace() as $t) {
            $aeTrace = new Traceback();
            $aeTrace->setFile(isset($t['file']) ? $t['file'] : 'unknown');
            $aeTrace->setFn(isset($t['class']) ? "{$t['class']}->{$t['function']}" : $t['function']);
            $aeTrace->setLine(isset($t['line']) ? $t['line'] : 0);
            $aeArgs = array();
            foreach ($t['args'] as $arg) {
                $aeArgs[] = $arg;
            }
            $aeTrace->setVars(json_encode($aeArgs));
            $report->addTraceback($aeTrace);
            unset($aeTrace);
        }
    }
}
