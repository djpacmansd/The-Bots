<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
		if( have_posts() ): ?>

		<h2 class="archive-title">
			<?php //which type of archive are we viewing? 
			if( is_category() ){
				echo 'Posts in the category ';
				single_cat_title(); //the name of the category
			}elseif( is_tag() ){
				echo 'Posts tagged with ';
				single_term_title();
			}elseif( is_date() ){
				the_archive_title();
			}else{
				echo 'Post Archive';
			} ?>
		</h2>

		<?php while( have_posts() ): the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?>>
			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?> 
				</a>
			</h2>

			<?php the_post_thumbnail( 'thumbnail' ); ?>

			<div class="entry-content">
				<?php the_excerpt(); //first 55 words of the_content() ?>
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

		<?php //bots_pagination(); ?>

	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_sidebar(); //include sidebar.php ?>
<?php get_footer(); //include footer.php ?>