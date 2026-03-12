<?php
	
	//お客様用データの削除
	$sql18del9 = "SELECT data FROM kengen WHERE a_id=" . $_GET['akn'];
	foreach ($db->query($sql18del9) as $row18del9)
	{
		unlink("../kanrisya/" . $row18del9['data']);
	}
	
	$sql18del11 = " DELETE FROM kengen WHERE a_id=" . $_GET['akn'];
	$stmt18del11 = $db->query($sql18del11);
	$stmt18del11->execute();
	$row18del11 = $stmt18del11->fetch(PDO::FETCH_ASSOC);

?>
