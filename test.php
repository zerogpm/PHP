<?php



$people = array(
    ["Name" => "Chris"],
    ["Name" => "Ada"]
);

var_dump($people);

array_multisort($people, SORT_ASC,SORT_STRING);



$sorted = [];
for($i = 0; $i < count($people); $i++) {
    $sorted[$i] = $people[$i];
}

var_dump($sorted);