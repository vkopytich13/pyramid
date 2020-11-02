<?php

namespace App\DB\Builder;

class WhereCollection implements CollectionInterface
{
    /**
     * @var array
     */
    private array $whereClause = [];

    /**
     * @param string $field
     * @param $value
     * @return WhereCollection
     */
    public function add(string $field, $value): WhereCollection
    {
        $this->whereClause[$field] = $value;
        return $this;
    }

    /**
     * @param array $where
     * @return CollectionInterface
     */
    public function set(array $where = []): CollectionInterface
    {
        $this->whereClause = $where;
        return $this;
    }

    /**
     * @return string
     */
    public function getSQL(): string
    {
        $sql = '';
        $counter = 0;
        $total = count($this->whereClause);

        if ($total > 0) {
            $sql .= ' WHERE ';
        }

        foreach ($this->whereClause as $field => $value) {
            $counter++;
            $sql .= $field . '=:' . $field;
            if ($counter < $total) {
                $sql .= ' AND ';
            }
        }
        return $sql;
    }
}
