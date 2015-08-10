<?php
/**
 * Created by PhpStorm.
 * User: Jian Su
 * Date: 7/29/2015
 * Time: 7:59 AM
 */



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

formatByPosition('Hello {0} {1} times!', 'world', 5);


