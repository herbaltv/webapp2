<?php

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Post Views Settings', HERBS_TEXTDOMAIN ),
			'id'    => 'post-views-tab',
			'type'  => 'tab-title',
		));

	tie_build_theme_option(
		array(
			'type'  => 'header',
			'id'    => 'post-views-settings',
			'title' => esc_html__( 'Post Views Source', HERBS_TEXTDOMAIN ),
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Post Views Source', HERBS_TEXTDOMAIN ),
			'id'      => 'tie_post_views',
			'type'    => 'select',
			'options' => array(
				''        => esc_html__( 'Disable', HERBS_TEXTDOMAIN ),
				'theme'   => esc_html__( "Theme's module", HERBS_TEXTDOMAIN ),
				'jetpack' => esc_html__( 'Jetpack plugin by Automattic', HERBS_TEXTDOMAIN ),
				'plugin'  => esc_html__( 'Third party post views plugin', HERBS_TEXTDOMAIN ),
			),
			'toggle'  => array(
				'theme'  => '#views_meta_field-item, #views_starter_number-item',
				'plugin' => '#views_meta_field-item',
			)
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Post meta field', HERBS_TEXTDOMAIN ),
			'id'      => 'views_meta_field',
			'type'    => 'text',
			'class'   => 'tie_post_views',
			'default' => 'tie_views',
			'hint'    => esc_html__( 'Chnage this if you have used a post views plugin before.', HERBS_TEXTDOMAIN ),
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Starter Post Views number', HERBS_TEXTDOMAIN ),
			'id'      => 'views_starter_number',
			'type'    => 'number',
			'class'   => 'tie_post_views',
			'hint'    => esc_html__( 'This will applied on the new Posts only.', HERBS_TEXTDOMAIN ),
		));

	tie_build_theme_option(
		array(
			'type'  => 'header',
			'id'    => 'post-views-colored',
			'title' => esc_html__( 'Colored Post Views Numbers', HERBS_TEXTDOMAIN ),
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Colored Post Views Numbers', HERBS_TEXTDOMAIN ),
			'id'     => 'views_colored',
			'toggle' => '#views_warm_color-item, #views_hot_color-item, #views_veryhot_color-item',
			'type'   => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => sprintf( esc_html__( '%s Min. Views Number', HERBS_TEXTDOMAIN ), '<span class="tie-number-views-badge" style="background: #f47512">'. esc_html__( 'WARM', HERBS_TEXTDOMAIN ) .'</span>' ),
			'id'   => 'views_warm_color',
			'type' => 'number',
			'hint' => sprintf( esc_html__( 'Default is: %s', HERBS_TEXTDOMAIN ), 500 ),
		));

	tie_build_theme_option(
		array(
			'name' => sprintf( esc_html__( '%s Min. Views Number', HERBS_TEXTDOMAIN ), '<span class="tie-number-views-badge" style="background: #f3502a">'. esc_html__( 'HOT', HERBS_TEXTDOMAIN ) .'</span>' ),
			'id'   => 'views_hot_color',
			'type' => 'number',
			'hint' => sprintf( esc_html__( 'Default is: %s', HERBS_TEXTDOMAIN ), 2000 ),
		));

	tie_build_theme_option(
		array(
			'name' => sprintf( esc_html__( '%s Min. Views Number', HERBS_TEXTDOMAIN ), '<span class="tie-number-views-badge" style="background: #f11e1e">'. esc_html__( 'VERY HOT', HERBS_TEXTDOMAIN ) .'</span>' ),
			'id'   => 'views_veryhot_color',
			'type' => 'number',
			'hint' => sprintf( esc_html__( 'Default is: %s', HERBS_TEXTDOMAIN ), 5000 ),
		));


