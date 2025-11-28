<?php
	//セッションを開始
	session_start();

	//PHPのエラーが出る設定にする（最後にコメントアウトしておく）
	//ini_set( 'display_errors', 1 );
	
	//sql設定を読み込む
	include("./text/sqlheader.php");
	
	if (isset($_SESSION['user_id']))
	{
		//MySQLに接続
		$sqllogin2 = 'select COUNT(u_id) AS cnt from user where user = \''. $_SESSION['user_id'] .'\'';
		$stmtlogin2 = $db->query($sqllogin2);
		$stmtlogin2->execute();
		$rowlogin2 = $stmtlogin2->fetch(PDO::FETCH_ASSOC);
		if($rowlogin2['cnt'] == "1")
		{
			header("location: ./upload/upload.php");
			exit();
		}
	}
	
	if (isset($_POST['btnExec']))
	{
		//送信ボタンがクリックされたとき
		//MySQLに接続

		$sqllogin = "select * from user where user = '" . $_POST['user'] . "'";
		//print($sqllogin);
		$stmtlogin = $db->query($sqllogin);
		$stmtlogin->execute();
		$rowlogin = $stmtlogin->fetch(PDO::FETCH_ASSOC);
		if ($rowlogin && password_verify($_POST['password'], $rowlogin['pw'])) {
		//if($rowlogin['cnt'] == "1")
		//{
			
			//セッション変数にユーザーを保存
			$_SESSION['user_id'] = $_POST['user'];
			
			header("location: ./upload/upload.php");
			exit();
		}
		else
		{
			print "ユーザー名かパスワードが間違っています！<br /><br />";
		}
	}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>OneSongデモサイト</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="./images/favicon.png">
<meta name="description" content="">
<link rel="stylesheet" href="../css/style.css">
<![endif]-->
</head>

<body>
	<div id="container">
		<header>
			<div class="inner">
				<h1 id="logo"><a href="index.php"><img src="./images/logo.png" alt="Lien"></a></h1>
			</div>
			<!--/.inner-->
		</header>
		<div class="inner">
			<div id="contents">
				<div id="main">
					<section>
						<h2>ログイン画面</h2>
						<br /><br />
						<FORM method="POST"  class="search_container1">
						<div class="cp_iptxt">
							<label class="ef">
							ユーザー名<br />
							<input type="text" name="user" placeholder="ユーザー名"><br /><br />
							パスワード<br />
							<input type="password" name="password" placeholder="パスワード"><br />
							</label>
							<br />
							<input type="submit" name="btnExec" value="ログイン">
						</div>
					</FORM>
					</section>
				<!--/main-->
				</div>
				<!--/main-->
			</div>
			<!--/#contents-->
		</div>
	<!--/.inner-->
	</div>
	<!--/container-->
</body>
</html>
