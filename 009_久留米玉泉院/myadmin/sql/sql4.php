<?php
	//SQL4の設定（未完了の葬儀の一覧）
	$sql4 = "SELECT * FROM anken LEFT OUTER JOIN place ON anken.venue=place.place_id WHERE fg=0 ORDER BY day ASC";
	$stmt4 = $db->query($sql4);
	$stmt4->execute();
	$row4 = $stmt4->fetch(PDO::FETCH_ASSOC);
?>
