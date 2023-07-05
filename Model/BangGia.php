<?php

namespace Model;

require_once 'BaseModel.php';
class BangGia extends BaseModel
{
    protected $primaryKey = 'ma_gia';
    public const TB_NAME = 'bang_gia';
    public function __construct()
    {
        parent::__construct(self::TB_NAME);
    }

    public function getGia($loaiVe, $loaiXe, $khungGio)
    {
        $sql = "select * from " . BangGia::TB_NAME . " where loai_ve = '${loaiVe}' and loai_xe = '${loaiXe}' and khung_gio = '${khungGio}' ";
        $gia = $this->pdo->query($sql);
        if ($gia) {
            return $this->pdo->query($sql)[0]["gia"];
        } else {
            return 0;
        }
    }
}