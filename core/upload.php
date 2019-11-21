<?php
/**
 * User: Jermaine Durham
 * Date: 7/10/18
 * Time: 9:17 PM
 */

namespace core;

use model\database;
use model\uploadd;

class upload extends database
{

	public static $image_support_files = ['jpeg', 'png', 'bmp', 'jpg', 'image/jpeg', 'image/png', 'image/bmp', 'image/jpg'];
	public static $video_support_files = ['flv', 'avi', 'wmv', 'mpg', 'mpeg', 'mp4', 'video/avi', 'video/x-ms-wmv', 'video/mpeg', 'video/mpg', 'video/mp4'];

	public static function add_member_photo($parentid, $memberid, $description, $FILE = [])
	{
		self::make_dir($parentid);
		//require_once "../model/uploadd.php";
		$description = addslashes(trim($description));

		$targetdir = config::AppDir() . "/view/profile/" . $_SESSION['SessionMemberID'] . "/photo/";

		if ($FILE['file']['name'] != "") {
			//for ($i = 0; $i < count($FILE["file"]['tmp_name']); $i++) {
			$file_ext = pathinfo($FILE['file']['name'], PATHINFO_EXTENSION);

			if (in_array($file_ext, self::$image_support_files)) {
				$name = self::genfilename(10) . "." . $file_ext;
				$filetype = "image";

				while (file_exists($targetdir . $name)) {
					$name = self::genfilename(12) . "." . $file_ext;
					break;
				}

				if (move_uploaded_file($FILE['file']['tmp_name'], $targetdir . $name)) {
					uploadd::add_member_photo_DB($parentid, $memberid, $description, $filetype, $name);
				}
			}

			//}
		} /*else {
            //uploadd::add_member_photo_DB($parentid, $memberid, $description);
        }*/
	}

	private static function make_dir($memid)
	{
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

	private static function genfilename($length)
	{
		$characters = "abcdefghijklmnopqrstuvwxyzABCDERFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$randomString = "";
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[mt_rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}

	public static function delete_member_photo($memberid, $photoid)
	{

	}

	public static function move_post_file($parentid)
	{
		//../view/profile/" . $_SESSION['SessionMemberID'] . "/photo/" . $name
	}

	public static function show_tmp_image($FILE = [])
	{
		//require_once "../model/uploadd.php";

		$targetdir = config::AppDir() . "/view/profile/" . $_SESSION['SessionMemberID'] . "/tmp/";

		$save_file = new uploadd();
		for ($i = 0; $i < count($FILE["file"]['tmp_name']); $i++) {
			$file_ext = pathinfo($FILE['file']['name'][$i], PATHINFO_EXTENSION);


			if (in_array($file_ext, self::$image_support_files)) {
				$name = self::genfilename(10) . "." . $file_ext;

				while (file_exists($targetdir . $name)) {
					$name = self::genfilename(12) . "." . $file_ext;
					break;
				}

				if (move_uploaded_file($FILE['file']['tmp_name'][$i], $targetdir . $name)) {
					$save_file::save_tmp_file_DB($_SESSION['SessionMemberID'], $name, "image");
					//echo "../view/profile/" . $_SESSION['SessionMemberID'] . "/tmp/" . $name;

					//Compress Function reduce file size and quility
					config::compress($targetdir . $name, $targetdir . $name, 60);

					?>
                    <div class="imagebox" id="imagebox<?php echo $save_file::$NEW_FILEID; ?>">
                        <button class="image_btn_post"
                                onclick="delete_image('<?php echo $save_file::$NEW_FILEID; ?>', '<?php echo $name; ?>')">
                            Delete
                        </button>
                        <img id='image<?php echo $save_file::$NEW_FILEID; ?>'
                             src='<?php echo "view/profile/" . $_SESSION['SessionMemberID'] . "/tmp/" . $name; ?>'/>
                    </div>
					<?php
				}
			}
		}
	}

	public function show_tmp_video($FILE)
	{
		//require_once "../model/uploadd.php";
		$save_file = new uploadd();
		for ($i = 0; $i < count($FILE['file']['tmp_name']); $i++) {
			$file_ext = pathinfo($FILE['file']['name'][$i], PATHINFO_EXTENSION);

			if (in_array($FILE['file']['name'][$i], self::$video_support_files)) {
				$name = self::genfilename(10) . "-" . time() . "." . $file_ext;

				if (move_uploaded_file($FILE['file']['tmp_name'][$i], "../view/profile/" . $_SESSION['SessionMemberID'] . "/tmp/" . $name)) {
					$save_file::save_tmp_file_DB($_SESSION['SessionMemberID'], $name, "video");
					//FFMPEG VIDEO FORMAT (CODE)
				}
			}
		}
	}

	public function delete_tmp_file($filename, $fileid)
	{
		//require_once "../model/uploadd.php";
		$delete_file = new uploadd();
		if ($delete_file::delete_tmp_file_DB($_SESSION['SessionMemberID'], $fileid)) {
			@unlink("../view/profile/" . $_SESSION['SessionMemberID'] . "/tmp/" . $filename);
		}
	}

}
