<?php

session_start();

chdir(dirname(__DIR__));

// Composer autoloading
include __DIR__ . '/../vendor/autoload.php';

$globalConfig = require './config/global.php';
$localConfig = [];

if (file_exists('./config/local.php'))
    $localConfig = require './config/local.php';

$config = array_merge($globalConfig, $localConfig);

OurMVCFramework\Application::run($config);
