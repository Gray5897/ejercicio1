<?php

    $data = file_get_contents("public/docs/example.json");
    $targets = json_decode($data, true);

?>

<form action="controllers/detalleimage.php">
    <div class="container">
        <?php
            foreach ($targets as $target){
                echo '<div class="target" id"'.$target['id'].'">
                <img class= "imgs" src="'.$target['image'].'" alt="">
                <div class="titarget">
                    '.$target['title'].'
                </div>
                <button class="detalle" id="'.$target['id'].'">Ver detalle</button>
            </div>';
            }
        ?>        
    </div>
</form>
    
