<?php

require_once '../App/vendor/autoload.php';
require_once '../Setup/ConfigReader.php';
require_once '../App/DB.php';
$config = require_once '../Config/Config.php';

$dbConfig = new ConfigReader($config);

try {
    $pdo = new DB("mysql:host=".$dbConfig->getHostName().";dbname=".$dbConfig->getDBName(), $dbConfig->getUserName(), $dbConfig->getUserPassword());
    echo '<pre>';
    print_r($pdo->run('SELECT * FROM participants')->fetch());
    echo '</pre>';

    $pdo = null;
} catch (PDOException $e) {
    die("Could not connect to the database " . $dbConfig->getDBName() . ": " . $e->getMessage());
}
