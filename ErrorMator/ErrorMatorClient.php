<?php

namespace ErrorMator;

use Guzzle\Service\Client;
use Guzzle\Service\Inspector;
use Guzzle\Service\Description\XmlDescriptionBuilder;

class ErrorMatorClient extends Client {
     const VERSION = "0.2";
    
    /**
     * Factory method to create a new ErrorMatorClient
     *
     * @param array|Collection $config Configuration data. Array keys:
     *    base_url - Base URL of web service
     *
     * @return ErrorMatorClient
     *
     * @TODO update factory method and docblock for parameters
     */
    public static function factory($config) {
        $default = array(
            'base_url' => '{scheme}://api.errormator.com/',
            'scheme' => 'https',
            'version' => '0.2'
        );
        
        $required = array('api_key');
        $config = Inspector::prepareConfig($config, $default, $required);

        $client = new self(
                        $config->get('base_url'),
                        $config->get('api_key')
        );
        $client->setConfig($config);

        // $client->setDescription(XmlDescriptionBuilder::build(__DIR__ . DIRECTORY_SEPARATOR . 'client.xml'));
        $client->setUserAgent ( sprintf( 'ErrorMator/%s (Language=PHP/%s)',
                self::VERSION,
                \PHP_VERSION
            ) );
        
        return $client;
    }

    /**
     * Client constructor
     *
     * @param string $baseUrl Base URL of the web service
     * @param string $apiKey API Private Key

     */
    public function __construct($baseUrl, $apiKey) {
        parent::__construct($baseUrl);
      
    }

}