<?php
class Database
{
    private static $instance = null;

    private $connection = null;

    private function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "jkh_services";

        $this->connection = new mysqli(
            $servername, $username, $password, $dbname
        );

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    private function __clone()
    {   
    }

    public function __wakeup()
    {
        throw new \BadMethodCallException('Unable to deserialize database connection');
    }

    public static function getInstance(): Database
    {
        if (null === self::$instance){
            self::$instance = new static();
        }

        return self::$instance;
    }

    public static function connection(): mysqli
    {
        return static::getInstance()->connection;
    }

    public static function prepare($statement): mysqli_stmt
    {
        return static::connection()->prepare($statement);
    }

    public static function lastInsertId(): int
    {
        return intval(static::connection()->insert_id);
    }
}
?>
