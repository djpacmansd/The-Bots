<?php get_header(); //include header.php ?>

<main id="content">

<?php bots_slider(); ?>


	<?php
	//defined in functions.php to show posts anywhere
	 //bots_posts( 5, 'Don\'t forget to look in the shop' ); ?>
<?php query_posts('showposts=5'); ?>
	<?php //THE LOOP
		 if( have_posts() ): ?>

		<?php while( have_posts() ): the_post(); ?>


		<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?>>
			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?> 
				</a>
			</h2>
			<?php the_post_thumbnail( 'thumbnail' ); ?>	
			<div class="entry-content">
				<?php the_excerpt(); //displays first 55 words of posts?>
			</div>
			<div class="postmeta"> 
				<span class="author"> Posted by: <?php the_author(); ?></span>
				<span class="date"><a href="<?php the_permalink(); ?>"><?php the_date(); ?></a></span>
				<span class="num-comments"> <?php comments_number(); ?></span>
				<span class="categories"><?php the_category(); ?></span>
				<span class="tags"><?php the_tags(); ?></span> 
			</div><!-- end postmeta -->			
		</article><!-- end post -->

		<?php endwhile; ?>

	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?> */

</main><!-- end #content -->


<?php awesome_products( 5, 'Latest Posts' ); ?>




<?php get_sidebar(); //include sidebar.php ?>
<?php get_footer(); //include footer.php ?>