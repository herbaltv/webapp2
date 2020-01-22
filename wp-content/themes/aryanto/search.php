<?php
/**
 * The template for displaying search results pages
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

get_header(); ?>

	<div <?php tie_content_column_attr(); ?>>

		<?php if ( have_posts() ) : ?>

			<header class="entry-header-outer container-wrapper">

				<?php do_action( 'Herbs/before_archive_title' ); ?>

				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', HERBS_TEXTDOMAIN ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>

				<?php do_action( 'Herbs/after_archive_title' ); ?>

			</header><!-- .entry-header-outer /-->

			<?php

			// Get the layout template part
			HERBS_HELPER::get_template_part( 'templates/archives', '', array(
				'layout'         => tie_get_option( 'search_layout', 'excerpt' ),
				'excerpt_length' => tie_get_option( 'search_excerpt_length' ),
			));

			// Page navigation
			HERBS_PAGINATION::show( array( 'type' => tie_get_option( 'search_pagination' ) ) );

		// If no content, include the "No posts found" template
		else :
			HERBS_HELPER::get_template_part( 'templates/not-found' );

		endif;

		?>

	</div><!-- .main-content /-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>