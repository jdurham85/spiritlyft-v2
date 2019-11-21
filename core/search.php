<?php

namespace core;

use model\database;
use model\profiled;

class search
{

	public static function _header()
	{
		$countrycode = profiled::MemberCountry(config::get_member_id())['id'];
		$statecode = profiled::MemberRegion(config::get_member_id())['id'];
		$cityname = profiled::MemberCity(config::get_member_id())['name'];
		?>
        <link rel="stylesheet" href="style/search.css">
        <script src="js/search_.js"></script>
        <script type="text/javascript">
            countrycode = '<?php echo($countrycode != null ? $countrycode : 230); ?>';
            statecode = '<?php echo $statecode; ?>';
            cityname = '<?php echo $cityname; ?>';
            setMemberLocation();
        </script>
        <table id="search_mode_tb" class="boxstyle">
            <tr>
                <td class="search_mode_btn boxstyle">
                    Friends
                </td>
                <td class="search_mode_btn boxstyle">
                    Events
                </td>
            </tr>
        </table>
        <table id="searchtitle" class="boxstyle">
            <tr>
                <td style="text-align: center;">Search</td>
                <td style="width: 85%;">
                    <input type="text" id="search_input" onkeyup="search_user_input();" placeholder="Type something
                here..."/>
                </td>
            </tr>
        </table>
        <div id="searchadvancebtn" onclick="showsearchadvanctb(this);">Advance Search</div>
        <table id="searchadvancetb" class="boxstyle">
            <tr>
                <td>
                    Country
                </td>
                <td>
                    <select id="scountry">
						<?php database::getCountry(); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    State
                </td>
                <td>
                    <!--input type="text" placeholder="e.g NC" id="sstate" /-->
                    <select id="sstate">
						<?php
						if ($countrycode != null) {
							profiled::getRegion($countrycode);
						} else {
							profiled::getRegion(230);
						}
						?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    City
                </td>
                <td>
                    <input type="text" onkeyup="fetch_city_name(this);" placeholder="<?php echo $cityname; ?>"
                           id="scity"/>
                    <div id="search_city_box" class="boxstyle">

                    </div>
                </td>
            </tr>
        </table>
        <div id="search_pl"></div>
		<?php
	}
}
