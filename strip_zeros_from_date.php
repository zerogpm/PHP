<?php
/**
 * Created by PhpStorm.
 * User: Jian Su
 * Date: 7/6/2015
 * Time: 9:35 PM
 */

//$date = date_create('now');
//echo $now = date_format($date, 'Y-m-d H:i:s')."<br/>";

$timeStamp = time();
echo $now = strftime("The date today is %m/%d/%y", $timeStamp) . "<br/>";

function strip_zeros_from_date($marked_string="") {
    //remove the marked zeros
    $no_zeros = str_replace('0', '', $marked_string);
    return $no_zeros;
}

echo strip_zeros_from_date($now);

echo "<hr/>";

$dateTime = time();
echo $mysql_datetime = strftime("%Y-%m-%d %H:%M:%S", $dateTime);