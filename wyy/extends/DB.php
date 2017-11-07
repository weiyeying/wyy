<?php

class DB {

    public static $pdo = NULL;
    private $Host;
    private $DBCHARSET;
    private $DBUser;
    private $DBPassword;
    private $DBPort;
    public $sql;
    public $opt;

    public function __construct($sql) {
        $this->sql = $sql;
       $this->Connect();
    }

    /*     * 连接** */

    private function Connect() {
        if (is_null(self::$pdo)) {
            try {
                $this->database();
                $link = new PDO($this->Host . ';port=' . $this->DBPort . ';charset=' . $this->DBCHARSET, $this->DBUser, $this->DBPassword);
            } catch (PDOException $e) {
                halt($e->getMessage());
            }
            self::$pdo = $link;
        }
    }

    private function database() {
        $this->Host = C("HOST");
        $this->DBUser = C("DB_USER");
        $this->DBPassword = C("DB_PASSWORD");
        $this->DBPort = C("PORT");
        $this->DBCHARSET = C("CHARSET");
    }

    /**
     * *原生查询所有数据
     * 
     * * */
    public function queryAll() {
        self::$pdo->query($this->sql);
        $this->check_error();
        return self::$pdo->query($this->sql)->fetchAll();
    }

    /**
     * *原生查询1条
     * 
     * * */
    public function queryOne() {
        self::$pdo->query($this->sql);
        $this->check_error();
        return self::$pdo->query($this->sql)->fetch();
    }

    /*     * 操作* */

    public function execut() {
        $res = self::$pdo->exec($this->sql);
        $this->check_error();
        return $res;
    }

    /**
     * 错误信息
     * * */
    private function check_error() {
        if (self::$pdo->errorCode() != '00000') {
            halt(self::$pdo->errorInfo()[2]);
            exit;
        }
    }

}
