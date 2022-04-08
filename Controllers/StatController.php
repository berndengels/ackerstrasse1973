<?php
require_once 'Controllers/Controller.php';
require_once 'Models/Stat.php';

class StatController extends Controller
{
    protected $model = Stat::class;

    public function __invoke(int $value)
    {
        $this->model->insert(['val' => $value]);
        $this->values();
    }

    public function values()
    {
        die(json_encode(['countStat' => $this->model->count()]));
    }
}
