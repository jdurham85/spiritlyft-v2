<?php

use core\postinc;
use model\postd;

if (isset($_POST['wallid'])) {
	$requestedwallid = $_POST['wallid'];
	$postwall = postd::load_post($requestedwallid);

	foreach ($postwall as $pwall) {
		postinc::create_post($pwall['wallid'], $pwall['parentid'], $pwall['memberid'], $pwall['description'], $pwall['date']);
	}
}