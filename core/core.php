<?php

namespace core;

class core
{
	public static function word_filter($word)
	{
		$bad_word = ['fucking',
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
			'pussy ass bitch'];

		for ($i = 0; $i < count($bad_word); $i++) {
			if (strpos(ucwords($word), ucwords($bad_word[$i]))) {
				$word = str_replace(ucwords($bad_word[$i]), "", ucwords($word));
			}
		}

		return $word;
	}

	public static function add_zero($number)
	{
		if ($number < 10) {
			return "0" . $number;
		} else {
			return $number;
		}
	}

	public static function time_12_format($hour)
	{
		//if($hour > "00" && "09" < $hour){
		switch ($hour) {
			case "00":
				return "12";
				break;

			case "01":
				return "1";
				break;

			case "02":
				return "2";
				break;

			case "03":
				return "3";
				break;

			case "04":
				return "4";
				break;

			case "05":
				return "5";
				break;

			case "06":
				return "6";
				break;

			case "07":
				return "7";
				break;

			case "08":
				return "8";
				break;

			case "09":
				return "9";
				break;

			case "10":
				return "10";
				break;

			case "11":
				return "11";
				break;

			case "12":
				return "12";
				break;

			case "13":
				return "1";
				break;

			case "14":
				return "2";
				break;

			case "15":
				return "3";
				break;

			case "16":
				return "4";
				break;

			case "17":
				return "5";
				break;

			case "18":
				return "6";
				break;

			case "19":
				return "7";
				break;

			case "20":
				return "8";
				break;

			case "21":
				return "9";
				break;

			case "22":
				return "10";
				break;

			case "23":
				return "11";
				break;

			case "default":
			{

				return $hour;
				break;
			}

		}
	}

	public static function make_profile_dir($parentid)
	{
		/*error_reporting(-1);
		ini_set('display_errors', 'On');*/

		$targetdirectory = $_SERVER['DOCUMENT_ROOT'] . "/spiritlyft/view/profile/";
		$filewritemode = 0755;

		/*if (!is_dir($targetdirectory . $parentid)) {
			mkdir($targetdirectory . $parentid);
		}

		if (!is_dir($targetdirectory . $parentid . "/tmp")) {
			mkdir($targetdirectory . $parentid . "/tmp", $filewritemode, true);
		}

		if (!is_dir($targetdirectory . $parentid . "/video")) {
			mkdir($targetdirectory . $parentid . "/video", $filewritemode, true);
		}

		if (!is_dir($targetdirectory . $parentid . "/photo")) {
			mkdir($targetdirectory . $parentid . "/photo", $filewritemode, true);
		}*/

		$memid = $parentid;

		if (!is_dir("../view/profile/" . $memid)) {
			@mkdir("../view/profile/" . $memid, 0777, true);
		}

		if (!is_dir("../view/profile/" . $memid . "/tmp")) {
			@mkdir("../view/profile/" . $memid . "/tmp", 0777, true);
		}

		if (!is_dir("../view/profile/" . $memid . "/video")) {
			@mkdir("../view/profile/" . $memid . "/video", 0777, true);
		}

		if (!is_dir("../view/profile/" . $memid . "/photo")) {
			@mkdir("../view/profile/" . $memid . "/photo", 0777, true);
		}
	}
}