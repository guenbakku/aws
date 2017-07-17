<?php

namespace Guenbakku\Sam\Model\Ec2;

use Cake\Core\Configure;
use Cake\Utility\Hash;
use Aws\Ec2\Ec2Client;
use Guenbakku\Sam\Model\Aws;

class Instance extends Aws{
    
    /**
     * List all EC2 instances in specific region
     *
     * @param   string: region code
     * @return  array: ec2 instances info
     */
    public function list($region=null) {        
        $ec2 = new Ec2Client([
            'version' => 'latest',
            'region' => $region?:$this->region(),
            'credentials' => $this->credentials(),
        ]);
        
        $response = $ec2->describeInstances([
            'Filters' => Configure::read("{$this->plugin}.describeInstances.Filters"),
        ])->toArray();
        $response = $this->simplify($response);
        return $response;
    }
    
    /**
     * Restart specific EC2 instance
     *
     * @param   string: EC2 instance id
     * @return  void
     */
    public function restart($instanceId) {
        $ec2 = new Ec2Client([
            'version' => 'latest',
            'region' => $this->region(),
            'credentials' => $this->credentials(),
        ]);
        
        $result = $ec2->rebootInstances([
            'InstanceIds' => [$instanceId],
        ]);
        
        // According to document, rebootInstances() always returns 
        // an empty array, so I hard coding 'return true' here.
        return true;
    }
    
    /**
     * Reduce hierarchy number of response from AWS
     *
     * @param   array: instances list
     * @return  array: hierarchy reduced instances list
     */
    protected function simplify($response) {
        $response = $response['Reservations'];
        foreach ($response as &$item) {
            $item = $item['Instances'][0];
            $item = $this->tagsToKeyVal($item);
        }
        return $response;
    }
    
    /**
     * Extract Tags item in result to ['key' => value] format
     *
     * @param   array: instance info
     * @return  array: instance info
     */
    protected function tagsToKeyVal($instance) {
        if (count($instance['Tags']) > 0) {
            $instance['Tags'] = array_column($instance['Tags'], 'Value', 'Key');
        }
        return $instance;
    }
}