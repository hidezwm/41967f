<?php
/**
 * Template Name: Frontpage Template
 * Description: A Page Template that showcases Sticky Posts, Asides, and Blog Posts
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
a {
	text-decoration: none;
	display: block;
	border-radius: 10px;
	cursor: pointer;
	padding:20px;
	max-width: 400px;
	float: right;
	margin: 40px;
	-moz-border-radius: 10px;
}
a.mb {

	background-color: rgba(255, 255, 255, 0.6);
	

}
a.mb:hover {
    color: #FFFFFF;
    background-color: rgba(25, 25, 25, 0.6);
    /* Firefox */
    -moz-transition: all 1s ease-in;
    /* WebKit */
    -webkit-transition: all 1s ease-in;
    /* Opera */
    -o-transition: all 1s ease-in;
    /* Standard */
    transition: all 1s ease-in;
}
h1 {
	font-size: 60px;
}
article {
	display: block;
	background-color: rgba(255, 255, 255, 0.6);
	-moz-border-radius: 10px;
	border-radius: 10px;
	padding:20px;
	max-width: 500px;
	float: right;
	margin: 40px;
	color: #333;
}
html {
	background: url(http://i.imgur.com/xCuj6.jpg) no-repeat center center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}
@media (max-width: 650px) {
	html {
		background: url();
		background: #0067C8;
	}
	#page {
		margin: 0;
	}
	article {
		padding:10px;
		margin: 10px;
	}
	a {
		padding:10px;
		margin: 10px;
	}
}
#page {
	background: none;
	margin: 0 auto;
	max-width: 1000px;
}
abbr, acronym, dfn {
border-bottom: 1px dotted #666;
cursor: help;
}
body.custom-background {
background: none;
}
.sitemap {
	font-size: 1px;
	text-decoration: none;
}
blockquote {
	font-family: Georgia, "Bitstream Charter", serif;
	font-style: italic;
	font-weight: normal;
	margin: 0 3em;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: "";
}
blockquote, q {
	quotes: "" "";
}
</style>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed">
	<a class="mb" href="<?php echo esc_url( home_url( '/hot/' ) ); ?>">
		<h1 id="site-title"><span><?php bloginfo( 'name' ); ?></span></h1>
		<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
		Enter >> 
	</a>
	<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/**
					 * We are using a heading by rendering the_content
					 * If we have content for this page, let's display it.
					 */
					if ( '' != get_the_content() )
						get_template_part( 'content', 'intro' );
				?>

				<?php endwhile; ?>
</div><a class="sitemap" href="/sitemap.xml">Sitemap</a></body></html>

