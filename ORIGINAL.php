<?php
// File name: I:\WRWIS\Projects\KWA Database\KWA Database\ORIGINAL.php
// Created by 譔Ä譠Ä赔ÄຌÅౌÅຘÅ౰Åo   http://dbconvert.com
//---------------------------------------------------------

// Increasing maximum execution time of the script.
set_time_limit(120);

$dbName = 'KWA';// Database name.
$userName = 'root';// User name.
$userPass = '';// Password.
$hostName = 'localhost:3306';// Server name

// Connecting to MySQL server.
echo 'Connecting to MySQL server.';
$dbConnect = mysql_connect($hostName, $userName, $userPass);
if (!$dbConnect)  {
	echo 'Error: '.mysql_error();
	exit;
}
if (!mysql_select_db($dbName, $dbConnect )) {
	echo 'Error: '.mysql_error();
	exit;
}

?>

