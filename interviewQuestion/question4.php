<?php
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
function parseLogStats($log, $UserName) {

    $UserStats = array(

        "Entries"		=> (int) 0,
        "Exits"			=> (int) 0,
        "StillHere"		=> (bool) false,
        "TotalMessages"	=> (int) 0
    );

    if (!is_string($log)) { die(); }

    $LogArray = preg_split("/\r\n|\n|\r/", $log);


    //Get the number of times $username left or entered the room
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


    //Decide if the user is still in the room or not
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