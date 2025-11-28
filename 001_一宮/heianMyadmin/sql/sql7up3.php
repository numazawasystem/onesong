<?php
	$i = $_POST["no"];
	$id = $_POST["id"];
	if($i < 10)
	{
		$data = "photo2-0" . $i;
	}else{
		$data = "photo2-" . $i;
	}
	if (is_uploaded_file($_FILES[$data]["tmp_name"])) {
		
		if($i < 10)
		{
			$name = "0" . $_POST["no"] . "_" . $_FILES[$data]["name"];
		}else{
			$name = $_POST["no"] . "_" . $_FILES[$data]["name"];
		}
		
		do {
			$filename = date("Ymd-His") . "-" . makeRandStr(10);
		} while (sql16($filename) > 0);
		$sql73 = "INSERT INTO photo2 (a_id , no , data ,name) VALUES ('" . $id . "' , '" . $i . "' , '" . $filename . "' , '" . $name . "')";
		$stmt73 = $db->query($sql73);
		
		if (move_uploaded_file($_FILES[$data]["tmp_name"], "../images/photoimg2/" . $filename)) {
			chmod("../images/photoimg2/" . $filename, 0644);
			
			print("読み込めない写真" . $i . "枚目送信完了");
		}
	}else{
		print("読み込めない写真" . $i . "枚目は空でした");
	}
?>