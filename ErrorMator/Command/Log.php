<?php

namespace ErrorMator\Command;

use Guzzle\Service\Command\AbstractCommand;

/**
 * Sends a simple API request to an example web service
 *
 */
class Log extends AbstractCommand {

    private $_log = array();

    public function setLog(array $log) {
        unset($this->_log);
        $this->_log[] = $log;
    }

    public function addLog(array $log) {
        $this->_log[] = $log;
    }

    /*
     * 
     * Possible data you can currenty send:
      http_status         : HTTP status of the request default 200
      priority            : Priority of the error default 1
      error_type          : Error/Exception name, saved up to 500 characters
      server              : server/instance name, saved up to 255 characters
      traceback           : (stacktrace), saved up to 10000 characters
      report_details      : Contains entries describing separate requests that made the error appear, its a list of dictionary objects
      occurences          : How many times error occured default 1
      client              : Used to determine what kind of client sent information, useful for future postprocessing information
      group_string        : Used to determine how to group errors together - errormators default: url+error_type hash
     *
     */

    protected function build() {
        $body = array();
        // Remove any logs which do not contain log_level and the message
        foreach ($this->_log as $log) {
            if (isset($log['log_level']) && isset($log['message'])) {
                $body[] = $log;
            }
        }
        $raw = json_encode($body);
      
        $this->request = $this->client->post('/api/logs?protocol_version={{version}}&api_key={{api_key}}', null, $raw);
        $this->request->setHeader('Content-Type', 'application/json');
    }

}

?>