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
									print("<br />　　「4:3」");
								}else if($row4['situation'] == 2){
									print("<br />　　「16:9」");
								}else if($row4['situation'] == 3){
									print("<br />　　「その他」");
								}else{
									print("　「不明」");
								}
							?>
						</h4>
						<?php
							if($row4['douga'] <> 0){
						?>
							<span class="option1">動画あり</span>
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
