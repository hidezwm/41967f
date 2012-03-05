<?php
// database connection.
$server = "localhost";
$username = "u116595";
$password = "3ct6Hdi1";
$database = "u116595";
$table = "demo_feeds";

$con = mysql_connect($server, $username, $password);

// Start counting time for the page load
$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];

if (!empty($_GET['like'])) {
	$lid = (int) $_GET['id'];
	$like = $_GET['like'];
}

if (!empty($_GET['key'])) {
	$keyword = $_GET['key'];
}


// When we end our PHP block, we want to make sure our DOCTYPE is on the top line to make
// sure that the browser snaps into Standards Mode.
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<title>Demo: Saved Rss Feeds</title>
		<link rel="stylesheet" href="./for_the_demo/sIFR-screen.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./for_the_demo/mysimplepie.css" type="text/css" media="screen, projector" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-25974998-2']);
  _gaq.push(['_setDomainName', 'smerpup.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script>
$(document).ready(function(){

	// hide #back-top first
	$("#back-top").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

});
</script>
	</head>
	<body id="bodydemo">
		<div id="site">
			<div id="content">

				<div id="sp_results">
					
					<div class="chunk">
						<?php

						if (!$con) {
							die('Could not connect: ' . mysql_error());
						}
						mysql_select_db($database, $con);
						
						if ($like){
							$sql = "UPDATE ".$table." SET  `like` =  '$like' WHERE  `Id` =  '$lid'";
							$foo = ($like == "yes") ? "LIKED!" : "UNLIKED!";
							if (!mysql_query($sql)) {
								die('Error: ' . mysql_error());
							} else {
								echo "Feed with id:". $lid . " is " . $foo . '<br>';
							}
							
						}
						$no = "unset";
						//output content
						echo "<strong>". mysql_num_rows (mysql_query("select Id FROM ".$table.";") )." feeds are in the database!</strong><br />"; 
						
if ($keyword){
	$result = mysql_query("select * FROM ".$table." WHERE LOCATE('".$keyword."', `Content`)>0 ");
						$num = mysql_num_rows ($result);
						echo "<strong>$num posts has been found!</strong>";
} else {
						$result = mysql_query("select * FROM ".$table.";");
						$num = mysql_num_rows ($result);
						echo "<strong>$num feeds has not been rated!</strong>";
}
						
						
						if (!$result) {
							die('Query failed: ' . mysql_error());
						}
						
						echo $likeid;

						while ($row = mysql_fetch_array($result)) {
							$id = $row['Id'];


							
							echo '<h3 id="transition" ><a name="'.$id.'" href="#'.$id.'">' . $row['Title'] . '</a></h3>';
							
								echo '<a href="?like=positive&id='.$id.'">Like </a> <a href="?like=negative&id='.$id.'">Unlike</a><br>';
							
							$content = $row['Content'];
							
							$content = strip_tags($content, '<p><a>');
							
							echo $content;

							
							//echo "Liked? ". $row['like'] . " ";
							//Prints human-readable information about a variable
							//print_r($row);

						}
						mysql_close($con);
						?>
					</div>
										<p id="back-top">
		<a href="#top"><span></span>Back to Top</a>
	</p>
				</div>
			</div>
	</body>
</html>
