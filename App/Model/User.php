<?php
namespace App\Model;

use PDO;

class User {

	private $db = null;

	public function __construct($db){
		$this->db = $db;
	}

	public function save($username, $password, $password_confirmation) {
		try {
			$stmt = $this->db->prepare("INSERT INTO USERS (username, password_digest) VALUES (:username, :password_digest)");
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':password_digest', $password_digest);

			$password_digest = password_hash($password, PASSWORD_DEFAULT);

			if($password == $password_confirmation) {
				$stmt->execute();
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
			$sth = $this->db->prepare('SELECT password_digest FROM USERS WHERE username = :username');
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

	}

}