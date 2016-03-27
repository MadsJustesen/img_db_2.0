<div id="openDeleteModal" class="modalDialog">
	<div class="row">	
		<a href="#close" title="Close" class="close">X</a>
		<div class="container-header">
			<h2>Delete user #<?php echo $_GET["id"] ?>?</h2>
		</div>	
		<div class="col-1"></div>
		<div class="col-10">
			<form name="deleteform" method="POST" action="delete_user">
				<?php echo '<input type="hidden" name="id" value="'. $_GET["id"] .'"/>'; ?> 

				<h3 class="header-tight">Sure you want to delete '<?php echo $this->user->getUsername($_GET["id"]); ?>'?</h3>
				<button type="Submit">Yes, delete this user</button>
			</form>
		</div>
	</div>
</div>