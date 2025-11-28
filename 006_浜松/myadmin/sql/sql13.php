<?php
	//SQL9の設定（重複チェック）
	function sql13($data , $access_token) {
		//sql設定を読み込む
		include("../text/sqlheader.php");
		
		$sql13 = "SELECT count(*) AS cnt FROM kengen WHERE data='" . $data . "'";
		//print($sql13);
		$stmt13 = $db->query($sql13);
		$stmt13->execute();
		$row13 = $stmt13->fetch(PDO::FETCH_ASSOC);
		
		
		$sql_token = "SELECT count(*) AS cnt FROM kengen WHERE access_token='" . $access_token . "'";
		$stmt_token = $db->query($sql_token);
		$stmt_token->execute();
		$row_token = $stmt_token->fetch(PDO::FETCH_ASSOC);
		
		$count = $row13['cnt'] + $row_token['cnt'];
		
		return $count;
	}
?>
