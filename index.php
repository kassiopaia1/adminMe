<?php
//start the session, must be at the first place
session_start();


include('./includes/functions.php');
include('./includes/htmlcontent.php');

//read the url, if it says ?logout=1 then logout
if (isset($_GET['logout']))
logout();
//if it says ?signup=1
if (isset($_GET['signup']))
signup();

getHTMLHead();
getHeader();
getSidebar();
getContent();
getFooter();
?>

