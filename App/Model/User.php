<?php
namespace App\Model;

use PDO;
use DateTime;

class User {

	private $dbh = null;

	public function __construct($dbh){
		$this->dbh = $dbh;
	}

	public function save() {
		try {
			$username 				= $_POST["add_user_username"];
			$password 				= $_POST["add_user_password"];
			$password_confirmation 	= $_POST["add_user_password_confirm"];

			$stmt = $this->dbh->prepare("INSERT INTO USERS (username, password_digest) VALUES (:username, :password_digest)");
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':password_digest', $password_digest);

			$password_digest = password_hash($password, PASSWORD_DEFAULT);

			if($password == $password_confirmation) {
				$stmt->execute();

				// Log in the user after signup
				$this->logIn($username, $password);
			} else {
				echo "Passwords didn't match! Please try again";
			}
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	public function update() {
		try {
			if(isset($_POST["username"])) {
				$username = $_POST["username"];
				
				$updateUsername = "UPDATE USERS SET username = '" . $username . "' WHERE id = " . $_SESSION["current_user"];
				$stmt = $this->dbh->prepare($updateUsername);
			}
			if(isset($_POST["password"]) && ($_POST["password"] === $_POST["password_confirm"])) {
				$password_digest = password_hash($_POST["password"], PASSWORD_DEFAULT);

				$updatePassword = "UPDATE USERS SET password_digest = '" . $password_digest . "' WHERE id = " . $_SESSION["current_user"];
				$stmt = $this->dbh->prepare($updatePassword);
			}
			$stmt->execute();
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	public function logIn($username, $password) {
		try {
			$sth = $this->dbh->prepare('SELECT id, password_digest FROM USERS WHERE username = :username');
			$sth->bindParam(':username', $username);
			$sth->execute();

			$result = $sth->fetch(PDO::FETCH_ASSOC);

			if (password_verify($password, $result["password_digest"])) {
				$_SESSION["logged_in"] = true;
				$_SESSION["current_user"] = $result["id"];
				$this->loginStamp();
			} else {
				$_SESSION["logged_in"] = false;
			}
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	public function isAdmin($userId) {
		try {
			$sth = $this->dbh->prepare('SELECT role FROM USERS WHERE id = :id');
			$sth->bindParam(':id', $userId);
			$sth->execute();

			$result = $sth->fetch(PDO::FETCH_ASSOC);
			$role = $result["role"];
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
		return ($role === "admin");
	}

	public function logOut() {
		$_SESSION["logged_in"] = false;
		$_SESSION["current_user"] = null;
	}

	public function all() {
		$sth = $this->dbh->prepare("SELECT * FROM USERS");
		$sth->execute();

		$result = $sth->fetchAll();
		return $result;
	}

	private function loginStamp() {
		$date = new DateTime();
		$sql = "UPDATE USERS SET last_login = '" . $date->format('Y-m-d H:i:s') . "' WHERE id = " . $_SESSION["current_user"];
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute();
	}

}