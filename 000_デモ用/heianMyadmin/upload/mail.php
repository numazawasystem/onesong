<?php
	//sql設定を読み込む
	include("../text/sqlheader.php");
	//SQL23の設定（案件情報）
	include("../sql/sql23.php");
	
	
	// メールを送信
	mb_language("Japanese");
	mb_internal_encoding("UTF-8");
	$to = "owakare-demo@chunichi-eizo.jp";
	$title = "案件NO：　" . $_POST["id"] . "　のデモサイトからの注文が行われました";
	$message = "案件NO：　" . $_POST["id"] . "　のデモサイトより注文が行われました。\r\n";
	$message .= "故人名：　" . $row23['kojin'] . "\r\n";
	$message .= "通夜日：　" . $row23['day'] . "\r\n";
	$message .= "会場　：　" . $row23['place_name'] . "\r\n\r\n";
	$message .= "詳細は\r\nhttps://owakare-ai000.chunichi-eizo.jp/heianMyadmin/html/list.php\r\nよりご確認ください。";
	
	
	$header  = "Content-Type: text/plain; charset=ISO-2022-JP\r\n";
	$header .= "From: owakare-demo@chunichi-eizo.jp\r\n";
	$header .= "Return-Path: owakare-demo@chunichi-eizo.jp\r\n";
	// -f をつけてReturn-Pathを明示
	mb_send_mail($to, $title, $message, $header, "-fowakare-demo@chunichi-eizo.jp");
	print("メールの送信を行いました。");
?>