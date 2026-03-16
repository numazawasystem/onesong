<?php
	//SQL12の設定（重複チェック）
	function sql14($name , $akn) {
		//sql設定を読み込む
		include("../text/sqlheader.php");
		
		$sql14 = "SELECT count(*) AS cnt FROM kengen WHERE name='" . $name . "' && a_id='" . $akn . "'";
		//print($sql14);
		$stmt14 = $db->query($sql14);
		$stmt14->execute();
		$row14 = $stmt14->fetch(PDO::FETCH_ASSOC);
		
		return $row14['cnt'];
	}
?>
