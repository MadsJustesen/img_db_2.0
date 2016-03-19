<?php
namespace App\Controller;

use App\Model\User;

class SessionController {

	private $user = null;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function create() {
		//No reason to check for request-type; this function will only be called with 'POST'
		$username = $_POST["username"];
		$password = $_POST["password"];

		$this->user->logIn($username, $password);	

		$this->redirect();
	}

	public function newSession() {
		require VIEW_DIR . '/pages/log_in.php';
	}

	private function redirect() {
		if($_SESSION["logged_in"]) {
			require VIEW_DIR . '/pages/home.php';
		} else {
			echo 'Username or password was incorrect. Please try again.';
			$this->newSession();
		}
	}

}

