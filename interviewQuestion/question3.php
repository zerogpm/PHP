<?php

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

        $objects = [];
        //counter
        $counter = count($logFile);
        for($x = 0; $x < $counter; $x++) {
            $posForSpace = strpos($logFile[$x], ' ');
            $posForCode200 = strpos($logFile[$x], '200');
            $ip = substr($logFile[$x], 0,$posForSpace);
            $code = substr($logFile[$x], $posForCode200, 3);
            echo $code . "<br/>";

        }

    } else {
        echo 'Error: unable to open file ' . $fileName;
    }
}

analyzeAccessLog('accesslog');