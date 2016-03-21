<?php 
require '../views/header.php';
?>

<div class="container container-form">
	<div class="container-header">
		<h1>Log in</h1>
	</div>
	<div class="row">
		<div class="col-1"></div>
		<div class="col-10">
			<form method="POST" action="log_in">
				<input type="text" name="username">
				<br>
				<label>Username </label>
				<input type="password" name="password">
				<br>
				<label>Password: </label>
				<button type="Submit">Log in</button>
			</form>
		</div>
	</div>
	<br>
	<div class="center">Not a user yet? <a href="sign_up">Sign up here!</a></div>
</div>

<?php 
require '../views/footer.php';
?>