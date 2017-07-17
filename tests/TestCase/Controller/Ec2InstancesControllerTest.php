<?php
namespace Guenbakku\Sam\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use Guenbakku\Sam\Controller\Ec2InstancesController;

/**
 * Guenbakku\Sam\Controller\Ec2Controller Test Case
 */
class Ec2InstancesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.guenbakku/sam.ec2instances'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
