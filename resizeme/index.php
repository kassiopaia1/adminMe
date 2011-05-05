<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Resize Images</title>
</head>

<body>
<h1>Choose Gallery</h1>
<p>
<form action="doit.php" method="post">
  <p> Choose where you put your images:<br>
    <select name="dir">
      <?php
	// open this directory 
	$currentDir = opendir(".");

	// get each entry
	while($entryName = readdir($currentDir)) {
		if (is_dir($entryName)  && $entryName != "." && $entryName != ".."){
		echo "<option>". $entryName ."</option>";
		}
	}
	?>
    </select>
  </p>
  <p> Choose your size: <br>
    <input type="radio" value="400" name="size">
    400px<br />
    <input type="radio" value="600" name="size">
    600px<br />
    <input type="radio" value="800" name="size">
    800px<br />
    <input type="radio" value="1024" name="size">
    1024px<br />
  </p>
  <p> Subfolder for original Files: <br>
    <input type="text" maxlength="20" name="dumpdir" value="originals">
  <p>
    <input type="submit" />
  </p>
  </p>
</form>
</p>
</body>
</html>
