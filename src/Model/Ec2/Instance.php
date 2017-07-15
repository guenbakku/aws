<?php

namespace Guenbakku\Sam\Model\Ec2;

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
    public function list($region) {
        $ec2 = new Ec2Client([
            'version' => 'latest',
            'region' => $region,
            'credentials' => $this->credentials,
        ]);
        
        $response = $ec2->describeInstances()->toArray();
        $response = $this->simplify($response);
        return $response;
    }
    
    /**
     * Restart specific EC2 instance
     *
     * @param   string: EC2 instance id
     * @return  void
     */
    public function restart($instaceId) {
        
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