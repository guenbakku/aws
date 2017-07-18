<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'Guenbakku/Sam',
    ['path' => '/sam'],
    function (RouteBuilder $routes) {
        $routes->extensions(['json']);
        $routes->redirect('/', [
            'controller' => 'Ec2Instances', 
            'action' => 'index'
        ]);
        $routes->fallbacks(DashedRoute::class);
    }
);

