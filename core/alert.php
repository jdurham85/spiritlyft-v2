<?php

namespace core;

use model\profiled;
use model\alertd;

/**
 * Created by PhpStorm.
 * User: Jermaine Durham
 * Date: 8/23/18
 * Time: 7:25 PM
 */
class alert
{
	public static $ADDED_POST = 0;
	public static $ADDED_POST_COMMENT = 1;
	public static $REPILED_TO_POST = 2;
	public static $REPILED_TO_POST_COMMENT = 3;
	public static $ADDED_PHOTO = "4";
	public static $ADDED_VIDEO = 5;
	public static $IS_LIVED = 6;
	public static $REACTED_TO_POST = 7;
	public static $REACTED_TO_POST_COMMENT = 8;
	public static $ADDED_SNAP = 9;
	public static $BIRTHDAY = 10;
	public static $EVENT_REMINDER = 11;
	public static $EVENT_INVITE = 12;
	public static $ACCOUNT_WARNING = 13;
	public static $FRIEND_SUGGESTED = 14;
	public static $SHARED_POST = 15;
	public static $NOTIFICATION_UNSEEN = 16;
	public static $NOTIFICATION_SEEN = 17;

	/*public static function notification_tofriend($mode, $parentid, $description = ""){

		$friends = friendInc::my_friends_list();
		//NOTIFCIATION ADD REPILED POST COMMENT
		for ($i = 0; $i < count($friends); $i++) {
			if ($friends[$i] != $parentid) {
				self::notification_add($friends[$i], $parentid, $mode, $description, $_POST['save_comment']);
			}
		}
	}*/

	public static function notification_add($tomemberid, $frommemberid, $mode, $description = "", $wallid = "", $commentid = "", $eventid = "", $gameid = "", $pageid = "")
	{
		$n = new alertd();
		$n::notification_add_DB($tomemberid, $frommemberid, $mode, $description, $wallid, $commentid, $eventid,
			$gameid, $pageid);
	}

	public static function notification_load($tomemberid)
	{
		$n = new alertd();
		$notification = $n::notification_load($tomemberid);

		for ($i = 0; $i < count($notification); $i++) {
			//echo $alertdd[$i]['mode'];
			if ($notification[$i]['mode'] == self::$ACCOUNT_WARNING) {

			}

			if ($notification[$i]['mode'] == self::$ADDED_PHOTO) {
				?>
                <div class="notification_pl" id="notification_pl<?php echo $notification[$i]['notificationid']; ?>">
                    <img src="<?php echo profiled::MemberProfilePic($notification[$i]['frommemberid']); ?>"/>
					<?php echo profiled::MemberFirstName($notification[$i]['frommemberid']) . " has add a new photo." ?>
                    <table style="float: left; width: 96%;">
                        <tr>
                            <td style="width: 50%;">
                                <div class="notification_btn"
                                     onclick="goto_page('profile?userid=<?php echo $notification[$i]['frommemberid']; ?>')">
                                    View
                                    Post
                                </div>
                            </td>
                            <td style="width: 50%;">
                                <div class="notification_delete_btn"
                                     onclick="notification_delete(<?php echo $notification[$i]['notificationid']; ?>);">
                                    Delete
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
				<?php
			}

			if ($notification[$i]['mode'] == self::$REACTED_TO_POST) {
				?>
                <div class="notification_pl" id="notification_pl<?php echo $notification[$i]['notificationid']; ?>">
                    <img src="<?php echo profiled::MemberProfilePic($notification[$i]['frommemberid']); ?>"/>
					<?php echo profiled::MemberFirstName($notification[$i]['frommemberid']) . " has reacted to your post." ?>
                    <div class="notification_btn_pl">
                        <table style="float: left; width: 96%;">
                            <tr>
                                <td style="width: 50%;">
                                    <div class="notification_btn"
                                         onclick="gotopage('<?php echo "postview?wallid=" . $notification[$i]['wallid'];
									     ?>');">
                                        View Post
                                    </div>
                                </td>
                                <td style="width: 50%;">
                                    <div class="notification_delete_btn"
                                         onclick="notification_delete(<?php echo $notification[$i]['notificationid']; ?>);">
                                        Delete
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
				<?php
			}

			if ($notification[$i]['mode'] == self::$REPILED_TO_POST) {
				?>
                <div class="notification_pl" id="notification_pl<?php echo $notification[$i]['notificationid']; ?>">
                    <img src="<?php echo profiled::MemberProfilePic($notification[$i]['frommemberid']); ?>"/>
					<?php echo profiled::MemberFirstName($notification[$i]['frommemberid']) . " has repiled to your post." ?>
                    <table style="float: left; width: 96%;">
                        <tr>
                            <td style="width: 50%;">
                                <div class="notification_btn"
                                     onclick="gotopage('<?php echo "postview?wallid=" . $notification[$i]['wallid'];
								     ?>');">View
                                    Post
                                </div>
                            </td>
                            <td style="width: 50%;">
                                <div class="notification_delete_btn"
                                     onclick="notification_delete(<?php echo $notification[$i]['notificationid']; ?>);">
                                    Delete
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
				<?php
			}

			if ($notification[$i]['mode'] == self::$REACTED_TO_POST) {
				?>
                <div class="notification_pl" id="notification_pl<?php echo $notification[$i]['notificationid']; ?>">
                    <img src="<?php echo profiled::MemberProfilePic($notification[$i]['frommemberid']); ?>"/>
					<?php echo profiled::MemberFirstName($notification[$i]['frommemberid']) . " has reacted to your post." ?>
                    <table style="float: left; width: 96%;">
                        <tr>
                            <td style="width: 50%;">
                                <div class="notification_btn"
                                     onclick="gotopage('<?php echo "postview?wallid=" . $notification[$i]['wallid'];
								     ?>');">View
                                    Post
                                </div>
                            </td>
                            <td style="width: 50%;">
                                <div class="notification_delete_btn"
                                     onclick="notification_delete(<?php echo $notification[$i]['notificationid']; ?>);">
                                    Delete
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
				<?php
			}

			if ($notification[$i]['mode'] == self::$EVENT_INVITE) {
				?>
                <div class="notification_pl" id="notification_pl<?php echo $notification[$i]['notificationid']; ?>">
                    <table style="float: left; width: 96%;">
                        <tr>
                            <td colspan="2">
                                <img src="<?php echo profiled::MemberProfilePic($notification[$i]['frommemberid']); ?>"/>
								<?php echo profiled::MemberFirstName($notification[$i]['frommemberid']) . " has invited you to an event.." ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">
                                <div class="notification_btn"
                                     onclick="event_preview(<?php echo $notification[$i]['eventid'] . "," . $notification[$i]['frommemberid']; ?>);">
                                    Preview Event
                                </div>
                            </td>
                            <td style="width: 50%;">
                                <div class="notification_delete_btn"
                                     onclick="notification_delete(<?php echo $notification[$i]['notificationid']; ?>);">
                                    Delete
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
				<?php
			}
		}
	}

	public static function notification_count_unseen($memberid)
	{
		$n = new alertd();
		return $n::notification_count_unseen($memberid);
	}

	public static function notification_exist($tomemberid = "", $wallid = "", $commentid = "", $eventid = "", $gameid = "", $pageid = "")
	{

	}

	public static function notification_delete($notificationid = "", $memberid = "", $wallid = "", $commentid = "", $eventid = "", $gameid = "", $pageid = "")
	{
		$n = new alertd();
		$n::notification_delete($notificationid, $memberid, $wallid, $commentid, $eventid, $gameid, $pageid);
	}

	public static function notification_set_seen($memberid)
	{
		$n = new alertd();
		$n::notification_set_seen($memberid);
	}
}