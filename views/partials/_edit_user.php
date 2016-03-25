<div id="openEditModal" class="modalDialog">
	<div class="row">	
		<a href="#close" title="Close" class="close">X</a>
		<div class="container-header">
			<h2>Edit user <?php echo $_GET["id"] ?></h2>
		</div>	
		<div class="col-1"></div>
		<div class="col-10">
			<form name="signupform" method="POST" action="edit_user">
				<input id="username" type="text" name="username" autofocus>
				<br>
				<label>New username</label>
				<br>
				<br>
				<label>Edit role:</label>
				<br>
				<input type="radio" name="role" value="user" checked><label>User</label>
				<br>
				<input type="radio" name="role" value="admin"><label>Admin</label>
				<button type="Submit">Save</button>
			</form>
		</div>
	</div>
</div>