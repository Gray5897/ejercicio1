<?php

namespace App\Controllers;

use App\Config\Database;
use Exception;

class TargetController
{
	public function __construct()
	{
	}

	public function saveTarget($name)
	{
		try {
			$database = new Database();
			$database->db->query('INSERT INTO targets(name) VALUES("' . $name . '")');
			header('Location: http://localhost/ejercicio1');
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function getTargets()
	{
		try {
			$database = new Database();
			$targets = $database->db->query('SELECT * FROM targets');
			return $targets;
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}
