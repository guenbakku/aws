<?php
namespace Guenbakku\Sam\Controller;

use Cake\Core\Configure;
use Cake\Utility\Hash;
use Cake\Event\Event;
use Guenbakku\Sam\Controller\AppController;
use Guenbakku\Sam\Model\Ec2\Instance;

/**
 * Ec2Instances Controller
 *
 *
 * @method \Guenbakku\Sam\Model\Entity\Ec2[] paginate($object = null, array $settings = [])
 */
class Ec2InstancesController extends AppController {
    
    public function beforeFilter(Event $Event) {
        parent::beforeFilter($Event);
        if (strpos($this->request->params['action'], 'api') === 0) {
            $this->viewBuilder()->layout(false);
        }
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $Instance = new Instance;
        $instances = $Instance->list();
        $this->set(compact('instances'));
    }
    
    public function apiRestart() {
        $instanceId = $this->request->query('instanceId');
        $Instance = new Instance;
    }
    
    public function test($id) {
        // debug($this->request->plugin);
        // $this->render(false);
        $Instance = new Instance;
        // debug($Instance->restart($id));
        $Instance->setRegion('Bach'); 
    }
}
