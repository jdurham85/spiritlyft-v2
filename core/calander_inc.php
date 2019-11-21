<?php

/**
 * Created by PhpStorm.
 * User: jermainedurham
 * Date: 10/8/18
 * Time: 5:25 PM
 */

namespace core;
class calander_inc
{
	function __construct()
	{
		self::make_calander();
	}

	private static function make_calander()
	{
		$date = time();
		$day = date('d', $date);
		$month = date('m', $date);
		$year = date('Y', $date);

		if (isset($_GET['month']) && isset($_GET['day']) && isset($_GET['year'])) {
			$month = $_GET['month'];
			$day = $_GET['day'];
			$year = $_GET['year'];
		}

		$month_names = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

		if ($month != 10) {
			$selected_month = str_replace("0", "", $month) - 1;
		} else {
			$selected_month = 9;
		}

		?>
        <script type="text/javascript">
            var month, day, year;

            month = <?php print $month; ?>;
            day = <?php print $day; ?>;
            year = <?php print $year; ?>;

            function previous_month() {
                month--;
            }

            function next_month() {
                month++;
            }

            function today_date() {

            }

        </script>
        <table id="calender_tb" class="boxstyle">
            <tr id="month_title">
                <td colspan="7"><?php echo $month_names[$selected_month] . "  " . date("d") . ",  " . $year; ?></td>
            </tr>
            <tr style="display: none;">
                <td colspan="7">
                    <table style="width: 100%; float: left;">
                        <tr align="center">
                            <td width="10%">
                                <button class="btn btn-secondary" style="width: 100%;"><</button>
                            </td>
                            <td width="80%">
                                <button class="btn btn-primary" style="width: 100%;">Today</button>
                            </td>
                            <td width="10%">
                                <button class="btn btn-secondary" style="width: 100%;">></button>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr align="center" class="daysoftheweek" style="font-weight: bold;">
                <td>
                    Sun
                </td>
                <td>
                    Mon
                </td>
                <td>
                    Tue
                </td>
                <td>
                    Wed
                </td>
                <td>
                    Thu
                </td>
                <td>
                    Fri
                </td>
                <td>
                    Sat
                </td>
            </tr>

		<?php

		$first_day = mktime(0, 0, 0, $month, 1, $year);

		$day_of_week = date('D', $first_day);

		switch ($day_of_week) {
			case "Sun":
				$blank = 0;
				break;
			case "Mon":
				$blank = 1;
				break;
			case "Tue":
				$blank = 2;
				break;
			case "Wed":
				$blank = 3;
				break;
			case "Thu":
				$blank = 4;
				break;
			case "Fri":
				$blank = 5;
				break;
			case "Sat":
				$blank = 6;
				break;
		}

		$day_in_month = cal_days_in_month(0, $month, $year);

		echo "<tr>";

		$day_count = 1;
		while ($blank > 0) {
			echo "<td height='' style=''></td>";
			$blank = $blank - 1;
			$day_count++;
		}

		$day_num = 1;

		while ($day_num <= $day_in_month) {

			if (date("F j, Y") == $month_names[$selected_month] . " " . $day_num . ", " . $year) {
				echo "<td height='' width='' style='border: 2px solid black; background-color: yellow; text-align: center; font-size: 20px; font-weight: bold;'>" . $day_num . "</td>";
			} else {
				echo "<td height='' width='' style='border: 2px solid black; text-align: center; font-size: 20px; font-weight: bold;'>" . $day_num . "</td>";
			}


			$day_num++;
			$day_count++;

			if ($day_count > 7) {
				echo "</tr>";
				$day_count = 1;
			}
		}
	}

}