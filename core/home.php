<?php

namespace core;

use model\profiled;

class home
{
	static function autoload()
	{
		?>
        <style>
            #postliner {
                margin: auto;
                width: 100%;
            }

            .post_insert {
                width: 100%;
                background-color: white;
                padding: 1em;
                float: left;
                margin: auto auto 1em auto;
                border-radius: 12px;
            }

            .post_insert input {
                padding: 1em 0 1em 0;
                height: 100px;
                width: 100%;
                font-size: 16px;
            }

            .post_insert button {
                width: 95%;
                border: 1px black solid;
                height: 30px;
                font-weight: bold;
                border-radius: 8px;
                text-align: center;
                margin-left: 2.5%;
                font-size: 16px;
            }
        </style>
        <script type="text/javascript">
            //var status = navigator.onLine;
            function opengallery_post_fm(form) {
                //app.makeToast();
                //return false;
                show_create_post_tb(form);
                //app.show_create_post_tb();
            }

            function show_create_post_tb() {

                $("#post_insert_tb").fadeOut(function () {
                    $("#post_box_insert_first").fadeOut(function () {
                        $("#form1").fadeIn();
                    });

                });
            }

            function show_post_insert_tb() {
                $("#form1").on("submit", function (event) {
                    event.preventDefault();
                    $(this).fadeOut(function () {
                        $("#post_insert_tb").fadeIn();
                        $("#post_box_insert_first").fadeIn();
                        clear_post_tmp_data();
                    });
                });
            }

            function delete_image(id, filename) {
                $.post("include/post/tmp_file_upload.php", {filename: filename, fileid: id}, function () {
                    $("#imagebox" + id).fadeOut(function () {
                        $(this).remove();
                    });
                });
            }

            function clear_post_tmp_data() {

                var fileid = "";
                var filename = ""

                $("#user_post_input").val("");

                $(".image_btn_post").each(function () {
                    $(this).click();
                });

                $("#file").val("");

                //$("#galleryview").html("");
                //alert("Bye Mr. Anderson");
            }

            /*$(document).on('click', "#file", "#photo_btn", function (e) {
               e.preventDefault();
            });*/

            $(document).ready(function () {
                //Load NewsFeed
                load_feed(post_page);

                $("#photo_btn").click(function (event) {
                    event.preventDefault();
                    $("#file").click();
                });


                $("#file").on("change", function (event) {
                    event.preventDefault();
                    if ($(this).val().length > 0) {

                        $.ajax({
                            url: "include/post/tmp_file_upload.php", // Url to which the request is send
                            type: "POST", // Type of request to be send, called as method
                            data: new FormData($(".pform")[0]), // Data sent to server, a set of key/value pairs (i.e. form
                            // fields and values)
                            contentType: false, // The content type used when sending data to the server.
                            cache: false, // To unable request pages to be cached
                            processData: false, // To send DOMDocument or non processed data file it is set to false
                            success: function (m) {
                                $("#galleryview").append(m);
                                $("#file").val("");
                                //console.log(m);
                            },
                            error: function (m) {
                                console.error("ERROR" + m);
                            }
                        });
                    }
                });

                $("#video_btn").click(function (event) {
                    event.preventDefault();
                    $("#file").click();
                });

                $("#post_btn").click(function (event) {
                    event.preventDefault();
                    var description = $("#user_post_input").val();

                    if (description === "") {
                        description = " ";
                    }

                    $.post("include/post/post_core.php", {user_post_input: description}, function (result) {

                        //alert(result);
                        //Add a function here to show new post

                        if ($("#post_intro_message").length > 0) {
                            $("#post_intro_message").fadeOut();
                        }

                        load_parent_user_last_post();

                        setTimeout(function () {
                            show_post_insert_tb(this);
                            clear_post_tmp_data();
                        }, 1000);
                    });

                });
            });
        </script>
		<?php
		//self::today_date();
		self::post_insert();
		self::postlist();
	}

	static function post_insert($profileid = 0)
	{
		$p = new profiled();
		$p::autoload();
		?>
        <!--div id="postliner">
            <table class="post_insert">
                <tr>
                    <td style="text-align: center;">
                        <img alt="" src="image/smiiley.gif" width="80"/>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; font-family: 'Helvetica Neue'">
                        "Think of something positive."
                    </td>
                </tr>
                <tr>
                    <td colspan="1">
                        <button style="background-color: green; color: white;" onclick="create_post_home();">Add
                            Post
                        </button>
                    </td>
                </tr>
            </table>
        </div -->
        <div id="post_box_insert_first">
            <table class="post_insert boxstyle">
                <tr>
                    <td style="text-align: center; width: 22%;">
                        <table style="text-align: center; margin: 12px auto; float: left; width: 100%;">
                            <tr>
                                <td>
                                    <img alt="" src="image/smiiley.gif" width="50"/>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; font-size: 14px; font-weight: 500;">
                                    "Little Blue"
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <div id="post_insert_tb" style="margin-top: 1px;">
                            <input type="text" id="user_input" onclick="opengallery_post_fm();" name="user_input"
                                   placeholder="Think of something positive."/>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <form id="form1" class="pform" name="form1" enctype="multipart/form-data" style="display: none;" method="post">
            <table id="post_create_tb" style="float: left; background-color: white; border: 1px black solid; width:
             100%;">
                <tr>
                    <td colspan="2">
                        <button onclick="show_post_insert_tb(this);"
                                style=" width: 100%; height: 40px; background-color: red; color: white; font-size:
                                12px; font-weight: bold; padding: .5em;">
                            Close
                        </button>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; margin: auto;">
                        <img src="<?php echo $p::profilepicture(); ?>"
                             style="text-align: center; width: 40px;"/>
                    </td>
                    <td>
						<?php echo $p::fullname(); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="margin: auto; text-align: center;">
                <textarea id="user_post_input" name="user_post_input" placeholder="What's on your mind?"
                          style="border-radius: 6px; margin: auto; border: 1px black solid; width: 99%; height: 100px;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button id="photo_btn" style="width: 100%; border:1px black solid;" class="btn">
                            <img src="image/photo-icon.png" width="25" height="auto"/> Add Photo
                        </button>
                    </td>
                </tr>
                <tr style="display: none;">
                    <td colspan="2">
                        <button id="photo_btn" style="width: 100%;" class="btn">
                            <img src="image/video-icon.png" width="25" height="auto"/> Add Video
                        </button>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button id="post_btn" style="background-color: #040505; width: 100%; color: white;" class="btn">
                            Create
                            Post
                        </button>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="file" name="file[]" id="file" accept="image/*, video/*"
                               style="width: 50px;"
                               multiple/>
                        <div id="galleryview" style="width: 100%; height: auto;">

                        </div>
                    </td>
                </tr>
            </table>
        </form>
		<?php
	}

	static function postlist()
	{
		?>
        <div id="post_box_insert"></div>
		<?php
	}

	static function today_date()
	{
		?>
        <div id="todaydate">
            <img alt="" id="todaydateimg" src="image/today-512.png" style="width: 100px; height: 100px;"/>
			<?php echo date("D F d, Y"); ?>
        </div>
		<?php
	}
}