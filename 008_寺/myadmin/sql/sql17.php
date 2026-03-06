<?php
	//SQL17の設定（検索結果写真2の一覧）
	$sql17 = "SELECT * FROM photo2 WHERE a_id=" . $_GET['akn'] . " ORDER BY no ASC";
	$stmt17 = $db->query($sql17);
	$stmt17->execute();
	$row17 = $stmt17->fetch(PDO::FETCH_ASSOC);
?>
