<?php

class Conexion{

	/*
	static public function conectar(){

		$link = new PDO("mysql:host=127.0.0.1:3306;dbname=db_soft",
			            "root",
			            "");

		$link->exec("set names utf8");

		return $link;

	}
	*/

	
	static public function conectar(){

		$link = new PDO("mysql:host=localhost:3306;dbname=db_soft",
			            "root",
			            "Ingens2021*");

		$link->exec("set names utf8");

		return $link;

	}
	

}