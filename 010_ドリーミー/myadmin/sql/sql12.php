<?php
	//SQL12の設定（重複チェック）
	function sql12($name , $akn) {
		//sql設定を読み込む
		include("../text/sqlheader.php");
		
		$sql12 = "SELECT count(*) AS cnt FROM mpg WHERE name='" . $name . "' && a_id='" . $akn . "'";
		//print($sql12);
		$stmt12 = $db->query($sql12);
		$stmt12->execute();
		$row12 = $stmt12->fetch(PDO::FETCH_ASSOC);
		
		return $row12['cnt'];
	}
?>
