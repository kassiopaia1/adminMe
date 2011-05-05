<?php 

// Script to zip or backup a folder
// 2011 (c) by Kassiopaia
// Fore more interesting Tools/Scripts/Hacks visit
// http://www.kassiopaia.ch
// use it, but let me know me'at'kassiopaia.ch

//gimme the folder you want to backup
//example http://mydomain.tld/zip.php?dir=mydirectory
//$dir = $_GET['dir'];
//or define a fix path
$dir = '/home/kassiopa/www/kassiopaia.ch/blog/';

//include the awesome zip library
include("zip.lib.php");

//some definitions to make
$savedir = '/home/kassiopa/www/kassiopaia.ch/secure/';
$zipfilename = date('Ymd').'_'.$dir.'_backup.zip';

//create a zipfile
$zip = new zipfile();

//declaring an array for storing all files to be zipped 
$allFiles = array();

listFilesInDir($dir);

//some nice recursion
function listFilesInDir($directory){
	global $allFiles;
	$files = scandir($directory);
	foreach ($files as $file){
		if (is_dir($directory.'/'.$file)){
			if ($file == '.' || $file == '..'){
				//do nothing
			}else{
				listFilesInDir($directory.'/'.$file);
			} 
		} else {
				echo 'now adding '.$directory.'/'.$file.'<br>';
				array_push($allFiles, $directory.'/'.$file);
		}
}
}

//Show all files
//print_r($allFiles);

//Add all Files to the zip file
$zip->addFiles($allFiles);

//Save the zip file
$zip->output($savedir.$zipfilename);

//send a notification with some information to the admin
notifyAdmin();

//Send a message to the Admin
function notifyAdmin(){
	//generating some information
	global $savedir;
	global $zipfilename;
	$size = filesize($savedir.$zipfilename);
	if ($size<1000){
		$attribute='Bytes';
	} else if ($size>=1000 && $size<1000000){
		$attribute='KB';
		$size = round($size/1000, 2);
	} else if ($size>=1000000){
		$attribute='MB';
		$size = round($size/1000000, 2);
	}
	global $dir;
	
	$to = "kassiopaia@gmail.com";
 	$subject = "Backup successful";
 	$body = "The following zip file has been created:\nRoot directory: ".$dir." \nSize:".$size.' '.$attribute.' \nDate created: '.date('d.m.Y');
	//	echo $body;
 	$headers = "From: system@yourdomain.tld\r\n" .
    "X-Mailer: php";
 if (mail($to, $subject, $body, $headers)) {
   echo("<p>Mail has been sent!</p>");
  } else {
   echo("<p>Message delivery failed...</p>");
  }
}

?>