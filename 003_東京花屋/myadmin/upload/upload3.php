<?php
	//PHPのエラーが出る設定にする（最後にコメントアウトしておく）
	//ini_set( 'display_errors', 1 );

	//セッションを開始
	session_start();

	//sql設定を読み込む
	include("../text/sqlheader.php");
	
	//ランダム文字列生成 (英数字)
		include("../function/str.php");
	//SQL8の設定（重複チェック）
		include("../sql/sql8.php");

	//ユーザー情報を取得
	//MySQLに接続
	
	//SQL7の設定（写真の写真のアップロード）
	include("../sql/sql7up2.php");
	
	//アップロード画面に戻る
	//header("location: ../html/main.php");
	//exit();


?>