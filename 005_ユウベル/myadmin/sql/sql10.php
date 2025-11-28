<?php
	//SQL10の設定（重複チェック）
	function sql10($name , $akn) {
		//sql設定を読み込む
		include("../text/sqlheader.php");
		
		$sql10 = "SELECT count(*) AS cnt FROM data WHERE name='" . $name . "' && a_id='" . $akn . "'";
		//print($sql10);
		$stmt10 = $db->query($sql10);
		$stmt10->execute();
		$row10 = $stmt10->fetch(PDO::FETCH_ASSOC);
		
		return $row10['cnt'];
	}
?>
