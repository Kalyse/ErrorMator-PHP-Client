<?php

namespace ErrorMator\Command;

use Guzzle\Service\Command\AbstractCommand;

/**
 * Sends a simple API request to an example web service
 *
 */
class Slow extends AbstractCommand {

    private $_slow = array();    
    public function addSlowRequest(array $slow) {
        $this->_slow[] = $slow;
    }

    /*
     * 
     * Possible data you can currently send:
          url URL of the request
          start_time Start time of request
          end_time End time of request
          template_start_time Start time of template render
          server server/instance name, saved up to 255 characters
          request Should contain information useful to identify cause of slowness default 1
          report_details Contains entries describing separate slow queries/calls to datastore, its a list of dictionary objects
          client Used to determine what kind of client sent information, useful for future postprocessing information
     *
     */

    protected function build() {
        
        $raw = json_encode( $this->_slow );
        $this->request = $this->client->post('/api/slow_reports?protocol_version={{version}}&api_key={{api_key}}', null, $raw);
        $this->request->setHeader('Content-Type', 'application/json');
        
    }

}

?>