<?php

namespace App\DB;
use PDO;

class MysqlDBConnection implements DBConnectionInterface
{
    /**
     * @var
     */
    private static $connection;

    /**
     * @return array
     */
    public function getCreds(): array
    {
        return [
            'username' => getenv('MYSQL_USERNAME'),
            'password' => getenv('MYSQL_ROOT_PASSWORD'),
            'host'     => getenv('MYSQL_HOST'),
            'database' => getenv('MYSQL_DATABASE'),
        ];
    }

    /**
     * @return PDO
     */
    public function open(): PDO
    {
        $options = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => FALSE,
        );
        $creds = $this->getCreds();

        if (!self::$connection instanceof PDO) {
            $username = $creds['username'];
            $password = $creds['password'];
            $host = $creds['host'];
            $database = $creds['database'];

            $dsn = 'mysql:host=' . $host . ';dbname=' . $database;
            self::$connection = new PDO($dsn, $username, $password, $options);
        }
        return self::$connection;
    }
}
