<?php

namespace core;

use model\profiled;

class message
{
	public static $MESSAGE_SENT = 0;
	public static $MESSAGE_RECEIVE = 1;
	public static $MESSAGE_UNSEEN = 1;
	public static $MESSAGE_SEEN = 2;
	public static $MESSAGE_DELETED = 3;
	public static $MESSAGE_BLOCKED = 4;

	public function __construct()
	{
		$this->css();
		$this->script();
		$this->message();
	}

	private function css()
	{
		?>
        <link rel="stylesheet" href="style/message.css"/>
        <style type="text/css">
            .body {
                /*border: 1px black solid;*/
            }
        </style>
		<?php
	}

	private function script()
	{
		?>
        <script type="text/javascript">

            //$("#sidemenu").hide();

            var messbox_height = "";

            $(document).ready(function () {
                if ($(document).width() >= 1024) {
                    $("#innerbody").css("width", "1024px");
                    $(".body").css("width", "1024px");
                    $("#messagebox").hide();
                    $("#sidemenu").fadeOut(function () {
                        $("#messagebox").fadeIn().delay(2000);
                    });
                    $(".message_close_btn").hide();
                    messbox_height = $(document).height() - $(".innerheader").height() - 15;
                } else {
                    $("#message_leftpl").css("width", "100%");
                    $("#message_right_pl").css("width", "100%").hide();
                    messbox_height = $(document).height() - $("#mheader").height() - 15;
                }


                //console.log(messbox_height);
                $("#messagebox").css("height", messbox_height);
                $("#message_leftpl").css("height", messbox_height);
                $("#message_right_pl").css("height", messbox_height);
                $("#message_friend_list").css("height", messbox_height - $("#message_title_tb").height() - 20);
                //$("#message_friend_list").css("height", $(".body").height() - $("#message_title_tb").height());

                /*if ($(".message_memberbox").length > 0) {
                    $(".message_memberbox:eq(0)").click();
                }*/

                message_friend_list_load();

                mfa_interval = setInterval(function () {
                    message_friends_alerts();
                }, 2000);

            });
        </script>
		<?php
	}

	private function message()
	{
		?>
        <div id="messagebox" class="boxstyle">
            <div id="message_leftpl">
                <table id="message_title_tb">
                    <tr>
                        <td id="message_title">
                            <img style="width: 40px; height: 40px; margin-left: 4px; float: left; border-radius: 100%;"
                                 alt=""
                                 src="<?php
							     echo profiled::MemberProfilePic(config::get_member_id()); ?>"/>
                            <span style=" margin: 9px auto auto 8px; float: left;">Message</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="message_friend_search" name="message_friend_search"/>
                        </td>
                    </tr>
                </table>
                <div id="message_friend_list">

                </div>
            </div>
            <div id="message_right_pl">

            </div>
        </div>
		<?php
	}

	private function _makedir()
	{
		$targetdir = config::AppDir() . 'view/message';

		if (!dir($targetdir)) {
			@mkdir($targetdir);
		}

		$targetdir = $targetdir . '/';

		//if()
	}
}
