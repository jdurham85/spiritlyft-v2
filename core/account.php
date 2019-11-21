<?php

namespace core;

use model\profiled;

class account
{
	function __construct()
	{
		self::style();
		self::js();
		?>
        <div id="accountsettingtitle">Account Setting</div>
		<?php
	}

	private static function style()
	{
		?>
        <style>
            #accountsettingtitle{
                background-color: white;
                margin-top: 4px;
                border-radius: 4px;
                padding: .5em;
                float: left;
                width: 100%;
                font-weight: bolder;
            }
        </style>
		<?php
	}

	private static function js()
	{
		?>
		<?php
	}

	public static function setting()
	{
		$parentid = config::get_member_id();
		?>
        <div class="editprofilepl boxstyle" style="width: 100%; font-size: 14px; padding: 1em; float: left;">
            <table style="width: 100%; float: left;">
                <tr style="margin: 10px auto;">
                    <td style="width: 50%; font-weight: bold;">
                        Name
                    </td>
                    <td style="width: 50%; text-align: right;">
                        <a href="javascript:void(0);">Change</a>
                    </td>
                </tr>

                <tr style="margin: 10px auto; border-top: 1px lightgray solid; color: darkgray; font-size: 12px;
                width: 50%; text-align:
                 left;">
                    <td>
                        Your Real Name.
                    </td>
                    <td style="text-align: right;">
						<?php echo profiled::MemberFullName($parentid); ?>
                    </td>
                </tr>
            </table>
            <table>
                <tr style="margin: 8px auto;">
                    <td style="width: 50%; font-weight: bold;">
                        Email
                    </td>
                    <td style="width: 50%; text-align: right;">
                        <a href="javascript:void(0);">Change</a>
                    </td>
                </tr>
                <tr style="margin: 4px auto; border-top: 1px lightgray solid; color: darkgray; font-size: 12px;
                width: 50%; text-align:
                 left;">
                    <td>
                        Your Email.
                    </td>
                    <td style="text-align: right;">
						<?php echo profiled::MemberEmail($parentid); ?>
                    </td>
                </tr>
            </table>

            <table>
                <tr style="margin: 10px auto;">
                    <td style="width: 50%; font-weight: bold;">
                        Change your password
                    </td>
                    <td style="width: 50%; text-align: right;">
                        <a href="javascript:void(0);">Change</a>
                    </td>
                </tr>
                <tr style="margin: 10px auto; border-top: 1px lightgray solid; color: darkgray; font-size: 12px;
                width: 50%; text-align:
                 left;">
                    <td>
                        Current Password
                    </td>
                    <td style="text-align: right;">
                        ******
                    </td>
                </tr>

            </table>
            <table>
                <tr style="margin: 10px auto;">
                    <td style="width: 50%; font-weight: bold;">
                        Birthday
                    </td>
                    <td style="width: 50%; text-align: right;">
                        <a href="javascript:void(0);">Change</a>
                    </td>
                </tr>
                <tr style="margin: 10px auto; border-top: 1px lightgray solid; color: darkgray; font-size: 12px;
                width: 50%; text-align:
                 left;">
                    <td>
                        Your Current Birthday
                    </td>
                    <td style="text-align: right;">
						<?php echo profiled::MemberBirthday($parentid); ?>
                    </td>
                </tr>
            </table>
            <!--table>
                <tr style="margin: 8px auto;">
                    <td style="font-weight: bold;">
                        Security Question
                    </td>
                </tr>

                <tr style="margin: 4px auto; border-top: 1px lightgray solid; color: darkgray; font-size: 12px;
                width: 50%; text-align:
                 left;">
                    <td>
                        To Identify you as the account owner
                    </td>
                    <td style="text-align: right;">
                        <a href="javascript:void(0);">Change</a>
                    </td>
                </tr>
            </table-->
            <table>

                <tr style="margin: 8px auto;">
                    <td style="font-weight: bold;">
                        Deactivate Account
                    </td>
                    <td style="text-align: right;">
                        <a href="javascript:void(0);">Deactivate</a>
                    </td>
                </tr>
            </table>
        </div>
		<?php
	}
}