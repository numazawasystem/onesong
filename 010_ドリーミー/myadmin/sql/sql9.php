<?php
	//SQL9の設定（重複チェック）
	function sql9($data) {
		//sql設定を読み込む
		include("../text/sqlheader.php");
		
		$sql9 = "SELECT count(*) AS cnt FROM data WHERE data='" . $data . "'";
		//print($sql9);
		$stmt9 = $db->query($sql9);
		$stmt9->execute();
		$row9 = $stmt9->fetch(PDO::FETCH_ASSOC);
		
		return $row9['cnt'];
	}
?>
