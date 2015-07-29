<?php
/**
 * Created by PhpStorm.
 * User: Jian Su
 * Date: 7/29/2015
 * Time: 7:59 AM
 */

$var = 1;

function testone() {
    $var  = 2;
    echo $var;
}

testone();

echo $var;