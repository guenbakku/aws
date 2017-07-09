<?php
namespace Guenbakku\Sam\Controller;

use Guenbakku\Sam\Controller\AppController;

/**
 * Users Controller
 *
 *
 * @method \Aws\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController {
    
    /**
     * Login method
     */
    public function login() {
        if ($this->request->is('post')) {
            $user = $this->request->data;
        }
        $this->set(compact('user'));
    }
}
