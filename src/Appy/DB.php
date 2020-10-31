<?php

class DB extends PDO
{

    public function __construct($dsn, $username, $password, $options = [])
    {
        $defaultOpt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => FALSE,
        );
        $options = array_merge($defaultOpt, $options);
        parent::__construct($dsn, $username, $password, $options);
    }

    public function run($sql, $args = null)
    {
        $stmt = $this->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    public function get($value, $field = null)
    {

    }

    public function save($id)
    {

    }

    public function cleanOut()
    {

    }
}
