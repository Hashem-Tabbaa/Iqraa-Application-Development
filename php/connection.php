<?php
    class db{
        private function __construct(){
        }
        private static $username = 'hashema2_IQraa';
        private static $password = '123456789';
        private static $connectionString = "mysql:host=localhost;dbname=hashema2_IQraa";
        
        private static $pdo = null;
        public static function getInstance(){
            if(!self::$pdo){
                try{
                    self::$pdo = new PDO(self::$connectionString, self::$username, self::$password);
                    self::$pdo-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }catch(PDOException $e){
                    echo "Connection faild: ".$e-> getMessage();
                }
            }
            return self::$pdo;
        }
    }

?>