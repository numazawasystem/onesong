<?php
	//SQL3の設定（検索結果写真の一覧）
	$sql3 = "SELECT a_id,no,data FROM photo WHERE a_id=" . $_GET['akn'] . " ORDER BY no ASC";
	$stmt3 = $db->query($sql3);
	$stmt3->execute();
	$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
?>
