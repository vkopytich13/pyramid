<?php

namespace App\DB;

class QueryBuilder extends QueryCreate implements QueryBuilderInterface
{
    /**
     * @param array $data
     * @param string $table
     * @return string|null
     */
    public static function insert(array $data, string $table): ?string
    {
        return "INSERT INTO {$table} (" . self::fields($data) . ") VALUES (" . self::insertPlaceHolders($data) . ");";
    }

    /**
     * @param array $data
     * @return string
     */
    protected static function insertPlaceHolders(array $data = []): string
    {
        $placeholders = array_keys($data);
        $sql = '';
        for ($i=0; $i < count($placeholders); $i++) {
            if ($i > 0) {
                $sql .= ', ';
            }
            $sql .= ':' . $placeholders[$i];
        }
        return $sql;
    }

    /**
     * @param array $data
     * @return string
     */
    protected static function fields(array $data = []): string
    {
        $placeholders = array_keys($data);
        $sql = '';
        for ($i=0; $i < count($placeholders); $i++) {
            if ($i > 0) {
                $sql .= ', ';
            }
            $sql .= $placeholders[$i];
        }
        return $sql;
    }

    /**
     * @param string $table
     * @return string
     */
    public static function findOneBy(string $table): string
    {
        return "SELECT * FROM {$table} WHERE entity_id=:entity_id";
    }

    /**
     * @param string $table
     * @return string
     */
    public static function findAll(string $table): string
    {
        return "SELECT * FROM {$table}";
    }

    /**
     * @param string $table
     * @param array $where
     * @return string
     */
    public static function findAllBy(string $table, array $where): string
    {
        return "SELECT * FROM {$table} WHERE " . self::where($where);
    }

    /**
     * @param array $conditions
     * @return string
     */
    protected static function where(array $conditions = []): string
    {
        $sql = '';

        $total = count($conditions);
        $counter = 0;
        foreach ($conditions as $field => $value) {
            $counter++;
            $sql .= $field .'=:'. $field;
            if ($counter < $total) {
                $sql .= ' AND ';
            }
        }

        return $sql;
    }
}
