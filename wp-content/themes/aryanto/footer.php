<?php
/**
 * The template for displaying the footer
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly


do_action( 'Herbs/after_main_content' );

HERBS_HELPER::get_template_part( 'templates/footer' );

?>

		</div><!-- #tie-wrapper /-->

		<?php get_sidebar( 'slide' ); ?>

	</div><!-- #tie-container /-->
</div><!-- .background-overlay /-->
<?php wp_footer(); ?>
</body>
</html>
