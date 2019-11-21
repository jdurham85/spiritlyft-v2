<?php

namespace core;

use model\eventsd;
use model\friendd;
use model\alertd;
use model\profiled;

class events_inc
{
	static function header()
	{
		?>
        <link rel="stylesheet" href="style/events.css">
        <div id="event_menu" class="boxstyle">
            <div class="event_menu_btn" onclick="gotopage('events');">Events</div>
            <div class="event_menu_btn" onclick="gotopage('birthday')">Birthday</div>
            <div class="event_menu_btn" onclick="gotopage('calander');">Calander</div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#select_member_td").css('max-height', $(this).height() - 95 + "px");
            });
        </script>
		<?php
	}

	public static function event_page()
	{
		?>
        <script type="text/javascript">
            function event_menu_close() {
                $("#event_add_tb").fadeOut();
            }

            function event_menu_show() {
                $("#event_add_tb").fadeIn();
            }

            $(document).ready(function () {
                myevent_load();
                $(".event_menu_btn:eq(0)").css("border-bottom", "6px black solid");
            });
        </script>
        <div id="event_body">
            <button id="event_add_btn" style="margin-bottom: 8px;" onclick="event_add_tb_show();">Create Event</button>
            <div id="event_add_tb">
                <form id="eventFrm">
                    <div class="event_title">Create Event</div>
                    <input type="hidden" id="CREATEEVENT" name="CREATEEVENT" value="TRUE"/>
                    <select id="event-level" name="event-level">
                        <option value="Public">Public - Everyone get to see this event.</option>
                        <option value="Private">Private - Invite guest like friends or anyone.</option>
                    </select>
                    <input type="text" id="event_title" name="event_title" placeholder="Add Title Here" required/>
                    <textarea id="event-description" name="event-description" style="height: 150px;"
                              placeholder="Add Event Description here" required></textarea>
                    <input type="datetime-local" id="event-datetime" name="event-datetime" required/>
                    <input type="text" id="event-location" name="event-location" placeholder="Add Location" required/>
                    <button type="submit" id="event_frm_add_btn" name="event_frm_add_btn" class="btn-block btn">Add
                        Event
                    </button>
                </form>

                <form id="eventupdateFrm">
                    <div class="event_title">Event Update</div>
                    <input type="hidden" id="UPDATEVENT" name="UPDATEEVENT" value="TRUE"/>
                    <select id="event-level1" name="event-level1">
                        <option value="Public">Public - Everyone get to see this event.</option>
                        <option value="Private">Private - Invite guest like friends or anyone.</option>
                    </select>
                    <input type="text" id="event_title1" name="event_title1" placeholder="Add Title Here"/>
                    <textarea id="event-description1" name="event-description1" style="height: 150px;"
                              placeholder="Add Event Description here"></textarea>
                    <input type="datetime-local" id="event-datetime1" name="event-datetime1"/>
                    <input type="text" id="event-location1" name="event-location1" placeholder="Add Location"/>
                    <button type="submit" id="event_frm_add_btn1" name="event_frm_add_btn1" class="btn-block btn">Update
                        Event
                    </button>
                </form>
            </div>
            <div id="event_body_liner"></div>
        </div>
		<?php
	}

	public static function birthday_page()
	{
		?>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".event_menu_btn:eq(1)").css("border-bottom", "6px black solid");
            });
        </script>
		<?php
	}

	public static function calander_page()
	{
		//require_once "core/calander_inc.php";

		?>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".event_menu_btn:eq(2)").css("border-bottom", "6px black solid");
                $("#calender_tb td").css("height", $("#calender_tb td").width() / 6 + "px");

                $(window).resize(function () {
                    $("#calender_tb td").css("height", $("#calender_tb td").width() / 6 + "px");
                });
            });
        </script>
        <div id="calander_box">
			<?php $calander_inc = new calander_inc(); ?>
        </div>
		<?php
	}

	static function is_event_parent($eventid, $parentid)
	{
		return åeventsd::is_event_parent($eventid, $parentid);
	}

	static function event_load()
	{

		/*if(file_exists("model/eventsd.php")){
	require_once "model/eventsd.php";
}elseif(file_exists("../model/eventsd.php")){
	require_once "../model/eventsd.php";
}*/

		$myevents = "";
		$event_total = 0;

		$myfriend = friendinc::member_friend(1);

		$myfriend[] = config::get_member_id();

		/*
echo '<pre class="event_item">';
print_r($myfriend);
echo '</pre>';
*/
		//Load event from friends and current member
		for ($a = 0; $a < count($myfriend); $a++) {

			$myevents = eventsd::event_load($myfriend[$a]);
			for ($i = 0; $i < count($myevents); $i++) {

				if ($myevents[$i]['event-level'] == "Public" || ($myevents[$i]['event-level'] == "Private" && $myevents[$i]['memberid'] == config::get_member_id()) || self::event_interest_member_exist($myevents[$i]['eventid'], config::get_member_id())) {
					$event_total++;

					$hour = explode(":", $myevents[$i]['time'])[0];
					$min = explode(":", $myevents[$i]['time'])[1];

					$am_pm = (($hour > 12 && 23 < $hour) ? "PM" : "AM");

					$hour = self::time_12_format($hour);

					$time = $hour . ":" . $min . " " . $am_pm;

					$datetimeformat = explode("/", $myevents[$i]['date'])[2] . "-" . explode("/", $myevents[$i]['date'])[0] . "-" . explode("/", $myevents[$i]['date'])[1] . "T" . $hour . ":" . $min;

					//$time_format = self::time_12_format($hour);

					$eventid = $myevents[$i]['eventid'];
					$interest_count = self::event_interest_count($eventid);

					//echo $eventid;
					?>
                    <div class="event_box boxstyle" id="eventbox<?php echo $myevents[$i]['eventid']; ?>">
						<?php

						$eventHostname = (config::get_member_id() == $myevents[$i]['memberid'] ? "(ME)" : profiled::MemberFullName($myevents[$i]['memberid']));

						echo '<div class="event_item" style="border-bottom: none; font-weight: 400; border-bottom: 2px black solid; line-height: 1px; font-size: 16px; text-align: center;"> Hosted By: ' . $eventHostname . '</div>';
						echo '<div class="event_title" style="border-bottom: none; font-weight: normal;  line-height: 50px; font-size: 22px;">' . $myevents[$i]['title'] . '</div>';
						echo '<div class="event_item" style="text-align: center; font-weight: normal; font-size: 16px; padding: .6em;">' . $myevents[$i]['date'] . ' @ ' . $time . '</div>';
						echo '<div class="event_item" style="text-align: center; font-weight: normal; font-size: 16px; padding: .6em;"> ' . $myevents[$i]['location'] . '</div>';
						echo '<div class="event_item" style="text-align: center; font-weight: normal; font-size: 16px; padding: .6em;">' . $myevents[$i]['description'] . '</div>';
						?>
                        <table class="event_opion_tb" id="event_option_tb<?php echo $myevents[$i]['eventid']; ?>">
                            <tr>
                                <td style="text-align: center;" colspan="3">
                                    <a href="javascript:void(0);"
                                       id="event_interested_count<?php echo $myevents[$i]['eventid']; ?>">
										<?php print $interest_count . " "; ?>Interested</a>
                            </tr>
							<?php
							if (config::get_member_id() == $myevents[$i]['memberid']) {
								?>
                                <tr>
                                    <td>
                                        <button class="btn btn-primary"
                                                onclick="event_select_friend(<?php echo $myevents[$i]['eventid']; ?>);">
                                            Invite
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-secondary"
                                                onclick="eventUpdateFrm(<?php echo $eventid . ",'" . $datetimeformat . "' "; ?>);">
                                            Update
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger"
                                                onclick="eventDelete('<?php echo $eventid; ?>');">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
								<?php
							} else {
								if (self::event_interest_member_exist($eventid, config::get_member_id())) {
									?>
                                    <tr id="event_interested_mode<?php echo $eventid; ?>'">
                                        <td>
                                            <button class="btn btn-success" onclick="">You are Interested</button>
                                        </td>
                                        <td align="center">
                                            <button class="btn btn-warning"
                                                    onclick="event_interest_delete('<?php echo $eventid; ?>');">Not
                                                Interested
                                            </button>
                                        </td>
                                    </tr>
									<?php
								} else {
									?>
                                    <tr id="event_interested_mode<?php echo $eventid; ?>'">
                                        <td>
                                            <button class="btn btn-success"
                                                    onclick="event_interest_create(<?php echo $eventid; ?>);">Interested
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger"
                                                    onclick="notification_delete_event_interest('<?php echo $eventid; ?>');">
                                                Not Interested
                                            </button>
                                        </td>
                                    </tr>
									<?php
								}
							}
							?>
                        </table>
                    </div>
					<?php
				}
			}
		}

		//if (count($myevents) != 0) {
		/*
*
Array
(
	[eventid] =&gt; 4
	[memberid] =&gt; 1
	[event-level] =&gt; Public
	[title] =&gt; Birthday Party
	[description] =&gt; Birthday will be held in Downtown Henderson on Main St.
	[date] =&gt; 10/20/2018
	[time] =&gt; 22:00
	[location] =&gt; Henderson, North Carolina
)
*/
		//}
		/* for ($i = 0; $i < count($myevents); $i++) {

 $hour = explode(":", $myevents[$i]['time'])[0];
 $min = explode(":", $myevents[$i]['time'])[1];

 $am_pm = (($hour > 12 && 23 < $hour) ? "PM" : "AM");

 $hour = self::time_12_format($hour);

 $time = $hour . ":" . $min . " " . $am_pm;

 $datetimeformat = explode("/", $myevents[$i]['date'])[2] . "-" . explode("/", $myevents[$i]['date'])[0] . "-" . explode("/", $myevents[$i]['date'])[1] . "T" . $hour . ":" . $min;

 //$time_format = self::time_12_format($hour);

 $eventid = $myevents[$i]['eventid'];
 $interest_count = self::event_interest_count($eventid);

 //echo $eventid;
 ?>
 <div class="event_box" id="eventbox<?php echo $myevents[$i]['eventid']; ?>">
	 <?php

	 $eventHostname = (config::get_member_id() == $myevents[$i]['memberid'] ? "(ME)" : profiled::MemberFullName($myevents[$i]['memberid']));

	 echo '<div class="event_item" style="border-bottom: none; border-bottom: 2px black solid; line-height: 1px; font-size: 16px; text-align: center;"> Hosted By: ' . $eventHostname . '</div>';
	 echo '<div class="event_title" style="border-bottom: none;  line-height: 50px; font-size: 22px;">' . $myevents[$i]['title'] . '</div>';
	 echo '<div class="event_item" style="text-align: center; font-size: 16px; padding: .6em;">' . $myevents[$i]['date'] . ' @ ' . $time . '</div>';
	 echo '<div class="event_item" style="text-align: center; font-size: 16px; padding: .6em;"> ' . $myevents[$i]['location'] . '</div>';
	 echo '<div class="event_item" style="text-align: center; font-size: 16px; padding: .6em;">' . $myevents[$i]['description'] . '</div>';
	 ?>
	 <table class="event_opion_tb" id="event_option_tb<?php echo $myevents[$i]['eventid']; ?>">
		 <tr>
			 <td style="text-align: center;" colspan="3">
				 <a href="javascript:void(0);"
					id="event_interested_count<?php echo $myevents[$i]['eventid']; ?>">
					 <?php print $interest_count . " "; ?>Interested</a>
		 </tr>
		 <?php
		 if (config::get_member_id() == $myevents[$i]['memberid']) {
			 ?>
			 <tr>
				 <td>
					 <button class="btn btn-primary"
							 onclick="event_select_friend(<?php echo $myevents[$i]['eventid']; ?>);">Invite
					 </button>
				 </td>
				 <td>
					 <button class="btn btn-secondary"
							 onclick="eventUpdateFrm(<?php echo $eventid . ",'" . $datetimeformat . "' "; ?>);">
						 Update
					 </button>
				 </td>
				 <td>
					 <button class="btn btn-danger" onclick="eventDelete('<?php echo $eventid; ?>');">Delete
					 </button>
				 </td>
			 </tr>
			 <?php
		 }
		 ?>
	 </table>
 </div>
 <?php
}*/
		if (count($myevents) == 0) {
			?>
            <div class="event_item">
                No event added.
            </div>
			<?php
		}
	}

	static function event_interest_member_exist($eventid, $tomemberid)
	{
		return eventsd::event_interest_member_exist($eventid, $tomemberid);
	}

	private static function time_12_format($hour)
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
		//}else{
		//return $hour;
		//}
	}

	static function event_interest_count($eventid)
	{
		return eventsd::event_interest_count($eventid);
	}

	static function delete_event_invite($eventid, $memberid)
	{
		return eventsd::delete_event_invite($eventid, $memberid);
	}

	static function create_event_invite($eventid, $tomemberid)
	{
		//return eventsd::create_event_invite($eventid, $memberid);
		if (alertd::notification_add_DB($tomemberid, config::get_member_id(), alertd::$EVENT_INVITE, "", "", "", $eventid, "", "")) {
			return true;
		} else {
			return false;
		}
	}

	static function delete_event_interest($eventid, $memberid)
	{
		return eventsd::delete_event_interest($eventid, $memberid);
	}

	static function create_event_interest($eventid, $tomemberid)
	{
		return eventsd::create_event_interest($eventid, $tomemberid);
	}

	static function event_preview($eventid, $frommemberid)
	{
		$myevents = eventsd::event_preview($eventid, $frommemberid);

		?>
        <div class="event_close_btn" onclick="event_preview_close();">Close</div>
		<?

		for ($i = 0; $i < count($myevents); $i++) {


			$hour = explode(":", $myevents[$i]['time'])[0];
			$min = explode(":", $myevents[$i]['time'])[1];

			$am_pm = (($hour > 12 && 23 < $hour) ? "PM" : "AM");

			$hour = self::time_12_format($hour);

			$time = $hour . ":" . $min . " " . $am_pm;

			$datetimeformat = explode("/", $myevents[$i]['date'])[2] . "-" . explode("/", $myevents[$i]['date'])[0] . "-" . explode("/", $myevents[$i]['date'])[1] . "T" . $hour . ":" . $min;

			//$time_format = self::time_12_format($hour);

			$eventid = $myevents[$i]['eventid'];
			$interest_count = self::event_interest_count($eventid);

			//echo $eventid;
			?>
        <div class="event_box" id="eventbox<?php echo $myevents[$i]['eventid']; ?>">
			<?php

			$eventHostname = (config::get_member_id() == $myevents[$i]['memberid'] ? "(ME)" : profiled::MemberFullName($myevents[$i]['memberid']));

			echo '<div class="event_item" style="border-bottom: none; border-bottom: 2px black solid; line-height: 1px; font-size: 16px; text-align: center;"> Hosted By: ' . $eventHostname . '</div>';
			echo '<div class="event_title" style="border-bottom: none;  line-height: 50px; font-size: 22px;">' . $myevents[$i]['title'] . '</div>';
			echo '<div class="event_item" style="text-align: center; font-size: 16px; padding: .6em;">' . $myevents[$i]['date'] . ' @ ' . $time . '</div>';
			echo '<div class="event_item" style="text-align: center; font-size: 16px; padding: .6em;"> ' . $myevents[$i]['location'] . '</div>';
			echo '<div class="event_item" style="text-align: center; font-size: 16px; padding: .6em;">' . $myevents[$i]['description'] . '</div>';
			?>
        <table class="event_opion_tb" id="event_option_tb<?php echo $myevents[$i]['eventid']; ?>">
            <tr>
                <td style="text-align: center;" colspan="3">
                    <a href="javascript:void(0);" id="event_interested_count<?php echo $myevents[$i]['eventid']; ?>">
						<?php print $interest_count . " "; ?>Interested</a>
            </tr>
			<?php
			if (config::get_member_id() != $myevents[$i]['memberid']) {
				?>
                <tr id="event_interest_option_tb<?php echo $myevents[$i]['eventid']; ?>">
                    <td>
                        <button class="btn btn-success"
                                onclick="event_interest_create('<?php echo $myevents[$i]['eventid']; ?>');">Interested
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-danger"
                                onclick="notification_delete_event_interest('<?php echo $myevents[$i]['eventid']; ?>');">
                            Not Interested
                        </button>
                    </td>
                </tr>
                </table>
                </div>
				<?php
			}
		}
	}

	static function event_select_friend($eventid, $page)
	{
		$myfriend = friendd::my_friends_list($page);

		for ($i = 0; $i < count($myfriend); $i++) {
			?>
            <table class="event_select_member">
                <tr>
                    <td width="5%" align="center">
                        <img src="<?php echo profiled::MemberProfilePic($myfriend[$i]); ?>"</td>
                    <td width="75%" align="center">
						<?php echo profiled::MemberFullName($myfriend[$i]); ?>
                    </td>
                    <td width="20%" align="center">
						<?php
						if (self::check_event_invite($eventid, $myfriend[$i])) {
							?>
                            <button class="btn"
                                    onclick="event_invite(this, <?php echo $eventid . ", " . $myfriend[$i]; ?>);">
                                Invited
                            </button>
							<?php
						} else {
							?>
                            <button class="btn btn-success"
                                    onclick="event_invite(this, <?php echo $eventid . "," . $myfriend[$i]; ?>);">
                                Invite
                            </button>
							<?php
						}
						?>
                    </td>
                </tr>
            </table>
			<?php
		}
	}

	static function check_event_invite($eventid, $tomemberid)
	{
		if (alertd::notification_exist($tomemberid, "", "", $eventid, "", "", "")) {
			return true;
		} else {
			return false;
		}
	}

	static function create_event($events, $event_file = [])
	{
		$eventlevel = $events['event-level'];
		$eventName = $events['event_title'];
		$eventDescription = config::word_filter($events['event-description']);
		$datetime = explode("T", $events['event-datetime']);
		$location = $events['event-location'];

		$year['year'] = explode("-", $datetime[0])[0];
		$month['month'] = explode("-", $datetime[0])[1];
		$day['date'] = explode("-", $datetime[0])[2];

		$time = $datetime[1];

		if (count($event_file) > 0) {
			eventsd::event_save(config::get_member_id(), $eventlevel, $eventName, $eventDescription, $event_file, $month['month'], $day['date'], $year['year'], $time, $location);
		} else {
			eventsd::event_save(config::get_member_id(), $eventlevel, $eventName, $eventDescription, $event_file, $month['month'], $day['date'], $year['year'], $time, $location);
		}

		//eventsd::event_save(config::get_member_id(), $eventlevel, $eventName, $eventDescription, $event_file, $month, $day, $year, $time, $location);

		return true;
	}

	static function update_event($events, $event_file = [])
	{
		$eventid = $events['UPDATEEVENT'];
		//$eventlevel = $events['event-level1'];
		$eventName = $events['event_title1'];
		$eventDescription = config::word_filter($events['event-description1']);
		$datetime = explode("T", $events['event-datetime1']);
		$location = $events['event-location1'];

		$year['year'] = explode("-", $datetime[0])[0];
		$month['month'] = explode("-", $datetime[0])[1];
		$day['date'] = explode("-", $datetime[0])[2];

		$time = $datetime[1];

		eventsd::event_update($eventid, $eventName, $eventDescription, $event_file = [], $month['month'], $day['date'], $year['year'], $time, $location);
		//}

		return true;
	}

	static function location_list($location)
	{
	}

	static function delete_parent_event($eventid, $memberid)
	{
		return eventsd::event_delete($eventid, $memberid);
	}

	static function delete_member_event($eventid, $memberid)
	{
		return eventsd::event_delete($eventid, $memberid);
	}

	static function delete_parent_all_interest($eventid, $memberid)
	{
		return eventsd::delete_event_interest($eventid, $memberid);
	}

	static function delete_parent_all_invite($eventid, $memberid)
	{
		return eventsd::delete_event_invite($eventid, $memberid);
	}

	static function delete_parent_all_notification_event($eventid, $tomemberid)
	{
		if ($eventid != "" && $tomemberid != "") {
			alertd::notification_delete("", $tomemberid, "", "", $eventid, "", "");
		} else {
			alertd::notification_delete("", "", "", "", $eventid, "", "");
		}
	}

	static function loadMemberNEWEVENT($parentid)
	{
		$myevents = eventsd::loadMemberNEWEVENT($parentid);

		//$myevents = null;
		if (count($myevents) != 0) {
			/*
		 *
	Array
			(
				[eventid] =&gt; 4
				[memberid] =&gt; 1
				[event-level] =&gt; Public
				[title] =&gt; Birthday Party
				[description] =&gt; Birthday will be held in Downtown Henderson on Main St.
				[date] =&gt; 10/20/2018
				[time] =&gt; 22:00
				[location] =&gt; Henderson, North Carolina
			)
		 */
		}
		for ($i = 0; $i < count($myevents); $i++) {

			$hour = explode(":", $myevents[$i]['time'])[0];
			$min = explode(":", $myevents[$i]['time'])[1];

			$am_pm = (($hour > 12 && 23 < $hour) ? "PM" : "AM");

			$hour = self::time_12_format($hour);

			$time = $hour . ":" . $min . " " . $am_pm;

			$datetimeformat = explode("/", $myevents[$i]['date'])[2] . "-" . explode("/", $myevents[$i]['date'])[0] . "-" . explode("/", $myevents[$i]['date'])[1] . "T" . $hour . ":" . $min;

			//$time_format = self::time_12_format($hour);

			$eventid = $myevents[$i]['eventid'];
			$interest_count = self::event_interest_count($eventid);
			?>
            <div class="event_box" id="eventbox<?php echo $myevents[$i]['eventid']; ?>">
				<?php

				$eventHostname = (config::get_member_id() == $myevents[$i]['memberid'] ? "(ME)" : profiled::MemberFullName($myevents[$i]['memberid']));

				echo '<div class="event_item" style="border-bottom: none; border-bottom: 2px black solid; line-height: 1px; font-size: 16px; text-align: center;"> Hosted By: ' . $eventHostname . '</div>';
				echo '<div class="event_title" style="border-bottom: none;  line-height: 50px; font-size: 22px;">' . $myevents[$i]['title'] . '</div>';
				echo '<div class="event_item" style="text-align: center; font-size: 16px; padding: .6em;">' . $myevents[$i]['date'] . ' @ ' . $time . '</div>';
				echo '<div class="event_item" style="text-align: center; font-size: 16px; padding: .6em;"> ' . $myevents[$i]['location'] . '</div>';
				echo '<div class="event_item" style="text-align: center; font-size: 16px; padding: .6em;">' . $myevents[$i]['description'] . '</div>';
				?>
                <table class="event_opion_tb" id="event_option_tb<?php echo $myevents[$i]['eventid']; ?>">
                    <tr>
                        <td style="text-align: center;" colspan="3">
                            <a href="javascript:void(0);"
                               id="event_interested_count<?php echo $myevents[$i]['eventid']; ?>">
								<?php print $interest_count . " "; ?>Interested</a>
                    </tr>
                    <tr>
                        <td>
                            <button class="btn btn-primary"
                                    onclick="event_select_friend(<?php echo $myevents[$i]['eventid']; ?>);">Invite
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-secondary"
                                    onclick="eventUpdateFrm(<?php echo $eventid . ",'" . $datetimeformat . "' "; ?>);">
                                Update
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-danger" onclick="eventDelete('<?php echo $eventid; ?>');">Delete
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
			<?php
		}
		if (count($myevents) == 0) {
			?>
            <div class="event_item">
                No event added.
            </div>
			<?php
		}
	}

	static function birthday_list()
	{
		?>
        <!--div class="boxstyle" style="text-align: center; font-weight: bold; width: 100%; float: left; font-size:
        18px;
        background-color:
        white;
        padding: 1em;">
            Birthday is currenly undergoing work, please check back again later.
        </div-->
		<?php
		//exit(0);
		$myfriendid = friendInc::my_friends_birthday_list();

		//sort($myfriendid, "dob");

		$month = date("m");
		$day = date("d");
		$year = date("Y");

		?>
        <div class="birthday-title">
            <img alt="" class="birthday_ico center-block" src="image/birthday.png"/>
        </div>
        <div class="birthday-title cent boxstyle" style="text-align: center; font-weight: bold;
">Todays - Birthdays
        </div><?php

		if (count($myfriendid) != 0) {
			foreach ($myfriendid as $friendbirthday) {
				$friend_birth_month = explode("/", $friendbirthday['dob'])[0];
				$friend_birth_day = explode("/", $friendbirthday['dob'])[1];

				if ($month == $friend_birth_month && $day == $friend_birth_day) {
					?>
                    <table class="birthday-member-list boxstyle"
                           style="text-align: center;">
                        <tr>
                            <td>
                                <img
                                     src="<?php echo profiled::MemberProfilePic($friendbirthday['frommemberid']); ?>"
                                     style="border-radius: 100%;"/>
                            </td>
                            <td style="width: 90%;">
								<?php echo profiled::MemberFullName($friendbirthday['frommemberid']); ?>
                            </td>
                        </tr>
                    </table>
					<?php
				}
			}
		} else {
			?>
            <div class="birthday-title" style="text-align: center;">There are no Birthdays for today.</div>
			<?php
		}


		?>
        <div class="birthday-title" style="text-align: center; font-weight: bold; background-color: white;
        margin-top: 2em;">
            &nbsp;Upcoming Birthdays
        </div>
		<?php

		if (count($myfriendid) != 0) {
			foreach ($myfriendid as $friendbirthday) {
				$friend_birth_month = explode("/", $friendbirthday['dob'])[0];
				$friend_birth_day = explode("/", $friendbirthday['dob'])[1];

				$friend_birthday = $friend_birth_month . "/" . $friend_birth_day;

				if ($month == $friend_birth_month && $day != $friend_birth_day && $day < $friend_birth_day && $friend_birth_month !=null) {
					?>
                    <table class="birthday-member-list boxstyle"
                           style="text-align: center; ">
                        <tr>
                            <td>
                                <img
                                     src="<?php echo profiled::MemberProfilePic($friendbirthday['frommemberid']); ?>"
                                     style="border-radius: 100%;"/>
                            </td>
                            <td style="width: 90%;">
								<?php echo profiled::MemberFullName($friendbirthday['frommemberid']) . "  " .
									self::birthday_date_format($friend_birthday); ?>
                            </td>
                        </tr>
                    </table>
					<?php

				}
			}
		} else {
			?>
            <div class="birthday-title" style="text-align: center;">There are no upcoming Birthdays.</div>
			<?php
		}
	}

	private static function birthday_date_format($birthday)
	{
		$month = ['null', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

		if (strpos($birthday, "/")) {
			$birth = explode("/", $birthday);
			return $month[$birth[0]] . ", " . $birth[1];
		}
	}
}

?>