<?php

namespace Guenbakku\Aws\Controller;

use Cake\Event\Event;
use App\Controller\AppController as BaseController;

class AppController extends BaseController {
    
    public function beforeRender(Event $Event) {
        parent::beforeRender($Event);
        $this->set(['plugin' => 'Aws']);
    }
}
