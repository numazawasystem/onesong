<?php
	//main.php
	
	//セッションを開始
	session_start();
	
	//PHPのエラーが出る設定にする（最後にコメントアウトしておく）
	ini_set( 'display_errors', 1 );

	//sql設定を読み込む
	include("../text/sqlheader.php");
	
	if (isset($_SESSION['user_id']))
	{
		//MySQLに接続
		$sqllogin2 = 'select COUNT(u_id) AS cnt , acs from user where user = \''. $_SESSION['user_id'] .'\'';
		$stmtlogin2 = $db->query($sqllogin2);
		$stmtlogin2->execute();
		$rowlogin2 = $stmtlogin2->fetch(PDO::FETCH_ASSOC);
		if($rowlogin2['cnt'] == "0")
		{
			header("location: ../index.php");
			exit();
		}
		$acs = $rowlogin2['acs'];
	}else{
		header("location: ../index.php");
		exit();
	}
	//動画のアップロード
	if (isset($_POST['btnExecUP2']))
	{
		
		//送信ボタンがクリックされたとき
		//MySQLに接続
		
		if (is_uploaded_file($_FILES["upfile2"]["tmp_name"])) {
			//ランダム文字列生成 (英数字)
			include("../function/str.php");
			//SQL11の設定（重複チェック）
			include("../sql/sql11.php");
			//SQL12の設定（重複チェック）
			include("../sql/sql12.php");
			if(sql12($_FILES["upfile2"]["name"] , $_GET["akn"]) == 0){
				do {
					$filename2 = date("Ymd-His") . "-" . makeRandStr(10);
				} while (sql11($filename2) > 0);
				
				//データ情報の設定（データ情報のアップロード）
				$sqldata2 = "INSERT INTO mpg (a_id,data,name) VALUES ('" . $_GET["akn"] . "' , '" . $filename2 . "' , '" . $_FILES["upfile2"]["name"] . "')";
				$stmtdata2 = $db->query($sqldata2);
				
				$sqldata3 = "UPDATE anken SET douga=1 WHERE a_id=" . $_GET["akn"];
				$stmtdata3 = $db->query($sqldata3);

				if (move_uploaded_file($_FILES["upfile2"]["tmp_name"], "../mpg/" . $filename2)) {
					chmod("../mpg/" . $filename2, 0644);
					
					// メールを送信
					mb_language("Japanese");
					mb_internal_encoding("UTF-8");
					$to = "owakare-demo@chunichi-eizo.jp";
					$title = $_GET["akn"] ."||　動画のアップロードが行われました";
					$message = "デモサイトの詳細ページより、\r\n案件NO：" . $_GET["akn"] . "　から動画のアップロードが行われました。";
					$header2  = "Content-Type: text/plain; charset=ISO-2022-JP\r\n";
					$header2 .= "From: owakare-demo@chunichi-eizo.jp\r\n";
					$header2 .= "Return-Path: owakare-demo@chunichi-eizo.jp\r\n";

					// -f をつけてReturn-Pathを明示
					mb_send_mail($to, $title, $message, $header2, "-fowakare-demo@chunichi-eizo.jp");
				}
			}
		}
	}
	//データのアップロード
	if (isset($_POST['btnExecUP1']))
	{
		//送信ボタンがクリックされたとき
		//MySQLに接続
		
		if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
			//ランダム文字列生成 (英数字)
			include("../function/str.php");
			//SQL9の設定（重複チェック）
			include("../sql/sql9.php");
			//SQL10の設定（重複チェック）
			include("../sql/sql10.php");
			if(sql10($_FILES["upfile"]["name"] , $_GET["akn"]) == 0){
				do {
					$filename = date("Ymd-His") . "-" . makeRandStr(10);
				} while (sql9($filename) > 0);
				
				//データ情報の設定（データ情報のアップロード）
				$sqldata = "INSERT INTO data (a_id,data,name) VALUES ('" . $_GET["akn"] . "' , '" . $filename . "' , '" . $_FILES["upfile"]["name"] . "')";
				$stmtdata = $db->query($sqldata);

				if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "../data/" . $filename)) {
					chmod("../data/" . $filename, 0644);
					
					// メールを送信
					mb_language("Japanese");
					mb_internal_encoding("UTF-8");
					$to = "owakare-demo@chunichi-eizo.jp";
					$title = $_GET["akn"] ."||　その他データのアップロードが行われました";
					$message = "デモサイトの詳細ページより、\r\n案件NO：" . $_GET["akn"] . "　からその他データのアップロードが行われました。";
					$header  = "Content-Type: text/plain; charset=ISO-2022-JP\r\n";
					$header .= "From: owakare-demo@chunichi-eizo.jp\r\n";
					$header .= "Return-Path: owakare-demo@chunichi-eizo.jp\r\n";

					// -f をつけてReturn-Pathを明示
					mb_send_mail($to, $title, $message, $header, "-fowakare-demo@chunichi-eizo.jp");
				}
			}
		}
	}
	
	//管理者データのアップロード
	if (isset($_POST['btnExecUP3']))
	{
		//送信ボタンがクリックされたとき
		//MySQLに接続
		
		if (is_uploaded_file($_FILES["upfile3"]["tmp_name"])) {
			//ランダム文字列生成 (英数字)
			include("../function/str.php");
			//SQL13の設定（重複チェック）
			include("../sql/sql13.php");
			//SQL14の設定（重複チェック）
			include("../sql/sql14.php");
			if(sql14($_FILES["upfile3"]["name"] , $_GET["akn"]) == 0){
				do {
					$filename = date("Ymd-His") . "-" . makeRandStr(10);
					$access_token = makeRandStr(30);
				} while (sql13($filename , $access_token) > 0);
				
				//データ情報の設定（データ情報のアップロード）
				$sqldata4 = "INSERT INTO kengen (a_id,data,name,access_token) VALUES ('" . $_GET["akn"] . "' , '" . $filename . "' , '" . $_FILES["upfile3"]["name"] . "' , '" . $access_token . "')";
				$stmtdata4 = $db->query($sqldata4);

				if (move_uploaded_file($_FILES["upfile3"]["tmp_name"], "../kanrisya/" . $filename)) {
					chmod("../kanrisya/" . $filename, 0644);
					
					// メールを送信
					mb_language("Japanese");
					mb_internal_encoding("UTF-8");
					$to = "owakare-demo@chunichi-eizo.jp";
					$title = $_GET["akn"] ."||　お客様用データのアップロードが行われました";
					$message = "デモサイトの詳細ページより、\r\n案件NO：" . $_GET["akn"] . "　からお客様用データのアップロードが行われました。";
					$header  = "Content-Type: text/plain; charset=ISO-2022-JP\r\n";
					$header .= "From: owakare-demo@chunichi-eizo.jp\r\n";
					$header .= "Return-Path: owakare-demo@chunichi-eizo.jp\r\n";

					// -f をつけてReturn-Pathを明示
					mb_send_mail($to, $title, $message, $header, "-fowakare-demo@chunichi-eizo.jp");
				}
			}
		}
	}
	
	//SQL3の設定（写真一覧）
	include("../sql/sql3.php");
	//SQL17の設定（写真一覧）
	include("../sql/sql17.php");
	//SQL6の設定（データ一覧）
	include("../sql/sql6.php");
	//SQL2の設定（動画一覧）
	include("../sql/sql2.php");
	//SQL1の設定（管理者データ一覧）
	include("../sql/sql1.php");
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>OneSongデモサイト</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../images/favicon.png">
	<meta name="description" content="">
	<link rel="stylesheet" href="../../css/style.css">
	<script src="../js/openclose.js"></script>
	<script src="../js/fixmenu_pagetop.js"></script>
</head>
<?php
	$tab = 1;
	include("../header.php");
?>
					<section>
						<h2>葬儀詳細</h2>
						<h3>写真一覧</h3>
						<?php
							if($acs == 1){
						?>
						<p><a href="../html/download.php?akn=<?php print($_GET['akn']); ?>" class="btn-square2">写真のダウンロード</a></p>
						<?php
							}
						?>
						<?php
							foreach ($db->query($sql3) as $row3)
							{
						?>
								<div class="list2">
									<?php
										if($row3['no'] == 21){
											print("発注書");
										}elseif($row3['no'] == 22){
											print("会葬礼状");
										}else{
											print($row3['no']);
										}
									?>
									<figure><img src="../images/photocth/<?php print($row3['data']); ?>.jpg" alt="写真" height="300"></figure>
									
								</div>
						<?php
							}
						?>
						<h3>読み込めない写真一覧</h3>
						<?php
							if($acs == 1){
						?>
						<p><a href="../html/download2.php?akn=<?php print($_GET['akn']); ?>" class="btn-square2">写真のダウンロード</a></p>
						<?php
							}
						?>
						<?php
							foreach ($db->query($sql17) as $row17)
							{
								if($row17['no'] < 10){
									print("0" . $row17['no'] . "枚目：　" . $row17['name'] . "<br />");
								}else{
									print($row17['no'] . "枚目：　" . $row17['name'] . "<br />");
								}
							}
						?>
						
						<h3>完成データ</h3>
						<?php
							foreach ($db->query($sql2) as $row2)
							{
								print($row2['name'] . "　　<a href=\"mpgdownload2.php?mpg=" . $row2['m_id'] . "\">ダウンロード</a>" . "<br />");
							}
						?>
						<?php
							if($acs == 1){
						?>
						<FORM method="POST"  class="search_container2" enctype="multipart/form-data">
							<input type="file" name="upfile2" size="30" /><br />
							<div class="list3"><input type="submit" name="btnExecUP2" value="動画のアップロード"></div>
						</form>
						<br /><br /><br />
						<p><a href="../html/mpg_delete.php?akn=<?php print($_GET['akn']); ?>" class="btn-square2">完成データの削除</a></p>
						<?php
							}
						?>



						<h3>お客様ダウンロード用データ</h3>
						
						<?php
							foreach ($db->query($sql1) as $row1)
							{
								print($row1['name'] . "　　https://owakare-ai000.chunichi-eizo.jp/?data=" . $row1['access_token'] . "　　<a href=\"./qr.php?data=" . $row1['access_token'] . "\" target=\"_blank\">ＱＲコード</a><br />");
							}
						?>
						
						<FORM method="POST"  class="search_container2" enctype="multipart/form-data">
							<input type="file" name="upfile3" size="30" /><br />
							<div class="list3"><input type="submit" name="btnExecUP3" value="お客様ダウンロード用データのアップロード"></div>
						</form>
						<br /><br /><br />
						
						<p><a href="../html/contents_delete.php?akn=<?php print($_GET['akn']); ?>" class="btn-square2">お客様ダウンロード用データの削除</a></p>
						
						
						
						<h3>追加データ（追加データは一つずつ選択してアップロードしてください。）</h3>
						<p><a href="../html/datadownload.php?akn=<?php print($_GET['akn']); ?>" class="btn-square3">データのダウンロード</a></p>
						<?php
							foreach ($db->query($sql6) as $row6)
							{
								print($row6['name'] . "<br />");
							}
						?>
						<FORM method="POST"  class="search_container3" enctype="multipart/form-data">
							<input type="file" name="upfile" size="30" /><br />
							<div class="list3"><input type="submit" name="btnExecUP1" value="データのアップロード"></div>
						</form>
						<?php
							if($acs == 1){
						?>
						<h3>管理画面</h3>
						<div class="list3">
							<a href="../html/delete.php?akn=<?php print($_GET['akn']); ?>" class="btn-square2" onclick="return confirm('本当に削除してもよろしいですか？');">この葬儀を削除</a>
						</div>
						<?php
							}
						?>
					</section>
				</div>
				<!--/main-->
				<?php
					include("../sub.php");
				?>
				<!--/#sub-->
			</div>
			<!--/#contents-->
		</div>
		<!--/.inner-->
	</div>

</body>
</html>
