<?php
require_once 'inc/MyDB.php';

class Model extends MyDB {

    protected $table;

    public function all() {
        $sql = "SELECT * FROM $this->table ORDER BY id DESC";
        return $this->getAll($sql);
    }

    public function find(int $id) {
        $sql = "SELECT * FROM $this->table WHERE id= ?";
        return $this->getOne($sql,[$id]);
    }

    public function where(array $params)
    {
        $conditions = [];
        foreach(array_keys($params) as $item) {
            $conditions[] = "$item = :$item";
        }
        $strConditions = implode(' AND ', $conditions);
        $sql = "SELECT * FROM $this->table WHERE $strConditions";

        $data = $this->getAll($sql, $params);
        if(count($data) === 1) {
            return $data[0];
        }
        return $data;
    }

    public function delete(int $id) {
        $sql = "DELETE FROM $this->table WHERE id= ?";
        return $this->prepareAndExecute($sql,[$id]);
    }

    public function insert(array $params) {
        $keys           = array_keys($params);
        $columns        = implode(',', $keys);
        $placeholder    = implode(',', array_map(fn($item) => ":$item", $keys));
        $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholder);";

        return $this->prepareAndExecute($sql, $params);
    }

    public function update(array $params, int $id) {
        $keys = array_keys($params);
        $placeholder = implode(',', array_map(fn($item) => "$item = :$item", $keys));
        $sql = "UPDATE $this->table  SET $placeholder WHERE id = :id;";
        $params['id'] = $id;

        return $this->prepareAndExecute($sql, $params);
    }
}
?>
