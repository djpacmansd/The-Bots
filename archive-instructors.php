<?php get_header(); //include header.php ?>


<main id="content">

 <h1 class="archive-title"><?php post_type_archive_title(); ?></h1>

 <div class="member-cont">

	<?php //THE LOOP
		if( have_posts() ): ?>
		<?php while( have_posts() ): the_post(); ?>


		<article id="post-<?php the_ID(); ?>" <?php post_class( ); ?> class="member">
			
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

	<?php //bots_pagination(); //defined in functions.php ?>

	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>
	</div><!-- end member-cont -->
</main><!-- end #content -->

<?php //get_sidebar(); //include sidebar-shop.php ?>
<?php get_footer(); //include footer.php ?>