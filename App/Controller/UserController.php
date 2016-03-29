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
		$this->afterCreate();
	}

	public function destroy() {
		$this->isAuthorized();

		$this->user->destroy();
		$this->users();
	}

	public function update() {
		$this->isAuthorized();

		$this->user->update();

		$title = "Account";
		require VIEW_DIR . '/pages/edit_user.php';
	}

	public function signUp() {
		$title = "Sign Up";
		require VIEW_DIR . '/pages/sign_up.php';
	}

	public function edit() {
		$this->isAuthorized();

		$title = "Account";
		require VIEW_DIR . '/pages/edit_user.php';
	}

	public function users() {
		$this->isAuthorized();

		$users = $this->user->all();
		$title = "Users";
		$admin = $this->user->isAdmin();
		require VIEW_DIR . '/pages/users.php';
	}

	public function account() {
		$this->isAuthorized();

		$title = "Account";
		require VIEW_DIR . '/pages/account.php';
	}

	public function afterCreate() {
		if($_SESSION["logged_in"]) {
			$title = "Home";
			require VIEW_DIR . '/pages/home.php';
		} else {
			$title = "Sign Up";
			require VIEW_DIR . '/pages/sign_up.php';
		}
	}

	private function isAuthorized() {
		if(!$_SESSION["logged_in"]) {
			require VIEW_DIR . '/pages/log_in.php';
			exit();
		}
	}

}
