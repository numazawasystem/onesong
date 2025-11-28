<?php
	//upload.php
	//PHPのエラーが出る設定にする（最後にコメントアウトしておく）
	//ini_set( 'display_errors', 1 );

	//セッションを開始
	session_start();

	//sql設定を読み込む
	include("../text/sqlheader.php");
	
	//SQL24の設定（サイト情報）
	include("../sql/sql24_site.php");

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
<title><?php print($row24_site['client']); ?>様専用ページ_<?php print($row24_site['title']); ?></title>
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
<style>
.list3 {
display: none !important;
}
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
						　日付<br />
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
						　コンテンツ<br />
						<div class="cp_ipselect cp_sl04">
							<select name="situation" id="situation">
							  <option value="0" hidden> コンテンツ</option>
							  <option value="1" selected>音楽のみ</option>
							  <option value="2">スライドショー</option>
							  <option value="3">その他</option>
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
						<div style="display: inline-block; _display: inline; position:relative;"><canvas id="canvas03" width="200px" height="200px" class="cs"></canvas><img src="../images/upload/delete.png" alt="×" class="delete" id="delete03"></div>
						<div style="display: inline-block; _display: inline; position:relative;"><canvas id="canvas04" width="200px" height="200px" class="cs"></canvas><img src="../images/upload/delete.png" alt="×" class="delete" id="delete04"></div>
						<div style="display: inline-block; _display: inline; position:relative;"><canvas id="canvas05" width="200px" height="200px" class="cs"></canvas><img src="../images/upload/delete.png" alt="×" class="delete" id="delete05"></div>
						<div style="display: inline-block; _display: inline; position:relative;"><canvas id="canvas06" width="200px" height="200px" class="cs"></canvas><img src="../images/upload/delete.png" alt="×" class="delete" id="delete06"></div>
						<div style="display: inline-block; _display: inline; position:relative;"><canvas id="canvas07" width="200px" height="200px" class="cs"></canvas><img src="../images/upload/delete.png" alt="×" class="delete" id="delete07"></div>
						<div style="display: inline-block; _display: inline; position:relative;"><canvas id="canvas08" width="200px" height="200px" class="cs"></canvas><img src="../images/upload/delete.png" alt="×" class="delete" id="delete08"></div>
						<div style="display: inline-block; _display: inline; position:relative;"><canvas id="canvas09" width="200px" height="200px" class="cs"></canvas><img src="../images/upload/delete.png" alt="×" class="delete" id="delete09"></div>
						<div style="display: inline-block; _display: inline; position:relative;"><canvas id="canvas10" width="200px" height="200px" class="cs"></canvas><img src="../images/upload/delete.png" alt="×" class="delete" id="delete10"></div>
						<div style="display: inline-block; _display: inline; position:relative;"><canvas id="canvas11" width="200px" height="200px" class="cs"></canvas><img src="../images/upload/delete.png" alt="×" class="delete" id="delete11"></div>
						<div style="display: inline-block; _display: inline; position:relative;"><canvas id="canvas12" width="200px" height="200px" class="cs"></canvas><img src="../images/upload/delete.png" alt="×" class="delete" id="delete12"></div>
						<div style="display: inline-block; _display: inline; position:relative;"><canvas id="canvas13" width="200px" height="200px" class="cs"></canvas><img src="../images/upload/delete.png" alt="×" class="delete" id="delete13"></div>
						<div style="display: inline-block; _display: inline; position:relative;"><canvas id="canvas14" width="200px" height="200px" class="cs"></canvas><img src="../images/upload/delete.png" alt="×" class="delete" id="delete14"></div>
						<div style="display: inline-block; _display: inline; position:relative;"><canvas id="canvas15" width="200px" height="200px" class="cs"></canvas><img src="../images/upload/delete.png" alt="×" class="delete" id="delete15"></div>
						<div style="display: inline-block; _display: inline; position:relative;"><canvas id="canvas16" width="200px" height="200px" class="cs"></canvas><img src="../images/upload/delete.png" alt="×" class="delete" id="delete16"></div>
						<div style="display: inline-block; _display: inline; position:relative;"><canvas id="canvas17" width="200px" height="200px" class="cs"></canvas><img src="../images/upload/delete.png" alt="×" class="delete" id="delete17"></div>
						<div style="display: inline-block; _display: inline; position:relative;"><canvas id="canvas18" width="200px" height="200px" class="cs"></canvas><img src="../images/upload/delete.png" alt="×" class="delete" id="delete18"></div>
						<div style="display: inline-block; _display: inline; position:relative;"><canvas id="canvas19" width="200px" height="200px" class="cs"></canvas><img src="../images/upload/delete.png" alt="×" class="delete" id="delete19"></div>
						<div style="display: inline-block; _display: inline; position:relative;"><canvas id="canvas20" width="200px" height="200px" class="cs"></canvas><img src="../images/upload/delete.png" alt="×" class="delete" id="delete20"></div>
					</figure>
				</a>
			</div>
			<input type="hidden" id="canvas01-h"  name="canvas01-h" value="">
			<input type="hidden" id="canvas02-h"  name="canvas02-h" value="">
			<input type="hidden" id="canvas03-h"  name="canvas03-h" value="">
			<input type="hidden" id="canvas04-h"  name="canvas04-h" value="">
			<input type="hidden" id="canvas05-h"  name="canvas05-h" value="">
			<input type="hidden" id="canvas06-h"  name="canvas06-h" value="">
			<input type="hidden" id="canvas07-h"  name="canvas07-h" value="">
			<input type="hidden" id="canvas08-h"  name="canvas08-h" value="">
			<input type="hidden" id="canvas09-h"  name="canvas09-h" value="">
			<input type="hidden" id="canvas10-h"  name="canvas10-h" value="">
			<input type="hidden" id="canvas11-h"  name="canvas11-h" value="">
			<input type="hidden" id="canvas12-h"  name="canvas12-h" value="">
			<input type="hidden" id="canvas13-h"  name="canvas13-h" value="">
			<input type="hidden" id="canvas14-h"  name="canvas14-h" value="">
			<input type="hidden" id="canvas15-h"  name="canvas15-h" value="">
			<input type="hidden" id="canvas16-h"  name="canvas16-h" value="">
			<input type="hidden" id="canvas17-h"  name="canvas17-h" value="">
			<input type="hidden" id="canvas18-h"  name="canvas18-h" value="">
			<input type="hidden" id="canvas19-h"  name="canvas19-h" value="">
			<input type="hidden" id="canvas20-h"  name="canvas20-h" value="">
			
			<!--/
			<h2>読み込めない写真のアップロード</h2>
			<h3>データを参照にドラッグ＆ドロップしてください。上記で読み込める場合は不要。</h3>
			-->
			<div id="photo2-01S" class="list3" style="background:#e6e6fa">写真０１<br /><input type="file" id="photo2-01" name="photo2-01" size="30" /></div>
			<div id="photo2-02S" class="list3" style="background:#e6e6fa">写真０２<br /><input type="file" id="photo2-02" name="photo2-02" size="30" /></div>
			<div id="photo2-03S" class="list3" style="background:#e6e6fa">写真０３<br /><input type="file" id="photo2-03" name="photo2-03" size="30" /></div>
			<div id="photo2-04S" class="list3" style="background:#e6e6fa">写真０４<br /><input type="file" id="photo2-04" name="photo2-04" size="30" /></div>
			<div id="photo2-05S" class="list3" style="background:#e6e6fa">写真０５<br /><input type="file" id="photo2-05" name="photo2-05" size="30" /></div>
			<div id="photo2-06S" class="list3" style="background:#e6e6fa">写真０６<br /><input type="file" id="photo2-06" name="photo2-06" size="30" /></div>
			<div id="photo2-07S" class="list3" style="background:#e6e6fa">写真０７<br /><input type="file" id="photo2-07" name="photo2-07" size="30" /></div>
			<div id="photo2-08S" class="list3" style="background:#e6e6fa">写真０８<br /><input type="file" id="photo2-08" name="photo2-08" size="30" /></div>
			<div id="photo2-09S" class="list3" style="background:#e6e6fa">写真０９<br /><input type="file" id="photo2-09" name="photo2-09" size="30" /></div>
			<div id="photo2-10S" class="list3" style="background:#e6e6fa">写真１０<br /><input type="file" id="photo2-10" name="photo2-10" size="30" /></div>
			<div id="photo2-11S" class="list3" style="background:#e6e6fa">写真１１<br /><input type="file" id="photo2-11" name="photo2-11" size="30" /></div>
			<div id="photo2-12S" class="list3" style="background:#e6e6fa">写真１２<br /><input type="file" id="photo2-12" name="photo2-12" size="30" /></div>
			<div id="photo2-13S" class="list3" style="background:#e6e6fa">写真１３<br /><input type="file" id="photo2-13" name="photo2-13" size="30" /></div>
			<div id="photo2-14S" class="list3" style="background:#e6e6fa">写真１４<br /><input type="file" id="photo2-14" name="photo2-14" size="30" /></div>
			<div id="photo2-15S" class="list3" style="background:#e6e6fa">写真１５<br /><input type="file" id="photo2-15" name="photo2-15" size="30" /></div>
			<div id="photo2-16S" class="list3" style="background:#e6e6fa">写真１６<br /><input type="file" id="photo2-16" name="photo2-16" size="30" /></div>
			<div id="photo2-17S" class="list3" style="background:#e6e6fa">写真１７<br /><input type="file" id="photo2-17" name="photo2-17" size="30" /></div>
			<div id="photo2-18S" class="list3" style="background:#e6e6fa">写真１８<br /><input type="file" id="photo2-18" name="photo2-18" size="30" /></div>
			<div id="photo2-19S" class="list3" style="background:#e6e6fa">写真１９<br /><input type="file" id="photo2-19" name="photo2-19" size="30" /></div>
			<div id="photo2-20S" class="list3" style="background:#e6e6fa">写真２０<br /><input type="file" id="photo2-20" name="photo2-20" size="30" /></div>
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
