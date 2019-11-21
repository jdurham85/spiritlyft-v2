<?php

use core\session_cookie_managerment;

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

session_cookie_managerment::delete_cookie();
session_cookie_managerment::delete_session();

header("location: ./");
?>
