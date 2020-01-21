<?php
/**
 * The template for displaying pages
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly
/*add_action( 'wp_enqueue_scripts', 'add_my_script' );
add_action( 'wp_enqueue_scripts', 'add_my_style' );
function add_my_style() {
	wp_enqueue_style(
        'slider',
		get_stylesheet_directory_uri() . '/owl/owl.css', false
    );
    wp_enqueue_style(
        'slider2',
		get_stylesheet_directory_uri() . '/owl/css/style.css', false
	);
	wp_enqueue_style(
        'slider3',
		get_stylesheet_directory_uri() . '/owl/css/owl.carousel.min.css', false
	);
	wp_enqueue_style(
        'responsive',
		get_stylesheet_directory_uri() . '/owl/css/responsive.css', false
	);
}
function add_my_script() {
    wp_enqueue_script(
        'carouselcool',
		get_stylesheet_directory_uri() . '/owl/js/owl.carousel.min.js', 
         array('jquery') 
    );
    wp_enqueue_script(
        'customjs',
		get_stylesheet_directory_uri() . '/owl/js/custom.js', 
         array('jquery') 
    );
}*/
get_header(); ?>

<?php

/**
 * Page Builder
 */
if( HERBS_HELPER::has_builder() ):

	// Get Blocks
	HERBS_HELPER::get_template_part( 'framework/blocks' );

	// After the page builder contents
	do_action( 'Herbs/after_builder_content' );


/**
 * Normal Page
 */
else:

	if ( have_posts() ) :

		while ( have_posts() ): the_post();

			HERBS_HELPER::get_template_part( 'templates/single-post/content' );

		endwhile;

	endif;

	get_sidebar();

endif;
?>

<?php
get_footer(); ?>
