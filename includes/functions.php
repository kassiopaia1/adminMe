<?php
session_start();

function validateUser($userid){
	session_regenerate_id (); //this is a security measure
	$_SESSION['valid'] = 1;
	$_SESSION['userid'] = $userid;
}

function isLoggedIn(){
	if($_SESSION['valid']){
		return true;
	}else{
		return false;
	}
}

function logout(){
	$_SESSION = array(); //destroy all of the session variables
	session_destroy();
}

function signup(){
	
}

?>
