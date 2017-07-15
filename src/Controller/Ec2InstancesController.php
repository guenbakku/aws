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
    public function index($region = null) {
        $region = $region?:Configure::read('Sam.regions.0');
        $Instance = new Instance;
        $instances = $Instance->list($region);
        $this->set(compact('region', 'instances'));
    }
    
    public function apiRestart() {
        $instanceId = $this->request->query('instanceId');
        $Instance = new Instance;
    }
}
