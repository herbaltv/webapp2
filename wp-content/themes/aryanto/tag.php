<?php
/**
 * The template for displaying tag pages
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

get_header(); ?>

	<div <?php tie_content_column_attr(); ?>>

		<?php if ( have_posts() ) : ?>


			<header class="entry-header-outer container-wrapper">
				<?php

					do_action( 'Herbs/before_archive_title' );

					the_archive_title( '<h1 class="page-title">', '</h1>' );

					if( tie_get_option( 'tag_desc' )){
						the_archive_description( '<div class="taxonomy-description entry">', '</div>' );
					}

					do_action( 'Herbs/after_archive_title' );

				?>
			</header><!-- .entry-header-outer /-->

			<?php

			// Get the layout template part
			HERBS_HELPER::get_template_part( 'templates/archives', '', array(
				'layout'         => tie_get_option( 'tag_layout', 'excerpt' ),
				'excerpt_length' => tie_get_option( 'tag_excerpt_length' ),
			));

			// Page navigation
			HERBS_PAGINATION::show( array( 'type' => tie_get_option( 'tag_pagination' ) ) );

		// If no content, include the "No posts found" template
		else :
			HERBS_HELPER::get_template_part( 'templates/not-found' );

		endif;

		?>

	</div><!-- .main-content /-->

<?php get_sidebar(); ?>
<?php get_footer();
