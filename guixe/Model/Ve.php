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
             WHERE $this->table.deleted_at IS NULL
              LIMIT $start, $limit";
        $sqlCountRecord = "SELECT COUNT(*) AS total_record FROM $this->table";

        if ($id) {
            $sql .= " WHERE $this->primaryKey = $id";
            $sqlCountRecord.= " WHERE $this->primaryKey = $id";
        }
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

        $sql = "SELECT $columns FROM $this->table WHERE loai_ve ='" . CardConst::TYPE_DAY . "' AND 
          $this->table.deleted_at IS NULL LIMIT $start, $limit";
        $this->SQL_LOG($sql);
        $result = $this->pdo->query($sql);
        $total = count($result);

        return [
            'data' => $result,
            'total' => $total,
            'current_page' => $page
        ];
    }

    public function getAll()
    {
        $sql = "SELECT * FROM $this->table WHERE deleted_at IS NULL";
        $this->SQL_LOG($sql);
        return $this->pdo->query($sql);
    }

    public function deleteById($id): bool|array|null
    {
        $now = date('Y-m-d H:i:s'); ;
        $sql = "UPDATE $this->table SET deleted_at = '$now' WHERE $this->primaryKey = $id";
        $this->SQL_LOG($sql);
        return $this->pdo->query($sql);
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
             WHERE $this->table.loai_xe= '$loaiXe' AND chu_ho.ma_can_ho = '$maCanHo'";
        $this->SQL_LOG($sql);
        return $this->pdo->query($sql)[0]['SL'];
    }
}