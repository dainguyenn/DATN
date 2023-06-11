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
            . " ON $this->table.$this->primaryKey = $tbJoin.$this->primaryKey
             INNER JOIN chu_ho ON chu_ho.ma_can_ho = $tbJoin.ma_can_ho";
        if ($id) {
            $sql .= " WHERE $this->primaryKey = $id";
        }
        $this->SQL_LOG($sql);
        return $this->pdo->query($sql);
    }

    public function check($maCanHo, $loaiXe)
    {
        $tbJoin = ThongTinVe::TB_NAME;

        $sql = "SELECT COUNT(loai_xe) AS SL FROM $this->table INNER JOIN "
            . $tbJoin
            . " ON $this->table.$this->primaryKey = $tbJoin.$this->primaryKey
             INNER JOIN chu_ho ON chu_ho.ma_can_ho = $tbJoin.ma_can_ho WHERE $this->table.loai_xe= '$loaiXe' AND chu_ho.ma_can_ho = '$maCanHo'";
        $this->SQL_LOG($sql);
        return $this->pdo->query($sql)[0]['SL'];
    }
}