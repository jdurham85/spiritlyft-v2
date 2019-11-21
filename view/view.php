<?php

namespace view;

use core\account;
use core\events_inc;
use core\friends;
use core\home;
use core\myprofile;
use core\post;
use core\search;
use core\session_cookie_managerment;
use SL_ERROR;

class view
{

	public static $isuserloggedin = false;
	public static $url = "";

	//public static $excusedURL = ["logout"];

	public static function autoload($page)
	{

	}

	public static function header()
	{
		if (self::$url != "logout") {
			self::$isuserloggedin = session_cookie_managerment::check_logged_in();

			if (!self::$isuserloggedin) {
				require_once 'outer_header.php';
			} else {
				require_once 'header.php';
				post::autoload();
			}
		}
	}

	public static function search()
	{
		$s = new search();
		$s::_header();
	}

	public static function accountsettings()
	{
		$as = new account();
		$as::setting();
	}

	public static function offlinepage()
	{
		?>
        <style>
            .offlinetb {
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                position: fixed;
                text-align: center;
                font-size: 18px;
                font-family: "Helvetica Neue", "Abadi MT Condensed Light";
                display: none;
                background-color: white;
                color: darkred;
                font-weight: bold;
                margin: auto;
                float: left;
                width: 100%;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function () {
                var bg = 'rgba(201,158,255,0.47)';
                /*setTimeout(function () {
                 $(".body, .menuheader").fadeOut(function () {
                 $(".offlinetb").show();
                 $("body").css("background-color", "white");
                 });
                 }, 2000);*/

                /*setInterval(function(){
                 var connectionstatus = navigator.onLine;
                 if(connectionstatus === false){
                 $(".body, .menuheader").fadeOut(function () {
                 $(".offlinetb").show();
                 $("body").css("background-color", "white");
                 });
                 }else{
                 if(!$(".body, .menuheader").is("visble"))
                 {
                 $(".body, .menuheader").fadeIn(function () {
                 $(".offlinetb").fadeOut();
                 $("body").css("background-color", bg);
                 });
                 }
                 }
                 }, 1000);*/
            });
        </script>
        <table class="offlinetb">
            <tr style="display: none;">
                <td style="font-weight: bold; padding: 1em 0 0 0; font-size: 50px; font-family:cursive; color: rgba(201,158,255,0.47);">
                    SpiritLyft
                </td>
            </tr>
            <tr>
                <td>
                    <img alt="oa" src="image/newsfeed_icon.png" style="width: 100px; height: 100px; opacity: 0.4;">
                </td>
            </tr>
            <tr>
                <td style="padding-top: 1em;">
                    There seems to be a problem with your connection.
                </td>
            </tr>
        </table>
		<?php
	}

	public static function test()
	{
		require "test.php";
	}

	public static function logout()
	{
		require "logout.php";
	}

	public static function createaccountpage()
	{
		?>
        <style>
            #form1 table {
                width: 100%;
                /*background-color: #c29ae1;*/
            }

            table caption {
                color: white;
                font-size: 16px;
                font-family: "Helvetica Neue";
                padding: 1em 0 1em 0;
            }

            #form1 input {
                width: 100%;
                padding: 1em 0 1em 0;
                border: 1px black solid;
                font-size: 14px;
            }

            #form1 select {
                width: 100%;
                padding: 1em 0 1em 0;
                border: 1px black solid;
                font-size: 14px;
            }

            #form1 button {
                width: 100%;
                padding: 1em 0 1em 0;
                background-color: whitesmoke;
                color: #8925bd;
                font-size: 22px;
                font-weight: bold;
            }

            #form1 a {
                color: white;
                font-weight: bold;
                font-size: 16px;
                text-decoration: none;
                text-align: center;
                line-height: 50px;
            }
        </style>
        <script type="application/javascript">
            var gender = "";
            $(document).ready(function () {
                if ($(this).width() >= 1024) {
                    $("#form1").css("width", "40%");
                    $("#form1").css("margin", "8px auto");
                }

                $("#createaccountbtn").click(function () {
                    gender = $("#gender option:selected").val();
                    $("#form1").on('submit', function (event) {
                        event.preventDefault();
                        if (gender !== "-1") {
                            $.ajax({
                                url: "include/account/create.php",
                                type: "post",
                                data: $("#form1").serialize(),
                                success: function (m) {
                                    //console.log(m);
                                    if (m === "SUCCESS") {
                                        $("#form1").fadeOut(function () {
                                            location = "home";
                                        });
                                    }
                                }
                            });
                        } else {
                            alert("Select your gender.")
                        }
                    });

                });

            });
        </script>
        <table id="loadingscreen">
            <tr>
                <td>
                    <div class="title" style="display: block;">SpiritLyft</div>
                </td>
            </tr>

            <tr style="background-color: #8925bd;">
                <td colspan="1" style="text-align: center;">
                    <img src="image/loadinganimation.gif" width="200"/>
                </td>
            </tr>
        </table>
        <div class="body">
            <form id="form1" enctype="multipart/form-data" method="post">
                <table>
                    <tr>
                        <td colspan="2">
                            <div class="title" style="display: block; width: 100%;">SpiritLyft</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" placeholder="First Name" id="firstname" name="firstname" required/>
                        </td>
                        <td>
                            <input type="text" placeholder="Last name" id="lastname" name="lastname" required/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="text" placeholder="Email" id="email" name="email" required/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="text" placeholder="Phone Number" id="phonenumber" name="phonenumber" required/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="password" placeholder="Create Password" id="password" name="password"
                                   required/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <select id="gender" name="gender">
                                <option value="-1" selected>Select your Gender (Click Here)</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input id="bithdate" name="birthdate" placeholder="Birthday e.g (mm/dd/yyyy)" required/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <Button id="createaccountbtn">Create Account</Button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <a href="login" style="font-family: 'Helvetica Neue'">Already have a account
                                (click here)</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
		<?php
	}

	public static function loginpage()
	{
		?>
        <style>
            #form1 table {
                width: 100%;
            }

            table caption {
                color: white;
                font-size: 16px;
                font-family: "Helvetica Neue";
                padding: 1em 0 1em 0;
            }

            #form1 input {
                width: 100%;
                padding: 1em 0 1em 0;
                border: 1px black solid;
                font-size: 14px;
            }

            #form1 select {
                width: 100%;
                padding: 1em 0 1em 0;
                border: 1px black solid;
                font-size: 14px;
            }

            #form1 button {
                width: 100%;
                padding: 1em 0 1em 0;
                background-color: whitesmoke;
                color: #8925bd;
                font-size: 22px;
                font-weight: bold;
            }

            #form1 a {
                color: white;
                font-weight: bold;
                font-size: 16px;
                text-decoration: none;
                text-align: center;
                line-height: 50px;
            }
        </style>
        <script type="application/javascript">
            $(document).ready(function () {

                if ($(this).width() >= 1024) {
                    $("#form1").css("width", "40%");
                    $("#form1").css("margin", "8px auto");
                }

                $("#loginbtn").click(function () {
                    $("#form1").on('submit', function (event) {
                        event.preventDefault();

                        $.ajax({
                            url: "include/account/login.php",
                            type: "post",
                            data: $("#form1").serialize(),
                            success: function (m) {
                                console.warn(m);
                                if (m === "SUCCESS") {
                                    $("#form1").fadeOut(function () {
                                        location = "home";
                                    });
                                } else {
                                    alert("Login information appears to be incorrect.");
                                }
                            }

                        });
                    });

                });
            });
        </script>
        <table id="loadingscreen">
            <tr>
                <td>
                    <div class="title" style="display: block;">SpiritLyft</div>
                </td>
            </tr>

            <tr style="background-color: color: #8925bd;">
                <td colspan="1" style="text-align: center;">
                    <img src="image/loadinganimation.gif" width="200"/>
                </td>
            </tr>
        </table>
        <div class="body">
            <form id="form1" enctype="multipart/form-data" method="post">
                <table>
                    <tr>
                        <td colspan="2">
                            <div class="title" style="display: block; width: 100%;">SpiritLyft</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="text" placeholder="Email or Mobile Number" id="email" name="email" required/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="password" placeholder="Insert Password" id="password" name="password"
                                   required/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <Button id="loginbtn">LOGIN</Button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <a href="./" style="font-family: 'Helvetica Neue'; text-align: center;">Create New Account
                                (click here)</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
		<?php
	}

	public static function home()
	{
		home::autoload();
	}

	public static function friendspl()
	{
		friends::header();


	}

	public static function profile()
	{
		require_once "profile.php";
	}

	public static function myprofile()
	{
		myprofile::autoload();
	}

	public static function editprofile()
	{
		myprofile::edit();
	}

	public static function privacy()
	{
		require_once "privacy.php";
	}

	public static function termsconditions()
	{
		require_once "terms&condition.php";
	}

	public static function error_page()
	{
		require_once "error.php";
		$ep = new SL_ERROR();

		$ep::error_page();
	}

	public static function events()
	{
		events_inc::header();
		events_inc::event_page();
	}

	public static function birthday()
	{
		events_inc::header();
		events_inc::birthday_page();
		events_inc::birthday_list();
	}

	public static function calander()
	{
		events_inc::header();
		events_inc::calander_page();
	}

	public static function postview()
	{
		require "postsview.php";
	}

	public static function message(){
        require "message.php";
    }

	public static function footer()
	{
		?>
        <footer class="footer"
                style="color: white; font-size: 16px; font-weight: bold; font-family: 'Helvetica Neue'; text-align: center; float: left; width: 100%;">
            Cre8-ADate &copy; 2019
        </footer>
		<?php
	}

}
