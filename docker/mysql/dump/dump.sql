CREATE TABLE IF NOT EXISTS participants (
    entity_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(250) UNIQUE KEY,
    position VARCHAR(30),
    shares_amount INT(10) UNSIGNED,
    start_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    parent_id INT(6) UNSIGNED NOT NULL
)
