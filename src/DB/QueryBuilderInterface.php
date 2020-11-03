<?php

namespace App\DB;

interface QueryBuilderInterface
{
    public function select(string $tableName, array $fields = []): QueryBuilderInterface;
    public function andWhere(array $fields = []): QueryBuilderInterface;
    public function getSQL(): string;
}
