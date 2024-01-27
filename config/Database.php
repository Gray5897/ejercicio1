<?php

class Database
{
	public $db;

	public function __construct()
	{
		try {
			$this->db = new PDO('mysql:host=localhost;dbname=ejercicio1', 'root', '');
		} catch (Exception $e) {
			echo "Error en la conexion a la base de datos";
		}
	}
}
