<?php
	//PHPのエラーが出る設定にする（最後にコメントアウトしておく）
	//ini_set( 'display_errors', 1 );
	
	if(isset($_GET["akn"])){

		// Zipクラスロード
		$zip = new ZipArchive();
		// Zipファイル名
		$zipFileName = $_GET["akn"] . "_photo2.zip";
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
		
		//ユーザー情報を取得
		include("../sql/sql19.php");
		// addFileでzipに追加するファイルを指定
		foreach ($db->query($sql19) as $row19)
		{
			$zip->addFile("../images/photoimg2/" . $row19["data"] , $row19["name"]);
		}
		// ZIPファイルをクローズ
		$zip->close();

		// ストリームに出力
		header('Content-Type: application/zip; name="' . $zipFileName . '"');
		header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
		header('Content-Length: '.filesize($zipFilePath.$zipFileName));
		echo file_get_contents($zipFilePath.$zipFileName);
		
		// メールを送信
		mb_language("Japanese");
		mb_internal_encoding("UTF-8");
		$to = "owakare-ai002@chunichi-eizo.jp";
		$title = $_GET["akn"] ."||　読み込めない写真のダウンロードが行われました";
		$message = "ロマンティアの詳細ページより、\r\n案件NO：" . $_GET["akn"] . "　から読み込めない写真のダウンロードが行われました。";
		$header2  = "Content-Type: text/plain; charset=ISO-2022-JP\r\n";
		$header2 .= "From: owakare-ai002@chunichi-eizo.jp\r\n";
		$header2 .= "Return-Path: owakare-ai002@chunichi-eizo.jp\r\n";

		// -f をつけてReturn-Pathを明示
		mb_send_mail($to, $title, $message, $header2, "-fowakare-ai002@chunichi-eizo.jp");
		// 一時ファイルを削除しておく
		unlink($zipFilePath.$zipFileName);
		exit();
	}
?>