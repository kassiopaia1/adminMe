<?php
include('settings.php');


// Connect to server and select databse.
function mysql_connecter() {
	mysql_connect("$host", "$username", "$password") or die("cannot connect");
}

mysql_select_db("$db_name") or die("cannot select DB");
?>
