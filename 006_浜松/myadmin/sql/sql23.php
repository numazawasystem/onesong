<?php
	$sql23 = "SELECT * FROM anken LEFT OUTER JOIN place ON anken.venue=place.place_id WHERE a_id = :id";
	$stmt23 = $db->prepare($sql23);
	$stmt23->execute([':id' => $_POST['id']]);
	$row23 = $stmt23->fetch(PDO::FETCH_ASSOC);
?>