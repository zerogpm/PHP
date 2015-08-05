<?php
/**
 * Created by PhpStorm.
 * User: Jian Su
 * Date: 7/29/2015
 * Time: 7:59 AM
 */

class Form {
    protected  $elements = [];
    protected $name;
    public $valid = false;

    public function getStartTag($attributes = null) {
        if(!$attributes) return '<form>';
        $tag = '<form';
        foreach($attributes as $key => $value) {
            $tag .= " $key=\"$value\"";
        }
        $tag .= '>';
        return $tag;
    }

    public function getEndTag() {
        return '</form>';
    }

}



