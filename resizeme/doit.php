<?php

// Script to resize images in a subfolder
// 2010 (c) by Kassiopaia
// Fore more interesting Tools/Scripts/Hacks visit
// http://www.kassiopaia.ch
// use it, but let me know me'at'kassiopaia.ch


// trying to get the settings from the url
$dir = $_POST['dir'];
$h2 = $_POST['size'];
$dumpdir = $_POST['dumpdir'];
if ($dir == ""){
	exit();
}
// set default variables

// the log file
$logfile = "log.txt";
$logfile = fopen($logfile, 'a') or die("can't open logfile");

//writing some neat stuff to the logfile
fwrite($logfile, "Process started at: " . date("d.m.Y - G:i:s") . "\n");

// the dir to the pictures
fwrite($logfile, "Dir is set to:\t\t".$dir."\n");

// the dir to dump the originals
if ($dir == "" || $dir == "."){
	$dumpdir = "originals/";
}
fwrite($logfile, "Dumpdir is set to:\t".$dumpdir."\n");

// the size (height)
if ($h2 < 1 ){
	$h2 = 600;
}
fwrite($logfile, "Height is set to:\t" . $h2 . "\n");

// read files inside current directory
$files = scandir($dir);

// loop all files in dir
foreach ($files as $file){
	// convert file name to lower case
	$newFile = strtolower($file);
	// if file extension is jpg then process image
	if (substr($newFile, -3) == 'jpg'){
		fwrite($logfile, "Processing:\t\t\t" . $newFile . "\n");
		
		//creating the new Filename (old name, lower case, no extension)
		$newFile = substr($newFile, 0, -4);
		$imageinfo = getimagesize($dir . "/" . $file);
	
		// read image geometry
		$w1 = $imageinfo[0]; // image width
		$h1 = $imageinfo[1]; // image height
	
		if ($h1 > $h2){
			//setting the new ratio
			$ratio = $h2 / $h1;
			$w2 = round($w1 * $ratio);
		
			// print image status
			$newFile .= "_" . $h2 . "x" . $w2 . ".jpg";
			echo "was $file ($w1 x $h1) -> $dumpdir/$newFile <br>";
			
			$output = new Imagick();
			$output -> readImage($dir."/".$file);
			//try to move file
			if (!file_exists($dir."/".$dumpdir)){
				mkdir($dir."/".$dumpdir, 0775);
			}
			rename($dir."/".$file, $dir."/".$dumpdir."/".$file);
			$output -> resizeImage($w2, $h2, imagick::FILTER_CATROM, 1);
			$output -> writeImage($dir."/".$newFile);
			echo "<img src=\"$dir/$newFile\" alt=\" fail\" />";
		 	echo "<br>";
		
			$output -> clear();
			$output -> destroy();
		} else {
		echo "Bilder sind schon sehr klein";
		}
	}
}

// close the logfile
fwrite($logfile, "\nProcess ended ordinary at: ". date("d.m.Y - G:i:s") . "\n");
fwrite($logfile, "================================================\n\n");
fclose($logfile);

?>
