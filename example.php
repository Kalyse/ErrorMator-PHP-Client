<?php

spl_autoload_register(function($className) {
            require(str_replace('\\', '/', ltrim($className, '\\')) . '.php');
        });
ini_set('display_errors', 'On');
error_reporting(E_ALL);

use ErrorMator\ErrorMatorClient;

// Get the Client and Pass your API KEY
$client = ErrorMatorClient::factory(array("api_key" => "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ"));


/*
 * Basic Example of Sending a Slow Request Error
 * SLOW REPORT EXAMPLE
 */

// Retrieve the Command that you Want to Execute
$command = $client->getCommand('slow');
// Add the Parameters that you want to Send to ErrorMator
$command->addSlowRequest(
        array(
            "url" => "http://slow_req_url.com",
            "server" => "SERVER_NAME",
            "report_details" =>
            array(
                array(
                    "start_time" => "2011-09-25T21:46:38.955371",
                    "end_time" => "2011-09-25T21:47:00.577239",
                    "template_start_time" => null,
                    "username" => "USER",
                    "url" => "HTTP://SOMEURL",
                    "ip" => "127.0.0.1",
                    "user_agent" => "BROWSER_AGENT",
                    "message" => "CUSTOM MESSAGE",
                    "request_id" => "SOME_UUID",
                    "request" => array("POST" => array('foo' => 'bar', 'xxx' => 'zzz')),
                    "slow_calls" => array(
                        array(
                            "duration" => 11.2424,
                            "timestamp" => "2011-09-25T21:46:38.974148",
                            "type" => "sqlalchemy"
                        )
                    )
                )
            )
        )
);
// Execute the Request.
$httpResponse = $client->execute($command);




/*
 * Basic Example of Sending a Log Message 
 * LOG REPORT EXAMPLE
 */
$command = $client->getCommand('log');
$command->addLog(
        array(
            "log_level" => "ERROR",
            "message" => "HTTP://google.com",
            "name" => "some.namespace.indicator",
            "request_id" => "SOME_UUID"
        )
);
$httpResponse = $client->execute($command);

/*
 * Basic Example of Sending an Error
 * LOG REPORT EXAMPLE
 */
$command = $client->getCommand('error');
$command->setDetails(
        array(
            "username" => "USER",
            "url" => "HTTP://google.com",
            "ip" => "127.0.0.1",
            "user_agent" => "BROWSER_AGENT",
            "message" => "CUSTOM MEdaSSAGE",
            "request_id" => "SOME_UUID"
        )
);
$command->setError(
        array(
            "errormator.client" => "php",
            "traceback" => "TRACEBaasafsdACK TEXggT",
            "server" => "Disco",
            "priority" => 6,
            "error_type" => "Neadw Eraror",
            "occurences" => 1,
            "http_status" => 500
        )
);
$httpResponse = $client->execute($command);
?>