<!DOCTYPE html>
<head>
	<meta charset="utf-8"/>
	<title>Home</title>

	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<?php 
	require '../views/header.php';
	
	if(!($_SESSION["logged_in"])) {
		header('Location: log_in.php');
	}
	?>
	
	<div class="container">
		<h3>Seneste billeder</h3>
		<p class= "image-title">En super heeelt</p>
		<img src="assets/img/superhero_gif.gif" class="latest-images">
		<p class= "image-title">Et blad</p>
		<img src="assets/img/leaf.jpg" class="latest-images">
		<p class= "image-title">Et blad</p>
		<img src="assets/img/leaf.jpg" class="latest-images">
		<p class= "image-title">Et blad</p>
		<img src="assets/img/leaf.jpg" class="latest-images">
	</div>
</body>