<?php
require_once 'vendor/autoload.php';
use Core\Controller\Router as Router;
// use Model\Model as Model;
$GLOBALS['config'] = require 'config/db.php';

$router = new Router();
$router->route();
