<?php

namespace Model;

use Constant\CardConst;

require_once 'BaseModel.php';

class Ve extends BaseModel
{
    protected $primaryKey = 'ma_ve';

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
             WHERE chu_ho.ma_can_ho = $id LIMIT $start, $limit";
        $sqlCountRecord = "SELECT COUNT(*) AS total_record FROM $this->table";

        $totalRecord = $this->pdo->query($sqlCountRecord);
        $lastPage = ceil(count($totalRecord)/$limit);
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

    public function DanhSachVe($id = null, $limit = 25, $page = 1, $bienSoXe = '')
    {
        $sql= "SELECT * FROM $this->table INNER JOIN luot_gui ON $this->table.ma_ve = luot_gui.ma_ve
                                           where bien_so_xe like '%$bienSoXe%'";
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
        return [
            'data' => $totalRecord,
            'total' => $total,
            'current_page' => $page,
            'last_page' => 1
        ];
        $lastPage = ceil(count($totalRecord)/$limit);
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
        $sql="SELECT * FROM  $this->table INNER JOIN luot_gui ON $this->table.ma_ve = luot_gui.ma_ve WHERE luot_gui.thanh_toan IS NOT NULL ";

        $totalRecord = $this->pdo->query($sql);
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
             WHERE $this->table.loai_xe= '$loaiXe' AND chu_ho.ma_can_ho = '$maCanHo'
             ";
        $this->SQL_LOG($sql);
        return $this->pdo->query($sql)[0]['SL'];
    }
}