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

  /**
   * get file name from image
   *
   * @param object $imageFile este es el archivo de una imagen
   *
   * @return string
   */
  public function getFileName($imageFile)
  {
    $fileName = $imageFile['name'];
    $fileExtension = $this->getFileExtension($fileName); //Se extrae la extension del archivo
    return md5(time() . $fileName) . '.' . $fileExtension; //Se limpia el nombre de caracteres especiales
  }

  /**
   * get file extension from image
   *
   * @param string $fileName este es el nombre de la imagen
   *
   * @return string
   */
  public function getFileExtension($fileName)
  {
    $fileNameCmps = explode(".", $fileName);
    return strtolower(end($fileNameCmps)); //Se extrae la extension del archivo
  }

  /**
   * save target
   *
   * @param string $image nombre de la imagen
   * @param string $name target name
   *
   * @return boolean
   */
  public function saveTarget($image, $name)
  {
    try {
      $database = new Database();
      $savetarget = $database->db->prepare('INSERT INTO targets(image, name) VALUES (:image, :name)');
      $savetarget->bindParam(':image', $image);
      $savetarget->bindParam(':name', $name);
      $savetarget->execute();
      return true;
    } catch (Exception $e) {
      return false;
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
      $target->execute(['id' => $id]);
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
      $saveupdatetarget->bindParam(':name', $name);
      $saveupdatetarget->bindParam(':image', $image);
      $saveupdatetarget->bindParam(':id', $id);
      $saveupdatetarget->execute();
      header('Location: http://localhost/ejercicio1');
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function deleteTarget($id)
  {
    try {
      $database = new Database();
      $deletetarget = $database->db->prepare('DELETE FROM targets WHERE id = :id');
      $deletetarget->bindParam(':id', $id);
      $deletetarget->execute();
      header('Location: http://localhost/ejercicio1');
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
}
