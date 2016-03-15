<?php
namespace App\Controller;

class SessionController {

	public function create() {
		require CONFIG_DIR . '/db.php';
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			try {
				$username = $_POST["username"];

				$dbh = new PDO('mysql:host=127.0.0.1;dbname=' . $db_name, $db_user, $db_pass);
				$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

				$sth = $dbh->prepare('SELECT password_digest FROM USERS WHERE username = :username');
				$sth->bindParam(':username', $username);
				$sth->execute();

				$result = $sth->fetch(PDO::FETCH_ASSOC);

				if (password_verify($_POST["password"], $result["password_digest"])) {
					$_SESSION["logged_in"] = true;
					header('Location: index.php');
					exit;
				} else {
					echo 'Prøv igen';
				}
			} catch (PDOException $e) {
				print "Error!: " . $e->getMessage() . "<br/>";
				die();
			}
		}

		$this->showLoginForm();
	}

	public function logIn() {
		require VIEW_DIR . '/pages/log_in.php';
	}

}

