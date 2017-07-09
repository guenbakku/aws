<?php
namespace Guenbakku\Sam\Controller;

use Cake\Core\Configure;
use Cake\Utility\Hash;
use Guenbakku\Sam\Controller\AppController;
use Guenbakku\Sam\Model\Ec2\Instance;

/**
 * Ec2Instances Controller
 *
 *
 * @method \Guenbakku\Sam\Model\Entity\Ec2[] paginate($object = null, array $settings = [])
 */
class Ec2InstancesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $Instance = new Instance;
        $instances = $Instance->list('us-east-1');
        // debug($instances);
        $this->set(compact('instances'));
    }
}
