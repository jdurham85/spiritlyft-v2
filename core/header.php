<?php

namespace core;

class header
{
	public function __construct()
	{
	}

	public function autoload()
	{
		self::stylesheet();
		self::javascript();
		self::style();
		self::header();
		self::mheader();
		self::block_screen();
		self::notificationtb();
		self::loadingscreen();
		self::logoutscreen();
	}

	private function stylesheet()
	{
		?>
        <link rel="stylesheet" href="style/sidemenu.css">
        <link rel="stylesheet" href="style/post.css">
        <link rel="stylesheet" href="style/profile.css">
        <link rel="stylesheet" href="style/notification.css">
        <link rel="stylesheet" href="style/friend_style.css">
		<?php
	}


	private function javascript()
	{
		?>
        <script src="js/menu.js"></script>
        <script src="js/account-setting_inc.js"></script>
        <script src="js/events.js"></script>
        <script src="js/friend.js"></script>
        <script src="js/post_inc.js"></script>
        <script src="js/post_comment.js"></script>
        <script src="js/profilebox_inc.js"></script>
        <script src="js/alerts.js"></script>
        <script src="js/header.js"></script>
        <script src="js/profile.js"></script>
        <script src="js/message.js"></script>
		<?php
	}

	private function style()
	{
		?>
        <link rel="stylesheet" href="style/header.css"/>
		<?php
	}

	private function header()
	{
		?>
        <div id="header">
            <div class="menuheader">
                <div class="title2" style="display: block; width: auto;">SpiritLyft</div>
                <table class="homebtn">
                    <tr>
                        <td>
                            <img alt="" src="image/home-512a.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            Home
                        </td>
                    </tr>
                </table>

                <table class="myprofilebtn">
                    <tr>
                        <td>
                            <img alt="" src="image/no-profile-picture-malea.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            My Profile
                        </td>
                    </tr>
                </table>

                <table class="messagebtn">
                    <tr>
                        <td>
                            <img alt="" src="image/message-icona.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            Message <span class="message_alert"></span>
                        </td>
                    </tr>
                </table>

                <table class="searchbtn">
                    <tr>
                        <td>
                            <img alt="" src="image/search-icon-png-9985a.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Search
                        </td>
                    </tr>
                </table>

                <table class="alertsbtn" style="/*border-bottom-right-radius: 12px; border-top-right-radius: 12px;*/"
                       onclick="notification_desktop_show();">
                    <tr>
                        <td>
                            <img alt="" src="image/notification_icona.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Alerts <span class="notification_count_unseen_alert"></span>
                        </td>
                    </tr>
                </table>

                <!--div style="width: 100%; margin: auto; float: left;">
                    <input id="searchinput" name="searchinput" type="text" placeholder="Search...."/>
                </div-->
            </div>

            <div id="notification_desktop_tb">
                <div id="notification_desktop_close_btn" onclick="notification_desktop_close();">Close</div>
                <div id="notification_desktop_title">Alerts</div>
            </div>
        </div>
		<?php
	}

	private function mheader()
	{
		?>
        <div id="mheader">
            <div class="title" style="float: none; width: auto; border: none; margin:auto;">SpiritLyft
            </div>
            <div class="mmenuheader">
                <!--img alt="" id="logo" src="image/spiritlyft.png"/ -->
                <!--button style="border-bottom-left-radius: 12px; border-top-left-radius: 12px;" class="menubtn"
                        onclick="menushow();">Menu
                </button>
                <button>Home</button>
                <button>Friends</button>
                <button>Message</button>
                <button style="border-bottom-right-radius: 12px; border-top-right-radius: 12px;">Alerts</button-->
                <table class="menubtn" style="/*border-bottom-left-radius: 12px; border-top-left-radius: 12px;*/"
                       onclick="menushow();">
                    <tr>
                        <td>
                            <img alt="" src="image/menua.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Menu <span class="menu_alert_pl"></span>
                        </td>
                    </tr>
                </table>

                <table class="homebtn">
                    <tr>
                        <td>
                            <img alt="" src="image/home-512a.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Home
                        </td>
                    </tr>
                </table>


                <table class="myprofilebtn">
                    <tr>
                        <td>
                            <img alt="" src="image/no-profile-picture-malea.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            My Profile
                        </td>
                    </tr>
                </table>

                <table class="messagebtn">
                    <tr>
                        <td>
                            <img alt="" src="image/message-icona.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Message <span class="message_alert"></span>
                        </td>
                    </tr>
                </table>

                <table class="alertsbtn" style="/*border-bottom-right-radius: 12px; border-top-right-radius: 12px;*/"
                       onclick="notification_show();">
                    <tr>
                        <td>
                            <img alt="" src="image/notification_icon.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Alerts <span class="notification_count_unseen_alert"></span>
                        </td>
                    </tr>
                </table>

            </div>
            <div class="menu">
                <button class="menuclosebtn" onclick="menuhide();">Close</button>
                <div class="menutitle">Menu</div>
                <table class="searchbtn">
                    <tr>
                        <td class="menuimg">
                            <img alt="" src="image/search-icon-png-9985.png"/>
                        </td>
                        <td class="menulabel">
                            Search
                        </td>
                    </tr>
                </table>

                <table class="birthdaylink">
                    <tr>
                        <td class="menuimg">
                            <img alt="" src="image/birthday_ico.png"/>
                        </td>
                        <td class="menulabel">
                            Birthday
                        </td>
                    </tr>
                </table>

                <table class="friendlink">
                    <tr>
                        <td class="menuimg">
                            <img alt="" src="image/friends.png"/>
                        </td>
                        <td class="menulabel">
                            My Friends <span class="friend_request_pl"></span>
                        </td>
                    </tr>
                </table>

                <table class="eventslink">
                    <tr>
                        <td class="menuimg">
                            <img alt="" src="image/calendar_icon.png"/>
                        </td>
                        <td class="menulabel">
                            Events
                        </td>
                    </tr>
                </table>

                <table class="helpcenterlink">
                    <tr>
                        <td class="menuimg">
                            <img alt="" src="image/help.png"/>
                        </td>
                        <td class="menulabel">
                            Help
                        </td>
                    </tr>
                </table>

                <table class="accountsettinglink">
                    <tr>
                        <td class="menuimg">
                            <img alt="" src="image/account-setting-ico.png"/>
                        </td>
                        <td class="menulabel">
                            Account Setting
                        </td>
                    </tr>
                </table>

                <table class="marketplacelink">
                    <tr>
                        <td class="menuimg">
                            <img alt="" src="image/marketplace.png"/>
                        </td>
                        <td class="menulabel">
                            Markgetplace
                        </td>
                    </tr>
                </table>

                <table class="gamelink">
                    <tr>
                        <td class="menuimg">
                            <img alt="" src="image/game-icon.png"/>
                        </td>
                        <td class="menulabel">
                            Game
                        </td>
                    </tr>
                </table>

                <table class="privacylink">
                    <tr>
                        <td class="menuimg">
                            <img alt="" src="image/privacyicon.png"/>
                        </td>
                        <td class="menulabel">
                            Privacy
                        </td>
                    </tr>
                </table>

                <table class="termsconditionslink">
                    <tr>
                        <td class="menuimg">
                            <img alt="" src="image/termsconditionsicon.png"/>
                        </td>
                        <td class="menulabel">
                            Terms & Conditions
                        </td>
                    </tr>
                </table>

                <table class="logoutlink">
                    <tr>
                        <td class="menuimg">
                            <img alt="" src="image/logout-img.png"/>
                        </td>
                        <td class="menulabel">
                            Logout
                        </td>
                    </tr>
                </table>
            </div>
        </div>
		<?php
	}

	private function block_screen()
	{
		?>
        <div id="block_screen">
            <table id="post_option_tb"></table>
            <table id="post_like_tb"></table>
            <div id="post_popup_box"></div>

			<?php
			self::member_photo_option_menu();
			self::member_photo_viewer();
			//self::post_comment_box();
            self::friendpopupbox();
			self::event_select_friend();
			self::event_preview();
			?>
        </div>
		<?
	}

	static function member_photo_option_menu()
	{
		?>
        <div id="member_photo_option_menu">
			<?php
			if (isset($_GET['userid']) && $_GET['userid'] != "") {
				?>
                <div style="font-weight: bold; text-align: center;">Please choose one of the following options:</div>
                <div id="member_photo_viewer_option_close_btn" class="btn-block"
                     onclick="member_photo_viewer_option_menu_close();">Cancel
                </div>
                <div id="member_photo_option_report_btn">Report</div>
                <div id="member_photo_option_download_btn">Download</div>
				<?php
			} else {
				?>
                <div style="font-weight: bold; text-align: center;">Please choose one of the following options:</div>
                <div id="member_photo_viewer_option_close_btn" class="btn-block"
                     onclick="member_photo_viewer_option_menu_close();">Cancel
                </div>
                <div id="member_photo_viewer_edit_btn">Edit Description</div>
                <div id="member_photo_viewer_set_profile_picture_btn" onclick="set_profile_picture()">Set Profile
                    Picture
                </div>
                <div id="member_photo_viewer_delete_btn">Delete Photo</div>
                <div>Post Photo</div>
                <div id="member_photo_option_download_btn">Download</div>
				<?php
			}
			?>
        </div>
		<?php
	}

	static function member_photo_viewer()
	{
		?>
        <div id="member_photo_viewer">
            <div height="40" style="background-color: white; border-bottom: 1px black solid; float: left; width: 100%;
            padding: .3em;">
                <div id="member_photo_viewer_close_btn" onclick="member_photo_viewer_close();">Close</div>
            </div>
            <div>
                <div id="member_photo_viewer_title"></div>
                <div id="member_photo_viewer_option_btn">Option</div>
            </div>

            <div style="width: 100%; float: left; text-align: center;">
                <img id="member_photo_viewer_img" src="image/loading_img.gif"/>
            </div>
            <div id="member_photo_viewer_description">

            </div>
            <div class="profile_wall_pl">
                <div class="profile_wall_react_btn">
                    <img alt="" class="profile_wall_img_btn" src="image/heart.png"/> React
                </div>
                <div class="profile_wall_comment_btn">
                    <img alt="" class="profile_wall_img_btn" style="height: 30px; margin-top: -2px;"
                         src="image/comment-icon.png"/> Comment
                </div>
            </div>
        </div>
		<?php
	}

	private static function post_comment_box()
	{
		?>
        <div class="post_comment_box">
            <div class="post_comment_header_bar">Comment
                <span class="post_comment_close_btn" onclick="wall_comment_close();">Close</span>
            </div>
            <div class="post_comment_insert" style="">
                <img width='60' style='margin: auto; position: fixed; top: 0; right: 0; left: 0; bottom: 0;'
                     src='image/loading_img.gif'/></div>
            <div class="post_comment_footer">
                <input placeholder="Write your comment here..." type="text" id="post_user_comment_input"
                       class="post_user_comment_input"/>
                <div class="post_user_comment_btn" onclick="save_wall_comment_post();">POST
                </div>
            </div>
        </div>
		<?php
	}

	static function event_select_friend()
	{
		?>
        <div id="event_select_friend_tb" style="display: none;">
            <h5 style="text-align: center; padding: .4em; width: 100%; float: left;">Select a member to invite.</h5>
            <div id="event_select_friend_close_btn" style="width: 100%; float: left; padding: .6em;"
                 class="btn btn-danger" onclick="event_select_friend_close();">Close
            </div>
            <div id="select_member_td"></div>
        </div>
		<?php
	}

	static function event_preview()
	{
		?>
        <div id="event_preview">

        </div>
		<?php
	}

	private function notificationtb()
	{
		?>
        <div id="notification_tb">
            <div id="notification_close_btn" onclick="notification_hide();">Close</div>
            <div id="notification_title">Alerts</div>
            <div id="notification_item"></div>
        </div>
		<?php
	}

	private function loadingscreen()
	{
		?>
        <table id="loadingscreen">
            <!--tr>
                <td>
                    <div class="title" style="display: block;">SpiritLyft</div>
                </td>
            </tr-->

            <tr style="background-color: color: #8925bd;">
                <td colspan="1" style="text-align: center;">
                    <img src="image/loadinganimation.gif" width="300"/>
                </td>
            </tr>
        </table>
		<?php
	}

	private function logoutscreen()
	{
		?>
        <table id="logoutscreen">
            <tr>
                <td>
                    <div class="title" style="display: block;">SpiritLyft</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div style="text-align: center; font-weight: bolder; font-size: 18px; color:
                    white; line-height: 60px;">Loggin
                        Out
                    </div>
                </td>
            </tr>

            <tr style="background-color: color: #8925bd;">
                <td colspan="1" style="text-align: center;">
                    <img src="image/loadinganimation.gif" width="100"/>
                </td>
            </tr>
        </table>
		<?php
	}

	public function sidemenu()
	{
		?>
        <div id="sidemenu">
            <div class="sidemenu_title">Menu</div>
            <table class="myprofilelink">
                <tr>
                    <td class="menuimg">
                        <img alt="" src="image/no-profile-picture-male.png"/>
                    </td>
                    <td class="menulabel">
                        My Profile
                    </td>
                </tr>
            </table>

            <table class="birthdaylink">
                <tr>
                    <td class="menuimg">
                        <img alt="" src="image/birthday_ico.png"/>
                    </td>
                    <td class="menulabel">
                        Birthday
                    </td>
                </tr>
            </table>

            <table class="friendlink">
                <tr>
                    <td class="menuimg">
                        <img alt="" src="image/friends.png"/>
                    </td>
                    <td class="menulabel">
                        My Friends <span class="friend_request_pl"></span>
                    </td>
                </tr>
            </table>

            <table class="eventslink">
                <tr>
                    <td class="menuimg">
                        <img alt="" src="image/calendar_icon.png"/>
                    </td>
                    <td class="menulabel">
                        Events
                    </td>
                </tr>
            </table>

            <!-- table class="helpcenterlink">
                <tr>
                    <td class="menuimg">
                        <img alt="" src="image/help.png"/>
                    </td>
                    <td class="menulabel">
                        Help
                    </td>
                </tr>
            </table-->

            <table class="accountsettinglink">
                <tr>
                    <td class="menuimg">
                        <img alt="" src="image/account-setting-ico.png"/>
                    </td>
                    <td class="menulabel">
                        Account Setting
                    </td>
                </tr>
            </table>

            <table class="marketplacelink">
                <tr>
                    <td class="menuimg">
                        <img alt="" src="image/marketplace.png"/>
                    </td>
                    <td class="menulabel">
                        Markgetplace
                    </td>
                </tr>
            </table>

            <!--table class="gamelink">
                <tr>
                    <td class="menuimg">
                        <img alt="" src="image/game-icon.png"/>
                    </td>
                    <td class="menulabel">
                        Game
                    </td>
                </tr>
            </table-->

            <table class="privacylink">
                <tr>
                    <td class="menuimg">
                        <img alt="" src="image/privacyicon.png"/>
                    </td>
                    <td class="menulabel">
                        Privacy
                    </td>
                </tr>
            </table>

            <table class="termsconditionslink">
                <tr>
                    <td class="menuimg">
                        <img alt="" src="image/termsconditionsicon.png"/>
                    </td>
                    <td class="menulabel">
                        Terms & Conditions
                    </td>
                </tr>
            </table>

            <table class="logoutlink">
                <tr>
                    <td class="menuimg">
                        <img alt="" src="image/logout-img.png"/>
                    </td>
                    <td class="menulabel">
                        Logout
                    </td>
                </tr>
            </table>
        </div>
		<?php
	}

	private static function friendpopupbox()
	{
		?>
        <div class="friendpopupbox boxstyle">
            <table class="friend_search_box">
                <tr>
                    <td id="friend_search_box_close_btn" onclick="friend_popup_box_close();">Close</td>
                    <td style="background-color: white; border-bottom: 1px #8925bd solid; padding: 1em;
                width: 95%; text-align: center;">
                        My Friends
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input class="friend_search_box_input" style="display: none;" type="text" placeholder="Search
                Friends"/>
                    </td>
                </tr>
            </table>

            <div class="friendpopupbox_load">

            </div>
        </div>
		<?php
	}
}
