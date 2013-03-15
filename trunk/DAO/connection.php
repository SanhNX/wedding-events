<?php
$username = 'root';
$password = '';
$hostname = 'localhost';
$db = 'weddingevents';

$dbhandle = mysql_connect($hostname, $username, $password)
or die("Unable to connect to MySQL");


mysql_select_db($db);
mysql_query("SET NAMES 'utf8'", $dbhandle);

?>