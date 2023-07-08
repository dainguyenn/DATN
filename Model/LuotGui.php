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

    public function LocDuLieu($bienSoXe)
    {
        $sql = "SELECT * FROM " . self::TB_NAME .
            " WHERE bien_so_xe like '%" . $bienSoXe . "%'";
        return $this->pdo->query($sql);
    }
}