<?php
	//PHPのエラーが出る設定にする（最後にコメントアウトしておく）
	//ini_set( 'display_errors', 1 );
?>
<?php
	session_start();

	$_SESSION = array();
	

	header("location: ../index.php");
	exit();
?>
