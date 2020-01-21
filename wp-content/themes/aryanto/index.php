<?php
/**
 * The main template file
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

get_header(); ?>

	<div <?php tie_content_column_attr(); ?>>

		<?php if ( have_posts() ) :

			// Get the layout template part
			HERBS_HELPER::get_template_part( 'templates/archives', '', array(
				'layout'         => tie_get_option( 'blog_display', 'excerpt' ),
				'excerpt_length' => tie_get_option( 'blog_excerpt_length' ),
			));

			// Page navigation
			HERBS_PAGINATION::show( array( 'type' => tie_get_option( 'blog_pagination' ) ) );

		// If no content, include the "No posts found" template
		else :
			HERBS_HELPER::get_template_part( 'templates/not-found' );

		endif;

		?>

	</div><!-- .main-content /-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
