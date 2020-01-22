<?php
/**
 * Header Main Template Part
 *
 * This template can be overridden by copying it to your-child-theme/templates/header/load.php.
 *
 * HOWEVER, on occasion Herbs will need to update template files and you
 * will need to copy the new files to your child theme to maintain compatibility.
 *
 * @author 		Herbs
 * @version   2.1.0
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly


// Show the header if it is enabled
if( ! apply_filters( 'Herbs/is_header_active', true ) ){
	return;
}

do_action( 'Herbs/before_header' );

// Rainbow Line
if( tie_get_option( 'rainbow_header' ) ){
	echo '<div class="rainbow-line"></div>';
}

?>
<header id="theme-header" <?php tie_header_class(); ?>>
	<?php

		// Top Nav Above the Header
		if( ! tie_get_option( 'top_nav_position' ) ){
			HERBS_HELPER::get_template_part( 'templates/header/nav', 'top' );
		}

		// Main Nav above the Header
		if( tie_get_option( 'main_nav_position' ) ){
			HERBS_HELPER::get_template_part( 'templates/header/nav', 'main' );
		}

		// Header Content area
		if( tie_get_option( 'header_layout', 3 ) != 1 ){
			HERBS_HELPER::get_template_part( 'templates/header/content' );
		}

		// Main Nav Below the Header
		if( ! tie_get_option( 'main_nav_position' ) ){
			HERBS_HELPER::get_template_part( 'templates/header/nav', 'main' );
		}

		// Top Nav Below the Header
		if( tie_get_option( 'top_nav_position' ) ){
			HERBS_HELPER::get_template_part( 'templates/header/nav', 'top' );
		}
		
		HERBS_HELPER::get_template_part( 'templates/header/tag' );

	?>
</header>
<?php

	do_action( 'Herbs/after_header' );

	// Get the main slider for the categories
	HERBS_HELPER::get_template_part('templates/category-slider');

	// Get single post below header layouts
	HERBS_HELPER::get_template_part( 'templates/header/posts-layout' );