<?php

require_once '../../vendor/autoload.php';

use App\Controllers\TargetController;

include "../layouts/header.php";


try {
  if (isset($_POST['btn-save'])) {
    if (empty($_POST['name'])) {
      echo "Debe llenar todos los campos, no se permiten valores vacios";
    } else {
      if (isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
        // Se extraen detalles del archivo cargado
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps)); //Se extrae la extension del archivo
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension; //Se limpia el nombre de caracteres especiales
        $_POST['image'] = $newFileName;
        var_dump($_POST['image']);
        $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
        // Se valida que el archivo este en las extensiones compatibles
        if (in_array($fileExtension, $allowedfileExtensions)) {
          // se almacena en una variable la direccion donde se alojara el archivo
          $uploadFileDir = '../../public/images/';
          $dest_path = $uploadFileDir . $newFileName;
          if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $target = new TargetController();
            $target->saveTarget($_POST['image'], $_POST['name']);
          } else {
            echo 'Se produjo algún error al mover el archivo al directorio de carga.';
          }
        } else {
          echo 'el archivo no esta dentro de las extensiones permitidas paraa imagen.';
        }
      } else {
        echo 'No se ha seleccionado una imagen en la casilla.';
      }
    }

    //$target = new TargetController();
    //$target->saveTarget($_POST['name']);
  }
} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br />";
}
?>

<form method="POST" enctype="multipart/form-data">
  <input type="file" name="image"><br>
  <input type="text" placeholder="Escriba el nombre de la imagen" name="name"><br>
  <button type="submit" name="btn-save">Guardar</button>
</form>


<?php
include "../layouts/footer.php";
?>
