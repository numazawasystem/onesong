<?php
	//SQL8の設定（重複チェック）
	function sql8($photo) {
		//sql設定を読み込む
		include("../text/sqlheader.php");
		
		$sql8 = "SELECT count(*) AS cnt FROM photo WHERE data='" . $photo . "'";
		$stmt8 = $db->query($sql8);
		$stmt8->execute();
		$row8 = $stmt8->fetch(PDO::FETCH_ASSOC);
		
		return $row8['cnt'];
	}
?>
