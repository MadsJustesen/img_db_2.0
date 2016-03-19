<?php 
require '../views/header.php';
?>

<div class="container container-form">
	<h1>Upload image</h1>
	<form method="POST" action="upload" enctype="multipart/form-data">
		<input type="file" name="image">
		<input type="submit" value="Upload">
	</form>
</div>


<?php 
require '../views/footer.php';
?>