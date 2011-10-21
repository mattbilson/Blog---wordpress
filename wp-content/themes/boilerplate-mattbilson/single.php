<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); ?>
		<div id="article-content">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<!--
				<nav id="nav-above" class="navigation">
					<?php previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'boilerplate' ) . ' %title' ); ?>
					<?php next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'boilerplate' ) . '' ); ?>
				</nav>#nav-above
					-->
				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
					<?php create_color_block(); ?><h1><?php the_title(); ?></h1>
					<div class="entry-content-column">
						<div class="entry-content">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'boilerplate' ), 'after' => '' ) ); ?>
						</div><!-- .entry-content -->
					</div>
					<div class="entry-info">
						<div class="entry-meta">
							<?php if ( get_post_meta($post->ID, 'originally-posted-on', true) ) : ?>
								<div id="originally-posted"><?php echo get_post_meta($post->ID, 'originally-posted-on', true); ?></div>
							<?php endif; ?>  
							<?php boilerplate_posted_on(); ?>
						</div><!-- .entry-meta -->
	<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
						<footer id="entry-author-info">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'boilerplate_author_bio_avatar_size', 60 ) ); ?>
							<h2><?php printf( esc_attr__( 'About %s', 'boilerplate' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
								<?php printf( __( 'View all posts by %s &rarr;', 'boilerplate' ), get_the_author() ); ?>
							</a>
						</footer><!-- #entry-author-info -->
	<?php endif; ?>
						<footer class="entry-utility">
							<?php boilerplate_posted_in(); ?>
						</footer><!-- .entry-utility -->
					</div><!-- .entry-info	-->
				</article><!-- #post-## -->
				<nav id="nav-below" class="navigation">
					<!--
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'boilerplate' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'boilerplate' ) . '</span>' ); ?></div>
					-->
				</nav><!-- #nav-below -->
				<?php comments_template( '', true ); ?>
<?php endwhile; // end of the loop. ?>
	</div>	<!--	end of #article-content	-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
