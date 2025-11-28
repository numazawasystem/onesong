<?php
	//SQL1の設定（検索結果管理者データの一覧）
	$sql1 = "SELECT * FROM kengen WHERE a_id=" . $_GET['akn'];
	$stmt1 = $db->query($sql1);
	$stmt1->execute();
	$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
?>
