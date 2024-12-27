<?php
    namespace App\Core;
    use PDO;
    
    abstract class Connection{

        private static $con;

        public static function GetConnection(){
            if(empty(self::$con)){

                self::$con = new PDO("mysql: host=localhost; dbname=starwars_catalog;", "root", "Vinicius@123456");
            }

            return self::$con;
        }
    }