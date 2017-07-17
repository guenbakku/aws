<?php
namespace Guenbakku\Sam\View\Cell;

use Cake\View\Cell;
use Cake\Core\Configure;

class RegionCell extends Cell {
    
    public function display($rootView) {
        $configPath = "{$this->request->plugin}.regions";
        $regions = Configure::read($configPath);

        $sessionPath = "{$this->request->plugin}.region";
        $currentRegion = $this->request->session()->read($sessionPath);

        $this->set(compact('regions', 'currentRegion', 'rootView'));
    }
}