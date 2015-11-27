<?php

$hours = 8.08;
$totalMins = $hours * 60;
$hours = intval($totalMins / 60);
$mins = $totalMins - ($hours * 60);
echo round($mins);