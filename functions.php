<?php 
//turn on featured images
add_theme_support( 'post-thumbnails', array( 'post','bots', 'tot-bots', 'products', 'instructors' ) ); // Add it for posts );

add_theme_support( 'custom-background' );

//allows you to visually style different kinds of content
add_theme_support( 'post-formats', array(
	'audio', 
	'video', 
	'aside', 
	'gallery', 
	'image', 
	'quote', 
	'status', 
	'chat', 
	'link'
) );

//critical if you have a blog or news feed
add_theme_support( 'automatic-feed-links' );

//upgrade the markup that WP uses to HTML5
add_theme_support( 'html5', array( 
	'search-form', 
	'gallery', 
	'comment-list', 
	'comment-form', 
	'caption' 
) );

//don't forget to remove <title> tag from header.php
//this makes <title> more SEO friendly!
add_theme_support( 'title-tag' );

//make a custom image size for the home page banner
//regenerate your thumbnails after adding image sizes
//				 name,      width, height, crop?
add_image_size( 'big-banner', 1280, 400, true );

//allows you to add editor-style.css to control the look of the editor window
add_editor_style();


//customize the_excerpt()
function bots_excerpt_length(){
	return 20; //words
}
add_filter( 'excerpt_length', 'bots_excerpt_length', 999 );

function bots_readmore(){
	return ' ... <a href="' . get_permalink() . '" class="readmore">Read More</a>';
}
add_filter( 'excerpt_more', 'bots_readmore' );



//make comment replies more user friendly
function bots_comment_reply(){
	//attach <script>
	wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'bots_comment_reply' );


//register all the menu areas you need
function bots_menus(){
	register_nav_menus( array(
		//computer friendly name => human friendly name
		'main_menu' 	=> 'Main Navigation Menu',
		'utilities' 	=> 'Utilities',
		'footer'			=> 'Footer Menu',
	) );
}
add_action( 'init', 'bots_menus' );


//add custom header image
add_theme_support( 'custom-header' );


/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since The Bots Dance Crew 2.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function bots_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'bots_content_image_sizes_attr', 10 , 2 );



/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since The Bots Dance Crew 2.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function bots_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'bots_post_thumbnail_sizes_attr', 10 , 3 );







//Customization API stuff
//https://codex.wordpress.org/Theme_Customization_API
add_action( 'customize_register', 'bots_customize' );
function bots_customize( $wp_customize ){
	//Text Color
	//create the setting. this is the data that goes in the DB
	$wp_customize->add_setting( 'bots_text_color', array( 'default' => '#fff' ) );
	//color picker control UI
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'text_color',
		array(
			'label' => 'Body Text Color',
			'section' => 'colors', //this one is built-in
			'settings' => 'bots_text_color', //the one we registered above
		) 
	) );

	//Layout Choices
	//make a new accordion section
	$wp_customize->add_section( 'bots_layout', array(
		'title' => 'Site Layout',
		'priority' => 30,
	) );
	//make the setting. this gets stored in the DB
	$wp_customize->add_setting( 'bots_sidebar_layout', array( 'default' => 'right' ) );
	//add a radio button UI
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'sidebar_layout',
		array(
			'label' 	=> 'Sidebar Layout', //human friendly
			'section' 	=> 'bots_layout', //the section we added above
			'settings' 	=> 'bots_sidebar_layout', //the setting from above
			'type'		=> 'radio',
			'choices'	=> array(
				//code 		=> human
				'left' 		=> 'Sidebar on the left',
				'right'		=> 'Sidebar on the right',
			),
 		)
	) );


	//LOGO Uploader
	$wp_customize->add_setting('bots_logo');
	//cropper image upload UI
	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control(
		$wp_customize, 'bots_logo',	array(
			'label' 		=> 'Upload Your Logo',
			'description' => 'This logo appears in the top left corner of your website',
			'section'		=> 'title_tagline', //Site identity section
			'settings' 		=> 'bots_logo',
			'width'			=> 200,
			'height'		=> 124,
			'flex_width'	=> true, //let user change aspect ratio. set false to prevent changes for both height and width
			'flex_height'	=> true,
		)
	) );
 

	//Front Page Image Section
	//make a new accordion section
	$wp_customize->add_section( 'frontpage_background', array(
		'title' => 'Front Page Image',
		'priority' => 20,
	) );
	
	//frontpage background image Uploader
	$wp_customize->add_setting('frontpage_background_image1');
	//cropper image upload UI
	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control(
		$wp_customize, 'frontpage_background_image1',	array(
			'label' 		=> 'Upload Your Background For Section 1',
			'description' => 'This is the first image you will see on the home page.',
			'section'		=> 'frontpage_background', //Site identity section
			'settings' 		=> 'frontpage_background_image1',
			'flex_width'	=> true, //let user change aspect ratio. set false to prevent changes for both height and width
			'flex_height'	=> true,
		)
	) );

	/*	//frontpage background image Uploader
	$wp_customize->add_setting('frontpage_background_image2');
	//cropper image upload UI
	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control(
		$wp_customize, 'frontpage_background_image2',	array(
			'label' 		=> 'Upload Your Background For Section 2',
			'description' => 'This is the second image you will see on the home page.',
			'section'		=> 'frontpage_background', //Front Page Background section
			'settings' 		=> 'frontpage_background_image2',
			'flex_width'	=> true, //let user change aspect ratio. set false to prevent changes for both height and width
			'flex_height'	=> true,
		)
	) );*/

/*		//frontpage background image Uploader
	$wp_customize->add_setting('frontpage_background_image3');
	//cropper image upload UI
	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control(
		$wp_customize, 'frontpage_background_image3',	array(
			'label' 		=> 'Upload Your Background For Section 3',
			'description' => 'This is the third image you will see on the home page.',
			'section'		=> 'frontpage_background', //Site identity section
			'settings' 		=> 'frontpage_background_image3',
			'flex_width'	=> true, //let user change aspect ratio. set false to prevent changes for both height and width
			'flex_height'	=> true,
		)
	) );*/
}/* end bots customize*/






//register sidebars
//Create Widget Areas
add_action( 'widgets_init', 'bots_widget_areas' );
function bots_widget_areas(){
		register_sidebar( array(
		'name'			=> 'Home Sidebar',
		'description'	=> 'Appears in home page (front-page.php) (optional)',
		'id'			=> 'home_sidebar',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );

	register_sidebar( array(
		'name'			=> 'Blog Sidebar',
		'description'	=> 'Appears next to all blog pages',
		'id'			=> 'blog_sidebar',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );
	register_sidebar( array(
		'name'			=> 'Footer Area Home',
		'description'	=> 'Appears at the bottom of the home page',
		'id'			=> 'footer_area_home',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );
	register_sidebar( array(
		'name'			=> 'Footer Area',
		'description'	=> 'Appears at the bottom of every page except the home page',
		'id'			=> 'footer_area',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );
	register_sidebar( array(
		'name'			=> 'Page Sidebar',
		'description'	=> 'Appears next to static pages',
		'id'			=> 'page_sidebar',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );
};



//Helper function to display pagination on any template
function bots_pagination(){
	?>
	
	<section class="pagination">
			<?php 
			//numbered pagination was added in 4.1, so check before using it
			if( function_exists( 'the_posts_pagination' ) ){
				//numbered 
				the_posts_pagination( array(
					'next_text' => 'Next Page &rarr;',
					'prev_text' => '&larr;',
					'mid_size' 	=> 3,
				) ); 
			}else{
				previous_posts_link();
				next_posts_link();
			} ?>
	</section>

	<?php
} //end bots_pagination()




//fullpage slider Helper function to show up to 5 featured posts in responsive slides "slideshow" posts
function fullpage_slider(){
	$slider_posts = new WP_Query( array(
		'category_name' => 'slideshow',
		'posts_per_page' => 5,
	) );
	//custom loop
	if( $slider_posts->have_posts() ){
	?>
		<div class="section fullpage-slider">
			<?php while( $slider_posts->have_posts() ){
				$slider_posts->the_post(); ?>

			<div class="slide" style="background-image: url('<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); echo $src[0]; ?>');">
				<div class="slide-caption cf">
					<a class="featured-title" href="<?php the_permalink(); ?>">
						<h2><?php the_title(); ?></h2>
					</a>	
				<?php the_excerpt(); ?>
				</div><!-- end slide caption -->
			</div><!-- end slide -->

			<?php } //end while ?>
			</div>
	<?php
	} //end if
	wp_reset_postdata();
} //end of slider function






// slider 
function bots_slider(){
	$slider_posts = new WP_Query( array(
		'category_name' => 'slideshow',
		'posts_per_page' => 5,
	) );
	//custom loop
	if( $slider_posts->have_posts() ){
	?>
	<section id="bots-slider">
		<ul class="rslides">
			<?php while( $slider_posts->have_posts() ){
				$slider_posts->the_post(); ?>
			<li>
					<figure>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'big-banner' ); ?>
						</a>
						<div class="controls cf"></div>
					</figure>
					<div class="slide-caption cf">
					<a class="featured-title" href="<?php the_permalink(); ?>">
						<h2><?php the_title(); ?></h2>
					</a>	
					<?php the_excerpt(); ?>
					</div><!-- end slide caption -->
			</li>
			<?php } //end while ?>
		</ul>
	</section>
	<?php
	} //end if
	wp_reset_postdata();
} //end of slider function










//Helper function to display BOTS thumbnails anywhere on the site
function static_bots_posts( $number = 5, $title = ''  ){
	//get recent products (post type)
	$bots_posts = new WP_Query( array(
		'post_type' 		=> 'post',
		'posts_per_page' 	=> $number,
	) );

	//custom loop
	if( $bots_posts->have_posts() ){	 ?>
	<section id="front-page-posts">
		<h2><?php echo $title; ?></h2>
		<ul class="latest-posts">
		<?php while( $bots_posts->have_posts() ){
				$bots_posts->the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'thumbnail' ); ?>
				</a>

				<div class="latest-posts-info">
					<a href="<?php the_permalink(); ?>">
						<h3><?php the_title(); ?></h3>
					</a>
					<?php the_excerpt(); ?>
				</div>
			</li>
		<?php } //end while ?>
		</ul>
	</section>
	<?php } // end if
	//clean up after a custom query
	wp_reset_postdata();
}



/* exclude certain categories from the static home page (front-page.php) */
function exclude_category($query) {
if ( $query->is_front_page() ) {
/* to get category id login into wp backend, go to catagories page and hover over category. The url will have the id in it. */
			// category, category id
$query->set('cat', '-192');
}
return $query;
}
add_filter('pre_get_posts', 'exclude_category');








/* get image and display from advanced custom fields */

function bots_values($value_image) {
	// first, get the image ID returned by ACF
	$image_id = get_field($value_image);
	// and the image size you want to return
	$image_size = 'full';
	// use wp_get_attachment_image_src to return an array containing the image
	// we'll pass in the $image_id in the first parameter
	// and the image size registered using add_image_size() in the second
	$image_array = wp_get_attachment_image_src($image_id, $image_size);
	// finally, extract and store the URL from $image_array
	$image_url = $image_array[0]; 

	if (!$value_image == '') { ?>
		<figure>
			<img src="<?php echo $image_url; ?>">
		</figure>
<?php
	}//end if
	//wp_reset_postdata();

}//end function bots_values













//look for shortcodes.php in the theme's function folder
include('functions/shortcodes.php');




/* Advanced Custom Fields Plugin in funcions folder */
include_once('functions/advanced-custom-fields/acf.php');
/* Advance Custom Fields on Home Page */





//include custom ninjaforms css
include('functions/ninjaforms-css.php');


















/**
 * Handles JavaScript detection.
 *
 * Removes class no-js and adds class `js` to the root `<html>` element when JavaScript is detected. *** MUST ADD class="no-js" to the <html> for it to work.
 *
 * @since The Bots 2.0
 */
function bots_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'bots_javascript_detection', 0 );


//Attach Javascript and CSS files
function bots_scripts(){
		//reset.css
	$reset = get_stylesheet_directory_uri() . '/css/reset.css';
	wp_enqueue_style( 'reset', $reset );

	$fullpage_css = get_stylesheet_directory_uri() . '/css/jquery.fullpage.min.css';
	wp_enqueue_style( 'fullpage_css', $fullpage_css );

	$font_awesome = get_stylesheet_directory_uri() . '/css/font-awesome.min.css';
	wp_enqueue_style( 'font-awesome', $font_awesome );

	//style.css
	wp_enqueue_style( 'main-stylesheet', get_stylesheet_uri() );

	//jquery
	wp_enqueue_script( 'jquery' );

	//responsiveslides.js
	$rs = get_stylesheet_directory_uri() . '/js/responsiveslides.min.js' ;
	//					handle             url   deps      ver   footer?
	wp_enqueue_script( 'responsiveslides', $rs, 'jquery', '1.54', true );


	//jquery.slimscroll.min.js
	$slimscroll = get_stylesheet_directory_uri() . '/js/jquery.slimscroll.min.js';
	wp_enqueue_script( 'slimscroll', $slimscroll, 'jquery', '1.0', true );


	//jquery.fullpage.js
	$fullpage = get_stylesheet_directory_uri() . '/js/jquery.fullpage.min.js';
	wp_enqueue_script( 'fullpage', $fullpage, 'jquery', '1.0', true );



	// Load the html5 shiv.
	wp_enqueue_script( 'bots-html5', get_template_directory_uri() . '/js/html5shiv.js', array(), '3.7.3' );
	wp_script_add_data( 'bots-html5', 'conditional', 'lt IE 9' );

	//main.js
	$main = get_stylesheet_directory_uri() . '/js/main.js';
	wp_enqueue_script( 'main', $main , 'responsiveslides', '1.0', true);
}
add_action( 'wp_enqueue_scripts', 'bots_scripts' );



//customize the CSS of the login/register form
function bots_login_css(){
	$url = get_stylesheet_directory_uri() . '/css/login.css';
	wp_enqueue_style( 'login-css', $url );
}
add_action( 'login_enqueue_scripts', 'bots_login_css' );

function bots_logo_tooltip(){
	return 'Return to ' . get_bloginfo( 'name' );
}
add_filter( 'login_headertitle', 'bots_logo_tooltip' );












//no close php