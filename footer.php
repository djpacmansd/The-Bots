	<footer class="section cf">
	<div class="footer-cont">
		<!-- custom footer with widgets inside -->
		<?php dynamic_sidebar( 'Footer Area' ); ?>
	</div>
	</footer><!-- end footer -->

<?php 
//must call wp_footer right before </body> for JS and plugins to run!
wp_footer();  ?>
</body>
</html>
