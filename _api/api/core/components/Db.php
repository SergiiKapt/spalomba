<?php

namespace api\core\components;

use PDO;

class Db
{
    private $host = "localhost";
    private $db_name = "spa_eurolombard";
    private $username = "root";
    private $password = "root";
    public $connect = null;

    public function __construct()
    {
        try {
            $this->connect = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->connect->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }

    public function getConnection()
    {

        return $this->connect;
    }
}