<?php

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Lightbox Settings', HERBS_TEXTDOMAIN ),
			'id'    => 'lightbox-settings-tab',
			'type'  => 'tab-title',
		));

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Lightbox Settings', HERBS_TEXTDOMAIN ),
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Enable Lightbox Automatically', HERBS_TEXTDOMAIN ),
			'hint' => esc_html__( 'Enable Lightbox automatically for all images linked to an image file in the post content area', HERBS_TEXTDOMAIN ),
			'id'   => 'lightbox_all',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Lightbox for Galleries', HERBS_TEXTDOMAIN ),
			'hint' => esc_html__( 'Enable Lightbox automatically for all images added via [gallery] shortcode in the content area', HERBS_TEXTDOMAIN ),
			'id'   => 'lightbox_gallery',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Lightbox Skin', HERBS_TEXTDOMAIN ),
			'id'      => 'lightbox_skin',
			'type'    => 'select',
			'options' => array(
				'dark'        => 'dark',
				'light'       => 'light',
				'smooth'      => 'smooth',
				'metro-black' => 'metro-black',
				'metro-white' => 'metro-white',
				'mac'         => 'mac',
			)));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Lightbox Thumbnail Position', HERBS_TEXTDOMAIN ),
			'id'      => 'lightbox_thumbs',
			'type'    => 'radio',
			'options' => array(
				'vertical'   => esc_html__( 'Vertical',   HERBS_TEXTDOMAIN ),
				'horizontal' => esc_html__( 'Horizontal', HERBS_TEXTDOMAIN ),
			)));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Show Lightbox Arrows', HERBS_TEXTDOMAIN ),
			'id'   => 'lightbox_arrows',
			'type' => 'checkbox',
		));

?>
