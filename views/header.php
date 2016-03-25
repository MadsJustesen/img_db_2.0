<!DOCTYPE html>
<head>
	<meta charset="utf-8"/>
	<title><?php if (isset($title)) { echo $title; } ?></title>

	<link rel="stylesheet" type="text/css" href="assets/stylesheets/main.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="assets/javascripts/application.js"></script>
</head>
<body>
	<button class="page-header" onclick="location.href='/'">
		Image Database
	</button>
	<?php 
	if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
		?>
		<div id="sticky-anchor"></div>
		<div id="sticky" class="nav-header">
			<ul>
				<li <?php if (isset($title) && $title === "Home") { echo 'class="active"'; } ?> ><a href="/">Home</a></li>
				<li <?php if (isset($title) && $title === "Users") { echo 'class="active"'; } ?>><a href="users">Users</a></li>
				<li <?php if (isset($title) && $title === "Gallery") { echo 'class="active"'; } ?>><a href="gallery">Gallery</a></li>
				<li <?php if (isset($title) && $title === "Upload") { echo 'class="active"'; } ?>><a href="upload">Upload</a></li>
				<li <?php 
				if (isset($title) && $title === "Account") { 
					echo 'class="active dropdown"'; 
				} else {
					echo 'class="dropdown"';
				}
				?>>
				<a href="account">Account</a>
				<div class="dropdown-content">
					<a href="edit_user">Settings</a>
					<a href="log_out">Log out</a>
				</div>
			</li>
		</ul>
	</div>
	<?php 
}
?>