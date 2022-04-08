<?php
require_once 'Controllers/Controller.php';
require_once 'Models/Vote.php';

class VoteController extends Controller
{
    protected $model = Vote::class;

    public function __invoke(int $value)
    {
        $key = ($value == 1) ? 'up' : 'down';
        $sessionId = session_id();

        if($this->model->where(['session' => $sessionId])) {
            die(json_encode([
                'hasVoted'   => 1,
            ]));
        }

        $this->model->insert([$key => 1, 'session' => $sessionId]);
        die(json_encode([
            'hasVoted'   => 0,
            'countUp'   => $this->model->countUp(),
            'countDown' => $this->model->countDown(),
        ]));
    }

    public function values()
    {
        die(json_encode([
            'countUp'   => $this->model->countUp(),
            'countDown' => $this->model->countDown(),
        ]));
    }
}
