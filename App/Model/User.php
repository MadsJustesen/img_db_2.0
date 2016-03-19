<?php
namespace App\Model;

use PDO;

class User {

	private $dbh = null;

	public function __construct($dbh){
		$this->dbh = $dbh;
	}

	public function save($username, $password, $password_confirmation) {
		try {
			$stmt = $this->dbh->prepare("INSERT INTO USERS (username, password_digest) VALUES (:username, :password_digest)");
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':password_digest', $password_digest);

			$password_digest = password_hash($password, PASSWORD_DEFAULT);

			if($password == $password_confirmation) {
				$stmt->execute();

				// Log in the user after signup
				logIn($username, $password);
			} else {
				echo "Passwords didn't match! Please try again";
			}
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	public function logIn($username, $password) {
		try {
			$sth = $this->dbh->prepare('SELECT password_digest FROM USERS WHERE username = :username');
			$sth->bindParam(':username', $username);
			$sth->execute();

			$result = $sth->fetch(PDO::FETCH_ASSOC);

			if (password_verify($password, $result["password_digest"])) {
				$_SESSION["logged_in"] = true;
			} else {
				$_SESSION["logged_in"] = false;
			}
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	public function logOut() {
		$_SESSION["logged_in"] = false;
	}

	public function all() {
		$sth = $this->dbh->prepare("SELECT * FROM USERS");
		$sth->execute();

		$result = $sth->fetchAll();
		return $result;
	}

}