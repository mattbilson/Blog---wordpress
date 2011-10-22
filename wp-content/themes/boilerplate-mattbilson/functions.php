<?php

 
 function create_color_block($div_class = null) {
	if ( !isset($div_class) ) {
		$div_class = "color-block";
	}
 	
 	echo '<div class="'.$div_class.' clearfix">';
 	for($i=1;$i<6;$i++) {
		echo '<div class="color"></div>';
 	}
 	echo '</div>';
 }
 function create_comment_color_block() {
 	echo '<div class="color-block clearfix">';
		echo '<div class="color"></div>';
 	echo '</div>';
 }
 
 if ( ! function_exists( 'boilerplate_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function boilerplate_posted_on() {
	printf( __( '%2$s', 'boilerplate' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		)
	);
}
endif;
 
if ( ! function_exists( 'boilerplate_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function boilerplate_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. <a href="%3$s" title="Permalink to %4$s" rel="bookmark">Permalink</a>.', 'boilerplate' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. <a href="%3$s" title="Permalink to %4$s" rel="bookmark">Permalink</a>.', 'boilerplate' );
	} else {
		$posted_in = __( '<a href="%3$s" title="Permalink to %4$s" rel="bookmark">Permalink</a>.', 'boilerplate' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;


/**
 * Add site specific start script
 */
	function add_child_site_script() {
		$cache = str_replace('?ver=','',cache_buster());
		wp_register_script( 'child_site_script', get_stylesheet_directory_uri(). '/js/script.js', array(), $cache, true );
		wp_enqueue_script( 'child_site_script' );
	}

	add_action('wp_loaded', 'add_child_site_script');


if ( ! function_exists( 'boilerplate_search_form' ) ) :
// change Search Form input type from "text" to "search" and add placeholder text
function boilerplate_search_form ( $form ) {
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<div><label class="screen-reader-text" for="s">' . __('') . '</label>
	<input type="search" placeholder="Search for..." value="' . get_search_query() . '" name="s" id="s" />
	<input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
	</div>
	</form>';
	return $form;
}
endif;

if ( ! function_exists( 'boilerplate_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own boilerplate_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function boilerplate_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>">
			<div id="comment-info-holder" class="clearfix">
				<?php create_comment_color_block(); ?>
				<div class="comment-author vcard">
					<?php printf( __( '%s', 'boilerplate' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<span style="float:left;">&nbsp; | &nbsp;</span>
				<footer class="comment-meta commentmetadata">
						<?php
							/* translators: 1: date, 2: time */
							printf( __( '%1$s at %2$s', 'boilerplate' ), get_comment_date(),  get_comment_time() );
						?>
				</footer><!-- .comment-meta .commentmetadata -->
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'boilerplate' ); ?></em>
			<?php endif; ?>
			<div class="comment-body"><?php comment_text(); ?></div>
			
		</article><!-- #comment-##  -->
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'boilerplate' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'boilerplate'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

 ?>