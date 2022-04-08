<?php

abstract class Controller {

    protected $model;

    public function __construct()
    {
        $this->model = new $this->model;
    }
}
?>
