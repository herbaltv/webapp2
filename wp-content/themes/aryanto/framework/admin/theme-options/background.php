<?php

	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'Background (in case Boxed / Framed / Bordered layout is enabled)', HERBS_TEXTDOMAIN ),
			'id'    => 'background-tab',
			'type'  => 'tab-title',
		));

	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'Background', HERBS_TEXTDOMAIN ),
			'id'    => 'background-settings',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'text'  => esc_html__( 'Bordered Layout supports plain background color only.', HERBS_TEXTDOMAIN ),
			'type'  => 'message',
		));

	tie_build_theme_option(
		array(
			'name'  => esc_html__( 'Background Color', HERBS_TEXTDOMAIN ),
			'id'    => 'background_color',
			'type'  => 'color',
		));

	tie_build_theme_option(
		array(
			'name'  => esc_html__( 'Background Color 2', HERBS_TEXTDOMAIN ),
			'id'    => 'background_color_2',
			'type'  => 'color',
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Background Image type', HERBS_TEXTDOMAIN ),
			'id'     => 'background_type',
			'type'   => 'radio',
			'toggle' => array(
				''        => '',
				'pattern' => '#background_pattern-item',
				'image'   => '#background_image-item',
			),
			'options' => array(
				''        => esc_html__( 'None',    HERBS_TEXTDOMAIN ),
				'pattern' => esc_html__( 'Pattern', HERBS_TEXTDOMAIN ),
				'image'   => esc_html__( 'Image',   HERBS_TEXTDOMAIN ),
			)));

	tie_build_theme_option(
		array(
			'name'  => esc_html__( 'Background Pattern', HERBS_TEXTDOMAIN ),
			'id'      => 'background_pattern',
			'type'    => 'visual',
			'class'   => 'background_type',
			'options' => HERBS_ADMIN_HELPER::get_patterns(),
		));

	tie_build_theme_option(
		array(
			'name'  => esc_html__( 'Background Image', HERBS_TEXTDOMAIN ),
			'id'    => 'background_image',
			'class' => 'background_type',
			'type'  => 'background',
		));


	tie_build_theme_option(
		array(
			'type'  => 'header',
			'title' => esc_html__( 'Background Settings', HERBS_TEXTDOMAIN ),
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Dots overlay layer', HERBS_TEXTDOMAIN ),
			'id'   => 'background_dots',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Background dimmer', HERBS_TEXTDOMAIN ),
			'id'     => 'background_dimmer',
			'toggle' => '#background_dimmer_value-item, #background_dimmer_color-item',
			'type'   => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Background dimmer', HERBS_TEXTDOMAIN ),
			'id'   => 'background_dimmer_value',
			'hint' => esc_html__( 'Value between 0 and 100 to dim background image. 0 - no dim, 100 - maximum dim.', HERBS_TEXTDOMAIN ),
			'type' => 'number',
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Background dimmer color', HERBS_TEXTDOMAIN ),
			'id'      => 'background_dimmer_color',
			'type'    => 'radio',
			'options'	=> array(
				'black' => esc_html__( 'Black', HERBS_TEXTDOMAIN ),
				'white' => esc_html__( 'White', HERBS_TEXTDOMAIN ),
			)));

?>
