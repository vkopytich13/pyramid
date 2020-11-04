<?php

namespace App\Model;

use App\DB\MysqlDBConnection;
use App\DB\QueryBuilder;

abstract class AbstractModel
{
    /**
     * @var MysqlDBConnection
     */
    protected MysqlDBConnection $connection;

    /**
     * @var QueryBuilder
     */
    protected QueryBuilder $queryBuilder;

    /**
     * AbstractModel constructor.
     * @param MysqlDBConnection $connection
     * @param QueryBuilder $queryBuilder
     */
    public function __construct(MysqlDBConnection $connection, QueryBuilder $queryBuilder)
    {
        $this->connection = $connection;
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * @param int $id
     * @return array|null
     */
    abstract public function findOne(int $id);

    /**
     * @param string $tableName
     * @return array|null
     */
    public function findAll(string $tableName): ?array
    {
        $this->queryBuilder->select($tableName);
        $sql = $this->queryBuilder->getSQL();

        $dbCon = $this->connection->open();
        $statement = $dbCon->prepare($sql);
        $statement->execute();

        return $statement->fetchAll();
    }
}
