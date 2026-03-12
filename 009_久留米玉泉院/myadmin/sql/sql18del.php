<?php
	//写真の削除
	$sql18del2 = "SELECT data FROM photo WHERE a_id=" . $_GET['akn'];
	foreach ($db->query($sql18del2) as $row18del2)
	{
		unlink("../images/photoimg/" . $row18del2['data'] . ".jpg");
		unlink("../images/photocth/" . $row18del2['data'] . ".jpg");
	}
	$sql18del3 = " DELETE FROM photo WHERE a_id=" . $_GET['akn'];
	$stmt18del3 = $db->query($sql18del3);
	$stmt18del3->execute();
	$row18del3 = $stmt18del3->fetch(PDO::FETCH_ASSOC);
	
	//写真２の削除
	$sql18del4 = "SELECT data FROM photo2 WHERE a_id=" . $_GET['akn'];
	foreach ($db->query($sql18del4) as $row18del4)
	{
		unlink("../images/photoimg2/" . $row18del4['data']);
	}
	$sql18del5 = " DELETE FROM photo2 WHERE a_id=" . $_GET['akn'];
	$stmt18del5 = $db->query($sql18del5);
	$stmt18del5->execute();
	$row18del5 = $stmt18del5->fetch(PDO::FETCH_ASSOC);
	
	//データ・動画・権限データの削除
	$sql18del6 = "SELECT data FROM data WHERE a_id=" . $_GET['akn'];
	foreach ($db->query($sql18del6) as $row18del6)
	{
		unlink("../data/" . $row18del6['data']);
	}
	$sql18del8 = "SELECT data FROM mpg WHERE a_id=" . $_GET['akn'];
	foreach ($db->query($sql18del8) as $row18del8)
	{
		unlink("../mpg/" . $row18del8['data']);
	}
	$sql18del9 = "SELECT data FROM kengen WHERE a_id=" . $_GET['akn'];
	foreach ($db->query($sql18del9) as $row18del9)
	{
		unlink("../kanrisya/" . $row18del9['data']);
	}
	$sql18del7 = " DELETE FROM data WHERE a_id=" . $_GET['akn'];
	$stmt18del7 = $db->query($sql18del7);
	$stmt18del7->execute();
	$row18del7 = $stmt18del7->fetch(PDO::FETCH_ASSOC);
	
	$sql18del10 = " DELETE FROM mpg WHERE a_id=" . $_GET['akn'];
	$stmt18del10 = $db->query($sql18del10);
	$stmt18del10->execute();
	$row18del10 = $stmt18del10->fetch(PDO::FETCH_ASSOC);
	
	$sql18del11 = " DELETE FROM kengen WHERE a_id=" . $_GET['akn'];
	$stmt18del11 = $db->query($sql18del11);
	$stmt18del11->execute();
	$row18del11 = $stmt18del11->fetch(PDO::FETCH_ASSOC);

	//SQL18delの設定（案件一覧のフラグ更新）
	$sql18del = "UPDATE anken SET fg=1 WHERE a_id=" . $_GET['akn'];
	$stmt18del = $db->query($sql18del);
	$stmt18del->execute();
	$row18del = $stmt18del->fetch(PDO::FETCH_ASSOC);
?>
