<body>
<div id="container">
	<header>
		<div class="inner">
			<h1 id="logo"><a href="../index.php"><img src="../images/logo.png" alt="Lien"></a></h1>
			<nav id="menubar">
				<ul>
					<li <?php if($tab == 1){ print("class=\"current\""); } ?>><a href="../index.php">ホーム</a></li>
					<li <?php if($tab == 2){ print("class=\"current\""); } ?>><a href="../html/list.php">過去の履歴</a></li>
					<li <?php if($tab == 3){ print("class=\"current\""); } ?>><a href="../html/logout.php">ログアウト</a></li>
				</ul>
			</nav>
		</div>
	<!--/.inner-->
	</header>
	<div class="inner">
		<div id="contents">
			<div id="main">