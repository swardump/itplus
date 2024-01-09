<?php
require_once 'conf.php';

final class Database 
{
    private static $conn = null;

    public function connect() 
    {
        $pdo = new \PDO("pgsql:host=".Conf::HOST.";port=".Conf::PORT.";dbname=".Conf::DBNAME.";user=".Conf::USER.";password=".Conf::PASSWD);
        return $pdo;
    }

    public static function get()
    {
        if (null === static::$conn) {
            static::$conn = new self();
        }

        return static::$conn;
    }

    protected function __construct()
    {

    }

}