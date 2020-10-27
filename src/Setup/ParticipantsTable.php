<?php

class ParticipantsTable
{
    private $dbConfig;

    public function __construct(
        Config $dbConfig
    ){
        $this->dbConfig = $dbConfig;
    }

    public function execute()
    {
        $sql = "CREATE TABLE IF NOT EXISTS participants (
            entity_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(30) NOT NULL,
            lastname VARCHAR(30) NOT NULL,
            email VARCHAR(50) UNIQUE KEY,
            position VARCHAR(10),
            shares_amount INT(10) UNSIGNED,
            start_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            parent_id INT(6) UNSIGNED NOT NULL
        )";
    }
}
