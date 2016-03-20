<?php 
require '../views/header.php';
?>

<div class="container container-main row">
	<h1>Users</h1>
	<div class="col-2"></div>
	<div class="col-8">
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
				// if(admin)
				//echo '<td><a href="' . edit_path . '">Edit</a></td>';
				//
					echo '</tr>';
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<?php 
require '../views/footer.php';
?>