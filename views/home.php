<?php

$data = file_get_contents("public/docs/example.json");
$targets = json_decode($data, true);

?>

<div class="container">
	<?php
	foreach ($targets as $target) {
		echo '<div class="target" id"' . $target['id'] . '">
                <img class= "imgs" src="' . $target['image'] . '" alt="">
                <div class="titarget">
                    ' . $target['title'] . '
                </div>
                <a href="controllers/detalleimage.php" class="detalle" id="' . $target['id'] . '">Ver detalle</a>
            </div>';
	}
	?>
</div>