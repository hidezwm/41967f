<?php
			// database connection.
			$server = ""; //e.g. localhost
			$username = ""; //database username
			$password = ""; //database password
			$database = ""; //database scheme
			$table = "";	//table you want to store the posts

			$server = "localhost";
			$username = "u116595";
			$password = "3ct6Hdi1";
			$database = "u116595";
			$table = "demo_feeds";


			$con = mysql_connect($server, $username, $password);
			mysql_query("charset utf8"); // UTF 8 support!!


// Start counting time for the page load
$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];

// Include SimplePie
// Located in the parent directory
include_once ('simplepie.inc');
include_once ('idn/idna_convert.class.php');

// Create a new instance of the SimplePie object
$feed = new SimplePie();
$feed -> set_cache_location("mysql://$username:$password@$server:3306/$database");
//$feed->force_fsockopen(true);

// Make sure that page is getting passed a URL
if (isset($_GET['feed']) && $_GET['feed'] !== '') {
	// Strip slashes if magic quotes is enabled (which automatically escapes certain characters)
	if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
		$_GET['feed'] = stripslashes($_GET['feed']);
	}

	// Use the URL that was passed to the page in SimplePie
	$feed -> set_feed_url($_GET['feed']);

	// XML dump
	$feed -> enable_xml_dump(isset($_GET['xmldump']) ? true : false);
}

// Allow us to change the input encoding from the URL string if we want to. (optional)
if (!empty($_GET['input'])) {
	$feed -> set_input_encoding($_GET['input']);
}

// Allow us to choose to not re-order the items by date. (optional)
if (!empty($_GET['orderbydate']) && $_GET['orderbydate'] == 'false') {
	$feed -> enable_order_by_date(false);
}

// Allow us to cache images in feeds.  This will also bypass any hotlink blocking put in place by the website.
if (!empty($_GET['image']) && $_GET['image'] == 'true') {
	$feed -> set_image_handler('./handler_image.php');
}

// We'll enable the discovering and caching of favicons.
$feed -> set_favicon_handler('./handler_image.php');

// Initialize the whole SimplePie object.  Read the feed, process it, parse it, cache it, and
// all that other good stuff.  The feed's information will not be available to SimplePie before
// this is called.
$success = $feed -> init();

// We'll make sure that the right content type and character encoding gets set automatically.
// This function will grab the proper character encoding, as well as set the content type to text/html.
$feed -> handle_content_type();

// When we end our PHP block, we want to make sure our DOCTYPE is on the top line to make
// sure that the browser snaps into Standards Mode.
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<title>SimplePie: Demo</title>

<link rel="stylesheet" href="./for_the_demo/sIFR-screen.css" type="text/css" media="screen">
<link rel="stylesheet" href="./for_the_demo/sIFR-print.css" type="text/css" media="print">
<link rel="stylesheet" href="./for_the_demo/simplepie.css" type="text/css" media="screen, projector" />

<script type="text/javascript" src="./for_the_demo/sifr.js"></script>
<script type="text/javascript" src="./for_the_demo/sifr-config.js"></script>
<script type="text/javascript" src="./for_the_demo/sleight.js"></script>
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
</head>

<body id="bodydemo">

<div id="header">
	<div id="headerInner">
		<div id="logoContainer">
			<div id="logoContainerInner">
				<div align="center"><a href="blog.smerpup.com"><img src="http://blog.smerpup.com/wp-content/themes/minima/images/home_selected.png" alt="Demo: save rss feeds to database" title="Demo: save rss feeds to database Author: Dezhi Liu" border="0" /></a></div>
				<div class="clearLeft"></div>
			</div>

		</div>
	</div>
</div>

<div id="site">

	<div id="content">

		<div class="chunk">
			<form action="" method="get" name="sp_form" id="sp_form">
				<div id="sp_input">


					<!-- If a feed has already been passed through the form, then make sure that the URL remains in the form field. -->
					<p><input type="text" name="feed" value="<?php
						if ($feed -> subscribe_url())
							echo $feed -> subscribe_url();
 ?>" class="text" id="feed_input" />&nbsp;<input type="submit" value="Read" class="button" /></p>


				</div>
			</form>


			<?php
			// Check to see if there are more than zero errors (i.e. if there are any errors at all)
			if ($feed -> error()) {
				// If so, start a <div> element with a classname so we can style it.
				echo '<div class="sp_errors">' . "\r\n";

				// ... and display it.
				echo '<p>' . htmlspecialchars($feed -> error()) . "</p>\r\n";

				// Close the <div> element we opened.
				echo '</div>' . "\r\n";
			}
			?>

		</div>

		<div id="sp_results">

			<!-- As long as the feed has data to work with... -->
			<?php if ($success): ?>
				<div class="chunk focus" align="center">

					<!-- If the feed has a link back to the site that publishes it (which 99% of them do), link the feed's title to it. -->
					<h3 class="header"><?php
						if ($feed -> get_link())
							echo '<a href="' . $feed -> get_link() . '">';
						echo $feed -> get_title();
						if ($feed -> get_link())
							echo '</a>';
					?></h3>
<!-- If the feed has a description, display it. -->
<?php  echo $feed -> get_description();?>

</div>

<!-- Let's begin looping through each individual news item in the feed. -->
<?php foreach($feed->get_items() as $item):
?>
<div class="chunk">
	<?php
			
			if (!$con) {
				die('Could not connect: ' . mysql_error());
			}
			mysql_select_db($database, $con);
			
			//check if item exists
			
			$id = $item -> get_id();
			
			if (mysql_num_rows(mysql_query("SELECT itemid FROM $table WHERE itemid = '$id'"))) {
				
				echo "<strong>Record exists! ID: " . $id . " The data stored are here:</strong>";
				echo "<br>";
				
				//output content
				$result = mysql_query("select * FROM $table WHERE itemid = '$id'");
				if (!$result) {
    				die('Query failed: ' . mysql_error());
				}
				
				while ($row = mysql_fetch_assoc($result)) {
				    //echo "Content: ". $row['Content'];
				    //Prints human-readable information about a variable
					 print_r($row);
					 echo "<br>";
				}

			} else {
			
				if ($item -> get_permalink()) {
					echo "permalink: " . $item -> get_permalink() . "<br>";
					$permalink = $item -> get_permalink();
				}
			
				echo "title: " . $item -> get_title() . "<br>authors: ";
				$title = $item -> get_title();
			
				//echo $item->get_author()->gat_name() . "<br>";
				$authors = "";
				foreach ($item->get_authors() as $author) {
					echo "" . $author -> get_name() . ",";
					$authors .= $author -> get_name() . ",";
				}
				$cat = "";
				echo "<br>categories: ";
				foreach ($item->get_categories() as $category) {
					echo "" . $category -> get_label() . ",";
					$cat .= $category -> get_label() . ",";
				}
				echo "<br>";
			
				//echo "description: " . $item -> get_description() . "<br>";
				//$des = $item -> get_description();
			
				echo "date: " . $item -> get_date('Y-m-d H:i:s') . "<br>";
				$date = $item -> get_date('Y-m-d H:i:s');
				
				//Convert special characters to HTML entities
				//$content = htmlentities((string)$item -> get_content(), ENT_QUOTES, "UTF-8");
				//echo "content: " . $content . "<br>";
				//Convert special HTML entities back to characters
				//$content_html = htmlspecialchars_decode($content);
				//echo "content html: " . $content_html . "<br>";
				
				//mysql_escape_string — Escapes a string for use in a mysql_query
				//$content_html_safe = mysql_real_escape_string((string)$item -> get_content(),$con);
				
				$content = (string)$item -> get_content();
				echo "content: " . $content . "<br>";
				$content_mysql = mysql_real_escape_string($content,$con);
				
			
				$sql = "INSERT INTO $table VALUES ('$date', '$authors', '$title', '$content_mysql', '$permalink', '$cat', '$id', '')";
			
				if (!mysql_query($sql, $con)) {
					die('Error: ' . mysql_error());
				} else {
					echo "<strong>Record saved!</strong>";
				}
				
				
			}


	?>
</div>
<!-- Stop looping through each item once we've gone through all of them. -->
<?php  endforeach;
mysql_close($con);
?>

<!-- From here on, we're no longer using data from the feed. -->
<?php  endif;?>

</div>

<div>
	<!-- Display how fast the page was rendered. -->
	<p class="footnote">
		Page processed in <?php  $mtime = explode(' ', microtime());
		echo round($mtime[0] + $mtime[1] - $starttime, 3);
		?>
		seconds.
	</p>
	<!-- Display the version of SimplePie being loaded. -->
	<p class="footnote">
		Powered by <a href="<?php  echo SIMPLEPIE_URL;?>"><?php  echo SIMPLEPIE_NAME . ' ' . SIMPLEPIE_VERSION . ', Build ' . SIMPLEPIE_BUILD;?></a>.  Run the <a href="../compatibility_test/sp_compatibility_test.php">SimplePie Compatibility Test</a>.  SimplePie is &copy; 2004&ndash;<?php echo date('Y');?>,
		Ryan Parman and Geoffrey Sneddon, and licensed under the <a href="http://www.opensource.org/licenses/bsd-license.php">BSD License</a>.
	</p>
</div>
</div>

</div>

</body>
</html> 