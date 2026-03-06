<?php
	//SQL16の設定（重複チェック）
	function sql16($photo) {
		//sql設定を読み込む
		include("../text/sqlheader.php");
		
		$sql16 = "SELECT count(*) AS cnt FROM photo2 WHERE data='" . $photo . "'";
		$stmt16 = $db->query($sql16);
		$stmt16->execute();
		$row16 = $stmt16->fetch(PDO::FETCH_ASSOC);
		
		return $row16['cnt'];
	}
?>
