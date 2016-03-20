<?php 
require '../views/header.php';
?>

<div class="container container-form">
	<h1>Upload image</h1>
	<form method="POST" action="upload" enctype="multipart/form-data">
		<table class="table-form">
			<tr>
				<td class="form-label"><label>Image title: </label></td>
				<td class="form-input"><input type="text" name="title"></td>
			</tr>
			<tr>
				<td class="form-label"><label>Choose file: </label></td>
				<td class="form-input"><input type="file" name="image"></td>
			</tr>	
			<tr>
				<td class="form-label"><input type="Submit" value="Upload"></td>
				<td></td>
			</tr>
		</table>
	</form>
</div>


<?php 
require '../views/footer.php';
?>