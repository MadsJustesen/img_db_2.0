<!DOCTYPE html>
<head>
	<meta charset="utf-8"/>
	<title>Tilføj Bruger</title>

	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head> 
<body>

	<div class="container">
		<form method="POST" action="add_user">
			<table class="table-form">
				<tr>
					<td><label>Brugernavn: </label></td>
					<td><input type="text" name="add_user_username"></td>
				</tr>
				<tr>
					<td><label>Password: </label></td>
					<td><input type="password" name="add_user_password"></td>
				</tr>
				<tr>
					<td><label>Gentag Password: </label></td>
					<td><input type="password" name="add_user_password_confirm"></td>
				</tr>	
				<tr>
					<td><input type="Submit" value="Gem bruger"></td>
					<td></td>
				</tr>
			</table>
		</form>
	</div>
</body>