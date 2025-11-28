<?php
		$i = $_POST["no"];
		$id = $_POST["id"];
		do {
			$filename = date("Ymd-His") . "-" . makeRandStr(10);
		} while (sql8($filename) > 0);
		$sql73 = "INSERT INTO photo (a_id , no , data) VALUES ('" . $id . "' , '" . $i . "' , '" . $filename . "')";
		$stmt73 = $db->query($sql73);
		
		
		//画像の受け取りと変換１
		if($i < 10){
			$data1 = str_replace(' ' , '+' , $_POST["canvas0" . $i . "-h"]);
		}else{
			$data1 = str_replace(' ' , '+' , $_POST["canvas" . $i . "-h"]);
		}
		$data1 = preg_replace('#^data:image/\w+;base64,#i' , '' , $data1);
		$data11 = base64_decode($data1);
		//画像を保存
	    file_put_contents('../images/photoimg/' . $filename . ".jpg", $data11);
	    
	    
	    // コピー元画像のサイズ取得
		$imagesize = getimagesize("data:;base64,".$data1);
		$src_w = $imagesize[0];
		$src_h = $imagesize[1];
		
		if($src_h > $src_w)
		{
		    $tate = 300;
		    $yoko = ($tate * $src_w)/$src_h;
		    $tateC = 0;
		    $yokoC = ($tate - $yoko)/2;;
		}else{
			$yoko = 300;
		    $tate = ($yoko * $src_h)/$src_w;
		    $tateC = ($yoko - $tate)/2;
		    $yokoC = 0;
		}
	    
	    // コピー先画像空で作成
		$dst_image = imagecreatetruecolor(300,300);
		// コピー元画像読み込み
		$src_image = imagecreatefromjpeg("data:;base64,".$data1);
		
		// リサイズしてコピー
		imagecopyresampled(
			$dst_image, // コピー先の画像
			$src_image, // コピー元の画像
			$yokoC,          // コピー先の x 座標
			$tateC,          // コピー先の y 座標。
			0,          // コピー元の x 座標
			0,          // コピー元の y 座標
			$yoko,     // コピー先の幅
			$tate,     // コピー先の高さ
			$src_w,     // コピー元の幅
			$src_h		// コピー元の高さ
		);
	    //画像を保存
	    imagejpeg($dst_image,"../images/photocth/" . $filename . ".jpg");
	    
	    print($i . "枚目送信完了");
	    
	    
	    
?>
