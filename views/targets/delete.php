<link rel="stylesheet" href="../../public/css/app.css">

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
  if (isset($_POST['btn-delete'])) {
      $imagepath = '../../public/images/'.$onetarget['image'];
      if (unlink($imagepath)) {
        $saveupdatetarget = new TargetController();
        $saveupdatetarget->deleteTarget($_POST['id']);
      } else {
        echo "Error al intentar eliminar la imagen.";
      }

  }
} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br />";
}

echo '<div class="style-target">
      <form method="POST">
        <img class="style-image" src="../../public/images/'.$onetarget['image'].'"></br>
        <span>Id de Imagen</span><input type="number" value="' . $onetarget['id'] . '" name="id" ><br>
        <span>Nombre de Imagen</span><input type="text" value="' . $onetarget['name'] . '" name="name"><br>
        <button class="style-btn" name="btn-delete">Eliminar</button><button class="style-btn-cancel" name="btn-cancel">Cancelar</button><br>
      </form>
    </div>';

?>




<?php
include "../layouts/footer.php";
?>
