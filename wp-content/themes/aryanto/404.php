<?php
/**
 * The template for displaying 404 pages (not found)
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

get_header(); ?>

	<div <?php tie_content_column_attr(); ?>>

		<div class="container-404">

			<?php
				/**
				 * tie_before_404_content hook.
				 */
				do_action( 'Herbs/before_404_content' );
			?>

			<h2><?php esc_html_e( '404 :(', HERBS_TEXTDOMAIN ); ?></h2>
			<h3><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', HERBS_TEXTDOMAIN ); ?></h3>
			<h4><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', HERBS_TEXTDOMAIN ); ?></h4>

			<div id="content-404">
				<?php get_search_form(); ?>
			</div><!-- #content-404 /-->

			<?php
				if( has_nav_menu( '404-menu' ) ){
					wp_nav_menu(
						array(
							'menu_id'        => 'menu-404',
							'container_id'   => 'menu-404',
							'theme_location' => '404-menu',
							'depth'          => 1,
						));
				}
			?>

			<?php
				/**
				 * tie_after_404_content hook.
				 */
				do_action( 'Herbs/after_404_content' );
			?>

		</div><!-- .container-404 /-->

	</div><!-- .main-content /-->

<?php get_footer(); ?>
