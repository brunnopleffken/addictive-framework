<?php

namespace Core\Database\Adapters;

use PDO;
use App\Config;

class PostgresqlAdapter
{
    private static $connection = null;

    public static function connect()
    {
        if (self::$connection === null) {
            $dsn = 'pgsql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';port=' . Config::DB_PORT;
            self::$connection = new PDO($dsn, Config::DB_USERNAME, Config::DB_PASSWORD);

            // Throw an Exception when an error occurs
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$connection;
    }
}
