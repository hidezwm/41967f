<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">

			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				get_sidebar( 'footer' );
			?>

			<div id="site-generator">
				<div class="footer inline-list">
				  <ul>
					<li><a href="/about-dezhi-liu" target="_blank">About</a><span class="dot divider"> ·</span></li>
					<li><a href="http://www.facebook.com/smerpup" target="_blank">Facebook</a><span class="dot divider"> ·</span></li>
					<li><a href="http://twitter.com/smerpup" target="_blank">Twitter</a><span class="dot divider"> ·</span></li>
					<li><a href="http://feeds.smerpup.com/smerpup" target="_blank">Feedburner</a><span class="dot divider"> ·</span></li>
					<li><a href="http://weibo.com/smerpup" target="_blank">新浪微博</a><span class="dot divider"> ·</span></li>
					<li><a href="/sitemap.html">Sitemap</a><span class="dot divider"> ·</span></li>
					<li><a href="/wp-admin">Admin</a><span class="dot divider"> ·</span></li>
					<li><span class="copyright">© 2012 Dezhi Liu</span></li>
				  </ul>
				 </div>
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>