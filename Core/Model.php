<?php

namespace Core;

use PDO;
use App\Config;

abstract class Model
{
    protected static $link;
    protected static $table;

    /**
     * Get the PDO database connection.
     */
    public static function connection()
    {
        if (!Config::DB_ENABLE) {
            return false;
        }

        switch (Config::DB_ADAPTER) {
            case 'mysql':
                self::$link = Database\Adapters\MysqlAdapter::connect();
                break;
            case 'postgresql':
                self::$link = Database\Adapters\PostgresqlAdapter::connect();
                break;
        }
    }

    /**
     * Finds an object in the collection responding to the ID.
     */
    public static function find($id)
    {
        $table = get_called_class()::$table;

        if (is_array($id)) {
            $ids = implode(',', $id);
            $condition = "id IN ({$ids})";
        }
        else {
            if (is_numeric($id)) {
                $condition = "id = {$id}";
            }
            else {
                throw new \Exception("ID must be a number.", 1);
            }
        }

        $sql = "SELECT * FROM {$table} WHERE {$condition};";

        var_dump(self::$link);

        if (is_array($id)) {
            return self::$link->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }
        else {
            return self::$link->query($sql)->fetch(PDO::FETCH_ASSOC);
        }
    }

    /**
     * Executes an INSERT query and returns the new record's ID.
     */
    public static function insert($array)
    {
        $table = get_called_class()->$table;

        // Loop through array
        foreach($array as $f => $v) {
            $fields[] = $f;
            $values[] = "'" . $v . "'";
        }

        // Insert into table
        $sql = "INSERT INTO {$table} (" . implode(", ", $fields) . ") VALUES (" . implode(", ", $values) . ");";

        return self::$link->query($sql);
    }

    /**
     * Returns an array of arrays containing the field values.
     */
    public static function fetchArray($sql)
    {
        $query = self::$link->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Deletes a single or multiple rows responding to the ID.
     */
    public static function delete($id)
    {
        $table = get_called_class()->$table;

        if (is_array($id)) {
            $ids = implode(',', $id);
            $condition = "id IN ({$ids})";
        }
        else {
            if (is_numeric($id)) {
                $condition = "id = {$id}";
            }
            else {
                throw new \Exception("ID must be a number.", 1);
            }
        }

        $sql = "DELETE FROM {$table} WHERE {$condition};";

        return self::$link->query($sql);
    }
}
