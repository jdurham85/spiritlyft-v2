<?php

namespace core;

class friends
{
	public static function header()
	{
		?>
        <script type="text/javascript">
            function myrequest() {
                $.post("include/myfriends/myfriends.php", {friends_page: "myrequest"}, function (page) {
                    //console.log(page);
                    $(".friends_body_pl").html(page);
                    $(".friends_body_pl").css("max-height", $(document).height() - $(".innerheader").height() - $(".friends_pl").innerHeight());

                });
            }

            function myfriends() {
                $.post("include/myfriends/myfriends.php", {friends_page: "myfriends"}, function (page) {
                    //console.log(page);
                    $(".friends_body_pl").html(page);

                    $(".friends_body_pl").css("max-height", $(document).height() - $(".innerheader").height() - $("" +
                        ".friends_pl")
                        .innerHeight());
                });
            }

            $(document).ready(function () {
                $(".friends_body_pl").css("max-height", $(window).innerHeight() - $(".mmenuheader").innerHeight() +
                    "px");

                myrequest();
            });
        </script>

        <div class="friends_pl">
            <div class="friends_pl_btn" onclick="myrequest();">Request <span
                        class="friends_request_count"></span></div>
            <div class="friends_pl_btn" onclick="myfriends();">My Friends</div>
        </div>

        <div class="friends_body_pl"></div>
		<?php
	}

	public static function myrequest()
	{
		?>
        <div class="friends_body_pl">
			<?php
			friendInc::friend_pending_request();
			?>
        </div>
		<?php
	}

	public static function myfriends()
	{
		?>
        <div class="friends_body_pl">
			<?php
			friendInc::all_myfriends();
			?>
        </div>
		<?php
	}

	private static function blocked_friends()
	{

	}
}