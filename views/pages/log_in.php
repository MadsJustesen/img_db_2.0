<!DOCTYPE html>
<head>
	<meta charset="utf-8"/>
	<title>Image Database</title>

	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

	<div class="container container-form">
		<h1>Log In</h1>
		<form method="POST" action="log_in">
			<table class="table-form">
				<tr>
					<td class="form-label"><label>Brugernavn: </label></td>
					<td class="form-input"><input type="text" name="username"></td>
				</tr>
				<tr>
					<td class="form-label"><label>Password: </label></td>
					<td class="form-input"><input type="password" name="password"></td>
				</tr>	
				<tr>
					<td class="form-label"><input type="Submit" value="Log ind"></td>
					<td></td>
				</tr>
			</table>
		</form>
		<br>
		<div class="center">Not a user yet? <a href="sign_up">Sign up here!</a></div>
	</div>
</body>