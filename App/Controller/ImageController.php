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
		$title = "Upload";
		require VIEW_DIR . '/pages/upload.php';
	}

	public function show() {
		$images = $this->image->all();
		$title = "Gallery";
		require VIEW_DIR . '/pages/gallery.php';
	}

	public function save() {
		$this->image->save();
		$title = "Upload";
		require VIEW_DIR . '/pages/upload.php';
	}

}