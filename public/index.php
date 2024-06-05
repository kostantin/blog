<?php

session_start();

require_once dirname(__DIR__) . '/config/config.php';
require_once ROOT . '/vendor/autoload.php';
require_once ROOT . '/support/helpers.php';


$router = new \classes\Router();

require_once ROOT . '/routes/web.php';

$router->route();





