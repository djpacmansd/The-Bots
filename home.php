<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
		if( have_posts() ): ?>
		<?php while( have_posts() ): the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'bots-post cf' ); ?>>
			<figure class="blog-image">
				<div class="post-overlay"
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'full' ); ?>
				</a>
				<h2 class="entry-title"> 
					<a href="<?php the_permalink(); ?>"> 
						<?php the_title(); ?> 
					</a>
				</h2>
				</div>
			</figure>
		</article>

		<?php endwhile; ?>

	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php bots_pagination(); ?>

<?php get_sidebar( 'page' ); ?>
<?php get_footer(); //include footer.php ?>