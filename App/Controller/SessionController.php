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
		$username = $_POST["username"];
		$password = $_POST["password"];

		$this->user->logIn($username, $password);	
		$this->redirect("log_in");
	}

	public function destroy() {
		$this->user->logOut();
		$this->redirect("log_out");
	}

	public function newSession() {
		$title = "Log in";
		require VIEW_DIR . '/pages/log_in.php';
	}

	public function redirect($from = null) {
		if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
			$title = "Home";
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

