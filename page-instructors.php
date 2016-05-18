<?php /**
 * Template Name: Instructors	
 * Description: Page template for instructors
 * @since Bots 2.0
 */


get_header(); //include header.php ?>

 

<main id="content">


	<?php//THE LOOP
	$args = array( 'post_type' => 'instructors');

	$query = new WP_Query( $args );

	if ($query->have_posts():
		while ($query->have_posts()) : $query->the_post(); ?>

		  	<article id="post-<?php the_ID(); ?>" <?php post_class( 'member' ); ?>>
					<a href="<?php the_permalink(); ?>">
						<figure class="member-image">
							<?php the_post_thumbnail( 'full' ); ?>
						</figure>
					</a>
					
					<h2 class="entry-title member-name"> 
						<a href="<?php the_permalink(); ?>"> 
						<!-- member name -->
							<?php the_title(); ?> 
						</a>
						<!--  member's title ex: Instructor, Founder, CEO, Accountant  -->
						<p class="member-title"><?php the_field( 'title' ); ?></p>
					</h2>
				</article><!-- end post -->

		<?php endwhile; ?>

	<?php else : ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php 
	endif;  //end THE LOOP 
	wp_reset_postdata();
	?>

</main><!-- end #content -->


<?php //bots_pagination(); ?>

<?php //get_sidebar( 'Page' ); ?>
<?php get_footer(); //include footer.php ?>