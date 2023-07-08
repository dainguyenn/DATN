<?php

namespace Model;

require_once 'BaseModel.php';
class LuotGui extends BaseModel
{
    protected $primaryKey = 'ma_luot_gui';
    public const TB_NAME = 'luot_gui';
    public function __construct()
    {
        parent::__construct('luot_gui');
    }

    public function CheckMaTheDangGui($maVe)
    {
        $sql = "SELECT * FROM " . self::TB_NAME
            . " WHERE gio_ra is null and hinh_anh_ra is null and ma_ve = " . $maVe;
        return count($this->pdo->query($sql)) > 0;
    }

    public function GetThongTinTheDangGui($maVe)
    {
        $sql = "SELECT * FROM " . self::TB_NAME
            . " WHERE gio_ra is null and hinh_anh_ra is null and ma_ve = " . $maVe;
        return $this->pdo->query($sql)[0];
    }

    public function LocDuLieu($filter)
    {
        $sql = "SELECT * FROM " . self::TB_NAME .
            " LEFT JOIN " . ThongTinVe::TB_NAME .
            " ON " . self::TB_NAME . ".ma_ve = " . ThongTinVe::TB_NAME . ".ma_ve" .
            " LEFT JOIN " . ChuHo::TB_NAME .
            "ON" . ChuHo::TB_NAME . "ma_can_ho = " . ThongTinVe::TB_NAME . "ma_can_ho";
        print_r($sql);

        //return $this->pdo->query($sql);
    }
}