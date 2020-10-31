<?php
require_once 'config.php';

class DataProcessing
{
    private $database = null;
    private $table = "participants";
    private $userEmail = "f@mail.com";
    private static $mainUser = [];

    public function __construct(DB $database)
    {
        $this->database = $database;
        self::$mainUser = [
            'entity_id'     => 1,
            'firstname'     => 'Mike',
            'lastname'      => 'Patterson',
            'email' => 'mike_pat@example.org',
            'position' => 'president',
            'shares_amount' => 10000,
            'start_date' => date('Y-m-d H:i:s', 1273449600),
            'parent_id' => 0
        ];
    }

    public function logic()
    {
        $arraySource = $this->database->run("SELECT * FROM {$this->table}")->fetchAll();

        if ($arraySource) {
            $row = self::checkMainUser($arraySource);

            if (!empty($row)) {
                echo 'GOOD!';
                $this->generateNewUsers($arraySource);
            } else {
                $this->deletingAllData();
                $this->generateFirstUser();
                $this->generateNewUsers($arraySource);
            }
        } else {
            echo "Your table '{$this->table}' is empty. Generating new data..." . PHP_EOL;
            $this->generateFirstUser();
            $this->generateNewUsers($arraySource);
//            generating new table
        }
    }

    public static function getArraySize($array) : int
    {
        return count($array);
    }

    public static function checkMainUser($array)
    {
        foreach ($array as $key => $value) {
            if ($value['entity_id'] == self::$mainUser['entity_id'] && $value['email'] == self::$mainUser['email']) {
                return $value;
            } else {
                return false;
            }
        }
        return false;
    }

    public function deletingAllData()
    {
        return $this->database->run("TRUNCATE TABLE {$this->table}");
    }

    public function generateFirstUser()
    {
        $sql = "INSERT INTO {$this->table} VALUES (:entity_id, :firstname, :lastname, :email, :position, :shares_amount, :start_date, :parent_id)";
        try {
            $this->database->run($sql, self::$mainUser)->fetchColumn();
            echo "First User have been generated" . PHP_EOL;
        } catch (PDOException $e) {
            echo "Can't to insert data in the table - " . $e->getMessage();
        }
    }

    public function generateNewUsers($arraySource)
    {
        $arrayRemainUsers = [];
        $faker = Faker\Factory::create();
        $positions = ['vice president', 'manager', 'novice'];

        for ($i=self::getArraySize($arraySource); $i <= 100; $i++) {
            echo "№$i - {$faker->name} - {$faker->safeEmail} - {$positions[rand(0, 2)]} - ". rand(0, 500) ." - ".rand(1, 100)."<br/>";
        }
        echo $faker->name;
    }

}
