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
        'email'         => 'email@example.org',
        'position'      => 'vice president',
        'shares_amount' => 5000,
        'parent_id'     => 1,
    ];
    $user = ParticipantHydrator::hydrate($data);

    $connection = new MysqlDBConnection();
//    $builder = new Builder();
    $queryBuilder = new QueryBuilder();
    $modelParticipant = new ParticipantModel($connection, $queryBuilder);

    // creating the first user - president of pyramid
//    $savedFirst = $modelParticipant->saveFirst();

    // creating just a usual user
//    $savedUser = $modelParticipant->save($user);

    $res = $modelParticipant->generateNestedUsers();
    echo "<pre>";
    print_r($res);
    echo "</pre>";


} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
