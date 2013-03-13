<?php
$username = 'root';
$password = '';
$hostname = 'localhost';
$db = 'weddingevents';

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
or die("Unable to connect to MySQL");

//chon lay data can su dung
mysql_select_db($db);

?>