<?php
// Using database namespace.
use Dotenv\Dotenv;

class Database {
    // Connect the database.
    private static $c_database;

    public static function getDatabase() {
        
        if(!isset(self::$c_database)) {
            $dbConfig = self::getDBConfig();
            $dsn = 'mysql:host='.$dbConfig['host'].';dbname='.$dbConfig['database'].';charset=UTF8';
            self::$c_database = new PDO($dsn, $dbConfig['username'], $dbConfig['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        }

        return self::$c_database;
    }

    private static function getDBConfig() {
        $dotenv = Dotenv::createImmutable(PATH_PRIVATE);
        $dotenv->load();

        return [
            'type'      => $_ENV['DB_TYPE'],
            'host'      => $_ENV['DB_HOST'],
            'database'  => $_ENV['DB_DATABASE'],
            'username'  => $_ENV['DB_USERNAME'],
            'password'  => $_ENV['DB_PASSWORD']
        ];
    }
}
?>