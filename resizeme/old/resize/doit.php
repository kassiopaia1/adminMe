<?php



// both values should be numeric or use default size 800x600
if (!is_numeric($w2) || !is_numeric($h2)){
	$w2 = 800; // default image width
	$h2 = 600; // default image height
}

// the $dir where the original files are saved
$dir = "temp/";

// read files inside current directory
$files = scandir('.');

// open loop for all fetched files in current directory
foreach ($files as $file){
	// convert file name to lower case
	$newFile = strtolower($file);
	// if file extension is jpg then process image
	if (substr($newFile, -3) == 'jpg'){
		//creating the new Filename (old name, lower case, no extension)
		$newFile = substr($newFile, 0, -4);
		
		$imageinfo = getimagesize($file);
	
		// read image geometry
		$w1 = $imageinfo[0]; // image width
		$h1 = $imageinfo[1]; // image height
	
	if ($h1 > $h2){
		//setting the new ratio
		$ratio = $h2 / $h1;
		$w2 = $w1 * $ratio;
		
		// print image status
		
		$newFile .= "_" . $w2 . "x" . $h2 . ".jpg";
		echo "was $file ($w1 x $h1) -> $dir$newFile <br>";
		
		$output = new Imagick();
		$output -> readImage($file);
			//try to move file
			rename($file, $dir.$file);
			
		$output -> resizeImage($w2, $h2, imagick::FILTER_CATROM, 1);
		$output -> writeImage($newFile);
	
		echo "<img src=\"" . $newFile . "\" alt=\" fail\" />";
	 	echo "<br>";
		
		$output -> clear();
		$output -> destroy();
	}
	}
}


?>
