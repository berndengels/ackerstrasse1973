<?php
require_once('Models/Model.php');

class Vote extends Model
{
    protected $table = 'votes';

    public function countUp()
    {
        $sql = "SELECT SUM(up) AS sumUp FROM $this->table";
        return $this->getOne($sql)['sumUp'];
    }

    public function countDown()
    {
        $sql = "SELECT SUM(down) AS sumDown FROM $this->table";
        return $this->getOne($sql)['sumDown'];
    }

}
