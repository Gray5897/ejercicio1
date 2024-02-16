<?php

require_once '../../vendor/autoload.php';

use App\Controllers\TargetController;

include "../layouts/header.php";
try {
  if (isset($_POST['btn-save'])) {
    if (empty($_POST['name'])) {
      $errorMessage = 'Debe llenar todos los campos, no se permiten valores vacios';
      return header('Location: http://localhost/tests/ejercicio1/views/targets/create.php?_error=' . $errorMessage);
    }
    if (isset($_FILES['image']) && empty($_FILES['image']['name'])) {
      $errorMessage = 'No se ha seleccionado una imagen en la casilla.';
      return header('Location: http://localhost/tests/ejercicio1/views/targets/create.php?_error=' . $errorMessage);
    }
    $target = new TargetController();
    $fileTmpPath = $_FILES['image']['tmp_name'];
    $newFileName = $target->getFileName($_FILES['image']);

    $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
    // Se valida que el archivo este en las extensiones compatibles
    if (!in_array($target->getFileExtension($newFileName), $allowedfileExtensions)) {
      $errorMessage = 'el archivo no esta dentro de las extensiones permitidas paraa imagen.';
      return header('Location: http://localhost/tests/ejercicio1/views/targets/create.php?_error=' . $errorMessage);
    }
    // se almacena en una variable la direccion donde se alojara el archivo
    $uploadFileDir = '../../public/images/';
    $dest_path = $uploadFileDir . $newFileName;
    if (move_uploaded_file($fileTmpPath, $dest_path)) {
      $target = new TargetController();
      $onSuccess = $target->saveTarget($newFileName, $_POST['name']);
      if ($onSuccess) {
        return header('Location: http://localhost/tests/ejercicio1');
      }
    }
    $errorMessage = 'Se produjo algún error al mover el archivo al directorio de carga.';
    return header('Location: http://localhost/tests/ejercicio1/views/targets/create.php?_error=' . $errorMessage);
  }
} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br />";
}
?>
<link rel="stylesheet" href="../../public/css/app.css">

<div class="style-target">
  <form method="POST" action="#" enctype="multipart/form-data">
    <span>Carga la Imagen</span><input type="file" name="image"><br>
    <span>Nombre de Imagen </span><input type="text" name="name"><br>
    <button type="submit" class="style-btn" name="btn-save">Guardar</button>
    <button type="button" class="style-btn-cancel" name="btn-cancel" onclick="back()">Cancelar</button><br>
    <?php echo (isset($_GET['_error']) ? $_GET['_error'] : ''); ?>
  </form>
</div>;

<?php
include "../layouts/footer.php";
?>


<script>
  const currentHost = window.location.hostname.toString();

  function back() {
    window.location = '/tests/ejercicio1';
  }
</script>
