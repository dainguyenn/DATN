<?php

namespace Model;
use core\CustomPDO;

require_once 'core/CustomPDO.php';

class BaseModel
{
    protected $attributes;
    protected $table;
    protected $pdo;
    public function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new CustomPDO();
    }

    public function getAll() {
        $sql = "SELECT * FROM $this->table";
        return $this->pdo->query($sql);
    }
}