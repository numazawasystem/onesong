<?php
	//SQL15の設定（検索結果データの一覧）
	$sql15 = "SELECT data , name FROM kengen WHERE a_id=" . $_GET['akn'];
	$stmt15 = $db->query($sql15);
	$stmt15->execute();
	$row15 = $stmt15->fetch(PDO::FETCH_ASSOC);
?>
