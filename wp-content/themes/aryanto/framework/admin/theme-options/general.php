<?php

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'General Settings', HERBS_TEXTDOMAIN ),
			'id'    => 'general-settings-tab',
			'type'  => 'tab-title',
		));


	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'Date Settings', HERBS_TEXTDOMAIN ),
			'id'    => 'time-format-settings',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Date format for blog posts', HERBS_TEXTDOMAIN ),
			'id'      => 'time_format',
			'type'    => 'radio',
			'options' => array(
				'traditional' => esc_html__( 'Traditional', HERBS_TEXTDOMAIN ),
				'modern'      => esc_html__( 'Time Ago Format', HERBS_TEXTDOMAIN ),
				'none'        => esc_html__( 'Disable all', HERBS_TEXTDOMAIN ),
			)));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Show the date depending on', HERBS_TEXTDOMAIN ),
			'id'      => 'time_type',
			'type'    => 'radio',
			'options' => array(
				'published' => esc_html__( 'Post Published Date', HERBS_TEXTDOMAIN ),
				'modified'  => esc_html__( 'Post Modified Date', HERBS_TEXTDOMAIN ),
			)));


	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'Breadcrumbs Settings', HERBS_TEXTDOMAIN ),
			'id'    => 'breadcrumbs-settings',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Breadcrumbs', HERBS_TEXTDOMAIN ),
			'id'     => 'breadcrumbs',
			'toggle' => '#breadcrumbs_delimiter-item',
			'type'   => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Breadcrumbs Delimiter', HERBS_TEXTDOMAIN ),
			'id'      => 'breadcrumbs_delimiter',
			'type'    => 'text',
			'default' => '&#47;',
		));


	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'Trim Text Settings', HERBS_TEXTDOMAIN ),
			'id'    => 'trim-text-settings',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Trim text by', HERBS_TEXTDOMAIN ),
			'id'      => 'trim_type',
			'type'		=> 'radio',
			'options'	=> array(
				'words' =>	esc_html__( 'Words', HERBS_TEXTDOMAIN ) ,
				'chars'	=>	esc_html__( 'Characters', HERBS_TEXTDOMAIN ),
			)));

	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'Post format icon on hover', HERBS_TEXTDOMAIN ),
			'id'    => 'post-font-icon',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Show the post format icon on hover?', HERBS_TEXTDOMAIN ),
			'id'     => 'thumb_overlay',
			'type'   => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'Custom Codes', HERBS_TEXTDOMAIN ),
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Header Code', HERBS_TEXTDOMAIN ),
			'id'   => 'header_code',
			'hint' => esc_html__( 'Will add to the &lt;head&gt; tag. Useful if you need to add additional codes such as CSS or JS.', HERBS_TEXTDOMAIN ),
			'type' => 'textarea',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Body Code', HERBS_TEXTDOMAIN ),
			'id'   => 'body_code',
			'hint' => esc_html__( 'Will add after opening the &lt;body&gt; tag.', HERBS_TEXTDOMAIN ),
			'type' => 'textarea',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Footer Code', HERBS_TEXTDOMAIN ),
			'id'   => 'footer_code',
			'hint' => esc_html__( 'Will add to the footer before the closing  &lt;/body&gt; tag. Useful if you need to add Javascript.', HERBS_TEXTDOMAIN ),
			'type' => 'textarea',
		));
?>
