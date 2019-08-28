<?php

require_once 'init.php'; 

class Connection {
    
    public static $instance;

    private function __construct() { }
    
    public static function getInstance() {
        try {
            if (!isset(self::$instance)) {
                self::$instance = new PDO('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DBNAME, MYSQL_USER, MYSQL_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));                
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
            }
        } catch (\Throwable $th) {
            echo "Erro não foi possível conectar ao banco de dados!";
            exit();
            //throw $th;
        } 
        return self::$instance;
    }
}