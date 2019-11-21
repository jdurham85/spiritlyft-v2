<?php

use model\database;

require "model/database.php";
$db = new database();

require "view/view.php";

require "model/account.php";
require "model/profiled.php";
require "model/uploadd.php";
require "model/alertd.php";
require "model/search.php";
require "model/postd.php";
require "model/friendd.php";
require "model/eventsd.php";
require "model/message.php";

//$fb = new friendd();

require "core/config.php";
require "core/session_cookie_managerment.php";
require "core/search.php";
require "core/controller.php";
require "core/home.php";
require "core/myprofile.php";
require "core/account.php";
require "core/core.php";
require "core/header.php";
require "core/post.php";
require "core/upload.php";
require "core/alert.php";
require "core/notificationenum.php";
require "core/test.php";
require "core/events_inc.php";
require "core/post_inc.php";
require "core/friend_inc.php";
require "core/calander_inc.php";
require "core/MobileDetect.php";
require "core/friends.php";
require "core/timezone.php";
require "core/message.php";
require_once "core/member_photo.php";
require_once "core/profile.php";
require_once "core/thumbnail.class.php";