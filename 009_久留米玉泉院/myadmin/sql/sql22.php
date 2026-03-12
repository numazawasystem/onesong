<?php
	// SQL22の設定（７日後の計算）
	$sql22 = "SELECT k.k_id, k.name, a.day AS issued_at, DATE_ADD(a.day, INTERVAL 7 DAY) AS valid_until
          FROM kengen k
          JOIN anken a ON k.a_id = a.a_id
          WHERE k.access_token = :token";

	$stmt22 = $db->prepare($sql22);
	$stmt22->execute([':token' => $_GET["data"]]);
	$row22 = $stmt22->fetch(PDO::FETCH_ASSOC);
?>