<?php
	//upload.php
	//PHPのエラーが出る設定にする（最後にコメントアウトしておく）
	//ini_set( 'display_errors', 1 );

	//セッションを開始
	session_start();

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
<link rel="stylesheet" href="../../css/modal.css">
<script src="../js/openclose.js"></script>
<script src="../js/fixmenu_pagetop.js"></script>
<script src="../js/canvas.js"></script>
<style>
      #canvas { background: #666; }
    </style>
<![endif]-->
</head>

<?php
	$tab = 1;
	include("../header.php");
?>
	<section>
		<h2>情報入力</h2>
		<br />
		<form method="POST"  name="form_main" class="search_container1" enctype="multipart/form-data">
			<div class="cp_iptxt">
				<label class="ef">
						　通夜日<br />
						　<input type="date" name="day" value="<?php print(date("Y-m-d")); ?>"><br />
						　故人様名
						<input type="text" name="title" id="title" placeholder="故人様名"><br />
						　会場<font size="-1">（<font color="#ff0000">会場により映像の画面比率が異なります</font>のでご注意ください）</font><br />
						<div class="cp_ipselect cp_sl04">
							<select name="category" id="category">
							  <option value="0" hidden selected> 会場名</option>
							<?php
								//MySQLに接続
								$sql_place = "SELECT * FROM place ORDER BY place_id ASC";
								$stmt_place = $db->query($sql_place);
								$stmt_place->execute();
								$row_place = $stmt_place->fetch(PDO::FETCH_ASSOC);
								foreach ($db->query($sql_place) as $row_place)
								{
									print("<option value=\"" . $row_place['place_id'] . "\">" . $row_place['place_name'] . "</option>");
								}
							?>
							</select>
						</div>
						　内容指定<br />
						<div class="cp_ipselect cp_sl04">
							<select name="situation" id="situation">
							  <option value="0" hidden selected> 内容指定</option>
							  <option value="1">オルゴール--男性</option>
							  <option value="2">オルゴール--女性</option>
							  <option value="3">ギター　　--男性</option>
							  <option value="4">ギター　　--女性</option>
							  <option value="5">ピアノ　　--男性</option>
							  <option value="6">ピアノ　　--女性</option>
							</select>
						</div>
				</label>
			</div>
			<br />
			<h2>写真のアップロード</h2>
			<h3>画像をドラッグ＆ドロップしてください</h3>


			<div class="list">
				<a href="javascript:void(0);" id="dragcs">
					<figure>
						<div style="display: inline-block; _display: inline; position:relative;"><canvas id="canvas01" width="200px" height="200px" class="cs"></canvas><img src="../images/upload/delete.png" alt="×" class="delete" id="delete01"></div>
						<div style="display: inline-block; _display: inline; position:relative;"><canvas id="canvas02" width="200px" height="200px" class="cs"></canvas><img src="../images/upload/delete.png" alt="×" class="delete" id="delete02"></div>
					</figure>
				</a>
			</div>
			<input type="hidden" id="canvas01-h"  name="canvas01-h" value="">
			<input type="hidden" id="canvas02-h"  name="canvas02-h" value="">

			<h2>読み込めない写真のアップロード</h2>
			<h3>データを参照にドラッグ＆ドロップしてください。上記で読み込める場合は不要。</h3>
			<div id="photo2-01S" class="list3" style="background:#e6e6fa">写真０１<br /><input type="file" id="photo2-01" name="photo2-01" size="30" /></div>
			<div id="photo2-02S" class="list3" style="background:#e6e6fa">写真０２<br /><input type="file" id="photo2-02" name="photo2-02" size="30" /></div>
			<h2></h2>
			
			<!--<input type="submit" name="btn" class="js-modal-open-kaisetu" value="発注"  data-target="modal_keisan"><br />-->
			
			<input type="button" name="btn" class="js-modal-open-kaisetu search_container4" value="発注"  data-target="modal_keisan"><br />
			<font color="#ff0000"><div id="errtest"></div></font>
			<input type="hidden" id="cs-ck"  name="cs-ck" value="0">
			
		</form>
			
		<br />
		 <script>
			canvas();
		</script>
		<script src="../js/canvas-up.js"></script>
		<script src="../js/canvas-up2.js"></script>
	</section>
	<br />
	<section id="new">
	</section>
<!--/main-->
</div>
<!--/main-->
<?php
	include("../sub.php");
?>

</div>
<!--/#contents-->

</div>
<!--/.inner-->

</div>
<!--/container-->
<div id="mask" class="hidden"></div>
<section id="modal" class="hidden">
	<p id="modal-text">画像送信の準備をしております</p>
</section>

</body>
</html>
