<?php

namespace App\Database;

require __DIR__ . '/../../config.php';
class DB{

    private $db_driver = DBDRIVER;
    private $host = DBHOST;
    private $db_name = DBNAME;
    private $username = DBUSER;
    private $password = DBPASS;
    private static $connection = null;

    public function getConnection(){
        if (self::$connection) {
            return self::$connection; 
        }
        try {
            self::$connection = new \PDO($this->db_driver.":host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            self::$connection->exec("set names utf8");
        } catch(\PDOException $exception){
            self::$connection = null;
        }
        return self::$connection;
    }
}
?>