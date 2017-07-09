<?php
use Cake\Core\Configure;

Configure::load('Guenbakku/Sam.sam');

// Load config file in root if it is existing
if (is_file(implode(DS, [ROOT, 'config', 'sam.php']))) {
    Configure::load('sam');
}