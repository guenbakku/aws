<?php
namespace Guenbakku\Sam\Controller;

use Cake\Core\Configure;
use Cake\Utility\Hash;
use Cake\Event\Event;
use Guenbakku\Sam\Controller\AppController;
use Guenbakku\Sam\Model\Aws;

/**
 * Ec2Instances Controller
 *
 *
 * @method \Guenbakku\Sam\Model\Entity\Ec2[] paginate($object = null, array $settings = [])
 */
class RegionsController extends AppController {
    
    /**
     * Set region to Session
     *
     * @return \Cake\Http\Response|void
     */
    public function change($region) {
        $region = $region?:Configure::read('Sam.regions.0');
        $Aws = new Aws;
        $Aws->region($region);
        return $this->redirect($this->referer());
    }
}
