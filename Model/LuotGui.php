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
        return $this->pdo->query($sql);
    }

    public function TongTienTheoThang($month = null, $year = null)
    {
        if (!isset($month)) {
            $month = date("m");
        }

        if (!isset($year)) {
            $year = date("yyyy");
        }

        $tbNameSelf = self::TB_NAME;
        $tbNameVe = Ve::TB_NAME;

        $sql = <<<SQL
            SELECT MONTH(gio_ra), SUM(thanh_toan) AS total_revenue
            FROM $tbNameSelf
            JOIN $tbNameVe  ON $tbNameSelf.ma_ve = $tbNameVe.ma_ve
            WHERE ve.loai_ve = 'Ngày'
                AND MONTH(gio_ra) = $month
                AND YEAR(gio_ra) = $year
            GROUP BY MONTH(gio_ra),  YEAR(gio_ra)
        SQL;
        echo $sql;
        return $this->pdo->query($sql);
    }
}