<?php
	//PHPのエラーが出る設定にする（最後にコメントアウトしておく）
	ini_set( 'display_errors', 1 );
	
	if(isset($_GET["akn"])){

		// Zipクラスロード
		$zip = new ZipArchive();
		// Zipファイル名
		$zipFileName = $_GET["akn"] . ".zip";
		// Zipファイル一時保存ディレクトリ取得【write権限のある任意のディレクトリ】
		$zipFilePath = '../tmp/';

		// ZIPファイルを開く
		$res = $zip->open($zipFilePath . $zipFileName, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);
		// zipファイルが作れなかったら終了
		if ($res !== true) {
		    echo "zipファイル作成失敗\n";
		    return;
		}
		//sql設定を読み込む
		include("../text/sqlheader.php");
		
		//SQL24の設定（サイト情報）
		include("../sql/sql24_site.php");
		
		//ユーザー情報を取得
		//SQL3の設定（写真一覧）
		include("../sql/sql3.php");
		// addFileでzipに追加するファイルを指定
		foreach ($db->query($sql3) as $row3)
		{
			if($row3["no"] == 21){
				$zip->addFile("../images/photoimg/" . $row3["data"] . ".jpg" , "発注書.jpg");
			}else if($row3["no"] == 22){
				$zip->addFile("../images/photoimg/" . $row3["data"] . ".jpg" , "会葬礼状.jpg");
			}else{
				$zip->addFile("../images/photoimg/" . $row3["data"] . ".jpg" , sprintf('%03d',$row3["no"]) . ".jpg");
			}
		}
		// ZIPファイルをクローズ
		$zip->close();

		// ストリームに出力
		header('Content-Type: application/zip; name="' . $zipFileName . '"');
		header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
		header('Content-Length: '.filesize($zipFilePath.$zipFileName));
		echo file_get_contents($zipFilePath.$zipFileName);
		
		// メールを送信
		//mb_language("Japanese");
		//mb_internal_encoding("UTF-8");
		//$to = $row24_site['mail'];
		//$title = $_GET["akn"] ."||　写真のダウンロードが行われました";
		//$message = $row24_site['client'] . $row24_site['title'] . "の詳細ページより、\r\n案件NO：" . $_GET["akn"] . "　から写真のダウンロードが行われました。";
		//$header2  = "Content-Type: text/plain; charset=ISO-2022-JP\r\n";
		//$header2 .= "From: " . $row24_site['mail'] . "\r\n";
		//$header2 .= "Return-Path: " . $row24_site['mail'] . "\r\n";

		// -f をつけてReturn-Pathを明示
		//mb_send_mail($to, $title, $message, $header2, "-f" . $row24_site['mail']);
		 
		// 一時ファイルを削除しておく
		unlink($zipFilePath.$zipFileName);
		exit();
	}
?>