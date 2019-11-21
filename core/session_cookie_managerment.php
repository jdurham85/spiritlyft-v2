<?php

namespace core;
/**
 * .
 * User: Jermaine Durham
 * Date: 7/2/18
 * Time: 9:18 AM
 */
class session_cookie_managerment
{
	const LOGINED_IN = true;
	const NOT_LOGINED = false;

	public static function getMemberID()
	{
		return (config::$MEMID == "" ? $_SESSION['SessionMemberID'] : config::$MEMID);
		//return ($_SESSION['SessionMemberID']);
	}

	public static function check_logged_in()
	{
		if (isset($_SESSION['SessionMemberID']) && $_SESSION['SessionMemberID'] != "" && $_SESSION['SessionMemberPassword'] != "") {
			return self::LOGINED_IN;
		} elseif (isset($_COOKIE['MemberID']) && $_COOKIE['MemberID'] != "" && $_COOKIE['MemberPassword'] != "") {
			$_SESSION['SessionMemberID'] = $_COOKIE['MemberID'];
			$_SESSION['SessionMemberPassword'] = $_COOKIE['MemberPassword'];
			return self::LOGINED_IN;
		} else if (config::$MEMID != "") {
			return self::LOGINED_IN;
		} else {
			return self::NOT_LOGINED;
		}
	}

	public static function create_session($memberid, $memberpassword)
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		$_SESSION['SessionMemberID'] = $memberid;
		$_SESSION['SessionMemberPassword'] = $memberpassword;
	}

	public static function create_cookie()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		setcookie("MemberID", $_SESSION['SessionMemberID'], time() + (86400 * 365), "/");
		setcookie("MemberPassword", $_SESSION['SessionMemberPassword'], time() + (86400 * 365), "/");
	}

	public static function delete_session()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		session_unset();
		session_destroy();
	}

	public static function delete_cookie()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		setcookie("MemberID", $_SESSION['SessionMemberID'], time() - (86400 * 365), "/");
		setcookie("MemberPassword", $_SESSION['SessionMemberPassword'], time() - (86400 * 365), "/");
	}
}