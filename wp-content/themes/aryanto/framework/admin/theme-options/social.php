<?php

tie_build_theme_option(
	array(
		'title' =>	esc_html__( 'Social Networks', HERBS_TEXTDOMAIN ),
		'id'    => 'social-networks-tab',
		'type'  => 'tab-title',
	));

tie_build_theme_option(
	array(
		'title' => esc_html__( 'Social Networks', HERBS_TEXTDOMAIN ),
		'id'    => 'social-networks',
		'type'  => 'header',
	));

tie_build_theme_option(
	array(
		'name'   => esc_html__( 'RSS', HERBS_TEXTDOMAIN ),
		'id'     => 'rss_icon',
		'type'   => 'checkbox',
		'toggle' => '#social-rss-item'
	));


$social_array	= tie_social_networks();

foreach ( $social_array as $network => $data ){

	$social_data = array(
		'name' => $data['title'],
		'id'   => 'social',
		'key'  => $network,
		'type' => 'arrayText',
	);

	$social_data['hint'] = ! empty( $data['hint'] ) ? $data['hint'] : '';

	tie_build_theme_option( $social_data );
}

for( $i = 1; $i <= 5; $i++ ){

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Custom Social Network', HERBS_TEXTDOMAIN ),
			'id'    => 'custom-social-network-' . $i ,
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Title', HERBS_TEXTDOMAIN ),
			'id'   => 'custom_social_title_'.$i,
			'type' => 'text',
		));

	tie_build_theme_option(
		array(
			'name'        => esc_html__( 'URL', HERBS_TEXTDOMAIN ),
			'id'          => 'custom_social_url_'.$i,
			'placeholder' => 'https://',
			'type'        => 'text',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Color', HERBS_TEXTDOMAIN ),
			'id'   => 'custom_social_color_'.$i,
			'type' => 'color',
		));

	tie_build_theme_option(
		array(
			'name'        => esc_html__( 'Icon', HERBS_TEXTDOMAIN ),
			'id'          => 'custom_social_icon_'.$i,
			'hint'        => '<a href="'. esc_url( 'https://fontawesome.com/v4.7.0/icons/' ) .'" target="_blank">'. esc_html__( 'Use the full Font Awesome icon name', HERBS_TEXTDOMAIN ) .'</a>',
			'type'        => 'text',
			'placeholder' => 'fa fa-icon',
		));

	tie_build_theme_option(
		array(
			'name'        => esc_html__( 'Image Icon', HERBS_TEXTDOMAIN ),
			'id'          => 'custom_social_icon_img_'.$i,
			'pre_text'    => esc_html__( '- OR -', HERBS_TEXTDOMAIN ),
			'type'        => 'upload',
			'placeholder' => 'https://',
		));
}
