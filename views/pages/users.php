<!DOCTYPE html>
<head>
	<meta charset="utf-8"/>
	<title>Brugere</title>

	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<?php 
	require '../views/header.php';
	?>

	<div class="container container-main">
		<h1>Users</h1>
		<table class="table-list">
			<thead>
				<tr>
					<th>Id</th>
					<th>Username</th>
					<th>Role</th>
					<th>Last login</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($users as $user) {
					echo '<tr>';
					echo '<td>' . $user["id"] 			. 	'</td>';
					echo '<td>' . $user["username"] 	. 	'</td>';
					echo '<td>' . $user["role"] 		. 	'</td>';
					echo '<td>' . $user["last_login"] 	. 	'</td>';
					echo '</tr>';
				}
				?>
			</tbody>
		</table>
	</div>
</body>