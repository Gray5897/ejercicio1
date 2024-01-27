<?php
include "views/layouts/header.php";
include "views/home.php";
include "views/layouts/footer.php";

/*try {
	$database = new Database();
	$database->db->query('INSERT INTO targets(name) VALUES("Juan")');
	$targets = $database->db->query('SELECT * from targets');
	foreach ($targets as $target) {
		print_r($target);
	}
} catch (PDOException $e) {
	print "¡Error!: " . $e->getMessage() . "<br/>";
}*/
