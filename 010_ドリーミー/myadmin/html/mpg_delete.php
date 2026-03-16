<?php
	//PHPのエラーが出る設定にする（最後にコメントアウトしておく）
	//ini_set( 'display_errors', 1 );

	//セッションを開始
	session_start();

	//sql設定を読み込む
	include("../text/sqlheader.php");

	//ユーザー情報を取得
	//MySQLに接続
	
	//SQL21delの設定（完了フラグ）
	include("../sql/sql21del.php");
	
	//アップロード画面に戻る
	header("location: ../html/main.php?akn=" . $_GET['akn']);
	exit();

?>
