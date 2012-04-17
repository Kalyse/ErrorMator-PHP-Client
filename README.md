 ErrorMator API
===============

There is no such thing as a perfect application. Errormator's main goal is to help you ensure your applications are working smooth, and get rid of all those pesky exceptions and errors. Errormator lets you and your team save precious time spent on debugging and repeating steps to produce errors from production environment. Time is money, let your team focus on new functionality instead of bughunting, or pulling pranks on teammates. And all in price of a pizza!

This API client provides an easy to use interface to send your errors, slow requests, and log reports to ErrorMator. 

Requirements
============
- PHP 5.3.2+ with cURL extension available.
- OpenSSL Support for HTTPS curl requests. 

Installation
============
To install this API in your application copy the three folders to a location accessible by your application. 
You can use your own autoloader, or even as a barebones autoloader use:

```php
spl_autoload_register(function($className) {
            require(str_replace('\\', '/', ltrim($className, '\\')) . '.php');
        });
```

Then whenever you want to use the ErrorMator client you should use the namespace:

```php
use ErrorMator\ErrorMatorClient;
```

Slow Requests, Log, Error
=============

The ErrorMator API provides three endpoints for you to send your reports. 

- Slow Requests
- Logs
- Errors

In order to send the respective message you should select the endpoint that you want to use from the ErrorMator Client.

```php

// Get the Client and Pass your API KEY
$client = ErrorMatorClient::factory(array("api_key" => "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ"));
// Get the Log API Endpoint Command for Sending Logging Information to ErrorMator
$command = $client->getCommand('log');
// Add my Log. 
$command->addLog(
        array(
            "log_level" => "ERROR",
            "message" => "Something really awful has happened to the kittens!",
            "name" => "some.namespace.indicator",
            "request_id" => "SOME_UUID"
        )
);
// Once you have added the logs through addLog(), you can execute and send the logs to ErrorMator.
$httpResponse = $client->execute($command);

```

Commands Available
===
These are the curretly supported commands that you can request from the API to communicate with ErrorMator

```php
$command = $client->getCommand('log'); // For Sending Log Information
$command = $client->getCommand('error'); // For Sending Error Information
$command = $client->getCommand('slow'); // For Sending Slow Request Information
```

For full use cases, see the example.php file and consult the API Documentation 

https://errormator.com/page/api-reports-create


