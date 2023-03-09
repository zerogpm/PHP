<?php
/**
 * Created by PhpStorm.
 * User: Jian Su
 * Date: 7/29/2015
 * Time: 7:19 AM
 */
echo "Server details: <br/>";
echo "Server Name : " . $_SERVER['SERVER_NAME'] . "<br/>";
echo "Server Address : " . $_SERVER['SERVER_ADDR'] . "<br/>";
echo "Server Port Number : " . $_SERVER['SERVER_PORT'] . "<br/>";
echo "Document Root : " . $_SERVER['DOCUMENT_ROOT'] . "<br/>";
#echo "PHP File Location : " . $_SERVER['PHP_SELF'] . "<br/>";
echo "Script Full Path : " . $_SERVER['SCRIPT_FILENAME'] . "<br/>";
echo "Server Name : " . $_SERVER['SERVER_NAME'] . "<br/><br/>";

echo "Request details : <br/>";
echo "Remote address : " . $_SERVER['REMOTE_ADDR'] . "<br/>";
echo "Remote Port Number : " . $_SERVER['REMOTE_PORT'] . "<br/>";
echo "Remote URL : " . $_SERVER['REQUEST_URI'] . "<br/>";
echo "QUERY_STRING : " . $_SERVER['QUERY_STRING'] . "<br />";
echo "HTTP_USER_AGENT : " . $_SERVER['HTTP_USER_AGENT'] . "<br />";
echo "REQUEST_TIME : " . $_SERVER['REQUEST_TIME'] . "<br /><br/>";

echo "<a href='http://php.net/manual/en/reserved.variables.server.php'>Server variables name</a>";
