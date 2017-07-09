<?php
namespace Guenbakku\Sam\Model;

use Cake\Core\Configure;

class Aws {
    
    protected $credentials;
    
    public function __construct() {
        $this->setCredentials();
    }
    
    /**
     * Set credential info from config file
     *
     * @param   string: credential group name
     * @return  object
     */
    public function setCredentials($group = null) {
        if ($group === null) {
            $group = Configure::read('Sam.credentials.uses');
        }
        $this->credentials = Configure::read("Sam.credentials.$group");
        return $this;
    }
}