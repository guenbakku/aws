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
        $this->request->allowMethod(['post']);
        $instanceId = $this->request->data('instanceId');
        $Instance = new Instance;
        $Instance->restart($instanceId);
        $this->render(false);
    }
    
    public function apiStart() {
        $this->request->allowMethod(['post']);
        $instanceId = $this->request->data('instanceId');
        $Instance = new Instance;
        $Instance->start($instanceId);
        $this->render(false);
    }
    
    public function apiStop() {
        $this->request->allowMethod(['post']);
        $instanceId = $this->request->data('instanceId');
        $Instance = new Instance;
        $Instance->stop($instanceId);
        $this->render(false);
    }
}
