<?php
namespace App\Controller;

use App\Model\Image;

class ImageController {

	private $image = null;

	public function __construct(Image $image)
	{
		$this->image = $image;
	}

	public function upload() {
		$this->isAuthorized();

		$title = "Upload";
		require VIEW_DIR . '/pages/upload.php';
	}

	public function gallery() {
		$this->isAuthorized();

		$images = $this->image->all();
		$title = "Gallery";
		require VIEW_DIR . '/pages/gallery.php';
	}

	public function save() {
		$this->isAuthorized();

		$this->image->save();
		$this->upload();
	}

	public function saveNewTitle() {
		$this->isAuthorized();

		$this->image->saveTitle();
		$this->gallery();
	}

	public function destroy() {
		$this->isAuthorized();

		$this->image->destroy();
		$this->gallery();
	}

	private function isAuthorized() {
		if(!$_SESSION["logged_in"]) {
			$title = "Log in";
			require VIEW_DIR . '/pages/log_in.php';
			exit();
		}
	}

}