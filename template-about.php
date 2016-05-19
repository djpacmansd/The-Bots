<?php /**
 * Template Name: About Us	
 * @since Bots 2.0
 */


get_header(); //include header.php ?>

 

<main id="content">
	<?php //THE LOOP
		if( have_posts() ): ?>
		<?php while( have_posts() ): the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?>>
		<figure class="hero">
			<?php 
				$image = get_field('page_header');
				if( $image ): ?>
				<img src="<?php echo $image; ?>" class="page-header" />
			<?php endif; ?>
			<p class="hero-text"><?php the_field( 'about_title' ); ?></p>
		</figure>


		<!-- <h2 class="entry-title"> 
			<a href="<?php //the_permalink(); ?>"> 
				<?php //the_title(); ?> 
			</a>
		</h2> -->

		<div class="about-us-cont">
			<h2 class="entry-title"> <?php the_title(); ?></h2>
			<!-- About us mission statement -->
			<?php the_field( 'about_us' ); ?>
		</div>





		<?php the_post_thumbnail( 'thumbnail' ); ?>	
		<div class="entry-content">
			<?php the_content(); //displays wp default edit field?>
		</div>

	</article><!-- end post -->

		<?php endwhile; ?>

	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<!-- values -->
<section class="values-cont">
	<div class="values-inner-cont">
		<article class="value">
			<!-- get the image from the custom field -->
			<?php 
			// first, get the image ID returned by ACF
			$image_id = get_field('value_1_image');
			// and the image size you want to return
			$image_size = 'full';
			// use wp_get_attachment_image_src to return an array containing the image
			// we'll pass in the $image_id in the first parameter
			// and the image size registered using add_image_size() in the second
			$image_array = wp_get_attachment_image_src($image_id, $image_size);
			// finally, extract and store the URL from $image_array
			$image_url = $image_array[0];
			?>
			<figure class="value-img">
				<img src="<?php echo $image_url; ?>">
			</figure>
			<div class="value-content">	
				<?php the_field( 'value_1' ); ?>
			</div>
		</article>

		<article class="value">
			<!-- get the image from the custom field -->
			<?php 
			// first, get the image ID returned by ACF
			$image_id = get_field('value_2_image');
			// and the image size you want to return
			$image_size = 'full';
			// use wp_get_attachment_image_src to return an array containing the image
			// we'll pass in the $image_id in the first parameter
			// and the image size registered using add_image_size() in the second
			$image_array = wp_get_attachment_image_src($image_id, $image_size);
			// finally, extract and store the URL from $image_array
			$image_url = $image_array[0];
			?>
			<figure class="value-img">
				<img src="<?php echo $image_url; ?>">
			</figure>
			<div class="value-content">	
				<?php the_field( 'value_2' ); ?>
			</div>
		</article>

		<article class="value">
			<!-- get the image from the custom field -->
			<?php 
			// first, get the image ID returned by ACF
			$image_id = get_field('value_3_image');
			// and the image size you want to return
			$image_size = 'full';
			// use wp_get_attachment_image_src to return an array containing the image
			// we'll pass in the $image_id in the first parameter
			// and the image size registered using add_image_size() in the second
			$image_array = wp_get_attachment_image_src($image_id, $image_size);
			// finally, extract and store the URL from $image_array
			$image_url = $image_array[0];
			?>
			<figure class="value-img">
				<img src="<?php echo $image_url; ?>">
			</figure>
			<div class="value-content">	
				<?php the_field( 'value_3' ); ?>
			</div>
		</article>
	</div><!-- end values-inner-cont -->
</section><!-- end values-cont section -->

<?php //bots_pagination(); ?>

<?php get_sidebar( 'Page' ); ?>
<?php get_footer(); //include footer.php ?>