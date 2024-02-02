<?php

$data = file_get_contents("public/docs/example.json");
$targets = json_decode($data, true);

require_once 'vendor/autoload.php';

use App\Controllers\TargetController;

$targetController = new TargetController();
$targets = $targetController->getTargets();

?>

<div class="btn-create-target">
  <button onClick="openCreateView()">Crear target</button>
</div>
<div class="container">
  <?php
  foreach ($targets as $target) {
    echo '<div class="target" id"' . $target['id'] . '">
                <img class= "imgs" src="public/images/' . $target['image'] . '" alt="">
                <div class="titarget">
                    ' . $target['name'] . '
                </div>
                <a href="controllers/detalleimage.php" class="detalle" id="' . $target['id'] . '">Ver detalle</a>
                <button onclick="OpenUpdateTarget(' . $target['id'] . ')" class="btn-update" id="' . $target['id'] . '">Actualizar</button>
                <button onclick="OpenDeleteTarget(' . $target['id'] . ')" class="btn-delete" id="' . $target['id'] . '">Eliminar</button>
            </div>';
  }
  ?>
</div>

<script>
  function openCreateView() {
    window.location.replace('/ejercicio1/views/targets/create.php');
  }

  function OpenUpdateTarget(id) {
    window.location.replace('/ejercicio1/views/targets/update.php?id=' + id);
  }

  function OpenDeleteTarget(id) {
    window.location.replace('/ejercicio1/views/targets/delete.php?id=' + id);
  }
</script>
