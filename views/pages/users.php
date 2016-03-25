<?php 
require '../views/header.php';
?>

<div id="openModal" class="modalDialog">
	<div class="row">	
		<a href="#close" title="Close" class="close">X</a>
		<div class="container-header">
			<h2>Edit user <?php echo $_GET["id"] ?></h2>
		</div>	
		<div class="col-1"></div>
		<div class="col-10">
			<p>This is a sample modal box that can be created using the powers of CSS3.</p>
			<p>You could do a lot of things here like have a pop-up ad that shows when your website loads, or create a login/register form for users.</p>
		</div>
	</div>
</div>

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
						echo '<td class="admin-column">
						<a href="/users?id='. $user["id"] .'#openModal" class="button">Edit</a>
						<a href="#openModal" class="button">Delete</a>
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