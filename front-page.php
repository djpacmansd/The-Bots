<?php get_header( 'home' ); //include header-home.php ?>




<?php 
	//use the get_theme_mod function to get id of the theme option 
	$id = get_theme_mod( 'frontpage_background_image1' );
	//get the url for the image that is associated with the theme option
	$src= wp_get_attachment_image_src( $id, 'full' );
?>


<main id="content" class="section main-section" style="background-image: url('<?php echo $src[0]; ?>'); background-repeat: no-repeat;">


<?php //THE LOOP
		if( have_posts() ): ?>
		<?php while( have_posts() ): the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?>>
			<h2 class="entry-title"> 				
					<?php the_title(); ?> 				
			</h2>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
				
		</article><!-- end post -->

		<?php endwhile; ?>
	<?php else: ?>

	<h2>Sorry, Page not found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>
	        <a href="#section1" class="down-hint" aria-hidden="true"></a>
</main><!-- END #content -->


<!-- fullpage_slider registered in functions.php
			it has it's on <div class="section"> to work with fullpage.js
 -->
<?php //fullpage_slider(); ?>

<div class="section" style="background-image: url('<?php the_field('section_1_bg'); ?>');">
	<?php the_field( 'section_1' ); ?> 
	<a href="#section2" class="down-hint" aria-hidden="true"></a>
</div>

<div class="section" style="background-image: url('<?php the_field('section_2_bg'); ?>');">
	<?php the_field('section_2'); ?>
	<a href="#section3" class="down-hint" aria-hidden="true"></a>
</div>


<div class="section" style="background-image: url('<?php the_field('section_3_bg'); ?>');">
	<?php the_field('section_3'); ?>
	<a href="#section-sidebar" class="down-hint" aria-hidden="true"></a>	
</div>


<?php get_sidebar( 'home' ); //include sidebar-home.php ?>

<?php get_footer( 'home' ); //include footer-home.php ?>

