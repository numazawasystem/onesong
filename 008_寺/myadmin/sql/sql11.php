<?php
	//SQL9の設定（重複チェック）
	function sql11($data) {
		//sql設定を読み込む
		include("../text/sqlheader.php");
		
		$sql11 = "SELECT count(*) AS cnt FROM mpg WHERE data='" . $data . "'";
		//print($sql11);
		$stmt11 = $db->query($sql11);
		$stmt11->execute();
		$row11 = $stmt11->fetch(PDO::FETCH_ASSOC);
		
		return $row11['cnt'];
	}
?>
