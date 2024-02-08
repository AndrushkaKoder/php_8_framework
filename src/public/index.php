<?php

require_once dirname(__DIR__) . '/config/constants.php';
require_once BASE_PATH . '/vendor/autoload.php';

session_start();

$app = new \Kernel\App();

$app->run();
