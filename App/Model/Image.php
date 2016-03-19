<?php
namespace App\Model;

use PDO;

class Image {
	
	private $dbh = null;

	public function __construct($dbh){
		$this->dbh = $dbh;
	}

	public function save() {
		try {
			$stmt = $this->dbh->prepare("INSERT INTO IMAGES (title, contenttype, image) VALUES (?, ?, ?)");

			$image = fopen($_FILES['image']['tmp_name'], 'rb');

			$stmt->bindParam(1, $title = "tmp_title");
			$stmt->bindParam(2, $_FILES['image']['type']);
			$stmt->bindParam(3, $image, PDO::PARAM_LOB);

			$stmt->execute();
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	public function get($title = null) {
		try {
			$stmt = $this->dbh->prepare('SELECT contenttype, image FROM IMAGES WHERE title = ?');

			$stmt->execute(array("tmp_title"));

			$stmt->bindColumn(1, $contenttype, 	PDO::PARAM_STR, 256);
			$stmt->bindColumn(2, $image, 		PDO::PARAM_LOB);
			$stmt->fetch(PDO::FETCH_BOUND);

			header("Content-Type: $contenttype");
			echo($image);

			return $image;
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}

}