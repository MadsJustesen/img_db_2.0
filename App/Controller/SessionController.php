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

		$this->redirect("log_in");
	}

	public function destroy() {
		$_SESSION["logged_in"] = false;
		$this->redirect("log_out");
	}

	public function newSession() {
		require VIEW_DIR . '/pages/log_in.php';
	}

	public function redirect($from = null) {
		if($_SESSION["logged_in"]) {
			require VIEW_DIR . '/pages/home.php';
		} else {
			switch($from) {
				case "log_in":
					echo 'Username or password was incorrect. Please try again.';
					break;
				case "log_out":
					echo 'You have been logged out.';
					break;
				default:
					break;
			}
			$this->newSession();
		}
	}

}

