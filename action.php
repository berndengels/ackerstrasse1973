<?php
ini_set('session.gc_maxlifetime', 315360000);
session_start();
require_once 'inc/Helper.php';

$controller = null;
$action = null;
$value = null;

if($_GET && isset($_GET['controller'])) {

    switch ($_GET['controller']) {
        case 'stat':
            require_once 'Controllers/StatController.php';
            $controller = new StatController();
            break;
        case 'vote':
            require_once 'Controllers/VoteController.php';
            $controller = new VoteController();
            break;
    }

    if($controller) {
        if(isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
            $action = $_GET['action'];
            $controller->$action();
        }
        if(isset($_GET['value'])){
            $value = (int) $_GET['value'];
            $controller($value);
        }
    }
}
