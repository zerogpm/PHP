<?php
/**
 * Created by PhpStorm.
 * User: Jian Su
 * Date: 8/3/2015
 * Time: 10:07 AM
 */

require 'classes/Form.php';
require 'classes/Field.php';

$type = 'text';
$name = 'username';
$fields[] = new Field($type,$name);

$name = 'password';
$type = 'password';
$fields[] = new Field($type,$name);

$name = 'login';
$id = 'Form1';
$form = new Form($name, $id, $fields);

echo $form->getStartTag() . PHP_EOL;
foreach($form->getFields() as $field) {
    echo ucfirst($field->getName()) . ': ' . $field->getTag() . PHP_EOL;
}

echo $form->getEndTag();