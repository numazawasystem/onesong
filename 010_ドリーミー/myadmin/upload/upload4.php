<?php
	//PHPのエラーが出る設定にする（最後にコメントアウトしておく）
	//ini_set( 'display_errors', 1 );

	//セッションを開始
	session_start();

	//sql設定を読み込む
	include("../text/sqlheader.php");
	
	//ランダム文字列生成 (英数字)
		include("../function/str.php");
	//SQL16の設定（重複チェック）
		include("../sql/sql16.php");

	//ユーザー情報を取得
	//MySQLに接続
	
	//SQL7の設定（写真の写真のアップロード）
	include("../sql/sql7up3.php");
	
?>