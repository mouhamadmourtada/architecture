<?php
namespace config;
// this the class to get a sigle connection to the database
class Connection{

    private static $host = 'localhost';
    private static $user = 'root'; // 'root
    private static $pass = 'passer';
    private static $db = 'mglsi_news';
    private static $conn;
    // this function is to get the connection to the database

    public static function getConnection(){
        if(self::$conn) {
            return self::$conn;
        }


        try {
            self::$conn = new \PDO("mysql:host=".self::$host.";dbname=".self::$db, self::$user, self::$pass);
            self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
            die();
        }
        return self::$conn;
    }

}