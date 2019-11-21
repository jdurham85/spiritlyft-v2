<?php

namespace core;

class profile
{
	private static $profileid = null;

	public static function setProfileIDwithURL($url)
	{
		self::setProfileID(str_replace("profile?userid=", "", $url));
	}

	public static function getProfileID()
	{
		return self::$profileid;
	}

	public static function setProfileID($pid)
	{
		self::$profileid = $pid;
	}
}