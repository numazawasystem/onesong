<?php
	//PHPのエラーが出る設定にする（最後にコメントアウトしておく）
	//ini_set( 'display_errors', 1 );

	//セッションを開始
	session_start();

	//sql設定を読み込む
	include("../text/sqlheader.php");

	//ユーザー情報を取得
	
	$plain_password = "chunichiEizo";
	$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);
	
	//SQLの設定（ユーザー登録）
	$sql = "INSERT INTO user (user , pw , acs ) VALUES ('demodemo' , '" . $hashed_password . "' , '0')";
	print($sql);
	$stmt = $db->query($sql);
	

?>
