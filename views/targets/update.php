<?php

require_once '../../vendor/autoload.php';

use App\Controllers\TargetController;

include "../layouts/header.php";

try {
  if (isset($_POST['btn-cancel'])) {
    header('Location: http://localhost/ejercicio1');
  }
} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br />";
}

try {
  $target = new TargetController();
  $onetarget = $target->getOneTarget($_GET['id']);
} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br />";
}

try {
  if (isset($_POST['btn-update'])) {
    if (empty($_POST['id']) or empty($_POST['name'])) {
      echo "Debe llenar todos los campos, no se permiten valores vacios";
    } else {
      if (isset($_FILES['image'])) {
        //se asigna la ruta donde se ubican las imagenes
        $imagepath = '../../public/images/'.$onetarget['image'];
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
          if (unlink($imagepath)) {
            $uploadFileDir = '../../public/images/';
            $dest_path = $uploadFileDir . $newFileName;
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
              $saveupdatetarget = new TargetController();
              $saveupdatetarget->saveUpdateTarget($_POST['id'], $_POST['name'], $_POST['image']);
            } else {
              echo 'Se produjo algún error al mover el archivo al directorio de carga.';
            }
          } else {
            echo "Error al intentar eliminar la imagen.";
          }
        } else {
          echo 'el archivo no esta dentro de las extensiones permitidas paraa imagen.';
        }
      } else {
        echo 'No se ha seleccionado una imagen en la casilla.';
      }
    }
  }
} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br />";
}

echo '<div>
        <form method="POST" enctype="multipart/form-data">
          <img src="../../public/images/'.$onetarget['image'].'" alt="Imagen previa" width="200">
          Id de Imagen<input type="number" value="' . $onetarget['id'] . '" name="id" ><br>
          Seleccionar nueva Imagen<input type="file" value="' . $onetarget['image'] . '" name="image"><br>
          Nombre de Imagen<input type="text" value="' . $onetarget['name'] . '" name="name"><br>
          <button name="btn-update">Actualizar</button><br>            <button name="btn-cancel">Cancelar</button><br>
        </form>
</div>';

?>




<?php
include "../layouts/footer.php";
?>


