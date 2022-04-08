<?php
require_once 'inc/Helper.php';

abstract class Controller {

    protected $model;

    public function __construct()
    {
        header('Content-Type: application/json');
        $this->model = new $this->model;
    }
}
?>
