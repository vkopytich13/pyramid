<?php
require_once '../DB/DBConnectionInterface.php';
require_once '../DB/MysqlDBConnection.php';
require_once '../DB/QueryBuilder.php';

use App\DB\MysqlDBConnection;
use App\DB\QueryBuilder;

try {
    $pdo = new MysqlDBConnection();

    $data = [
        'entity_id'     => 1,
        'firstname'     => 'Mike',
        'lastname'      => 'Patterson',
        'email'         => 'mike_pat@example.org',
        'position'      => 'president',
        'shares_amount' => 10000,
        'start_date'    => date('Y-m-d H:i:s', 1273449600),
        'parent_id'     => 0,
    ];

    $sql = QueryBuilder::insert($data, 'participants');

    $dbCon = $pdo->open();
    $statement = $dbCon->prepare($sql);
    $statement->execute($data);

} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}


//require_once '../App/vendor/autoload.php';
//require_once '../Setup/ConfigReader.php';
//require_once '../App/DB.php';
//$config = require_once '../Config/Config.php';
//
//$dbConfig = new ConfigReader($config);
//
//try {
//    $pdo = new DB("mysql:host=".$dbConfig->getHostName().";dbname=".$dbConfig->getDBName(), $dbConfig->getUserName(), $dbConfig->getUserPassword());
//    echo '<pre>';
//    print_r($pdo->run('SELECT * FROM participants')->fetchAll());
//    echo '</pre>';
//
//    $pdo = null;
//} catch (PDOException $e) {
//    die("Could not connect to the database " . $dbConfig->getDBName() . ": " . $e->getMessage());
//}
