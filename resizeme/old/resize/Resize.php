<?php

if(isset($_POST['submit']))
	{
		
		//make sure this directory is writable!
		$path_thumbs = "/temp/";
		
		//the new width of the resized image, in pixels.
		$img_thumb_width = 100; // 

		$extlimit = "yes"; //Limit allowed extensions? (no for all extensions allowed)
		//List of allowed extensions if extlimit = yes
		$limitedext = array(".gif",".jpg",".png",".jpeg",".bmp");
		
		//the image -> variables
	    $file_type = $_FILES['vImage']['type'];
        $file_name = $_FILES['vImage']['name'];
        $file_size = $_FILES['vImage']['size'];
        $file_tmp = $_FILES['vImage']['tmp_name'];

        //check if you have selected a file.
        if(!is_uploaded_file($file_tmp)){
           echo "Error: Please select a file to upload!. <br>--<a href=\"$_SERVER[PHP_SELF]\">back</a>";
           exit(); //exit the script and don't process the rest of it!
        }
       //check the file's extension
       $ext = strrchr($file_name,'.');
       $ext = strtolower($ext);
       //uh-oh! the file extension is not allowed!
       if (($extlimit == "yes") && (!in_array($ext,$limitedext))) {
          echo "Wrong file extension.  <br>--<a href=\"$_SERVER[PHP_SELF]\">back</a>";
          exit();
       }
       //so, whats the file's extension?
       $getExt = explode ('.', $file_name);
       $file_ext = $getExt[count($getExt)-1];

       //create a random file name
       $rand_name = md5(time());
       $rand_name= rand(0,999999999);
       //the new width variable
       $ThumbWidth = $img_thumb_width;

	   //////////////////////////
	   // CREATE THE THUMBNAIL //
	   //////////////////////////
	   
       //keep image type
       if($file_size){
          if($file_type == "image/pjpeg" || $file_type == "image/jpeg"){
               $new_img = imagecreatefromjpeg($file_tmp);
           }elseif($file_type == "image/x-png" || $file_type == "image/png"){
               $new_img = imagecreatefrompng($file_tmp);
           }elseif($file_type == "image/gif"){
               $new_img = imagecreatefromgif($file_tmp);
           }
           //list the width and height and keep the height ratio.
           list($width, $height) = getimagesize($file_tmp);
           //calculate the image ratio
           $imgratio=$width/$height;
           if ($imgratio>1){
              $newwidth = $ThumbWidth;
              $newheight = $ThumbWidth/$imgratio;
           }else{
                 $newheight = $ThumbWidth;
                 $newwidth = $ThumbWidth*$imgratio;
           }
           //function for resize image.
           if (function_exists(imagecreatetruecolor)){
           $resized_img = imagecreatetruecolor($newwidth,$newheight);
           }else{
                 die("Error: Please make sure you have GD library ver 2+");
           }
           //the resizing is going on here!
           imagecopyresized($resized_img, $new_img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
           //finally, save the image
           ImageJpeg ($resized_img,"$path_thumbs/$rand_name.$file_ext");
           ImageDestroy ($resized_img);
           ImageDestroy ($new_img);
           
           
        }

        //ok copy the finished file to the thumbnail directory
		move_uploaded_file ($file_tmp, "$path_big/$rand_name.$file_ext");
		/*
			Don't want to copy it to a separate directory?
			Want to just display the image to the user?
			Follow the following steps:
			
			2. Uncomment this code:
		/*
		/* UNCOMMENT THIS IF YOU WANT */
		//echo "IMG:<img src=\"$path_big/$rand_name.$file_ext\" />";
		//exit();
		//*/
		
		//and you should be set!
             
		//success message, redirect to main page.		
		$msg = urlencode("$title was uploaded! <a href=\"Resize.php\">Upload More?</a>");
			header("Location: Resize.php?msg=$msg");
			exit();
		
	
}else{
	
		//if there is a message, display it
		if(isset($_GET['msg']))
		{
			//but decode it first!
			echo "<p>".urldecode($_GET['msg'])."</p>";
		}
		//the upload form
	echo "
	<form action=\"$_SERVER[PHP_SELF]\" method=\"post\"enctype=\"multipart/form-data\">\n
	<p>File:<input type=\"file\" name=\"vImage\" /></p>\n
	<p><input type=\"submit\" name=\"submit\" value=\"Submit\" /></p>";
}

?>