<!DOCTYPE html>
<head>
	<meta charset="utf-8"/>
	<title>Title</title>

	<link rel="stylesheet" type="text/css" href="assets/stylesheets/main.css">
	<script src="assets/javascripts/application.js"></script>
</head>
<body>
	<?php 
	if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
		?>
		<div class="page-header">
			<ul>
				<li class="active"><a href="/">Home</a></li>
				<li><a href="users">Users</a></li>
				<li><a href="gallery">Gallery</a></li>
				<li><a href="upload">Upload</a></li>
				<li><a href="log_out">Log out</a></li>
			</ul>
		</div>
		<?php 
	}
	?>