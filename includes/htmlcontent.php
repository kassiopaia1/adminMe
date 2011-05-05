<?php

function getHTMLHead(){
	$title = "AdminMe";
	$stylesheet = "styles.css";
	$jqueryfile = "jquery-1.5.2.js";

	echo '
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>'.$title.'</title><link href="'. $stylesheet.'" rel="stylesheet" type="text/css">
<script type="text/javascript" src="'.$jqueryfile.'"></script>
<script type="text/javascript">
			$(document).ready(function(){
				//design the tables
				$("tr:even").css({
					background:"lightgrey"
				});
				$("tr:first").css({
					background:"grey"
				});
	
			});
		</script>
</head>
<body>'
	;
}

function getHeader(){
	echo '
	<div class="container">
<div class="header"><a href="#"> <img src="header.jpg" alt="Logo"
	width="100%" height="90" id="logo" /> </a></div>
	';
}

function getSidebar(){
	echo '
<div class="sidebar1">
<ul class="nav">
	<li><a href="#">Link one</a></li>
	<li><a href="#">Link two</a></li>
	<li><a href="#">Link three</a></li>
	<li><a href="#">Link four</a></li>
</ul>
<p>Some Bambam Information<br>
2011 (c), Flo &amp; Mike</p>
<div class="login">
<p>';

	if (isLoggedIn()){
		echo "Welcome ".$_SESSION['userid']."<br>";
		echo '<a href="?logout=1">Logout</a>';
	} else {
		echo '
		   <form name="form1" method="post" action="./includes/checklogin.php">
        Username: <br>
        <input name="myusername" type="text" id="myusername">
        <br>
        Password:<br>
        <input name="mypassword" type="password" id="mypassword">
        <input type="submit" name="Submit" value="Login">
      </form><br><a href="?signup=1">Sign up</a>';

	}
	echo '
</p>
</div>
</div>

';
}

function getContent(){
	echo '
	
<div class="content">
<h1>Header one H1</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis
tristique massa. Pellentesque sagittis tristique mauris ut placerat.
Morbi in facilisis libero. Nulla condimentum cursus massa eget
fringilla. Nunc volutpat scelerisque egestas. Sed pretium scelerisque
lacus, non commodo neque dignissim nec. Aliquam congue, nunc nec
pulvinar hendrerit, augue tortor congue felis, vitae viverra velit ipsum
eget leo. Praesent consequat, leo vel sodales euismod, neque orci
vehicula nisi, et vestibulum nisl risus ut libero. Phasellus at purus
eros. Aenean molestie gravida tincidunt. Sed scelerisque justo at enim
auctor ultrices. Morbi ultrices tempor velit sed interdum. Vivamus
tempus mollis nulla, a malesuada arcu consectetur in. Praesent gravida
massa eu neque ornare imperdiet. Maecenas ornare lacus id metus
consequat quis mollis dui auctor. Donec varius neque sit amet lectus
pulvinar a fringilla libero tempus.</p>
<table summary="some random data" width="200">
	<tr>
		<td>ID</td>
		<td>Name</td>
		<td>Age</td>
	</tr>
	<tr>
		<td>1</td>
		<td>Mike</td>
		<td>24</td>
	</tr>
	<tr>
		<td>2</td>
		<td>Flo</td>
		<td>23</td>
	</tr>
	<tr>
		<td>1</td>
		<td>Mike</td>
		<td>24</td>
	</tr>
	<tr>
		<td>2</td>
		<td>Flo</td>
		<td>23</td>
	</tr>
	<tr>
		<td>1</td>
		<td>Mike</td>
		<td>24</td>
	</tr>
	<tr>
		<td>2</td>
		<td>Flo</td>
		<td>23</td>
	</tr>
</table>
</p>
<p>In lorem nisi, lacinia ac vulputate et, fringilla eu odio. Donec
scelerisque leo ut lorem semper euismod. In hac habitasse platea
dictumst. Aliquam in ullamcorper justo. Aenean nec tellus elit, laoreet
scelerisque est. Pellentesque consectetur hendrerit tellus eu ornare. In
quis sem leo, quis rutrum tortor. Phasellus fermentum dignissim nibh id
condimentum. Duis quis elit leo, at rhoncus odio. Nulla leo nibh, dictum
a pellentesque sit amet, consectetur vitae nisl. Duis sed dolor lorem.
Maecenas nisi urna, facilisis non bibendum ut, malesuada vel neque. In
ultricies nulla at justo euismod et tempus felis iaculis. Duis mi velit,
tincidunt vulputate auctor eu, placerat ac nibh.</p>
<p>Donec purus ante, accumsan vitae ultricies non, ultrices ut sapien.
Proin mollis, ligula nec pharetra rhoncus, tortor ligula semper felis,
in scelerisque nibh orci a lacus. Aliquam eget ipsum quis libero cursus
malesuada nec eu ante. Ut porta posuere pretium. Suspendisse vitae leo
sem. Praesent vulputate lectus sit amet purus gravida gravida. Sed
auctor risus ac eros eleifend fermentum. Suspendisse aliquam lacus sed
lacus consectetur in hendrerit nulla congue. Vivamus in dolor vel diam
aliquet tincidunt in vitae felis. Sed euismod vulputate nibh, a
venenatis lectus auctor at. Nulla sed odio massa, vitae consequat nunc.
Suspendisse semper massa quis justo lobortis id vehicula elit sodales.
Fusce nulla nunc, rutrum a volutpat at, luctus in nibh. Donec nec tortor
tellus, nec fermentum urna. Nulla aliquet fermentum ante mollis tempus.
</p>
<p>Sed aliquam ullamcorper volutpat. Cras vitae nulla urna. Mauris
commodo pulvinar elit feugiat vehicula. Suspendisse ac risus orci,
aliquam consectetur orci. Curabitur at augue nec dolor dignissim
interdum. Phasellus imperdiet arcu vel purus accumsan vestibulum.
Pellentesque ultricies, est ut porta feugiat, metus dolor pellentesque
dolor, quis placerat eros ipsum vel leo. Vivamus ultricies nisi quis
quam pellentesque pulvinar convallis velit auctor. Curabitur adipiscing
tempus imperdiet. Duis vestibulum luctus dolor quis ullamcorper.
Maecenas nec neque a magna dapibus venenatis. Praesent nec vehicula
nulla. Sed ut orci ligula. Pellentesque interdum imperdiet eleifend.
Pellentesque scelerisque porta justo, ut congue eros rhoncus at. Integer
sed sapien nisl, vel iaculis nulla.</p>
</div>
';

}

function getFooter(){
	echo '
<div class="footer">
<p>This is the footer</p>
</div>
</div>
</body>
</html>
	';
}



?>
