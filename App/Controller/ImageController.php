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
		require VIEW_DIR . '/pages/upload.php';
	}

	public function show() {
		$images = $this->image->all();
		require VIEW_DIR . '/pages/gallery.php';
	}

	public function save() {
		$this->image->save();
		require VIEW_DIR . '/pages/upload.php';
	}

}