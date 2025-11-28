<?php
//PHPのエラーが出る設定にする（最後にコメントアウトしておく）
	ini_set( 'display_errors', 1 );
	
	if(isset($_GET["data"])){
	//sql設定を読み込む
		include("../../heianMyadmin/text/sqlheader.php");
		
		$sql_token = "SELECT * FROM kengen WHERE access_token='" . $_GET["data"] . "'";
		$stmt_token = $db->query($sql_token);
		$stmt_token->execute();
		$row_token = $stmt_token->fetch(PDO::FETCH_ASSOC);
		
		
		
		$original_file = $row_token['data']; // 元ファイル名
		$filepath = "../../heianMyadmin/kanrisya/" . $original_file;

		// 任意のダウンロード名
		$download_name = $row_token['name'];

		if (file_exists($filepath)) {
		    header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename="' . rawurlencode($download_name) . '"; filename*=UTF-8\'\'' . rawurlencode($download_name));
		    header('Content-Length: ' . filesize($filepath));
		    readfile($filepath);
		} else {
		    echo "ファイルが見つかりません。<br />";
		    echo $filepath . "<br />";
		    echo $download_name . "<br />";
		    echo $row_token['data'] . "<br />";
		    echo $row_token['name'] . "<br />";
		}
		
		// メールを送信
		mb_language("Japanese");
		mb_internal_encoding("UTF-8");

		$to = "owakare-ai002@chunichi-eizo.jp";
		$title = "ロマンティア - ダウンロード通知";

		$message = "ロマンティア お客様ダウンロードページから動画のダウンロードが行われました。\n\n対象動画：" . $row_token['name'];

		$header2  = "Content-Type: text/plain; charset=ISO-2022-JP\r\n";
		$header2 .= "From: owakare-ai002@chunichi-eizo.jp\r\n";
		$header2 .= "Return-Path: owakare-ai002@chunichi-eizo.jp\r\n";

		// -f をつけてReturn-Pathを明示
		mb_send_mail($to, $title, $message, $header2, "-fowakare-ai002@chunichi-eizo.jp");
		exit();
	}
	?>