<?php get_header(); //include header.php ?>

<main id="content">
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
	        
</main><!-- END #content -->

<?php //bots_pagination(); ?>

<?php get_sidebar(); ?>
<?php get_footer(); //include footer.php ?>