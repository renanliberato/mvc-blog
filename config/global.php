<?php

return [
    'routes' => [
        '/' => [
            'controller' => Application\Controller\IndexController::class,
            'action' => 'index',
        ],
    ],
    'controllers' => [
        Application\Controller\IndexController::class,
        Application\Controller\AuthController::class,
    ],
    'controllers_factories' => [
        Application\Controller\IndexController::class => Application\Controller\IndexControllerFactory::class,
        Application\Controller\AuthController::class => Application\Controller\AuthControllerFactory::class,
    ],
    'view_path' => './src/Application/templates/',
];
