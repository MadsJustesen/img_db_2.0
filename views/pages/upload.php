<?php 
require '../views/header.php';
?>

<div class="container container-form">
	<div class="container-header">
		<h1>Upload image</h1>
	</div>
	<div class="row">
		<div class="col-1"></div>
		<div class="col-10">
			<form method="POST" action="upload" enctype="multipart/form-data">
				<input type="text" name="title">
				<br>
				<label>Image title</label>
				<input type="file" name="image">
				<br>
				<button type="Submit">Upload</button>
			</form>
		</div>
	</div>
</div>


<?php 
require '../views/footer.php';
?>