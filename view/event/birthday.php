<?php
/**
 * Created by PhpStorm.
 * User: jermainedurham
 * Date: 10/7/18
 * Time: 5:55 PM
 */

use core\events_inc;

events_inc::header();
?>
<div id="birthday_box">
	<?php
	events_inc::birthday_page();
	events_inc::birthday_list();
	?>
</div>
