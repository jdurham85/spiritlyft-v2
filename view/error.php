<?php

/**
 * .
 * User: Jermaine Durham
 * Date: 7/3/18
 * Time: 7:31 AM
 */

class SL_ERROR
{
	public function __construct()
	{
		?>
        <style>
            #errorpanel {
                background-color: whitesmoke;
                float: left;
                padding: 1em;
                width: 100%;
            }
        </style>
		<?php
	}

	public static function error_page()
	{
		//require "inner_header.php";
		?>
        <div id="errorpanel">The page you have request is not available at the moment, try again later.
            <a href="home" target="_self">Click here to leave</a>
        </div>
		<?php
	}
}