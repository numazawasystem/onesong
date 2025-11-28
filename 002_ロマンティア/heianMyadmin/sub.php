<?php
	//SQL4の設定（終了していない葬儀の一覧）
	include("../sql/sql4.php");
?>
<div id="sub">
	<nav>
		<h2>　</h2>
		<?php
			foreach ($db->query($sql4) as $row4)
			{
				if (isset($_GET['akn']) && $_GET['akn'] == $row4['a_id'])
				{
		?>
				<div class="list" style="background: #c0c0c0;">
		<?php
				}else{
		?>
				<div class="list">
					<a href="../html/main.php?akn=<?php print($row4['a_id']); ?>">
		<?php
				}
		?>
						<h4>日付：<?php print($row4['day']); ?></h4>
						<h4>　<?php print($row4['kojin']); ?>　様</h4>
						<h4>
							<?php
								print("　" . $row4['place_name']);
								
								if($row4['situation'] == 1){
									print("<br />　　オルゴール--男性");
								}else if($row4['situation'] == 2){
									print("<br />　　オルゴール--女性");
								}else if($row4['situation'] == 3){
									print("<br />　　　　ギター--男性");
								}else if($row4['situation'] == 4){
									print("<br />　　　　ギター--女性");
								}else if($row4['situation'] == 5){
									print("<br />　　　　ピアノ--男性");
								}else if($row4['situation'] == 6){
									print("<br />　　　　ピアノ--女性");
								}else{
									print("　「不明」");
								}
							?>
						</h4>
						<?php
							if($row4['douga'] <> 0){
						?>
							<span class="option1">音楽あり</span>
						<?php
							}
						?>
					</a>
				</div>
		<?php
			}
		?>

	</nav>
</div>
