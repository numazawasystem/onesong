<?php
	//SQL19の設定（読み込めない写真データの一覧）
	$sql19 = "SELECT data , name FROM photo2 WHERE a_id=" . $_GET['akn'];
	$stmt19 = $db->query($sql19);
	$stmt19->execute();
	$row19 = $stmt19->fetch(PDO::FETCH_ASSOC);
?>
