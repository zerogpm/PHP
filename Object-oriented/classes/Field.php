<?php
/**
 * Created by PhpStorm.
 * User: Jian Su
 * Date: 8/4/2015
 * Time: 8:48 AM
 */
class Field {

    public $type;
    public $name;

    public function __construct($type, $name) {
        $this->type = $type;
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function getTag() {
        $html = "<input";
        $html .= " type=\"$this->type\"";
        $html .= " name=\"$this->name\"";
        $html .= ">";
        return $html;
    }

}