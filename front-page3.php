<?php get_header(); //include header.php ?>

<main id="content">
<div class="section">
 <h2>SOME STUFF</h2>
</div>

<div class="section">
<?php bots_slider(); ?>
</div>

<div class="section">
<?php static_bots_posts( 5, 'Latest Posts' ); ?>
</div>

</main><!-- end #content -->
<div class="section">
SIDE BAR
<?php get_sidebar(); //include sidebar.php ?>
</div>
<div class="section">
FOOTER
<?php get_footer(); //include footer.php ?>
</div>