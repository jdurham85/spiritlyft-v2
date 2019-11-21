<?php

/**
 * .
 * User: Jermaine Durham
 * Date: 7/29/18
 * Time: 12:55 AM
 */

use core\config;
use core\friendInc;
use core\profile;
use model\profiled;

$config = new config();
$profileid = profile::getProfileID();

$member_info = new profiled();

echo '<div class="content-wrapper">';

if ($profileid == $config->get_session_id()) {
	?>
    <script type="text/javascript">
        gotopage("myprofile");
    </script>
	<?php
	exit(0);
} elseif (friendInc::is_block($config->get_session_id(), $profileid)) {
	?>
    <table class="profiletb">
        <tr>
            <td style="text-align: center;">
                <img style="border-radius: 100%; height: 200px; width: 200px;" src="image/unavailabel_icon.png"
                     width="160"/>
            </td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold; font-size: 16px; padding:1em;">
                Profile Unavailable, Try again later.
            </td>
        </tr>
    </table>
	<?php
	exit;
} elseif (friendInc::IS_FRIEND($profileid, $config->get_session_id()) == false) {
	?>
    <table class="profiletb" style="padding-top: 1em;">
        <tr>
            <td style="text-align: center;">
                <img src="<?php echo $member_info::MemberProfilePic($profileid); ?>"
                     style="border-radius: 100%; height: 200px; width: 200px; border: 1px black solid;"/>
            </td>
        </tr>
        <tr style="">
            <td style="text-align: center; font-size: 16px; font-family: 'Arial Black';">
				<?php //echo $member_info::MemberFullName($profileid);
				?>
            </td>
        </tr>
        <tr>
            <td style="text-align: center; padding: 1em;">
                <strong><?php echo $member_info::MemberFullName($profileid); ?></strong> profile is private.
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <table class="" style="float: left; width: 100%;">
                    <tr>
                        <td style="text-align: center;">
							<?php
							switch (friendInc::check_request($profileid)) {
								case friendInc::$REQUEST_PENDING:
									?>
                                    <button onclick="" id="send_request_btn<?php echo $profileid; ?>" style="background-color: white; font-weight: bold; width:100%; border-radius: 4px;
                                    height: 50px;
                                    color: #c29ae1; border: 2px #c29ae1 solid;">
                                        Request Pending
                                    </button>
									<?php
									break;

								case friendInc::$REQUEST_DECLINED || friendInc::$REQUEST_BLOCKED:

									break;

								default:
									?>
                                    <button onclick="send_friend_request(<?php echo $profileid; ?>);"
                                            id="send_request_btn<?php echo $profileid; ?>" style="background-color: white; font-weight: bold; width:100%; border-radius: 4px;
                                    height: 50px;
                                    color: #c29ae1; border: 2px #c29ae1 solid;">
                                        Add Friend
                                    </button>
									<?php
									break;
							}
							?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
	<?php
	exit();
}
?>
    <script type="text/javascript">
        $(document).ready(function () {
            $.post("include/post/post_core.php", {
                load_friend_post: <?php echo $profileid; ?>
            }, function (feed) {
                //console.log(feed);
                $("#post_box_insert_first").append(feed);
            });
        });
    </script>
    <table class="profiletb">
        <tr>
            <td style="text-align: center;">
                <img style="border-radius: 100%; height: 200px; width: 200px; border: 1px black solid;"
                     src="<?php echo $member_info::MemberProfilePic($profileid); ?>" width="160"/>
            </td>
        </tr>
        <tr style="">
            <td style="text-align: center; font-size: 16px; font-family: 'Arial Black';">
				<?php echo $member_info::MemberFullName($profileid); ?>
            </td>
        </tr>
        <tr>
            <td style="text-align: center; padding:1em;">
                <div onclick="" style="text-align: center; padding:0.5em; border:1px black solid;">
                    <img src="image/message-icon.png"
                         width="30"/>Send <?php echo " " . profiled::MemberFirstName($profileid) . " a message"; ?>
                </div>
            </td>
        </tr>
    </table>
    <div class="profiletb">
        <div class="profile_header_btn">My Friends</div>
        <div class="profile_header_btn">My Gallery</div>
        <div class="profile_header_btn">My Video</div>
    </div>
    <div id="post_box_insert_first"></div>

<?php
echo '</div>';
?>