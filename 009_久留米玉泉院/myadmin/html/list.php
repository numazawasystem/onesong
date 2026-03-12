<?php
	//list.php
	
	//セッションを開始
	session_start();
	
	//PHPのエラーが出る設定にする（最後にコメントアウトしておく）
	ini_set( 'display_errors', 1 );

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
	
	//件数位置の読み込み
	if(isset($_GET["page"])){
		if($_GET["page"] > 0){
			$purasu = $_GET["page"] + 1;
			$mainasu = $_GET["page"] - 1;
			$page = $_GET["page"] * 50;
		}else{
			$purasu = 1;
			$mainasu = 0;
			$page = 0;
		}
	}else{
		$purasu = 1;
		$mainasu = 0;
		$page = 0;
	}
	
	//SQL5の設定（葬儀の一覧）
	include("../sql/sql5.php");
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
	<script src="../js/openclose.js"></script>
	<script src="../js/fixmenu_pagetop.js"></script>
</head>
<?php
	$tab = 2;
	include("../header.php");
?>
					<section>
						<h2>葬儀一覧（５０件ずつ表示）</h2>
						<div class="tbl1">
							<table>
							<tr>
								<th>案件NO</th>
								<th>日付</th>
								<th>故人名</th>
								<th>会場</th>
								<th>比率</th>
								<th>動画アップロード</th>
								<th>完了</th>
								<th>登録日</th>
							</tr>
							<?php
								$count1 = 0;
								foreach ($db->query($sql5) as $row5)
								{
							?>

									<tr>
										<td><?php print($row5['a_id']); ?></td>
										<td><?php print($row5['day']); ?></td>
										<td><?php print($row5['kojin']); ?></td>
										<td>
										<?php
											print($row5['place_name']);
										?>
										</td>
										<td>
										<?php
											if($row5['situation'] == 1){
												print("4:3");
											}else if($row5['situation'] == 2){
												print("16:9");
											}else if($row5['situation'] == 3){
												print("その他");
											}else{
												print("不明");
											}
										?>
										</td>
										<td>
										<?php
											if($row5['douga'] == 0){
												print("未アップロード");
											}else{
												print("アップロード済み");
											}
										?>
										</td>
										<td>
										<?php
											if($row5['fg'] == 0){
												print("表示中");
											}else{
												print("削除済み");
											}
										?>
										</td>
										<td><?php print($row5['touroku']); ?></td>
									</tr>

							<?php
								$count1 = $count1 + 1;
								}
							?>
							</table>
						</div>
					</section>
					<section id="new" style="text-align:right">
						<h2>---</h2>
						<?php if($page > 0){ ?>
							<a href="list.php?page=<?php print($mainasu); ?>" class="btn-flat-logo">＜＜ＢＡＣＫ</a>
						<?php } ?>
						<?php if($count1 == 50){ ?>
							<a href="list.php?page=<?php print($purasu); ?>" class="btn-flat-logo">ＮＥＸＴ＞＞</a>
						<?php } ?>
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
