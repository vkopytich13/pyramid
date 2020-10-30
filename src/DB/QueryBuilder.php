<?php

namespace App\DB;


class QueryBuilder
{
    public static function insert(array $data, string $table): ?string
    {
        echo $sql = 'INSERT INTO `' . $table . '` (' . self::fields($data) . ') VALUES (' . self::insertPlaceHolders($data) . ');';
        return $sql;
    }

    public static function update(array $data, string $table, array $where): string
    {
        $sql = '';
        return $sql;
    }

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

    protected static function fields(array $data = []): string
    {
        $placeholders = array_keys($data);
        $sql = '';
        for ($i=0; $i < count($placeholders); $i++) {
            if ($i > 0) {
                $sql .= ', ';
            }
            $sql .= "`" . $placeholders[$i] . "`";
        }
        return $sql;
    }
}
