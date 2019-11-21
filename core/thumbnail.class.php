<?php

namespace core;
class thumbnail
{
	var $file_name;
	var $ix, $iy;
	var $bg_color = 0xFFFFFF;
	var $image_type = 'image/jpeg';

	function thumbnail($file, $width = 100, $height = 100, $color = 0xFFFFFF, $type = 'image/jpeg')
	{
		$this->file_name = $file;
		$this->ix = $width;
		$this->iy = $height;
		$this->bg_color = $color;
		$this->image_type = $type;
	}

	function setType($img_type = 'image/jpeg')
	{
		$this->image_type = $img_type;
	}

	function setSize($w = 100, $h = 100)
	{
		$this->ix = $w;
		$this->iy = $h;
	}

	function setBackground($color)
	{
		$this->bg_color = $color;
	}

	function save($image = "", $path = "", $namer = "")
	{
		if (file_exists($this->file_name)) {
			$extn = substr(strrchr($image, "."), 1);
			$thumb_image = $path . $namer . $image;

			$image_size = getimagesize($this->file_name);
			if ($image_size[2] == "1") {
				$this->image_type = 'image/gif';
			} else if ($image_size[2] == "2") {
				$this->image_type = 'image/jpeg';
			} else if ($image_size[2] == "3") {
				$this->image_type = 'image/png';
			}

			$ix_original = $this->ix;
			$iy_original = $this->iy;

			switch ($this->image_type) {
				case 'image/jpeg':
					$img = @imagecreatefromjpeg($this->file_name);
					break;
				case 'image/pjpeg':
					$img = @imagecreatefromjpeg($this->file_name);
					break;
				case 'image/gif':
					$img = @imagecreatefromgif($this->file_name);
					break;
				case 'image/png':
					$img = @imagecreatefrompng($this->file_name);
					break;
			}

			if ($img) {
				$original_width = $width = imagesx($img);
				$original_height = $height = imagesy($img);

				$kx = $width / $this->ix;
				$ky = $height / $this->iy;

				if (($width < $this->ix) && ($height < $this->iy)) {
					$kx1 = round(($this->ix - $width) / 2);
					$ky1 = round(($this->iy - $height) / 2);
					$this->ix = $width;
					$this->iy = $height;
				} elseif ($kx > $ky) {
					$kx = 1;
					$kx1 = 0;
					$ky = $height / $width * ($this->ix / $this->iy);
					$ky1 = ($this->iy - ($ky * $this->iy)) / 2;
					$this->iy = $this->iy * $ky;
				} else {
					$kx = $width / $height * ($this->iy / $this->ix);
					$kx1 = round(($this->ix - ($kx * $this->ix)) / 2);
					$ky = 1;
					$ky1 = 0;
					$this->ix = $this->ix * $kx;
				}

				$img1 = imagecreatetruecolor($ix_original, $iy_original);
				imagefill($img1, 0, 0, $this->bg_color);
				imagecopyresized($img1, $img, round($kx1), round($ky1), 0, 0, round($this->ix), round($this->iy), imagesx($img), imagesy($img));
				if ($img1) {
					switch ($this->image_type) {
						case 'image/jpeg':
							$img = @imagejpeg($img1, $thumb_image, 100);
							break;
						case 'image/pjpeg':
							$img = @imagejpeg($img1, $thumb_image, 100);
							break;
						case 'image/gif':
							$img = @imagegif($img1, $thumb_image);
							break;
						case 'image/png':
							$img = @imagepng($img1, $thumb_image, 9);
							break;
					}
				}

			}
		}

	}

	function output()
	{

		if (file_exists($this->file_name)) {

			$ix_original = $this->ix;
			$iy_original = $this->iy;

			switch ($this->image_type) {
				case 'image/jpeg':
				case 'image/pjpeg':
					$img = @imagecreatefromjpeg($this->file_name);
					break;
				case 'image/gif':
					$img = @imagecreatefromgif($this->file_name);
					break;
				case 'image/png':
					$img = @imagecreatefrompng($this->file_name);
					break;
			}

			if ($img) {
				$original_width = $width = imagesx($img);
				$original_height = $height = imagesy($img);

				$kx = $width / $this->ix;
				$ky = $height / $this->iy;

				if (($width < $this->ix) && ($height < $this->iy)) {
					$kx1 = round(($this->ix - $width) / 2);
					$ky1 = round(($this->iy - $height) / 2);
					$this->ix = $width;
					$this->iy = $height;
				} elseif ($kx > $ky) {
					$kx = 1;
					$kx1 = 0;
					$ky = $height / $width * ($this->ix / $this->iy);
					$ky1 = ($this->iy - ($ky * $this->iy)) / 2;
					$this->iy = $this->iy * $ky;
				} else {
					$kx = $width / $height * ($this->iy / $this->ix);
					$kx1 = round(($this->ix - ($kx * $this->ix)) / 2);
					$ky = 1;
					$ky1 = 0;
					$this->ix = $this->ix * $kx;
				}

				$img1 = imagecreatetruecolor($ix_original, $iy_original);
				imagefill($img1, 0, 0, $this->bg_color);
				imagecopyresized($img1, $img, round($kx1), round($ky1), 0, 0, round($this->ix), round($this->iy), imagesx($img), imagesy($img));

				header("Content-Type: " . $this->image_type);
				header("Last-Modified: " . gmdate('D, d M Y H:i:s \G\M\T', $date));

				header("Expires: " . gmdate('D, d M Y H:i:s \G\M\T', strtotime('+7 day')));
				header("Cache-Control: max-age=5184000");
				header("Accept-Ranges: bytes");
				header("Pragma: cache");
				header("Cache-Control: store, cache");

				if ($img1)
					imagejpeg($img1);
				else {
					$ff = fopen($this->file_name, 'r');
					$contents = fread($ff, filesize($this->file_name));
					fclose($ff);
					echo $contents;
				}
			}
		}
	}
}

?>