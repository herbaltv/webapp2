<?php
/**
 * The main template file
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

//wp_enqueue_style( 'slider', get_template_directory_uri() . '/owl/owl.css',false,'1.1','all');
//wp_enqueue_style( 'slider', get_template_directory_uri() . '/owl/css/style.css',false,'1.1','all');
//wp_enqueue_style( 'slider', get_template_directory_uri() . '/owl/css/owl.carousel.min.css',false,'1.1','all');
//wp_enqueue_style( 'slider', get_template_directory_uri() . '/owl/css/owl.theme.default.min.css',false,'1.1','all');
//wp_enqueue_style( 'slider', get_template_directory_uri() . '/owl/css/responsive.css',false,'1.1','all');
//wp_enqueue_script( 'script', get_template_directory_uri() . '/owl/js/custom.js', false, 1.1, true);
//wp_enqueue_script( 'script', get_template_directory_uri() . '/owl/js/owl.carousel.min.js', false, 1.1, true);
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
