<?php

namespace core;

use model\friendd;
use model\profiled;

/**
 * .
 * User: Jermaine Durham
 * Date: 7/18/18
 * Time: 8:52 PM
 */
class friendInc
{
	public static $REQUEST_NOT_AVAILABLE = 0;
	public static $REQUEST_SEND = 1;
	public static $REQUEST_PENDING = 1;
	public static $REQUEST_ACCEPTED = 2;
	public static $REQUEST_DECLINED = 3;
	public static $REQUEST_BLOCKED = 4;

	private static $friendd = "";

	public static function friend_pending_request()
	{
		$myfriend = friendd::friend_request_array();

		$count = count($myfriend);

		/*if ($count > 0) {
			?>
            <table class="member_friend_tb boxstyle">
                <tr>
                    <td style="text-align: center;">
                        <img alt="" src="image/smiiley.gif" style="width: 60px; height: 60px;" />
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;">
                        "I see you have <span class="little_blue_friend_request_count"><?php echo $count; ?></span>
                        friend request"
                    </td>
                </tr>
            </table>
			<?php
		}*/

		if (!$count == 0) {
			foreach ($myfriend as $myfriends) {
				?>
                <table id="member_friend_request_tb<?php echo $myfriends; ?>" class="member_friend_tb">
                    <tr>
                        <td style="text-align: center;">
                            <img alt="" class="member_img" style="width: 60px; height: 60px;" src="<?php echo
							profiled::MemberProfilePic
							($myfriends); ?>"/>
                        </td>
                        <td style="text-align: center; padding: 1em; width: 60%;">
                            <strong><?php echo profiled::MemberFullName($myfriends); ?></strong>
                        </td>
                        <td style="text-align: center;" id="friend_request_btn_tr<?php echo $myfriends; ?>">
                            <button class="btn btn-success"
                                    onclick="accept_friend_request(<?php echo $myfriends; ?>);"
                                    id="send_request_btn<?php echo $myfriends; ?>"
                                    class="bg bg-green" style="width: 100%; padding:0.6em; float: left;">
                                Accept
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-danger"
                                    id="remove_request_btn<?php echo $myfriends; ?>"
                                    onclick="decline_friend_request(<?php echo $myfriends; ?>);"
                                    class="bg bg-red" style="width: 100%; padding:0.6em; float: left;">
                                Decline
                            </button>
                        </td>
                    </tr>
                </table>
				<?php
			}
		} else {
			?>
            <table class="boxstyle" style="width: 100%; background-color: white; margin-top: .2em; padding: 1em; float:
            left;
            text-align:
            center;">
                <tr>
                    <td>
                        <img alt="Little Blue" src="image/smiiley.gif" style="border: none;" width="80"
                             height="80"/>
                    </td>
                </tr>
                <tr>
                    <td style="">
                        No Friends Request at the moment.
                    </td>
                </tr>
            </table>
			<?php
		}
	}

	public static function all_myfriends()
	{
		?>
        <div style="font-weight: bold; font-size: 14px; line-height: 35px; width: 100%; float: left; border-bottom:
        1px darkgray solid; padding: .5em;">
            <!-- img alt="" src="image/friends.png" style="float: left; width: 40px; height: 30px;"/ -->
            <span style="margin-left: 10px; float: left; font-size: 20px;">My Friends
                <?php echo
                friendInc::friend_count(); ?>
            </span>
            <span style="float:right; font-size: 12px; color: blue;">Find Friends</span>
        </div>
        <div class="profile_picture_pl">
			<?php
			$friends = friendd::member_friends(config::get_member_id());
			if (count($friends) > 0) {
				foreach ($friends as $memberid) {
					?>
                    <table class="myfriends_tb" style="cursor: pointer;" onclick="gotopage('profile?userid=<?php echo
                    $memberid;
                    ?>');">
                        <tr>
                            <td style="text-align: center;">
                                <img alt="" src="<?php echo profiled::MemberProfilePic($memberid); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="myfriends_name" style="text-align: center;">
								<?php echo profiled::MemberFullName($memberid); ?>
                            </td>
                        </tr>
                    </table>
					<?php
				}
			} else {
				?>
                <table class="myfriends_tb" style="width: 100%; float:left;">
                    <tr>
                        <td>
                            <img alt="Little Blue" src="image/smiiley.gif" style="border: none;" width="80"
                                 height="80"/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            You currently do not have any friends.
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            <a href="javascript:void(0);">Find Friends</a>
                        </td>
                    </tr>
                </table>
				<?php
			}
			?>
        </div>
		<?php
	}

	public static function friend_suggestions()
	{
		//require_once "../model/friendd.php";
	}

	public static function friend_count()
	{
		return friendd::friend_count();
	}

	public static function IS_FRIEND($tomemberid, $frommemberid)
	{
		return friendd::IS_FRIEND($tomemberid, $frommemberid);
	}

	public static function send_request($tomemberid)
	{
		//require_once "../model/friendd.php";

		$request = new friendd();

		$request::send_request($tomemberid);
	}

	public static function decline_request($frommemberid)
	{
		//require_once "../model/friendd.php";

		$request = new friendd();

		$request::decline_request($frommemberid);
	}

	public static function block_request($frommemberid)
	{
		//require_once "../model/friendd.php";

		$request = new friendd();

		$request::block_request($frommemberid);
	}

	public static function accept_request($frommemberid)
	{
		//require_once "../model/friendd.php";

		$request = new friendd();

		$request::accept_request($frommemberid);
	}

	public static function check_request($frommemberid)
	{
		return friendd::check_request($frommemberid);
	}

	public static function friends($memberid)
	{
		//require_once "../model/friendd.php";

		$request = new friendd();
	}

	public static function myfriend_suggestions()
	{
		//require_once '../model/friendd.php';

		$f = new friendd;

		$f->setup_friend_suggestions();
	}

	public static function my_friends_birthday_list()
	{
		return friendd::my_friends_birthday_list();
	}

	public static function my_friends_list($page = 1, $limit = 20)
	{
		return friendd::my_friends_list($page, $limit);
	}

	public static function my_profile_friends()
	{
	}

	public static function my_friends($page = 1, $limit = 20)
	{
		return friendd::my_friends_list($page, $limit);
	}

	public
	static function is_block($parentid, $memberid)
	{
		return friendd::is_block($parentid, $memberid);
	}

	public
	static function blockf($parentid, $memberid)
	{
		return friendd::blockf($parentid, $memberid);
	}

	public
	static function unblockf($parentid, $memberid)
	{
		return friendd::unblockf($parentid, $memberid);
	}

	public
	static function blockf_list($parentid)
	{
		return friendd::blockf_list($parentid);
	}

	public static function myfriend_search($page = 1, $name)
	{
		return friendd::myfriend_search($page = 1, $name);
	}

	public static function member_friend($parentid = null)
	{
		$parentid = ($parentid == null ? config::get_member_id() : $parentid);
		return friendd::member_friends($parentid);
	}
}