<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test</title>
</head>
<body>

<?php
$bilderdir= "./content/".$HTTP_GET_VARS["var"];
$Verzeichnis=opendir('./content/'.$HTTP_GET_VARS["var"]);
echo "<br>Dateien: <br>";
while ($filename = readdir ($Verzeichnis)) {
if ($filename != "." && $filename != ".." && eregi("jpg",$filename) xor eregi("gif",$filename) xor eregi("jpeg",$filename)) {
echo "$bilderdir<br>";
echo "$filename <br>";
img_resize($filename, "1024", $bilderdir, "new_".$filename);
}
}
closedir($Verzeichnis);
 
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
</body>
</html>