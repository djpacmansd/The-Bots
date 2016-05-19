<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<title><?php bloginfo( 'name' ) ?> | <?php the_title(); ?></title>
	<?php wp_head(); //Necessary in <head> for JS and plugins to work. ?>
</head>
<body <?php body_class(); ?>>
<a href="javascript:" id="return-to-top"><i class="icon-chevron-up"></i></a>

	<header>	
		<div class="top-bar-cont">
			<div class="nav-cont">
				<?php 
//don't forget to register theme locations in functions.php
				wp_nav_menu( array(
					'theme_location' => 'main_menu',
					'container'		=> 'nav', 	//wrap ul in <nav>
					'container-class' => 'main-nav',
					'menu_class'	=> 'main-nav' //nav class="main-nav
					) ); ?>			
				</div><!-- end .nav-cont -->
			<div class="top-bar cf">
				<!-- custom logo upload : registered in functions -->
				<a id="site-logo" class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php echo wp_get_attachment_image( get_theme_mod('bots_logo'), 'full' ); ?>
				</a> 

				<div id="tb-right" class="cf">
					<?php get_search_form(); ?>
					<a href="#" id="menu-btn" class="menu-btn menu-btn-animation btn-open"><span></span></a>
				</div>
			</div><!--  end .top-bar -->
		</div><!--  end .top-bar-cont -->
	</header><!-- end .site-header -->








