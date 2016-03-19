<?php 
require '../views/header.php';
?>

<div class="container container-form">
	<h1>New user</h1>
	<form method="POST" action="sign_up">
		<table class="table-form">
			<tr>
				<td class="form-label"><label>Username: </label></td>
				<td class="form-input"><input type="text" name="add_user_username"></td>
			</tr>
			<tr>
				<td class="form-label"><label>Password: </label></td>
				<td class="form-input"><input type="password" name="add_user_password"></td>
			</tr>
			<tr>
				<td class="form-label"><label>Repeat password: </label></td>
				<td class="form-input"><input type="password" name="add_user_password_confirm"></td>
			</tr>	
			<tr>
				<td class="form-label"><input type="Submit" value="Sign up!"></td>
				<td></td>
			</tr>
		</table>
	</form>
</div>
<?php 
require '../views/footer.php';
?>