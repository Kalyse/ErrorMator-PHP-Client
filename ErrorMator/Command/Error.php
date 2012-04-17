<?php

namespace ErrorMator\Command;

use Guzzle\Service\Command\AbstractCommand;

/**
 * Sends a simple API request to an example web service
 *
 */
class Error extends AbstractCommand {

    public function setError(array $error) {
        $this->error = $error;
    }

    public function setDetails(array $details) {
        $this->details = array($details);
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

        if (!isset($this->details) || !isset($this->error)) {
            throw new \Exception("You have not set an 'Error' or a 'Details' attribute/value for request to Error Reporting");
        }

        $this->error['report_details'] = $this->details;
        $body = json_encode(array(array_merge($this->error, $this->getAll())));
        $this->request = $this->client->post('/api/reports?protocol_version={{version}}&api_key={{api_key}}', null, $body);
        $this->request->setHeader('Content-Type', 'application/json');
    }

}

?>