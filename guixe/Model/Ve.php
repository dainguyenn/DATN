<?php

namespace Model;
require_once 'BaseModel.php';

class Ve extends BaseModel
{
    protected $primaryKey = 'ma_ve';

    public function __construct()
    {
        parent::__construct('ve');
    }

    public function getInfo($id = null, array $columns = ['*'])
    {
        $columns = $this->implodeColumns($columns);
        $tbJoin = ThongTinVe::TB_NAME;
        $sql = "SELECT $columns FROM $this->table INNER JOIN "
            . $tbJoin
            . " ON $this->table.$this->primaryKey = $tbJoin.$this->primaryKey";
        if($id){
            $sql.=" WHERE $this->primaryKey = $id";
        }
        $this->SQL_LOG($sql);
        return $this->pdo->query($sql);
    }
}