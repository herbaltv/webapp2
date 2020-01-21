<?php

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'bbPress', HERBS_TEXTDOMAIN ),
			'id'    => 'bbpress-tab',
			'type'  => 'tab-title',
		));

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Sidebar Position', HERBS_TEXTDOMAIN ),
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'id'      => 'bbpress_sidebar_pos',
			'type'    => 'visual',
			'options' => array(
				''      => array( esc_html__( 'Default', HERBS_TEXTDOMAIN )         => 'default.png' ),
				'right'	=> array( esc_html__( 'Sidebar Right', HERBS_TEXTDOMAIN )   => 'sidebars/sidebar-right.png' ),
				'left'	=> array( esc_html__( 'Sidebar Left', HERBS_TEXTDOMAIN )    => 'sidebars/sidebar-left.png' ),
				'full'	=> array( esc_html__( 'Without Sidebar', HERBS_TEXTDOMAIN ) => 'sidebars/sidebar-full-width.png' ),
			)));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'bbPress Sidebar', HERBS_TEXTDOMAIN ),
			'id'      => 'sidebar_bbpress',
			'type'    => 'select',
			'options' => HERBS_ADMIN_HELPER::get_sidebars(),
		));
