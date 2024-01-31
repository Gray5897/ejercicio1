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
    if (empty($_POST['id']) or empty($_POST['name']) or empty($_POST['image'])) {
      echo "Debe llenar todos los campos, no se permiten valores vacios";
    } else {
      $saveupdatetarget = new TargetController();
      $saveupdatetarget->saveUpdateTarget($_POST['id'], $_POST['name'], $_POST['image']);
    }
  }
} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br />";
}

echo '<div>
        <form method="POST">
            Id de Imagen<input type="number" value="' . $onetarget['id'] . '" name="id" ><br>
            Nombre de Imagen<input type="text" value="' . $onetarget['name'] . '" name="name"><br>
            Link de Imagen<input type="text" value="' . $onetarget['image'] . '" name="image"><br>
            <button name="btn-update">Actualizar</button><br>
            <button name="btn-cancel">Cancelar</button><br>
        </form>
</div>';

?>




<?php
include "../layouts/footer.php";
?>


