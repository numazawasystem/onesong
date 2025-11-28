<?php
//PHPのエラーが出る設定にする（最後にコメントアウトしておく）
	ini_set( 'display_errors', 1 );
	
	if(isset($_GET["data"])){
	//sql設定を読み込む
		include("../../heianMyadmin/text/sqlheader.php");
		
		// エラー対策（dataがない場合）
		if (!isset($_GET["data"]) || empty($_GET["data"])) {
		    die("不正なリクエストです。");
		}

		// SQLインジェクション対策（prepare + bindValue）
		$sql_token = "SELECT * FROM kengen WHERE access_token = :token";
		$stmt_token = $db->prepare($sql_token);
		$stmt_token->bindValue(':token', $_GET["data"], PDO::PARAM_STR);
		$stmt_token->execute();
		$row_token = $stmt_token->fetch(PDO::FETCH_ASSOC);

		if (!$row_token) {
		    die("データが見つかりません。");
		}
		
		
		// メールを送信
		//mb_language("Japanese");
		//mb_internal_encoding("UTF-8");

		//$to = "owakare-ai@chunichi-eizo.jp";
		//$title = "一宮平安閣エターナルソング - ダウンロード通知";

		//$message = "一宮平安閣エターナルソング お客様ダウンロードページから動画のダウンロードが行われました。\n\n対象動画：" . $row_token['name'];

		//$header2  = "Content-Type: text/plain; charset=ISO-2022-JP\r\n";
		//$header2 .= "From: owakare-ai@chunichi-eizo.jp\r\n";
		//$header2 .= "Return-Path: owakare-ai@chunichi-eizo.jp\r\n";

		// -f をつけてReturn-Pathを明示
		//mb_send_mail($to, $title, $message, $header2, "-fowakare-ai@chunichi-eizo.jp");
		
		
		

		// ファイルパス・ダウンロード名
		$original_file = $row_token['data'];
		$filepath = "../../heianMyadmin/kanrisya/" . basename($original_file); // セキュリティ強化
		$download_name = $row_token['name'];

		if (file_exists($filepath)) {
		    set_time_limit(0); // タイムアウト無効

		    // ヘッダ出力
		    header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename="' . rawurlencode($download_name) . '"; filename*=UTF-8\'\'' . rawurlencode($download_name));
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($filepath));

		    // バッファリング送信（1MBずつ）
		    $chunkSize = 1024 * 1024; // 1MB
		    $handle = fopen($filepath, 'rb');
		    while (!feof($handle)) {
		        echo fread($handle, $chunkSize);
		        flush();
		    }
		    fclose($handle);
		    exit;
		} else {
		    echo "ファイルが見つかりません。<br />";
		    echo htmlspecialchars($filepath) . "<br />";
		    echo htmlspecialchars($download_name) . "<br />";
		}
		
		
		exit();
	}
	?>