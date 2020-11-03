<?php
require '../vendor/autoload.php';

use App\DB\MysqlDBConnection;
use App\DB\Builder\Builder;
use App\DB\QueryBuilder;

try {
    $pdo = new MysqlDBConnection();
    $dbCon = $pdo->open();

    $builder = new Builder();
    $queryBuilder = new QueryBuilder($builder);

    $whereData = [
        'entity_id' => 1,
        'email' => 'mike_pat@example.org',
        'firstname' => 'Mike'
    ];

    $sql = $queryBuilder->select('participants', ['entity_id', 'firstname', 'lastname', 'email', 'shares_amount'])
                 ->andWhere($whereData);

    $statement = $dbCon->prepare($sql->getSQL());
    $statement->execute($whereData);

    echo "<pre>";
    print_r($statement->fetchAll());
    echo "</pre>";

//    $statement = $dbCon->prepare($queryBuilder->getSQL());
//    $statement->execute([
//        'entity_id' => 3
//    ]);
//
//    echo "<pre>";
//    print_r($statement->fetchAll());
//    echo "</pre>";


//    $data = [
//        'entity_id'     => 1,
//        'firstname'     => 'Mike',
//        'lastname'      => 'Patterson',
//        'email'         => 'mike_pat@example.org',
//        'position'      => 'president',
//        'shares_amount' => 10000,
//        'start_date'    => date('Y-m-d H:i:s', 1273449600),
//        'parent_id'     => 0,
//    ];
//
//    $sql = QueryBuilder::insert($data, 'participants');
//
//    $statement = $dbCon->prepare($sql);
//    $statement->execute($data);

//    $sql = QueryBuilder::findAll('participants');
//    $statement = $dbCon->prepare($sql);
//    $statement->execute();

//    $sql = QueryBuilder::findOneBy('participants');
//    $statement = $dbCon->prepare($sql);
//    $statement->execute(['entity_id' => 1]);
//
//    echo "<pre>";
//    print_r($statement->fetchAll());
//    echo "</pre>";
//
//    $sql = QueryBuilder::findOneBy('participants');
//    $statement = $dbCon->prepare($sql);
//    $statement->execute([
//        'id' => 3
//    ]);
//
//    echo "<pre>";
//    print_r($statement->fetch());
//    echo "</pre>";
//
//
//    $data = [
//        'entity_id' => 1,
//        'email' => 'mike_pat@example.org'
//    ];
//    $sql = QueryBuilder::findAllBy('participants', $data);
//    $statement = $dbCon->prepare($sql);
//    $statement->execute($data);
//
//    echo "<pre>";
//    print_r($statement->fetchAll());
//    echo "</pre>";


} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
