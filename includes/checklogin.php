<?php
include('../includes/sql.php');
include('../includes/functions.php');

ob_start();

// Define $myusername and $mypassword
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

// To protect MySQL injection
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);

$encryptedpassword = md5($mypassword);

$sql = "SELECT * FROM $tbl_name WHERE username='$myusername' and password='$encryptedpassword'";
$result = mysql_query($sql);

$userData = mysql_fetch_array($result, MYSQL_ASSOC);

/* if(mysql_num_rows($result) < 1) //no such user exists
 {
 echo "bad user";
 }
 else if (md5($mypassword) != $userData['encryptedpassword']) //incorrect password
 {
 echo "bad pass";
 }
 */

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
	// Register $myusername, $mypassword and redirect to file "login_success.php"
	//session_regenerate_id (); //this is a security measure
	validateUser($myusername);
	header("location:../index.php");

}
else {
	echo "Wrong Username or Password";
}

ob_end_flush();
?>
