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
}