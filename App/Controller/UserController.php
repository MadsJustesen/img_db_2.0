<?php
namespace App\Controller;

use App\Model\User;

class UserController {

	private $user = null;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function create() {
		$username 				= $_POST["add_user_username"];
		$password 				= $_POST["add_user_password"];
		$password_confirmation 	= $_POST["add_user_password_confirm"];

		$this->user->save($username, $password, $password_confirmation);

		$this->redirect();
	}

	public function users() {
		$users = $this->user->all();
		$title = "Users";
		$admin = $this->user->isAdmin($_SESSION["current_user"]);
		require VIEW_DIR . '/pages/users.php';
	}

	public function signUp() {
		$title = "Sign Up";
		require VIEW_DIR . '/pages/sign_up.php';
	}

	public function redirect() {
		if($_SESSION["logged_in"]) {
			$title = "Home";
			require VIEW_DIR . '/pages/home.php';
		} else {
			$title = "Sign Up";
			require VIEW_DIR . '/pages/sign_up.php';
		}
	}

}
