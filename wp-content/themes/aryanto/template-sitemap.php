<?php
/**
 * Template Name: Sitemap Page
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly


add_action( 'Herbs/after_post_content', 'tie_template_sitemap', 4 );

HERBS_HELPER::get_template_part( 'page' );
