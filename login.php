<?php
@session_start();
require_once("inc/functions.php");
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title><?= showSiteTitle("Login"); ?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
		<link type="text/css" rel="stylesheet" href="css/login.css">
	</head>
    <body>
		<div class="wrapper">
			<div class="container">
				<h1 id="title">PastaMedia</h1>
				<div id="error"></div>
				<?php
					if(!@$_GET['logout']){
				?>
				<form method="post">
					<input type="text" name="login" id="login" placeholder="Użytkownik" autocomplete="off">
					<input type="password" name="passwd" id="passwd" placeholder="Hasło">
					<button type="button" id="login-button">Zaloguj</button>
				</form>
				<?php
					}else{
						logout();
					}
				?>
			</div>
			
			<ul class="bg-bubbles">
				<li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
			</ul>
		</div>

		<script src="js/jquery.min.js"></script>
		<script src="js/login.js" async></script>
	</body>
</html>