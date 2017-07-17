<?php

namespace Guenbakku\Sam\Controller;

use Cake\Event\Event;
use Cake\Core\Configure;
use App\Controller\AppController as BaseController;

class AppController extends BaseController {
    
    public function beforeFilter(Event $Event) {
        parent::beforeFilter($Event);
        
        // Write name of plugin to global Config to use in another places.
        Configure::write('guenbakku.plugin', $this->request->plugin);
    }
}
