<?php

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Layout', HERBS_TEXTDOMAIN ),
			'id'    => 'layout-tab',
			'type'  => 'tab-title',
		));



	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'Site Width', HERBS_TEXTDOMAIN ),
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Site Width', HERBS_TEXTDOMAIN ),
			'id'      => 'site_width',
			'type'    => 'text',
			'default' => '1200px',
			'hint'    => esc_html__( 'Controls the overall site width. In px or %, ex: 100% or 1170px.', HERBS_TEXTDOMAIN ),
		));



	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Theme Layout', HERBS_TEXTDOMAIN ),
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'id'      => 'theme_layout',
			'type'    => 'visual',
			'options' => array(
				'full'   => array( esc_html__( 'Full-Width', HERBS_TEXTDOMAIN ) => 'layouts/layout-full.png'   ),
				'boxed'  => array( esc_html__( 'Boxed', HERBS_TEXTDOMAIN )      => 'layouts/layout-boxed.png'  ),
				'framed' => array( esc_html__( 'Framed', HERBS_TEXTDOMAIN )     => 'layouts/layout-framed.png' ),
				'border' => array( esc_html__( 'Bordered', HERBS_TEXTDOMAIN )   => 'layouts/layout-border.png' ),
			)));



	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'Loader Icon', HERBS_TEXTDOMAIN ),
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'id'      => 'loader-icon',
			'type'    => 'visual',
			'options' => array(
				'1'	=> 'ajax-loader-1.png',
				'2' => 'ajax-loader-2.png',
			)));
