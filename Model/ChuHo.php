<?php

namespace Model;
require_once 'BaseModel.php';
class ChuHo extends BaseModel
{
    protected $primaryKey = 'ma_can_ho';
    public const TB_NAME = 'chu_ho';
    public function __construct()
    {
        parent::__construct(self::TB_NAME);
    }
}