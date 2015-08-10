<?php


##
#	Programming
#		- Please complete the following functions.
#		- Please test your work.
##


/**
 * Format the arguments based on a position.
 *
 * @param string $fmt The format string.
 * @return string The formatted string.
 *
 * An example:
 *     php> = formatByPosition('Hello {0} {1} times!', 'world', 5)
 *     'Hello world 5 times!'
 */
function formatByPosition($fmt, $words, $num)
{
	//value need to be Worked with
	$formatString   = $fmt;
	$replaceNumber  = $num;
	$replaceWords   = $words;

	//values to search for
	$searchValue1 = "{0}";
	$searchValue2 = "{1}";

	//replace the values we just passed in
	$text1 = str_replace($searchValue1, $replaceWords, $formatString);
	$text2 = str_replace($searchValue2, $replaceNumber, $text1);
	echo $text2;
}



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
	//Three point Coordinates
	$Point_A_X_Coordinate = $objects[0]['x'];
	$Point_A_Y_Coordinate = $objects[0]['y'];

	$Point_B_X_Coordinate = $objects[1]['x'];
	$Point_B_Y_Coordinate = $objects[1]['y'];

	$Point_C_X_Coordinate = $objects[2]['x'];
	$Point_C_Y_Coordinate = $objects[2]['y'];

	//Calculate Distance Between Point A to Point C
	//According to Pythagorean theorem, if the length of both a and b are known, then c can be calculated as
	$AC_Distance = sqrt(pow($Point_C_X_Coordinate - $Point_A_X_Coordinate, 2) + pow($Point_C_Y_Coordinate - $Point_A_Y_Coordinate,2));

	//keep 2 decimal digits
	$RoundedAC_Distance = round($AC_Distance, 2);

	//Calculate Distance Between Point B to Point C
	$BC_Distance = sqrt(pow($Point_C_Y_Coordinate - $Point_B_Y_Coordinate, 2) + pow($Point_C_X_Coordinate - $Point_B_X_Coordinate,2));

	$RoundedBC_Distance = round($BC_Distance,2);

	$AB_Distance = $Point_B_Y_Coordinate - $Point_A_Y_Coordinate;

	//find the Closest Distance
	if($AB_Distance < ($RoundedBC_Distance + $RoundedAC_Distance)) {
		return [
			0 => "a",
			1 => "b"
		];
	} elseif ($RoundedAC_Distance < ($RoundedBC_Distance + $AB_Distance)) {
		return [
			0 => "a",
			1 => "c"
		];
	} elseif ($RoundedBC_Distance < ($RoundedAC_Distance + $AB_Distance)) {
		return [
			0 => "b",
			1 => "c"
		];
	}

}



/**
 * Analyze the HTTP access log and calculate the percentage of failed requests.
 *
 * Please feel free to analyze the string instead of opening a file.
 * If you do analyze the string, show how you would open files.
 *
 * NOTE: assume only 200 and 404 error codes,
 * but you may want to add support for other codes.
 *
 * Sample access log content:
 * <pre>
 * 192.168.2.20 - - [28/Jul/2006:10:27:10 -0300] "GET /try/ HTTP/1.0" 200 3395
 * 127.0.0.1 - - [28/Jul/2006:10:22:04 -0300] "GET / HTTP/1.0" 200 2216
 * 127.0.0.1 - - [28/Jul/2006:10:27:32 -0300] "GET /hidden/ HTTP/1.0" 404 7218
 * </pre>
 *
 * @param string $fileName The path to the log file.
 * @return array The list of IP with the ratio.
 *
 * An example:
 *     php> = analyzeAccessLog('/var/log/httpd/access_log')
 *     array(
 *       "127.0.0.1" => 0.5,
 *       "192.168.2.20" => 0,
 *     )
 */
function analyzeAccessLog($fileName)
{
	$logFile = file($fileName);
	//test to see if the file is ok
	if($logFile) {
		//to hold IP and code number
		$ip   = [];
		$code = [];

		$length = count($logFile);

		for($i = 0; $i < $length; $i++) {
			//extract ip address from text file
			if(preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/', $logFile[$i], $ip_matches)) {
				$ip[$i] = $ip_matches;
			}

			//extract error code from text file,I got stucked at wrting a good regular expression at this point
			if(preg_match('/ 200 /', $logFile[$i], $ip_matches)) {
				$code[$i] = $ip_matches;
			}
		}

		$ips = array_column($ip, 0);
		//unable to finish this...I think I am getting there.

	} else {
		echo 'Error: unable to open file ' . $fileName;
	}
}



##
#	Debugging & Refactoring
# 		- Please debug the following function, using the included data set
#		- Offer some brief thoughts about what was broken.
#		- Offer some brief thoughts about the quality of the code.
#		- When you're finished, try refactoring the code to make it better.
#		- Make a new function to do this with, parseLogStats2 if you like.
#		- Try to explain why you made some of the changes.
#
##

/*
//sample data set
$message =
"[Notice][Todd] has entered the room
[Notice][Todd] has exited the room
[Notice][Todd] has entered the room
[Message][Todd] wrote a 7 character message
[Message][Ben] wrote a 17 character message
[Message][Ben] wrote a 2 character message
[Notice][Todd] has exited the room
[Notice][Ben] has exited the room
[Notice][Todd] has entered the room
[Notice][Todd] has exited the room
[Notice][Todd] has entered the room";
 */
//var_dump(parseLogStats($message, "Todd"));


/**
 * This function parses text from a log file to determine some simple chat stats about a given user.
 *
 * @param string $log The string of log text to analyze.
 * @param string $UserName The user for who we want stats from
 * @return array
 *
 * It counts
 * 		the number of times they have exited the room,
 * 		the number of times they have entered the room,
 * 		and how many messages they have sent.
 *
 * In addition it attempts to determine whether they are still in the room or not.
 *
 * However, the function is very buggy. Most of the values it returns are wrong or simply incorrect.
 *
 * It even generates error messages when run on some servers.
 *
 * Using the example message, please find the bugs and correct them. Once you've debugged this code, you can also provide a refactored version.
 *
 */

/**
 * Problem 1: Line: 209  $x array index start at 0 and $x should be less length otherwise it will be array out of bounds
 * Problem 2: Line: 211 it is not reliable only check if (strpos($LogArray[$x], $UserName) !== FALSE)
 * Problem 3: Line: 225 if ($UserStats["Exits"] == $UserStats["Entries"]) logic error, if exit equal entries, there should be no people in the chat room!
 * Problem 4: Line: 225  There are some rare case when the log only has exit but no entries. we need to further check on this!
 * Problem 5: Line: 232 $:LogLine never used, also same issues like Problem 2
 */

//sample data set
$message =
	"[Notice][Todd] has entered the room
[Notice][Todd] has exited the room
[Notice][Todd] has entered the room
[Message][Todd] wrote a 7 character message
[Message][Ben] wrote a 17 character message
[Message][Ben] wrote a 2 character message
[Notice][Todd] has exited the room
[Notice][Ben] has exited the room
[Notice][Todd] has entered the room
[Notice][Todd] has exited the room
[Notice][Todd] has entered the room";

function parseLogStats($log, $UserName) {

	$UserStats = array(

		"Entries"		=> (int) 0,
		"Exits"			=> (int) 0,
		"StillHere"		=> (bool) false,
		"TotalMessages"	=> (int) 0
	);

	if (!is_string($log)) { die(); }

	$LogArray = preg_split("/\r\n|\n|\r/", $log);


	/** @var  $x array index start at 0 and $x should be less length otherwise it will be array out of bounds*/
	for ($x = 1; $x <= count($LogArray); $x++)
	{
		if (strpos($LogArray[$x], $UserName) !== FALSE)
		{
			if (strpos($LogArray[$x], "entered") !== FALSE)
			{
				$UserStats["Entries"] = $UserStats["Entries"] + 1;
			} else {
				$UserStats["Exits"] = $UserStats["Entries"] + 1;
			}

		}
	}


	/** logic error, if exit equal entries, there should be no people in the chat room! */
	if ($UserStats["Exits"] == $UserStats["Entries"])
	{
		$UserStats["StillHere"] = true;
	}


	//Count the number of messages sent by the user
	foreach ($LogArray as $LogLine)
	{
		if (strpos($LogArray[0], $UserName) !== FALSE)
		{
			$UserStats["TotalMessages"] = $UserStats["TotalMessages"] + 1;
		}
	}



	return $UserStats;

}

/**
 * @param $log
 * @param $UserName
 * @return array
 *
 *  since i know some key words will not change, I rather extract string words from Array and compare them.
 *  There are some rare case when the log only has exit but no entries. we need to further check on this!
 *
 */

function parseLogStats2($log, $UserName) {

	$UserStats = array(

		"Entries"		=> (int) 0,
		"Exits"			=> (int) 0,
		"StillHere"		=> (bool) false,
		"TotalMessages"	=> (int) 0
	);

	if (!is_string($log)) { die(); }

	$LogArray = preg_split("/\r\n|\n|\r/", $log);


	//Get the number of times $username left or entered the room
	$length             = count($LogArray);
	$userNameLength     = strlen($UserName);

	//compare key words with array value
	$entriesKeyWords    = "entered";
	$entriesKeyLength   = strlen($entriesKeyWords);

	$exitKeyWords       = "exited";
	$exitKeyWordsLength = strlen($exitKeyWords);

	$MessageKeyWords    = "message";
	$MessageLength      = strlen($MessageKeyWords);

	//Problem 1
	/** @var  $x array index start at 0 and $x should be less length otherwise it will be array out of bounds*/
	for ($x = 0; $x < $length; $x++)
	{

		if(substr($LogArray[$x], strpos($LogArray[$x], $UserName), $userNameLength) === $UserName) {
			//check if keyword 'entered' exist, then add 1 to associate array
			if(substr($LogArray[$x], strpos($LogArray[$x], $entriesKeyWords), $entriesKeyLength) === $entriesKeyWords) {
				$UserStats["Entries"]++;
			}

			//check if keyword 'exit' exist, then add 1 to associate array
			if(substr($LogArray[$x], strpos($LogArray[$x], $exitKeyWords), $exitKeyWordsLength) === $exitKeyWords) {
				$UserStats["Exits"]++;
			}

			//check if keyword message exist, then add 1 to associate array
			if(substr($LogArray[$x], strpos($LogArray[$x], $MessageKeyWords), $MessageLength) === $MessageKeyWords) {
				$UserStats["TotalMessages"]++;
			}
		}
	}

	//Decide if the user is still in the room or not
	if ($UserStats["Exits"] != $UserStats["Entries"])
	{
		//There are some rare case when the log only has exit but no entries. we need to further check on this!
		if($UserStats["Exits"] == 1 && $UserStats["Entries"] == 0) {
			$UserStats["StillHere"] = false;
		}else {
			$UserStats["StillHere"] = true;
		}

	}

	return $UserStats;

}






