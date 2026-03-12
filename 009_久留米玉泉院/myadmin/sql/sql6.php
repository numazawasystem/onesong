<?php
	//SQL6の設定（検索結果データの一覧）
	$sql6 = "SELECT data , name FROM data WHERE a_id=" . $_GET['akn'];
	$stmt6 = $db->query($sql6);
	$stmt6->execute();
	$row6 = $stmt6->fetch(PDO::FETCH_ASSOC);
?>
