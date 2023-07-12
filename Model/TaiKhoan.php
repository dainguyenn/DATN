<?php

namespace Model;

require_once 'BaseModel.php';
class TaiKhoan extends BaseModel
{
    protected $primaryKey = 'ma_tai_khoan';
    public const TB_NAME = 'tai_khoan';
    public function __construct()
    {
        parent::__construct('tai_khoan');
    }

    public function Login($userName, $passWord)
    {
        $tableName = self::TB_NAME;
        $sql = <<<SQL
            SELECT *
            FROM $tableName
            WHERE ten_tai_khoan = '$userName'
            AND mat_khau = '$passWord'
        SQL;
        $account = $this->pdo->query($sql);
        return $account;
    }
}