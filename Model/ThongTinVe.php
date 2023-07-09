<?php

namespace Model;

require_once 'BaseModel.php';
class ThongTinVe extends BaseModel
{
    protected $primaryKey = 'ma_ve';
    public const TB_NAME = 'thong_tin_ve';
    public function __construct()
    {
        parent::__construct('thong_tin_ve');
    }

    public function kiemTraBienSo($bienSo)
    {
        $sql = "SELECT * FROM $this->table INNER JOIN ve ON ve.ma_ve = $this->table.ma_ve  
        WHERE $this->table.bien_so_xe = '$bienSo' AND ve.deleted_at IS NULL";
        return $this->pdo->query($sql);
    }
}