<?php
require_once('baseImport.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Matthieu's personal page</title>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="style.css" rel="stylesheet" type="text/css" />
		<?php
			if (TEST_MODE_ACTIVATED) {
				echo '<link href="debug-style.css" rel="stylesheet" type="text/css" />';
			} else {
				// do not use the debug style
			}
		?>
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
		<header><?php require_once("header.php"); ?></header>
		<nav><?php require_once("menu.php"); ?></nav>
		<article><?php require_once("content.php"); ?></article>
		<footer><?php require_once("copyright.php"); ?></footer>
	</body>
</html>