<?php

/**
 * Class ConfigReader
 */
class ConfigReader
{
    /** @var array */
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getHostName()
    {
        return $this->config['DB']['db_host'];
    }

    public function getUserName()
    {
        return $this->config['DB']['db_user'];
    }

    public function getUserPassword()
    {
        return $this->config['DB']['db_pass'];
    }

    public function getDBName()
    {
        return $this->config['DB']['db_name'];
    }

    public function getPresident()
    {
        return $this->config['president'];
    }

    public function getVicePresident()
    {
        return $this->config['president'];
    }
}
