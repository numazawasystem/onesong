<?php
	//PHPのエラーが出る設定にする（最後にコメントアウトしておく）
	ini_set( 'display_errors', 1 );
	
	if(isset($_GET["akn"])){

		// Zipクラスロード
		$zip = new ZipArchive();
		// Zipファイル名
		$zipFileName = $_GET["akn"] . "_narration.zip";
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
		//SQL15の設定（データ一覧）
		include("../sql/sql15.php");
		// addFileでzipに追加するファイルを指定
		foreach ($db->query($sql15) as $row15)
		{
			$zip->addFile("../kanrisya/" . $row15["data"] , $row15["name"]);
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
		$title = $_GET["akn"] ."||　完成データのダウンロードが行われました";
		$message = "ロマンティアの詳細ページより、\r\n案件NO：" . $_GET["akn"] . "　から完成データのダウンロードが行われました。";
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