<?php
	
	//お客様用データの削除
	$sql18del8 = "SELECT data FROM mpg WHERE a_id=" . $_GET['akn'];
	foreach ($db->query($sql18del8) as $row18del8)
	{
		unlink("../mpg/" . $row18del8['data']);
	}
	
	$sql18del10 = " DELETE FROM mpg WHERE a_id=" . $_GET['akn'];
	$stmt18del10 = $db->query($sql18del10);
	$stmt18del10->execute();
	$row18del10 = $stmt18del10->fetch(PDO::FETCH_ASSOC);
?>
