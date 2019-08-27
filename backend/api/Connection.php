<?php

class Connection {
	
	private $SERVER		= "localhost:3306";
	private $USER		= "root";
	private $PASS		= "";
	private $DATABASE	= "scv";

	public static $instance;

	private function __construct() {
	//
	}
 
	public static function getInstance() {
		try {
				if (!isset(self::$instance)) {					
					self::$instance = new PDO('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DBNAME, MYSQL_USER, MYSQL_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
					self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
				}
		} catch(Exception $e) {
			print $e->getMessage();
		}

		return self::$instance;
	}
}
?>