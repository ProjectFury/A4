<?php


namespace Rentit;

use PDO;

final class Database extends PDO
{
    use Singleton;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        $config = Registry::getInstance();
        //$dsn driver:host="nombre del equipo"
        $dsn = 'mysql:host=' . $config->get('host') . ';dbname=' . $config->get('database');
        $username = $config->get('user');
        $passwd = $config->get('password');
        //config.json data goes here

        //PDO construction
        try {
            parent::__construct($dsn, $username, $passwd);
        } catch (\PDOException $e) {
            echo 'Error connecting to database.';
        }
    }
}