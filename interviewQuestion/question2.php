<?php

/**
 * Find two closest objects by distance.
 *
 *
 * @param array $objects The list of objects with the name and coordinates.
 * @return array The closest objects names.
 *
 * An example:
 *     php> $obj1 = ['name' => 'a', 'x' => 1, 'y' => 1];
 *     php> $obj2 = ['name' => 'b', 'x' => 1, 'y' => 2];
 *     php> $obj3 = ['name' => 'c', 'x' => 10, 'y' => 10];
 *     php> = findClosest([$obj1, $obj2, $obj3])
 *     array(
 *       0 => "a",
 *       1 => "b",
 *     )
 */

$obj1 = ['name' => 'a', 'x' => 1, 'y'  => 1];
$obj2 = ['name' => 'b', 'x' => 1, 'y'  => 2];
$obj3 = ['name' => 'c', 'x' => 10, 'y' => 10];
$objects = [$obj1, $obj2, $obj3];


function findClosest(array $objects)
{
    $obj1 = $objects[0];
    $obj2 = $objects[1];
    $obj3 = $objects[2];

}

findClosest($objects);