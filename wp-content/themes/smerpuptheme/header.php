<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
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
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="icon" type="image/ico" href="/favicon.ico">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
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
<script language="javascript"> 
function toggleComments() {
	var ele = document.getElementById("comments");
	var text = document.getElementById("comment_switch");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "Show Comments";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "Hide Comments";
	}
} 
</script>
<script>

	var navBar;

	var scrollStates = [

		{
			element: "#access",
			dragWithScroll: true,
			startScroll: 55
		},

	];

	function windowScroll() {
		var scroll = $(window).scrollTop();

		for (var i in scrollStates) {
			// instantiate the element's jquery pointer
			if (typeof scrollStates[i].element == "string") {
				scrollStates[i].element = $(scrollStates[i].element);
			}
			var el = scrollStates[i].element;

			if (scrollStates[i].dragWithScroll) {
				if (!scrollStates[i].clonedElement) {
					scrollStates[i].clonedElement = el.clone();
					scrollStates[i].clonedElement.appendTo($(".navBar"));
					scrollStates[i].clonedElement.css({
						"top": 0,
						"opacity": 0
					});
				}
				if (scroll <= scrollStates[i].startScroll) {
					scrollStates[i].clonedElement.css({opacity: 0, "z-index" : -1});
					el.css({opacity: 1});
				} else {
					scrollStates[i].clonedElement.css({opacity: 1, "z-index" : 1});
					el.css({opacity: 0});
				}

				continue;
			}
		}
	}

	$(window).load(function () {

		// placeholder fix for IE
		$('[placeholder]').live("focus", function() {
		  var input = $(this);
		  if (input.val() == input.attr('placeholder')) {
			input.val('');
			input.removeClass('placeholder');
		  }
		}).live("blur", function() {
		  var input = $(this);
		  if (input.val() == '' || input.val() == input.attr('placeholder')) {
			input.addClass('placeholder');
			input.val(input.attr('placeholder'));
		  }
		});

		navBar = $("#access");

		$(window).scroll(windowScroll);

	});


</script>
<!-- google -->
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
<!-- google -->
</head>

<body <?php body_class(); ?> data-rendering="true">
<div id="page" class="hfeed">
	<header id="branding" role="banner">
	<div class="navBar">
	</div>
	<div id="ads">
	</div>
			<nav id="access" role="navigation" style="opacity: 1;">
				<h3 class="assistive-text"><?php _e( 'Main menu', 'twentyeleven' ); ?></h3>
				<?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
				<div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'twentyeleven' ); ?>"><?php _e( 'Skip to primary content', 'twentyeleven' ); ?></a></div>
				<div class="skip-link"><a class="assistive-text" href="#secondary" title="<?php esc_attr_e( 'Skip to secondary content', 'twentyeleven' ); ?>"><?php _e( 'Skip to secondary content', 'twentyeleven' ); ?></a></div>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" id="menu-home-button" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); 
				get_search_form();
				?>
				
			</nav><!-- #access -->
	</header><!-- #branding -->


	<div id="main">