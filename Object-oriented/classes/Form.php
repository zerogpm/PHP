<?php
/**
 * Created by PhpStorm.
 * User: Jian Su
 * Date: 7/29/2015
 * Time: 7:59 AM
 */

class Form {
    const NAME = 'StdForm';
    protected  $elements = [];
    public $name;
    public $valid = false;
    public $key;
    public $id;
    public $fields;
    public $db;

    public function __construct($name, $id, array $fields = null) {
        $this->name = $name;
        $this->id = $id;
        if($fields) {
            $this->fields = $fields;
        }
    }

    public function __destruct() {
        $this->db = null;
        echo 'Cleanup duty is finished';
    }


    public function getStartTag() {
        return "<form name=\" $this->name\" id=\" $this->id\">";
    }

    public function getEndTag() {
        return '</form>';
    }

    public function getFields() {
        return $this->fields;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function set($property, $value = null) {
        $this->$property = $value;
    }

    public function setFormAttribs($attribs) {
        foreach($attribs as $key => $value){
            $this->$key = $value;
        }
    }

    public function setId($setId) {
        $this->id = $setId;
        return $this;
    }

}



