<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test</title>
</head>
<?php

$image_dir="./images/";
$tmpname="./images/$images";
$size="1024";
$save_dir="./images";
img_resize_start($image_dir, $tmpname, $size, $save_dir);

function img_resize_start ($image_dir, $tmpname, $size, $save_dir)
{if ($handle = opendir($image_dir)) {
    		 while (false !== ($file = readdir($handle))) {
    		  if ($file != "." && $file != ".." && $file !=".php") {
   		      $images ="$file";
			  img_resize($tmpname, $size, $save_dir, "new_" . $images);
			   	 }
 		  	 }
  		  closedir($handle);
			}

	echo ("Alle Bilder verkleinert");

}

function img_resize( $tmpname, $size, $save_dir, $save_name )
    {
    $save_dir .= ( substr($save_dir,-1) != "/") ? "/" : "";
        $gis       = GetImageSize($tmpname);
    $type       = $gis[2];
    switch($type)
        {
        case "1": $imorig = imagecreatefromgif($tmpname); break;
        case "2": $imorig = imagecreatefromjpeg($tmpname);break;
        case "3": $imorig = imagecreatefrompng($tmpname); break;
        default:  $imorig = imagecreatefromjpeg($tmpname);
        }

        $x = imageSX($imorig);
        $y = imageSY($imorig);
        if($gis[0] <= $size)
        {
        $av = $x;
        $ah = $y;
        }
            else
        {
            $yc = $y*1.3333333;
            $d = $x>$yc?$x:$yc;
            $c = $d>$size ? $size/$d : $size;
              $av = $x*$c;       
              $ah = $y*$c;      
        }   
        $im = imagecreate($av, $ah);
        $im = imagecreatetruecolor($av,$ah);
    if (imagecopyresampled($im,$imorig , 0,0,0,0,$av,$ah,$x,$y))
        if (imagejpeg($im, $save_dir.$save_name))
		    return true;
            else
            return false;
			
    }

?>
<body>
</body>
</html>