<?php
$host="localhost"; // Host name 
$username="test"; // Mysql username 
$password="1234"; // Mysql password 
$db_name="test"; // Database name 
$tbl_name="user"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

?>
