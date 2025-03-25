<?php
require_once __DIR__ . "/config.php";
class Database
{
    private static $instance = null;
    private $conn;
    private function __construct()
    {
        $this->conn = new mysqli(host, user, password, dbname);
        if ($this->conn->connect_error) {
            die("" . $this->conn->connect_error);
        }
    }
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
}
