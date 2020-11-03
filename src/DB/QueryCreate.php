<?php

namespace App\DB;

use App\DB\Builder\Builder;

class QueryCreate implements QueryBuilderInterface
{
    /**
     * @var Builder
     */
    private Builder $builder;

    /**
     * @var string
     */
    private string $sql = '';

    /**
     * QueryCreate constructor.
     * @param Builder $builder
     */
    public function __construct(
        Builder $builder
    ) {
        $this->builder = $builder;
    }

    /**
     * @param string $tableName
     * @param array $fields
     * @return QueryBuilderInterface
     */
    public function select(string $tableName, array $fields = []): QueryBuilderInterface
    {
        $fieldCollection = $this->builder->fields()->set($fields);
        $this->sql .= "SELECT " . $fieldCollection->getSQL() . " FROM {$tableName}";

        return $this;
    }

    /**
     * @param array $fields
     * @return QueryBuilderInterface
     */
    public function andWhere(array $fields = []): QueryBuilderInterface
    {
        $this->builder->where()->set($fields);
        $this->sql .= $this->builder->where()->getSQL();

        return $this;
    }

    /**
     * @return string
     */
    public function getSQL(): string
    {
        return trim($this->sql);
    }
}
