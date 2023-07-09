<?php

namespace Model;

use Constant\CardConst;

require_once 'BaseModel.php';

class Ve extends BaseModel
{
    protected $primaryKey = 'ma_ve';
    public const TB_NAME = 've';
    protected $softDelete = true;
    public function __construct()
    {
        parent::__construct('ve');
    }

    /**
     * @param $id
     * @param array $columns
     * @return bool|array|null
     * Lấy thông tin của vé  (ve + thong_tin_ve) nếu có id lấy thông tin vé có ma_ve
     */
    public function getInfo($id = null, array $columns = ['*'], $limit = 25, $page = 1): bool|array|null
    {
        $columns = $this->implodeColumns($columns);
        $start = ($page - 1) * $limit;

        $tbJoin = ThongTinVe::TB_NAME;
        $sql = "SELECT $columns FROM $this->table INNER JOIN "
            . $tbJoin
            . " ON $this->table.$this->primaryKey = $tbJoin.$this->primaryKey
             INNER JOIN chu_ho ON chu_ho.ma_can_ho = $tbJoin.ma_can_ho
             WHERE chu_ho.ma_can_ho = $id AND ve.deleted_at IS NULL LIMIT $start, $limit";
        $sqlCountRecord = "SELECT COUNT(*) AS total_record FROM $this->table";

        $totalRecord = $this->pdo->query($sqlCountRecord);
        $lastPage = ceil(count($totalRecord) / $limit);
        $this->SQL_LOG($sql);
        $result = $this->pdo->query($sql);
        $total = count($result);
        return [
            'data' => $result,
            'total' => $total,
            'current_page' => $page,
            'last_page' => $lastPage
        ];
    }

    public function getCardDay($id = null, array $columns = ['*'], $limit = 25, $page = 1)
    {
        $columns = $this->implodeColumns($columns);
        $start = ($page - 1) * $limit;

        $sql = "SELECT $columns FROM $this->table WHERE loai_ve ='" . CardConst::TYPE_DAY . "' LIMIT $start, $limit";
        $this->SQL_LOG($sql);
        $result = $this->pdo->query($sql);
        $total = count($result);

        return [
            'data' => $result,
            'total' => $total,
            'current_page' => $page
        ];
    }

    public function DanhSachVe($id = null, $limit = 25, $page = 1, $filter)
    {
        $sql = "SELECT luot_gui.ma_luot_gui, luot_gui.ma_ve, ve.loai_ve, ve.loai_xe, luot_gui.bien_so_xe, luot_gui.gio_vao, luot_gui.gio_ra, ve.trang_thai FROM " . self::TB_NAME .
            " RIGHT JOIN " . LuotGui::TB_NAME .
            " ON " . LuotGui::TB_NAME . ".ma_ve = " . Ve::TB_NAME . ".ma_ve" .
            " LEFT JOIN " . ThongTinVe::TB_NAME .
            " ON " . self::TB_NAME . ".ma_ve = " . ThongTinVe::TB_NAME . ".ma_ve" .
            " LEFT JOIN " . ChuHo::TB_NAME .
            " ON " . ChuHo::TB_NAME . ".ma_can_ho = " . ThongTinVe::TB_NAME . ".ma_can_ho";
        if (isset($filter)) {
            $condtion = [];
            if (isset($filter['bien_so_xe']) && !empty($filter['bien_so_xe'])) {
                array_push($condtion, LuotGui::TB_NAME . ".bien_so_xe like '%${filter['bien_so_xe']}%'");
            }
            if (isset($filter['ma_ve']) && !empty($filter['ma_ve'])) {
                array_push($condtion, LuotGui::TB_NAME . ".ma_ve like '%${filter['ma_ve']}%'");
            }
            if (isset($filter['loai_ve']) && !empty($filter['loai_ve'])) {
                array_push($condtion, Ve::TB_NAME . ".loai_ve like '%${filter['loai_ve']}%'");
            }
            if (isset($filter['ten_chu_ho']) && !empty($filter['ten_chu_ho'])) {
                array_push($condtion, ChuHo::TB_NAME . ".ten_chu_ho like '%${filter['ten_chu_ho']}%'");
            }
            foreach ($condtion as $item => $value) {
                if ($item == 0) {
                    $sql = $sql . " WHERE " . $value;
                } else {
                    $sql = $sql . " AND " . $value;
                }
            }
        }
        print_r($sql);
        $totalRecord = $this->pdo->query($sql);
        $this->SQL_LOG($sql);
        $result = $this->pdo->query($sql);
        $total = count($result);



        return [
            'data' => $totalRecord,
            'total' => $total,
            'current_page' => $page,
            'last_page' => 1
        ];
    }
    public function DangGui($id = null, $limit = 25, $page = 1)
    {

        $start = ($page - 1) * $limit;

        $sql = "SELECT * FROM $this->table INNER JOIN luot_gui ON $this->table.ma_ve = luot_gui.ma_ve
                WHERE luot_gui.gio_ra IS null";

        $totalRecord = $this->pdo->query($sql);
        $total = count($totalRecord);
        return [
            'data' => $totalRecord,
            'total' => $total,
            'current_page' => $page,
            'last_page' => 1
        ];
        $lastPage = ceil(count($totalRecord) / $limit);
        $this->SQL_LOG($sql);
        $result = $this->pdo->query($sql);
        $total = count($result);
        return [
            'data' => $result,
            'total' => $total,
            'current_page' => $page,
            'last_page' => $lastPage
        ];
    }

    public function DaThanhToan($id = null, $limit = 25, $page = 1)
    {
        $sql = "SELECT * FROM  $this->table INNER JOIN luot_gui ON $this->table.ma_ve = luot_gui.ma_ve WHERE luot_gui.thanh_toan IS NOT NULL ";

        $totalRecord = $this->pdo->query($sql);
        $total = count($totalRecord);
        return [
            'data' => $totalRecord,
            'total' => $total,
            'current_page' => $page,
            'last_page' => 1
        ];

    }
    /**
     * @param $maCanHo
     * @param $loaiXe
     * @return mixed
     * Đếm số lựượng xe cư dân đã đăng ký
     */
    public function check($maCanHo, $loaiXe)
    {
        $tbJoin = ThongTinVe::TB_NAME;

        $sql = "SELECT COUNT(loai_xe) AS SL FROM $this->table INNER JOIN "
            . $tbJoin
            . " ON $this->table.$this->primaryKey = $tbJoin.$this->primaryKey
             INNER JOIN chu_ho ON chu_ho.ma_can_ho = $tbJoin.ma_can_ho 
             WHERE $this->table.loai_xe= '$loaiXe' AND chu_ho.ma_can_ho = '$maCanHo' AND ve.deleted_at IS NULL
             ";
        $this->SQL_LOG($sql);
        return $this->pdo->query($sql)[0]['SL'];
    }

    public function deleteById($id): bool|array|null
    {
        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE $this->table SET deleted_at = '$now' WHERE id=$id";
        $this->SQL_LOG($sql);
        return $this->pdo->query($sql);
    }
}