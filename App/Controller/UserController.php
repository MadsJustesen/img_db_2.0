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
		//No reason to check for request-type; this function will only be called with 'POST'
		$username 				= $_POST["add_user_username"];
		$password 				= $_POST["add_user_password"];
		$password_confirmation 	= $_POST["add_user_password_confirm"];

		$this->user->save($username, $password, $password_confirmation);

		$this->redirect();
	}

	public function users() {
		$users = $this->user->all();
		require VIEW_DIR . '/pages/users.php';
	}

	public function signUp() {
		require VIEW_DIR . '/pages/sign_up.php';
	}

	public function redirect() {
		if($_SESSION["logged_in"]) {
			require VIEW_DIR . '/pages/home.php';
		} else {
			require VIEW_DIR . '/pages/sign_up.php';
		}
	}

}
