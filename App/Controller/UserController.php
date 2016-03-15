<?php
namespace App\Controller;

use PDO;

class UserController {

	public function create() {
		require CONFIG_DIR . '/db.php';
		if ($_SERVER["REQUEST_METHOD"] == "POST") { 
			try {
				$dbh = new PDO('mysql:host=127.0.0.1;dbname=' . $db_name, $db_user, $db_pass);
				$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

				if($_POST["add_user_password"] == $_POST["add_user_password_confirm"]) {
					$stmt = $dbh->prepare("INSERT INTO USERS (username, password_digest) VALUES (:username, :password_digest)");
					$stmt->bindParam(':username', $username);
					$stmt->bindParam(':password_digest', $password_digest);

					$username = $_POST["add_user_username"];
					$password_digest = password_hash($_POST["add_user_password"], PASSWORD_DEFAULT);
					$stmt->execute();
				} else {
					echo 'Passwords confirmation didn\'t match';
				}

				$dbh = null;
			} catch (PDOException $e) {
				print "Error!: " . $e->getMessage() . "<br/>";
				die();
			}
		}
	}

	public function addUser() {
		require VIEW_DIR . '/pages/add_user.php';
	}

}
