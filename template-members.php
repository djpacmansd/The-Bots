<?php /**
 * Template Name: Members Template
 * Description: Page template dispay all members on page for a custom post type
 * @since Bots 2.0
 */


get_header(); //include header.php ?>

 

<main id="content">
<?php //THE LOOP
		if( have_posts() ): ?>
		<?php while( have_posts() ): the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-entry' ); ?>>
			<h2 class="page-title entry-title"> 				
					<?php the_title(); ?> 				
			</h2>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</article><!-- end post -->
		
		<?php endwhile; ?>

	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

	<div class="member-cont">
	<?php //THE CUSTOM LOOP
	/* get the ID of a custom field on a page with a custom template page, can be used as a universal template as long as the custom field key 'posttype' and value (instructors, bots, totbots) is entered */
															/* post ID, custom field, single-page = true */
	$bots_posttype = get_post_meta( $post->ID, 'posttype', 1 );
	$args = array( 'post_type' => $bots_posttype );
	$bots_query = new WP_Query( $args );

		if( $bots_query->have_posts() ): ?>
		<?php while( $bots_query->have_posts() ): $bots_query->the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'member' ); ?>>
			<a href="<?php the_permalink(); ?>">
				<figure class="member-image">
					<?php the_post_thumbnail( 'full' ); ?>
				</figure>
			</a>
			
			<div class="member-info">
				<h2 class="entry-title member-name"> 
					<a href="<?php the_permalink(); ?>"> 
					<!-- member name -->
						<?php the_title(); ?> 
					</a>
				</h2>

				<!--  member's title ex: Instructor, Founder, CEO, Accountant  -->
				<p class="member-title"><?php the_field( 'title' ); ?></p>
			</div>

		</article><!-- end post -->

		<?php endwhile; ?>

	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end CUSTOM THE LOOP 
	wp_reset_postdata();
	?>
	</div><!-- member-cont -->
</main><!-- end #content -->


<?php //bots_pagination(); ?>

<?php //get_sidebar( 'Page' ); ?>
<?php get_footer(); //include footer.php ?>