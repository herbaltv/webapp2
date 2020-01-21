<?php

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'WooCommerce Settings', HERBS_TEXTDOMAIN ),
			'id'    => 'woocommerce-tab',
			'type'  => 'tab-title',
		));

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'WooCommerce Settings', HERBS_TEXTDOMAIN ),
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Number of products per page', HERBS_TEXTDOMAIN ),
			'id'   => 'products_pre_page',
			'type' => 'number',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Number of the related products', HERBS_TEXTDOMAIN ),
			'id'   => 'related_products_number',
			'type' => 'number',
		));

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'WooCommerce Sidebar Position', HERBS_TEXTDOMAIN ),
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'id'      => 'woo_sidebar_pos',
			'type'    => 'visual',
			'options' => array(
				''      => array( esc_html__( 'Default', HERBS_TEXTDOMAIN ) => 'default.png' ),
				'right'	=> array( esc_html__( 'Sidebar Right', HERBS_TEXTDOMAIN ) => 'sidebars/sidebar-right.png' ),
				'left'	=> array( esc_html__( 'Sidebar Left', HERBS_TEXTDOMAIN ) => 'sidebars/sidebar-left.png' ),
				'full'	=> array( esc_html__( 'Without Sidebar', HERBS_TEXTDOMAIN ) => 'sidebars/sidebar-full-width.png' ),
			)));

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'WooCommerce Product Page Sidebar Position', HERBS_TEXTDOMAIN ),
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'id'      => 'woo_product_sidebar_pos',
			'type'    => 'visual',
			'options' => array(
				''      => array( esc_html__( 'Default', HERBS_TEXTDOMAIN ) => 'default.png' ),
				'right'	=> array( esc_html__( 'Sidebar Right', HERBS_TEXTDOMAIN ) => 'sidebars/sidebar-right.png' ),
				'left'	=> array( esc_html__( 'Sidebar Left', HERBS_TEXTDOMAIN ) => 'sidebars/sidebar-left.png' ),
				'full'	=> array( esc_html__( 'Without Sidebar', HERBS_TEXTDOMAIN ) => 'sidebars/sidebar-full-width.png' ),
			)));

?>
