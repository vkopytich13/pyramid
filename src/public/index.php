<?php
require_once '../DB/DBConnectionInterface.php';
require_once '../DB/MysqlDBConnection.php';
require_once '../DB/QueryBuilder.php';

use App\DB\MysqlDBConnection;
use App\DB\QueryBuilder;

try {
    $pdo = new MysqlDBConnection();

    QueryBuilder::insert([
        'id' => 1,
        'firstname' => 'Villy'
    ], 'participants');

    $pdo->open();
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
