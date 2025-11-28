<?php
	//SQL5の設定（葬儀の一覧）
	$sql5 = "SELECT * FROM anken LEFT OUTER JOIN place ON anken.venue=place.place_id ORDER BY day DESC LIMIT " . $page . ", 50;";
	//print($sql5);
	$stmt5 = $db->query($sql5);
	$stmt5->execute();
	$row5 = $stmt5->fetch(PDO::FETCH_ASSOC);
?>
