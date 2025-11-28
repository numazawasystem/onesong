<?php
	//セッションを開始
	session_start();

	//PHPのエラーが出る設定にする（最後にコメントアウトしておく）
	//ini_set( 'display_errors', 1 );
	
	//sql設定を読み込む
	include("../heianMyadmin/text/sqlheader.php");
	
	//SQL1の設定（GETからデータ一覧を取得）
	$sql1 = "SELECT * FROM kengen WHERE access_token='" . $_GET['data'] . "'";
	$stmt1 = $db->query($sql1);
	$stmt1->execute();
	$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
	
	$sql2 = "SELECT * FROM anken WHERE a_id='" . $row1['a_id'] . "'";
	$stmt2 = $db->query($sql2);
	$stmt2->execute();
	$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
	
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>OneSongデモサイト</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="./top/images/favicon.png">
<meta name="description" content="">
<link rel="stylesheet" href="../css/style.css">
<![endif]-->
</head>

<body>
	<div id="container">
		<header>
			<div class="inner">
				<h1 id="logo"><a href=""><img src="./top/images/logo.png" alt="OneSong"></a></h1>
			</div>
			<!--/.inner-->
		</header>
		<div class="inner">
			<div id="contents">
				<div id="main">
					<section>
						<h2>ダウンロードページ</h2>
						<p>ファイルのダウンロードはLINE内では正常に行えない場合があります。<br>
							ブラウザで開いてからダウンロードしてください。</p>
						<br /><br /><br />

					
					<h3><?php print($row1['name']); ?></h3>
						<?php
							$cnt = 0;
							foreach ($db->query($sql1) as $row1)
							{
								$cnt += 1;
							}
						
						if($cnt > 0){
						?>
							<p><a href="./top/html/mpgdownload.php?data=<?php print($_GET['data']); ?>" class="btn-square2">ダウンロード</a></p>
						<?php
						}else{
						?>
							<p><a href="" class="btn-square2" onclick="return confirm('動画はまだアップロードされていません');">動画のダウンロード</a></p>
						<?php
						}
						?>
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
