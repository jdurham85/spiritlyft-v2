<?php

namespace core;

use model\profiled;

class config
{
	public static $MEMID = null;
	private static $APPFolder = "spiritlyft";
	public $APP_NAME = "Spiritlyft";

	public static function setDefaultTimezone()
	{
		$parentid = self::get_member_id();

		$country = profiled::MemberCountry($parentid);
		$region = profiled::MemberRegion($parentid);

		//Set default from set location (Country, Region)
		$timezone = timezone::get_time_zone(strtoupper($country['code']), strtoupper
		($region['code']));

		if ($timezone != null) {
			date_default_timezone_set($timezone);
			//echo $timezone;
		}
	}

	public static function get_member_id()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		return (isset($_SESSION['SessionMemberID']) ? $_SESSION['SessionMemberID'] : self::$MEMID);
		//return ($_SESSION['SessionMemberID']);
	}

	public static function AppDir()
	{
		return $_SERVER['DOCUMENT_ROOT'] . (self::$APPFolder != "" ? "/" . self::$APPFolder : "");
	}

	public static function app_set_id($MID)
	{
		self::$MEMID = $MID;
	}

	public static function word_filter($word)
	{
		$bad_word = [
			'fucking',
			'fucker',
			'fuck',
			'motherfucker',
			'motherfucking',
			'ass',
			'bitch',
			'bitch-ass',
			'shit',
			'shiting',
			'kill',
			'killer',
			'pussy',
			'pussy ass',
			'pussy ass bitch'
		];

		for ($i = 0; $i < count($bad_word); $i++) {
			if (strpos(ucwords($word), ucwords($bad_word[$i]))) {
				$word = str_replace(ucwords($bad_word[$i]), "", ucwords($word));
			}
		}

		return $word;
	}

	public static function add_zero_if_need($number)
	{
		if ($number >= 1 && $number <= 9) {
			return "0" . $number;
		} else {
			return $number;
		}
	}

	public static function compress($source, $destination, $quality)
	{

		$info = getimagesize($source);
		$image = null;

		if ($info['mime'] == 'image/jpeg')
			$image = imagecreatefromjpeg($source);

		elseif ($info['mime'] == 'image/gif')
			$image = imagecreatefromgif($source);

		elseif ($info['mime'] == 'image/png')
			$image = imagecreatefrompng($source);

		imagejpeg($image, $destination, $quality);

		return $destination;
	}

	public static function resize_and_crop($original_image_url, $thumb_image_url, $thumb_w, $thumb_h, $quality = 75)
	{
		// ACQUIRE THE ORIGINAL IMAGE: http://php.net/manual/en/function.imagecreatefromjpeg.php
		$original = imagecreatefromjpeg($original_image_url);
		if (!$original) return FALSE;

		// GET ORIGINAL IMAGE DIMENSIONS
		list($original_w, $original_h) = getimagesize($original_image_url);

		// RESIZE IMAGE AND PRESERVE PROPORTIONS
		$thumb_w_resize = $thumb_w;
		$thumb_h_resize = $thumb_h;
		if ($original_w > $original_h) {
			$thumb_h_ratio = $thumb_h / $original_h;
			$thumb_w_resize = (int)round($original_w * $thumb_h_ratio);
		} else {
			$thumb_w_ratio = $thumb_w / $original_w;
			$thumb_h_resize = (int)round($original_h * $thumb_w_ratio);
		}
		if ($thumb_w_resize < $thumb_w) {
			$thumb_h_ratio = $thumb_w / $thumb_w_resize;
			$thumb_h_resize = (int)round($thumb_h * $thumb_h_ratio);
			$thumb_w_resize = $thumb_w;
		}

		// CREATE THE PROPORTIONAL IMAGE RESOURCE
		$thumb = imagecreatetruecolor($thumb_w_resize, $thumb_h_resize);
		if (!imagecopyresampled($thumb, $original, 0, 0, 0, 0, $thumb_w_resize, $thumb_h_resize, $original_w, $original_h)) return FALSE;

		// ACTIVATE THIS TO STORE THE INTERMEDIATE IMAGE
		// imagejpeg($thumb, 'RAY_temp_' . $thumb_w_resize . 'x' . $thumb_h_resize . '.jpg', 100);

		// CREATE THE CENTERED CROPPED IMAGE TO THE SPECIFIED DIMENSIONS
		$final = imagecreatetruecolor($thumb_w, $thumb_h);

		$thumb_w_offset = 0;
		$thumb_h_offset = 0;
		if ($thumb_w < $thumb_w_resize) {
			$thumb_w_offset = (int)round(($thumb_w_resize - $thumb_w) / 2);
		} else {
			$thumb_h_offset = (int)round(($thumb_h_resize - $thumb_h) / 2);
		}

		if (!imagecopy($final, $thumb, 0, 0, $thumb_w_offset, $thumb_h_offset, $thumb_w_resize, $thumb_h_resize)) return FALSE;

		// STORE THE FINAL IMAGE - WILL OVERWRITE $thumb_image_url
		if (!imagejpeg($final, $thumb_image_url, $quality)) return FALSE;
		return TRUE;
	}

	// RESIZE AN IMAGE PROPORTIONALLY AND CROP TO THE CENTER

	public function get_session_id()
	{

		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		return (self::$MEMID == "" ? $_SESSION['SessionMemberID'] : self::$MEMID);
		//return ($_SESSION['SessionMemberID']);
	}


// USE CASE
	/*echo '<a target="_blank" href="orig_600x374.jpg">Original 600x374</a><br/>';

	resize_and_crop('orig_600x374.jpg', 'temp_100x100.jpg', 100, 100);
	echo '<a target="_blank" href="temp_100x100.jpg">100x100</a><br/>';

	resize_and_crop('orig_600x374.jpg', 'temp_200x100.jpg', 200, 100);
	echo '<a target="_blank" href="temp_200x100.jpg">200x100</a><br/>';

	resize_and_crop('orig_600x374.jpg', 'temp_200x300.jpg', 200, 300);
	echo '<a target="_blank" href="temp_200x300.jpg">200x300</a><br/>';*/
}