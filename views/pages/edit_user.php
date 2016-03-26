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
			<form name="editform" method="POST" action="edit_user" onsubmit="return validateEdit()">
				<h3 class="header-tight">Change username</h3>
				<input type="text" name="new_username" autofocus>
				<br>
				<label>New username</label>
				<br><br><br><br>
				<h3 class="header-tight">Change password</h3>
				<input type="password" name="old_password">
				<br>
				<label>Old password</label>
				<br>
				<input type="password" name="new_password">
				<br>
				<label>New password</label>
				<br>
				<input type="password" name="new_password_confirm">
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