<?php
	//SQL7の設定（葬儀情報のアップロード）
	$sql7 = "INSERT INTO anken (kojin , day , venue , situation , douga , fg , touroku) VALUES ('" . $_POST["title"] . "' , '" . $_POST["day"] . "' , '" . $_POST["category"] . "' , '" . $_POST["situation"] . "', '0' , '0' , '" . date("Y/m/d") . "')";
	$stmt7 = $db->query($sql7);
	//print($sql7);
	
	$sql72 = "SELECT LAST_INSERT_ID() AS ID";
	$stmt72 = $db->query($sql72);
	$stmt72->execute();
	$row72 = $stmt72->fetch(PDO::FETCH_ASSOC);
	print($row72['ID']);
?>
