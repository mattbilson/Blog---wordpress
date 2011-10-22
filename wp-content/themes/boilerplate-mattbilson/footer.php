<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */
 
	function echoLatestTweet() {
		require_once(ABSPATH . 'wp-includes/class-snoopy.php');
		$snoopy = new Snoopy;
		
		$url = "http://twitter.com/statuses/user_timeline/mattbilson.json?exclude_replies=true&include_rts=true";
		$result = $snoopy->fetch($url);
		if ($result){
			$jsonData = json_decode($snoopy->results, true);
		}
		
		foreach ($jsonData as $tweet) {
			if(!$tweet['in_reply_to_user_id']) {
				echo $tweet['text'];
				break;
			}
		}
	}
	
?>
			</section><!-- #main -->
		<footer id="page-footer" role="contentinfo">
			
			<?php create_color_block("color-bar"); ?>
			<div class="container clearfix">
	<?php
		/* A sidebar in the footer? Yep. You can can customize
		 * your footer with four columns of widgets.
		 */
		get_sidebar( 'footer' );
	?>
				<!--<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>-->
			</div>
			<div class="container clearfix">
				<hr />
				<div id="latest-tweet">
						<p>
							<a href="https://twitter.com/intent/user?screen_name=mattbilson" target="_blank" onclick="popup('My Twitter profile' , 'width=700,height=480'); return false;">
								<?php echoLatestTweet(); ?>
							</a>
						</p>
				</div>
			</div>
			</footer><!-- footer -->
	<?php
		/* Always have wp_footer() just before the closing </body>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to reference JavaScript files.
		 */
		wp_footer();
	?>
	</div> <!--#container-->
	</body>
</html>