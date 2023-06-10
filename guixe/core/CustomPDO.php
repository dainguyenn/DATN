<?php

namespace core;

use Const\EnvConst;
use PDOException;
use PDO;

class CustomPDO{
    private $host;
    private $dbname;
    private $username;
    private $password;
    private PDO $pdo;

    public function __construct() {
        $this->host = EnvConst::$DB_HOST.':'.EnvConst::$DB_PORT;
        $this->dbname = EnvConst::$DB_DATABASE;
        $this->username = EnvConst::$DB_USERNAME;
        $this->password = EnvConst::$DB_PASSWORD;
    }

    private function connect() {
        try {
            $this->pdo =new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $e->getMessage());
        }
    }

    public function query($sql) {
        $this->connect();
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Truy vấn thất bại: " . $e->getMessage());
        }
    }
    public function queryAndReturnId($sql) {
        $this->connect();
        try {
            $this->pdo->prepare($sql)->execute();
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            die("Truy vấn thất bại: " . $e->getMessage());
        }
    }
}

