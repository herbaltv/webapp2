<?php
/**
 * The template for displaying the header
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body id="tie-body" <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div class="background-overlay">

	<div id="tie-container" class="site tie-container">

		<?php do_action( 'Herbs/before_wrapper' ); ?>

		<div id="tie-wrapper">

			<?php

				HERBS_HELPER::get_template_part( 'templates/header/load' );

				do_action( 'Herbs/before_main_content' );
