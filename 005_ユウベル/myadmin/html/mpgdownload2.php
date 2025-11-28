<?php
	//PHPのエラーが出る設定にする（最後にコメントアウトしておく）
	ini_set( 'display_errors', 1 );
	
	if(isset($_GET["mpg"])){

		//sql設定を読み込む
		include("../text/sqlheader.php");
		
		//SQL24の設定（サイト情報）
		include("../sql/sql24_site.php");
		
		
		// まずエラー対策
		if (!isset($_GET["mpg"]) || !is_numeric($_GET["mpg"])) {
		    die("不正なリクエストです。");
		}

		// SQLインジェクション対策（prepare使う）
		$sql_mpg = "SELECT * FROM mpg WHERE m_id = :mid";
		$stmt_mpg = $db->prepare($sql_mpg);
		$stmt_mpg->bindValue(':mid', $_GET["mpg"], PDO::PARAM_INT);
		$stmt_mpg->execute();
		$row_mpg = $stmt_mpg->fetch(PDO::FETCH_ASSOC);

		if (!$row_mpg) {
		    die("データが見つかりません。");
		}
		
		// メールを送信
		mb_language("Japanese");
		mb_internal_encoding("UTF-8");
		$to = $row24_site['mail'];
		$title = $row24_site['client'] . "より動画のダウンロードが行われました";
		$message = $row24_site['client'] . $row24_site['title'] . "の詳細ページより、\r\n「ファイル名：" . $row_mpg['name'] . "」　動画のダウンロードが行われました。";
		$header2  = "Content-Type: text/plain; charset=ISO-2022-JP\r\n";
		$header2 .= "From: " . $row24_site['mail'] . "\r\n";
		$header2 .= "Return-Path: " . $row24_site['mail'] . "\r\n";
		// -f をつけてReturn-Pathを明示
		mb_send_mail($to, $title, $message, $header2, "-f" . $row24_site['mail']);
		

		// ファイルパス・ダウンロード名を設定
		$original_file = $row_mpg['data'];
		$filepath = "../../myadmin/mpg/" . basename($original_file); // セキュリティ強化
		$download_name = $row_mpg['name'];

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