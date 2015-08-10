<?php
/**
 * Created by PhpStorm.
 * User: Jian Su
 * Date: 8/5/2015
 * Time: 2:30 PM
 */

class StringLengthValidator {
    public static $minimum;
    public static $maximum;

    public static function validate($value = null) {
        if(!is_string($value) || !self::$minimum || !self::$maximum)
            return false;

        $length = strlen($value);
        if($length < self::$maximum && $length > self::$minimum) {
            return true;
        }
    }

    public static function setMinimum($value) {
        self::$minimum = $value;
    }

    public static function setMaxium($value) {
        self::$maximum = $value;
    }
}