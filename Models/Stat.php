<?php
require_once('Models/Model.php');

class Stat extends Model
{
    protected $table = 'stats';

    public function count()
    {
        $sql = "SELECT COUNT(*) AS statCount FROM $this->table";
        return $this->getOne($sql)['statCount'];
    }
}
