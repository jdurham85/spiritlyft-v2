<?php

namespace core;

use view\view;

class controller
{

	public static $REQUEST_URL = null;

	public static function autoload()
	{
		//echo trim($_SERVER['REQUEST_URI']);
		$url = str_replace("/spiritlyft/", "", $_SERVER['REQUEST_URI']);
		self::parseurl($_SERVER['REQUEST_URI']);
		self::route_to_page($url);
	}

	private static function parseurl($url)
	{
		$url = str_replace("/spiritlyft/", "", $url);

		//echo $url;

		$url1 = explode("/", $url);

		//print_r($url);

		foreach ($url1 as $value) {
			if (!$value == null) {
				self::$REQUEST_URL[] = $value;
			}

			//array_unique($this->REQUEST_URL);

			//echo count($this->REQUEST_URL);
			//print_r($this->REQUEST_URL);
		}

		//print_r(self::$REQUEST_URL);
		return $url;
	}

	private static function route_to_page($url)
	{
		//require "view/view.php";
		if (session_cookie_managerment::check_logged_in() == false) {
			?>
            <div class="innerheader">
				<?php
				//$view = new namespace \view();

				//$page = ["login", "createaccount"];

				if ($url == "login") {
					view::loginpage();
				} elseif ($url == "createaccount" || $url == "") {
					view::createaccountpage();
				}
				?>
            </div>
            <style>
                html {
                    background-color: #b8a5e1;
                }
            </style>
			<?php
			exit(0);
		}

		config::setDefaultTimezone();

		if ($url == "logout") {
			view::logout();
		}

		view::$url = $url;

		?>
        <div class="innerheader">
			<?php
			view::header();
			?>
        </div>
		<?php
		view::offlinepage();
		?>
        <div id="innerbody">
			<?php

			/* SIDEMENU */
			$header = new header();
			$header->sidemenu();
			/* SIDEMENU END */

			echo "<div class='body'>";
			self::gotopage($url);
			echo "</div>";

			?>
        </div>
        <div class="friendonlinepl">
            <div id="friend_online_pl_title">Who's Online</div>
        </div>
		<?php
		//view::footer();
	}

	public static function gotopage($url)
	{
		switch (trim($url)) {

			case null || "":
				view::home();
				break;

			case "search":
				view::search();
				break;

			case "accountsettings":
				view::accountsettings();
				break;

			case "login":

				view::loginpage();
				break;

			case "home":
				view::home();
				break;

			case "myprofile":
				view::myprofile();
				break;

			case "test":
				view::test();
				break;

			case "privacy":
				view::privacy();
				break;

			case "termscondition":
				view::termsconditions();
				break;

			case "events":
				view::events();
				break;

			case "birthday":
				view::birthday();
				break;

			case "calander":
				view::calander();
				break;

			case "friendspl" /*|| strpos($url, "friendspl?friends_page")*/ :
				//echo $url;
				/*if (strpos($url, "friendspl?friends_page")) {
					$_POST['friends_page'] = str_replace("friendspl?friends_page=", "", $url);
				}*/
				view::friendspl();
				break;

			case strpos($url, "postview?wallid"):
				$_POST['wallid'] = str_replace("postview?wallid=", "", $url);
				view::postview();
				break;

			case strpos($url, "profile?userid"):
				profile::setProfileIDwithURL($url);
				view::profile();
				break;

			case "editprofile":
				view::editprofile();
				break;

			case "message" :
				view::message();
				break;

			default:
				view::error_page();
				break;
		}
	}
}