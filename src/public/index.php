<?php
require '../vendor/autoload.php';

use App\DB\MysqlDBConnection;
use App\DB\Builder\Builder;
use App\DB\QueryBuilder;

use App\Hydration\ParticipantHydrator;

use App\Model\ParticipantModel;

try {

    $data = [
        'firstname'     => 'Vitaly',
        'lastname'      => 'Kopytich',
        'email'         => 'v12311@example.org',
        'position'      => 'novice',
        'shares_amount' => 0,
        'parent_id'     => 1,
    ];

    $connection = new MysqlDBConnection();
    $builder = new Builder();
    $queryBuilder = new QueryBuilder($builder);
    $modelParticipant = new ParticipantModel($connection, $queryBuilder);

    $user = ParticipantHydrator::hydrate($data);


    // creating the first user - president of pyramid
    $savedFirst = $modelParticipant->saveFirst();

    // creating just a usual user
    $savedUser = $modelParticipant->save($user);

    echo "<pre>";
    var_dump($user);
    echo "</pre>";


//    $data = [
//        'entity_id'     => 1,
//        'firstname'     => 'Mike',
//        'lastname'      => 'Patterson',
//        'email'         => 'mike_pat@example.org',
//        'position'      => 'president',
//        'shares_amount' => 10000,
//        'date_created'  => date('Y-m-d H:i:s', 1273449600),
//        'parent_id'     => 0,
//    ];
//
//    $entity = ParticipantHydrator::hydrate($data);
//
//    echo "<pre>";
//    print_r($entity);
//    echo "</pre>";



//    $pdo = new MysqlDBConnection();
//    $dbCon = $pdo->open();
//
//    $builder = new Builder();
//    $queryBuilder = new QueryBuilder($builder);
//
//    $whereData = [
//        'entity_id' => 1,
//        'email' => 'mike_pat@example.org'
//    ];
//
//    $sql = $queryBuilder->select('participants')
//                 ->andWhere($whereData);
//
//    $statement = $dbCon->prepare($sql->getSQL());
//    $statement->execute($whereData);
//
//    if (empty($statement->fetch())) {
//        $sql = QueryBuilder::cleanAll('participants');
//        $statement = $dbCon->prepare($sql);
//        $statement->execute();
//        echo 'All are clean!';
//    } else {
//        echo 'good!';
//    }
//
//    echo "<pre>";
//    print_r($statement->fetch());
//    echo "</pre>";

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
