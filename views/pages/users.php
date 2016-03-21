<?php 
require '../views/header.php';
?>

<div class="container container-main row">
	<div class="container-header">
		<h2>Users</h2>
	</div>
	<div class="col-1"></div>
	<div class="col-10">
		<table class="table-list">
			<thead>
				<tr>
					<th>#</th>
					<th>Username</th>
					<th>Role</th>
					<th>Last login</th>
					<?php 
					if($admin) {
						echo '<th class="admin-column">Admin</th>';
					}
					?>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($users as $user) {
					if($user["id"] === $_SESSION["current_user"]) {
						echo '<tr class="active-user">';
					} else {
						echo '<tr>';
					}
					echo '<td>' . $user["id"] . '</td>';
					echo '<td>' . $user["username"] . '</td>';
					echo '<td>' . $user["role"] . '</td>';
					echo '<td>' . $user["last_login"] . '</td>';
					if($admin) {
						echo '<td class="admin-column"><button class="table-button">Edit</button>
						<button class="table-button">Delete</button>
						</td>';
					}
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