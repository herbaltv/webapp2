<?php

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Blocks Settings', HERBS_TEXTDOMAIN ),
			'id'    => 'blocks-tab',
			'type'  => 'tab-title',
		));


	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'Block Style', HERBS_TEXTDOMAIN ),
			'type'  => 'header',
		));


	tie_build_theme_option(
		array(
			'id'      => 'boxes_style',
			'type'    => 'visual',
			'options' => array(
				'1'	=> array( esc_html__( 'Bordered', HERBS_TEXTDOMAIN ) => 'blocks/magazine-1.png' ),
				'2' => array( esc_html__( 'Clean', HERBS_TEXTDOMAIN )    => 'blocks/magazine-2.png' ),
			)));

	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'Block Head Style', HERBS_TEXTDOMAIN ),
			'type'  => 'header',
		));


	tie_build_theme_option(
		array(
			'id'      => 'blocks_style',
			'type'    => 'visual',
			'options' => array(
				'1'	=> array( esc_html__( 'Style', HERBS_TEXTDOMAIN ) .' #1' => 'blocks/head-1.png' ),
				'2' => array( esc_html__( 'Style', HERBS_TEXTDOMAIN ) .' #2' => 'blocks/head-2.png' ),
				'3' => array( esc_html__( 'Style', HERBS_TEXTDOMAIN ) .' #3' => 'blocks/head-3.png' ),
				'4' => array( esc_html__( 'Style', HERBS_TEXTDOMAIN ) .' #4' => 'blocks/head-4.png' ),
				'5' => array( esc_html__( 'Style', HERBS_TEXTDOMAIN ) .' #5' => 'blocks/head-5.png' ),
				'6' => array( esc_html__( 'Style', HERBS_TEXTDOMAIN ) .' #6' => 'blocks/head-6.png' ),
				'7' => array( esc_html__( 'Style', HERBS_TEXTDOMAIN ) .' #7' => 'blocks/head-7.png' ),
				'8' => array( esc_html__( 'Style', HERBS_TEXTDOMAIN ) .' #8' => 'blocks/head-8.png' ),
			)));


	# Global Blocks Meta Settings
	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'Blocks Meta Settings', HERBS_TEXTDOMAIN ),
			'id'    =>	'blocks-meta-settings',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Disable Author name meta', HERBS_TEXTDOMAIN ),
			'id'   => 'blocks_disable_author_meta',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Disable Comments number meta', HERBS_TEXTDOMAIN ),
			'id'   => 'blocks_disable_comments_meta',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Disable Views Number meta', HERBS_TEXTDOMAIN ),
			'id'   => 'blocks_disable_views_meta',
			'type' => 'checkbox',
		));
