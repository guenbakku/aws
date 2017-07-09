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
        
        $result = $ec2->describeInstances()->toArray();
        $result = Hash::get($result, 'Reservations.0.Instances');
        $result = $this->extractTag($result);
        return $result;
    }
    
    /**
     * Extract Tags item in result to ['key' => value] format
     *
     * @param   array: instances list
     * @return  array: instances list
     */
    public function extractTag($result) {
        foreach ($result as &$item) {
            if (count($item['Tags']) > 0) {
                $item['Tags'] = array_column($item['Tags'], 'Value', 'Key');
            }
        }
        return $result;
    }
    
    /**
     * Restart specific EC2 instance
     *
     * @param   string: EC2 instance id
     * @return  void
     */
    public function restart($instaceId) {
        
    }
}