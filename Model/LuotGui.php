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

    public function ChiTietDoanhThuCacNgay($month = null, $year = null)
    {

        if ($month == null) {
            $month = date("m");
        }

        if ($year == null) {
            $year = date("Y");
        }

        $tbNameSelf = self::TB_NAME;

        $sql = <<<SQL
            SELECT DAY(DATE(gio_ra)) AS ngay, SUM(thanh_toan) AS tong_doanh_thu
            FROM $tbNameSelf
            WHERE MONTH(gio_ra) = $month
                AND YEAR(gio_ra) = $year
            GROUP BY DATE(gio_ra)
            ORDER BY DATE(gio_ra)
        SQL;
        return $this->pdo->query($sql);
    }
}