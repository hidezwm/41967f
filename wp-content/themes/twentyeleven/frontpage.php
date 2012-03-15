<?php
/**
 * Template Name: The Frontpage
 * Description: A Page Template that showcases Sticky Posts, Asides, and Blog Posts
 *
 * The showcase template in Twenty Eleven consists of a featured posts section using sticky posts,
 * another recent posts area (with the latest post shown in full and the rest as a list)
 * and a left sidebar holding aside posts.
 *
 * We are creating two queries to fetch the proper posts and a custom widget for the sidebar.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<style>
#logo {
margin: 50px;
font-size: 80px;
font-style: italic;
}
ul {
list-style: none;
margin: 50px;
padding-bottom: 50px;
}
ul li a {
	text-decoration: none;
    display: block;
    margin-bottom: 10px;
    background-color: rgba(200, 0, 103, 0.16);
    -moz-border-radius: 4px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 40px;
    padding:10px;
}
ul li a:hover {
    display: block;
    color: #FFFFFF;
    background-color: rgba(200, 0, 103, 0.6);
    border-color:#DDDDDD;
    box-shadow: 0 0 10px rgba(65, 131, 196, 0.3);
}
#page {
	background: #fff;
}
@media (max-width: 800px) {
	#logo { font-size: 50px;} 
	ul li a { font-size: 30px; }
}
</style>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed">
<a href="http://bangforce.com/" id="logo">bangforce.com</a>
<ul>
<li><a href="http://bangforce.com/">Home</a></li>
<li><a href="http://bangforce.com/blog/">Blog</a></li>
<li><a href="http://comm.bangforce.com">Community</a></li>
<li><a href="http://bangforce.com/sample-page/">About</a></li>
</ul>
</div>
</body>
</html>