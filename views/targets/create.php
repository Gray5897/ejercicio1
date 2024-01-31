<?php

require_once '../../vendor/autoload.php';

use App\Controllers\TargetController;

include "../layouts/header.php";


try {
  if (isset($_POST['btn-save'])) {
    $target = new TargetController();
    $target->saveTarget($_POST['name']);
  }
} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br />";
}
?>

<form method="POST">
  <input type="text" placeholder="Escriba su nombre" name="name">
  <button type="submit" name="btn-save">Guardar</button>
</form>


<?php
include "../layouts/footer.php";
?>
