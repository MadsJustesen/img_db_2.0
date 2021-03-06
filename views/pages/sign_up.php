<?php 
require '../views/header.php';
?>

<div class="container container-form">
	<div class="container-header">
		<h2>New user</h2>
	</div>
	<div class="row">

		<div id="error-div" class="row error-container">
			<div class="col-1"></div>
			<div class="col-10">
				<!-- Error messages -->
				<p class="error" id="username-missing-error"></p>
				<p class="error" id="password-length-error"></p>
				<p class="error" id="password-match-error"></p>
				<!-- -->
			</div>
		</div>
		
		<div class="col-1"></div>
		<div class="col-10">
			<form name="signupform" method="POST" action="sign_up" onsubmit="return validateSignUp()">
				<input id="username" type="text" name="add_user_username" autofocus>
				<br>
				<label>Username</label>
				<br>
				<input id="password" type="password" name="add_user_password">
				<br>
				<label>Password</label>
				<br>
				<input id="password-confirmation" type="password" name="add_user_password_confirm">
				<br>
				<label>Repeat password</label>
				<br>
				<button type="Submit">Sign up!</button>
			</form>
		</div>
	</div>
	<div class="center">Already a user? <a href="log_in">Log in here!</a></div>
</div>
<?php 
require '../views/footer.php';
?>