<?php 
require '../views/header.php';
?>

<div class="container container-main">
	<div class="container-header">
		<h2>My images</h2>
	</div>
	<table  class="image-table">
		<?php 
		$i = 1;
		echo '<tr>';
		foreach ($images as $image) {
			echo '<td>
			<div class="image-container" style="overflow:hidden;">
				<div class="image-header">
					<h3>' . $image["title"] . '</h3>
				</div>
				<img src="data:image/jpeg;base64,' . base64_encode( $image["image"] ) . '"/>
			</div>
			</td>';

			if($i % 4 === 0){
				echo "</tr><tr>";
			}

			$i++;
		}
		echo "</tr>";
		?>
	</table>
</div>

<?php 
require '../views/footer.php';
?>