<?php
	//list.php
	
	//セッションを開始
	session_start();
	
	//PHPのエラーが出る設定にする（最後にコメントアウトしておく）
	ini_set( 'display_errors', 1 );

	//sql設定を読み込む
	include("../text/sqlheader.php");
	
	if (isset($_SESSION['user_id']))
	{
		//MySQLに接続
		$sqllogin2 = 'select COUNT(u_id) AS cnt from user where user = \''. $_SESSION['user_id'] .'\'';
		$stmtlogin2 = $db->query($sqllogin2);
		$stmtlogin2->execute();
		$rowlogin2 = $stmtlogin2->fetch(PDO::FETCH_ASSOC);
		if($rowlogin2['cnt'] == "0")
		{
			header("location: ../index.php");
			exit();
		}
	}else{
		header("location: ../index.php");
		exit();
	}
	
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>OneSong</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../images/favicon.png">
	<meta name="description" content="">
	<link rel="stylesheet" href="../../css/style.css">
	<script src="../js/openclose.js"></script>
	<script src="../js/qrcode.min.js"></script>
	<script src="../js/fixmenu_pagetop.js"></script>
</head>
<body>
	<div id="container">
		<header>
			<div class="inner">
				<h1 id="logo"><a href="../index.php"><img src="../images/logo.png" alt="Lien"></a></h1>
			</div>
			<!--/.inner-->
		</header>
		<div class="inner">
			<div id="contents">
				<div id="main">
					<section>
						<h2>アクセス用QRコード</h2>
					<br />
					<div id="qrcode"></div><br />
					  <p id="urlText"></p>
					  <button onclick="window.print()">印刷する</button>
						
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
	<script>
	const url = "https://owakare-ai002.chunichi-eizo.jp/?data=<?php print($_GET['data']); ?>";
	document.getElementById("urlText").textContent = url;
	new QRCode(document.getElementById("qrcode"), {
	  text: url,
	  width: 200,
	  height: 200
	});
	</script>
</body>
</html>
</body>
</html>
