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
      $saveupdatetarget = new TargetController();
      $saveupdatetarget->deleteTarget($_POST['id']);
  }
} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br />";
}

echo '<div>
        <form method="POST">
            Id de Imagen<input type="number" value="' . $onetarget['id'] . '" name="id" ><br>
            Nombre de Imagen<input type="text" value="' . $onetarget['name'] . '" name="name"><br>
            Link de Imagen<input type="text" value="' . $onetarget['image'] . '" name="image"><br>
            <button name="btn-delete">Eliminar</button>
            <button name="btn-cancel">Cancelar</button><br>
        </form>
</div>';

?>




<?php
include "../layouts/footer.php";
?>
