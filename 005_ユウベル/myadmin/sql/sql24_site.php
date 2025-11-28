<?php
	//SQL1の設定（検索結果管理者データの一覧）
	$sql24_site = "SELECT * FROM site";
	$stmt24_site = $db->query($sql24_site);
	$stmt24_site->execute();
	$row24_site = $stmt24_site->fetch(PDO::FETCH_ASSOC);
?>
