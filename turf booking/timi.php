<?php

date_default_timezone_set('Asia/Kolkata');
// Get the current time in 12-hour format with AM/PM
$current_time = date('H:i'); // 'H' for 24-hour format, 'i' for minutes
echo  "$current_time <br>". strtotime('15:00');

     if(strtotime('15:00') > strtotime($current_time))
     {
        echo"hi sir";
     }

     
/*

date_default_timezone_set('Asia/Kolkata');

// Get the current time in 24-hour format
$current_time = date('H:i'); // 'H' for 24-hour format, 'i' for minutes
echo "Current time: $current_time <br>";

$comparison_time = '15:00';

if (strtotime($comparison_time) > strtotime($current_time)) {
    echo "Comparison time ($comparison_time) is greater than current time ($current_time).<br>";
    echo "hi sir";
} else {
    echo "Comparison time ($comparison_time) is not greater than current time ($current_time).<br>";
}
*/
?>

