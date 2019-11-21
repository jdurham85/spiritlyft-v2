<?php

namespace core;
class post
{
	static function autoload()
	{
		self::style();
		self::javascript();
		self::add_postbox();
	}

	static function style()
	{
		?>
        <style>
            #create_postbox {
                width: 100%;
                background-color: white;
                position: fixed;
                top: 0;
                right: 0;
                left: 0;
                bottom: 0;
                z-index: 1;
                font-size: 16px;
                display: none;
            }

            #create_postbox_title {
                width: 62.8%;
                float: left;
                text-align: left;
                padding: 1em;
                font-weight: bold;
                color: white;
                background-color: #c29ae1;
            }

            #create_pb_close_btn {
                width: 20%;
                background-color: darkred;
                color: white;
                font-weight: bold;
                float: left;
                padding: 1em;
                text-align: center;
            }

            #pdescription {
                border-top: 1px black solid;
                border-bottom: 1px black solid;
            }

            #create_postbox input {
                padding: 1em 0 1em 0;
                height: 100px;
                width: 99.1%;
                margin: .5em auto;
                font-size: 16px;
            }

            #create_postbox button {
                width: 100%;
                border: 1px black solid;
                height: 50px;
                font-weight: bold;
                text-align: center;
                font-size: 16px;
            }

            #postprivacy {
                margin: 1em auto;
                width: 100%;
                height: 60px;
                border: 1px black solid;
                font-size: 12px;
                font-weight: bold;
            }

            #post_uploadpanel {
                width: 100%;
                float: left;
                margin: 1em auto;
            }

            .fileuploadpanel {
                display: none;
            }

            .pfbox {
                border: 2px gray dashed;
                width: 80px;
                height: 80px;
                line-height: 80px;
                float: left;
                display: block;
                margin-left: 8px;
                text-align: center;
                font-size: 12px;
            }

            .post_itembox {
                width: 80px;
                height: 80px;
                float: left;
            }

            .create_post_item_removebtn {
                position: relative;
                background-color: red;
                border-radius: 2px;
                font-weight: bold;
                width: 100%;
                color: white;
                text-align: center;
            }
        </style>
		<?php
	}

	static function javascript()
	{
		?>
        <script type="text/javascript">
            var POSTMODE = "";

            function create_post_home() {
                POSTMODE = "HOME";
                $("#create_postbox").slideToggle();
            }

            function create_post_profile() {
                POSTMODE = "PROFILE";
                $("#create_postbox").slideToggle();
            }

            function create_post_guest() {
                POSTMODE = "GUEST";
                $("#create_postbox").slideToggle();
            }

            function postbox_close() {
                $("#create_postbox").fadeOut();
            }

            function post_create_remove_item(len) {
                $("#pfbox" + len).remove();
                $("#fbox" + len).remove();
                $("#post_itembox" + len).remove();
            }

            function create_photo_upload_box() {
                var pfbox_length = $(".fbox").length;

                //console.log(pfbox_length);
                var photoupload_box = "<div id='post_itembox" + pfbox_length + "' class='post_itembox'><div " +
                    "class='create_post_item_removebtn' onclick='post_create_remove_item(" + pfbox_length +
                    ");'>Delete</div><img id='pfbox" +
                    pfbox_length + "' " +
                    "class='pfbox' " +
                    "/></div>";

                var fileinput = "<input type='file' name='file[]' id='fbox" + pfbox_length + "' onchange='readURL" +
                    "(this," +
                    pfbox_length + ");' " +
                    "class='fbox' />";

                $("#post_uploadpanel").append(photoupload_box);

                $(".fileuploadpanel").append(fileinput);

                $("#fbox" + pfbox_length).click();
            }

            function readURL(input, len) {
                //var pfbox_length = $(".fbox").length;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        //$(input).attr('src', e.target.result);
                        $("#pfbox" + len).attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            function addnewpost() {
                $("#postfrm").submit(function (e) {
                    e.preventDefault();

                    $.ajax({
                        url: "include/post/add.php", // Url to which the request is send
                        type: "POST", // Type of request to be send, called as method
                        data: new FormData($("#postfrm")[0]), // Data sent to server, a set of key/value pairs (i.e.
                        // form fields and values)
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false, // To send DOMDocument or non processed data file it is set to false
                        success: function (m) {
                            console.log(m);
                        },
                        error: function (m) {
                            console.error("ERROR" + m);
                        }
                    });
                });
            }

            $(document).ready(function () {
                $("#create_postbox").css("height", $(this).height() + "px");

                $("#postfrm").on('submit', function (event) {
                    event.preventDefault();
                });
            });
        </script>
		<?php
	}

	static function add_postbox()
	{
		?>
        <div id="create_postbox">
            <div id="create_postbox_title">Create Post</div>
            <div id="create_pb_close_btn" onclick="postbox_close();">Close</div>
            <form id="postfrm" enctype="multipart/form-data" method="post">
                <select id="postprivacy" name="postprivacy">
                    <option value="Public">Public</option>
                    <option value="Private">Private</option>
                    <option value="Only Me">Only Me</option>
                </select>
                <input type="text" id="pdescription" name="description" placeholder="Type here...."/>
                <button id="postaddbtn" onclick="create_photo_upload_box();" style="background-color: blue; color: white;
">Add Photo/Video
                </button>
                <div class="fileuploadpanel">

                </div>
                <div id="post_uploadpanel">

                </div>
                <button id="addnewpostbtn" onclick="addnewpost();">Create New Post</button>
            </form>
        </div>
		<?php
	}
}