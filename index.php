<?php
require_once 'vendor/autoload.php';
use Core\Controller\Router as Router;
// use Model\Model as Model;
$GLOBALS['conf'] = require 'config/conf.php';

$router = new Router();
$router->route();
