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
			$username = $_POST["add_user_username"];
			$password = $_POST["add_user_password"];

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
		if(isset($_REQUEST["isAdmin"]) && !$this->isAdmin()) {
				echo "<script>alert('Du er ikke registeret som admin');</script>";
				return false;
		}

		try {
			if(isset($_POST["new_username"]) && trim($_POST["new_username"]) != "") {
				$username = $_POST["new_username"];
				
				$updateUsername = "UPDATE USERS SET username = '" . $username . "' WHERE id = " . $_POST["id"];
				$stmt = $this->dbh->prepare($updateUsername);
				$stmt->execute();
			}

			if(isset($_POST["new_password"]) && $this->isAuthorized($this->getUsername(), $_POST["old_password"])) {
				$password_digest = password_hash($_POST["new_password"], PASSWORD_DEFAULT);

				$updatePassword = "UPDATE USERS SET password_digest = '" . $password_digest . "' WHERE id = " . $_POST["id"];
				$stmt = $this->dbh->prepare($updatePassword);
				$stmt->execute();
			}
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	public function destroy() {
		try {
			$destroyUser = "DELETE FROM USERS WHERE id = " . $_POST["id"];
			$stmt = $this->dbh->prepare($destroyUser);
			$stmt->execute();
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	public function saveNewTitle(){
		echo "<script>console.log('ny fra user.php');</script>";
	}

	public function logIn($username, $password) {
		try {
			if (password_verify($password, $this->getPasswordDigest($username))) {
				$_SESSION["logged_in"] = true;
				$_SESSION["current_user"] = $this->getUserId($username);
				$_SESSION["is_admin"] = $this->isAdmin();
				$this->loginStamp();
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
		$_SESSION["current_user"] = null;
	}

	public function all() {
		$sth = $this->dbh->prepare("SELECT * FROM USERS");
		$sth->execute();

		$result = $sth->fetchAll();
		return $result;
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

	public function getUsername($id = null) {
		if ($id == null) {
			return $this->currentUser()["username"];
		} else {
			return $this->user($id)["username"];
		}
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

	private function user($id) {
		$sth = $this->dbh->prepare("SELECT * FROM USERS WHERE id = :id");
		$sth->bindParam(':id', $id);
		$sth->execute();

		$result = $sth->fetch(PDO::FETCH_ASSOC);
		return $result;
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