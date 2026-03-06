<?php
	//SQL2の設定（検索結果データの一覧）
	$sql2 = "SELECT * FROM mpg WHERE a_id=" . $_GET['akn'];
	$stmt2 = $db->query($sql2);
	$stmt2->execute();
	$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
?>
