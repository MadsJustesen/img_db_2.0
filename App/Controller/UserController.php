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
		$this->user->save();
		$this->redirect();
	}

	public function update() {
		$this->user->update();

		$title = "Account";
		require VIEW_DIR . '/pages/edit_user.php';
	}

	public function signUp() {
		$title = "Sign Up";
		require VIEW_DIR . '/pages/sign_up.php';
	}

	public function edit() {
		$title = "Account";
		require VIEW_DIR . '/pages/edit_user.php';
	}

	public function users() {
		$users = $this->user->all();
		$title = "Users";
		$admin = $this->user->isAdmin($_SESSION["current_user"]);
		require VIEW_DIR . '/pages/users.php';
	}

	public function account() {
		$title = "Account";
		require VIEW_DIR . '/pages/account.php';
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
