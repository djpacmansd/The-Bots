<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
		if( have_posts() ): ?>
		<?php while( have_posts() ): the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix cf' ); ?>>
			
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'thumbnail' ); ?>
			</a>
			
			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?> 
				</a>
			</h2>

			<?php the_terms( get_the_id(), 'brand', '<h3>', ', ', '</h3>'  ); ?>			

			<div class="entry-content">
				<?php the_excerpt(); //first 55 words of the_content() ?>

				<?php //show just the price custom field value
				$price =  get_post_meta( get_the_id(), 'price', true );
				//if this product has a price, show it in a pricetag
				if($price){
					?>
					<span class="product-price">
						<?php echo $price; ?>
					</span>
					<?php
				} ?>
				
			</div>
						
		</article><!-- end post -->

		<?php endwhile; ?>

		<?php //bots_pagination(); //defined in functions.php ?>

	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_sidebar();  ?>
<?php get_footer(); //include footer.php ?>