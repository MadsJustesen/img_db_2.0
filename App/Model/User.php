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

			$stmt = $this->dbh->prepare("INSERT INTO USERS (username, password_digest) VALUES (:username, :password_digest)");
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':password_digest', $password_digest);

			$password_digest = password_hash($password, PASSWORD_DEFAULT);

			$stmt->execute();

			// Log in user after sign up
			$this->logIn($username, $password);
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	public function update() {
		try {
			if(isset($_POST["username"]) && $_POST["username"].trim() != "") {
				$username = $_POST["username"];
				
				$updateUsername = "UPDATE USERS SET username = '" . $username . "' WHERE id = " . $_SESSION["current_user"];
				$stmt = $this->dbh->prepare($updateUsername);
				$stmt->execute();
			}

			if(isset($_POST["new_password"]) && $this->isAuthorized($this->currentUser()["username"], $_POST["old_password"])) {
				$password_digest = password_hash($_POST["new_password"], PASSWORD_DEFAULT);

				$updatePassword = "UPDATE USERS SET password_digest = '" . $password_digest . "' WHERE id = " . $_SESSION["current_user"];
				$stmt = $this->dbh->prepare($updatePassword);
				$stmt->execute();
			}
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	public function logIn() {
		try {
			$username = $_POST["username"];
			$password = $_POST["password"];

			if (password_verify($password, $this->getPasswordDigest($username))) {
				$_SESSION["logged_in"] = true;
				$_SESSION["current_user"] = $this->getUserId($username);
				$this->loginStamp();
			} else {
				$_SESSION["logged_in"] = false;
			}
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	public function isAdmin() {
		try {
			$userId = $_SESSION["current_user"];
			$sth = $this->dbh->prepare("SELECT role FROM USERS WHERE id = :id");
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

	private function getUserId($username) {
		$sth = $this->dbh->prepare('SELECT id FROM USERS WHERE username = :username');
		$sth->bindParam(':username', $username);
		$sth->execute();
		$result = $sth->fetch(PDO::FETCH_ASSOC);
		return $result["id"];
	}

	private function getPasswordDigest($username) {
		$sth = $this->dbh->prepare("SELECT password_digest FROM USERS WHERE username = :username");
		$sth->bindParam(':username', $username);
		$sth->execute();

		$result = $sth->fetch(PDO::FETCH_ASSOC);
		return $result["password_digest"];
	}

	private function loginStamp() {
		$date = new DateTime();
		$sql = "UPDATE USERS SET last_login = '" . $date->format('Y-m-d H:i:s') . "' WHERE id = " . $_SESSION["current_user"];
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute();
	}

	private function currentUser() {
		$sth = $this->dbh->prepare("SELECT * FROM USERS WHERE id = :id");
		$sth->bindParam(':id', $_SESSION["current_user"]);
		$sth->execute();

		$result = $sth->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	private function isAuthorized($username, $password) {
		return password_verify($password, $this->getPasswordDigest($username));
	}

}