<?php
namespace Guenbakku\Sam\Model;

use \InvalidArgumentException;
use Cake\Core\Configure;
use Cake\Network\Session;

class Aws {
    
    public $Session;
    public $plugin;
    
    public function __construct() {
        $this->Session = new Session();
        $this->plugin = Configure::read('guenbakku.plugin');
        
        // Set default value to Session
        if (empty($this->Session->read("{$this->plugin}.credentials"))) {
            $this->credentials(Configure::read("{$this->plugin}.credentials.uses"));
        }
        if (empty($this->Session->read("{$this->plugin}.region"))) {
            $this->region(Configure::read("{$this->plugin}.regions.0"));
        }
    }
    
    /**
     * Set or get credentials from Session.
     *
     * @param   string: credential group name
     * @return  object
     */
    public function credentials($group = null) {
        if (empty($group)) {
            return $this->Session->read("{$this->plugin}.credentials");
        } else {
            $credentials = Configure::read("{$this->plugin}.credentials.{$group}");
            $this->Session->write("{$this->plugin}.credentials", $credentials);
        }
    }
    
    /**
     * Save or get region from Session.
     *
     * @param   string: region name (ex: us-east-1)
     * @return  void
     */
    public function region($region = null) {
        if (empty($region)) {
            return $this->Session->read("{$this->plugin}.region");
        } else {
            if (!in_array($region, Configure::read("{$this->plugin}.regions"))) {
                throw new InvalidArgumentException("Invalid region name: $region");
            }
            $this->Session->write("{$this->plugin}.region", $region);
        }
    }
}