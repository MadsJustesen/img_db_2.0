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
			$stmt = $this->dbh->prepare("INSERT INTO IMAGES (title, contenttype, image, user_id) VALUES (?, ?, ?, ?)");

			$image = fopen($_FILES['image']['tmp_name'], 'rb');

			$stmt->bindParam(1, $_REQUEST["title"]);
			$stmt->bindParam(2, $_FILES['image']['type']);
			$stmt->bindParam(3, $image, PDO::PARAM_LOB);
			$stmt->bindParam(4, $_SESSION["current_user"]);

			$stmt->execute();
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	public function destroy () {
		try {
			$destroyImage = "DELETE FROM IMAGES WHERE id = " . $_POST["id"];
			$stmt = $this->dbh->prepare($destroyImage);
			$stmt->execute();
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	public function getByTitle($title = null) {
		try {
			$stmt = $this->dbh->prepare('SELECT contenttype, image FROM IMAGES WHERE title = ?');

			$stmt->execute(array($title));

			$stmt->bindColumn(1, $contenttype, 	PDO::PARAM_STR, 256);
			$stmt->bindColumn(2, $image, 		PDO::PARAM_LOB);
			$stmt->fetch(PDO::FETCH_BOUND);

			return $image;
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	public function all() {
		$sth = $this->dbh->prepare("SELECT * FROM IMAGES WHERE user_id = :id");
		$sth->bindParam(':id', $_SESSION["current_user"]);
		$sth->execute();

		$images = $sth->fetchAll();

		return $images;
	}

}