	<footer class="section fp-auto-height cf">
		<div class="footer-cont">
			<!-- custom footer with widgets inside -->
			<?php dynamic_sidebar( 'Footer Area Home' ); ?>
		</div>
	</footer><!-- end footer -->
</div><!-- closes #fullpage opened in header.php -->

<?php 
//must call wp_footer right before </body> for JS and plugins to run!
wp_footer();  ?>
</body>
</html>
