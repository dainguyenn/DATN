<?php

namespace Model;

use Const\EnvConst;
use Const\LocalEnv;
use core\CustomPDO;

class BaseModel
{
    protected $attributes;
    protected $table;
    protected $primaryKey;
    protected $pdo;

    public function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new CustomPDO();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";
        $this->SQL_LOG($sql);
        return $this->pdo->query($sql);
    }

    public function create(array $attributes = [])
    {
        $sql = "INSERT INTO $this->table";
        $keys = "(";
        $values = " VALUES(";
        foreach ($attributes as $key => $value) {
            $keys = $keys . $key . ',';
            $values = $values . "'$value'" . ',';
        }
        $keys = substr($keys, 0, -1) . ')';
        $values = substr($values, 0, -1) . ')';
        $sql .= $keys . $values;
        $this->SQL_LOG($sql);
        return $this->pdo->query($sql);
    }

    public function update($id, array $attributes = [])
    {
        $sql = "UPDATE $this->table SET";
        $values = "";
        $condition = " WHERE id = $id";
        foreach ($attributes as $key => $value) {
            $values = $values . $key . "=" . "'$value',";
        }
        $values = substr($values, 0, -1) . ')';
        $sql .= $values . $condition;
        $this->SQL_LOG($sql);
        return $this->pdo->query($sql);
    }

    public function findById($id,array $columns = ['*'])
    {
        $columns = $this->implodeColumns($columns);
        $sql = "SELECT $columns FROM $this->table WHERE $this->primaryKey = $id";
        $this->SQL_LOG($sql);

        return $this->pdo->query($sql)[0];
    }

    public function deleteById($id)
    {
        $sql = "DELETE FROM $this->table WHERE $this->primaryKey = $id";
        $this->SQL_LOG($sql);

        return $this->pdo->query($sql)[0];
    }
    protected function implodeColumns(array $columns = [])
    {
        return implode(',',$columns);
    }

    protected function SQL_LOG($sql)
    {
        if (EnvConst::USE_SQL_LOG) {
            $date = date_create('now', timezone_open('Asia/Saigon'))->format('Y-m-d H:i:s');
            $file = 'log.' . date_create('now', timezone_open('Asia/Saigon'))->format('Y-m-d') . '.log';
            $filePath = EnvConst::$SQL_LOG_PATH . '/log/sql/' . $file;
            if (!file_exists($filePath)) {
                file_put_contents($filePath, '');
            }
            $fp = fopen($filePath, 'a');
            $message = $date . ' | INFO: SQL(table: ' . $this->table . ', query: ' . $sql . ')';
            fwrite($fp, $message . "\n");
            fclose($fp);
        }
    }
}