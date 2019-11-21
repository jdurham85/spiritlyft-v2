<?php

namespace core;

use model\profiled;

class myprofile
{
	public static function autoload()
	{
		self::style();
		self::js();
		//home::today_date();
		self::header();
		self::friend();
	}

	private static function style()
	{
		?>

		<?php
	}

	private static function js()
	{
		?>
        <script type="text/javascript">
            var fpage = 1;
            var fspage = 1;


            function mypost() {
                $.post("include/post/post_core.php", {
                    load_my_post: 1
                }, function (feed) {
                    //console.log(feed);
                    $("#post_box_insert_first").append(feed);
                });
            }

            function mygallerybox() {
                $(".profile_pl").load("include/profile/mygallery.php");
            }

            function myfriendbox() {
                $(".profile_pl").load("include/profile/myfriends.php");
            }

            function friend_popup_box() {
                $("#block_screen").fadeIn(function () {
                    $(".friendpopupbox").fadeIn(function () {

                        if ($(this).width() >= 1024) {
                            $(this).css("width", "40%");
                        }

                        $(".friendpopupbox_load").fadeIn(function () {
                            $.post("include/profile/my_friend_extend_list.php", {
                                page: fpage
                            }, function (fs) {
                                $(".friendpopupbox_load").html(fs);

                                $(".friendpopupbox_load").css("height", $(window).innerHeight() - $(".friend_search_box")
                                    .height() + "px");
                            });
                        });

                        //console.log($(".friendpopupbox_load").scrollHeight());

                        /*$(".friendpopupbox_load").scroll(function (event) {
							//console.log(event.originalEvent.height);
						});*/
                    });
                });
            }

            function myfriend_search() {

                //console.log($(".friend_search_box_input").val());

                if ($(".friend_search_box_input").val().length > 0) {
                    var flength = $(".friendpopup_box").length - 1;
                    //console.log(flength);
                    $(".friendpopupbox_load").html("");

                    $.post("include/profile/myfriend_search.php", {
                        page: fspage,
                        name: $(".friend_search_box_input").val()
                    }, function (f) {
                        if (f == null) {
                            fspage = 1;
                        } else {
                            if (flength <= 0) {
                                $(".friendpopupbox_load").html(f);
                            } else {
                                $(".friendpopup_box:eq(" + flength + ")").after(f);
                            }
                        }

                    });

                    $(".friendpopupbox_load").scroll(function () {
                        var flength = $(".friendpopup_box").length - 1;
                        //console.log($(".friendpopup_box:eq(" + flength + ")")[0].outerHTML);
                    });
                }
            }

            function friend_popup_box_close() {
                $(".friendpopupbox_load").fadeOut(function () {
                    $(this).html("");
                    $(".friendpopupbox").fadeOut(function (){
                        $("#block_screen").fadeOut(2000);
                    });
                    fspage = 1;
                    fpage = 1;
                });
            }

            $(document).ready(function () {
                //$(".body").height("");

                mygallerybox();

                setTimeout(function () {
                    mypost();
                }, 2000);

                /*$(".friend_search_box_input").keyup(function () {
                    myfriend_search();
                });*/

            });
        </script>
		<?php
	}

	private static function header()
	{
		$p = new profiled();
		$p::autoload();
		?>
        <div class="profileliner">
            <div class="profilebody">
                <div id="profileimg">
                    <img alt="Profile Image" src="<?php echo $p::profilepicture(); ?>"/>
                </div>

                <div id="profilename">
					<?php echo $p::fullname(); ?>
                </div>

                <div id="profilebio"></div>

                <button class="profilestylebtn" style="background-color: blue; color: white;" id="editprofilebtn"
                        onclick="gotopage
                ('editprofile');">Edit
                    Profile
                </button>
                <!--button class="profilestylebtn" id="accountsettingsbtn" onclick="gotopage('accountsettings');
                ">Account Settings
                </button-->
                <div class="profileline"></div>
            </div>
        </div>

        <div class="profileliner" style="border: none; padding: 0 0 0 0; background-color: transparent;">
            <div class="profile_header_btn" style="background-color: #8925bd; color: white;" onclick="myfriendbox();">
                My Friends
            </div>
            <div class="profile_header_btn" style="background-color: green; color: white;" onclick="mygallerybox();">
                My Gallery
            </div>
            <div class="profile_header_btn" style="background-color: #0b58a2; color: white;">
                My Video
            </div>
        </div>
		<?php
	}

	private static function friend()
	{
		?>
        <div class="profileliner">
            <div class="profilebody">
                <div class="profile_pl">

                </div>
            </div>
        </div>

        <div id="post_box_insert_first"></div>
		<?php
	}

	/*Edit Profile*/

	public static function edit()
	{
		$countrycode = profiled::MemberCountry(config::get_member_id())['id'];
		$statecode = profiled::MemberRegion(config::get_member_id())['id'];
		$citycode = profiled::MemberCity(config::get_member_id())['id'];

		$parentid = config::get_member_id();
		?>
        <script type="text/javascript">
            $(document).ready(function () {
                countrycode = '<?php echo($countrycode != null ? $countrycode : null); ?>';
                statecode = '<?php echo($statecode != null ? $statecode : null); ?>';
                citycode = '<?php echo($citycode != null ? $citycode : null); ?>';
            });
        </script>
        <div class="editprofilepl boxstyle" style="width: 100%; font-size: 14px; padding: .1em; float: left;">
            <div style="float: left; width: 100%; border-bottom: 1px lightgray solid; text-align: left; font-weight:
            bold;
            font-size:
            18px;">My Location
            </div>
            <table style="width: 100%; margin: 12px auto; float: left;">
                <tr>
                    <td style="font-weight:400;">
                        Current Country
                    </td>
                    <td style="text-align: right;">
                        <span id="pcountry"><?php echo " " . strtoupper(profiled::MemberCountry($parentid)['code']);
	                        ?></span>
                        <select style="display: none;" id="epcountry" name="epcountry">

                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;">
                        <a href="javascript:void(0);" onclick="ep_show_country(this);">Change</a>
                    </td>
                </tr>
            </table>

            <table style="width: 100%; margin: 12px auto; float: left;">
                <tr>
                    <td style="font-weight:400;">
                        Current State
                    </td>
                    <td style="text-align: right;">
                        <span id="pstate"><?php echo " " . ucfirst(profiled::MemberRegion($parentid)['name']); ?></span>
                        <select style="display: none;" id="epstate" name="epstate">

                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;">
                        <a href="javascript:void(0);" onclick="ep_show_state(this);">Change</a>
                    </td>
                </tr>
            </table>

            <table style="width: 100%; margin: 12px auto; float: left;">
                <tr>
                    <td style="font-weight:400;">
                        Current City
                    </td>
                    <td style="text-align: right;">
                        <span id="pcity"><?php echo ucfirst(profiled::MemberCity($parentid)['name']); ?></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;">
                        <a href="javascript:void(0);" onclick="ep_show_city(this);">Change</a>
                        <select style="display: none;" id="epcity" name="epcity">

                        </select>
                    </td>
                </tr>
            </table>
        </div>
		<?php
	}
}
