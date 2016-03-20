<?php 
require '../views/header.php';
?>

<div class="container container-main">
	<h1>My images</h1>
	<table>
		<?php 
		$i = 1;
		echo "<tr>";
		foreach ($images as $image) {
			echo '<td><img src="data:image/jpeg;base64,' . base64_encode( $image["image"] ) . '"/></td>';

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