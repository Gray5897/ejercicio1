<?php

namespace App\Controllers;

use App\Config\Database;
use Exception;
use PDO;

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

	public function getOneTarget($id)
	{
		try {
			$database = new Database($id);
			$target = $database->db->prepare('SELECT * FROM targets WHERE id = :id');
			$target->execute(['id'=>$id]);
			return $target->fetch(PDO::FETCH_ASSOC);
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function saveUpdateTarget($id, $name, $image)
	{
		try {
			$database = new Database();
			$saveupdatetarget = $database->db->prepare('UPDATE targets SET name = :name, image = :image WHERE id = :id');
			$saveupdatetarget->bindParam(':name',$name);
			$saveupdatetarget->bindParam(':image',$image);
			$saveupdatetarget->bindParam(':id', $id);
			$saveupdatetarget->execute();
			header('Location: http://localhost/ejercicio1');
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}
