<?php 
require '../views/header.php';
?>

<div class="container container-form">
	<div class="container-header">
		<h2>Edit profile</h2>
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
			<form name="signupform" method="POST" action="edit_user">
				<input id="username" type="text" name="username" autofocus>
				<br>
				<label>New username</label>
				<br>
				<input id="password" type="password" name="password">
				<br>
				<label>New password</label>
				<br>
				<input id="password-confirmation" type="password" name="password_confirm">
				<br>
				<label>Repeat new password</label>
				<br>
				<button type="Submit">Save</button>
			</form>
		</div>
	</div>
</div>
<?php 
require '../views/footer.php';
?>