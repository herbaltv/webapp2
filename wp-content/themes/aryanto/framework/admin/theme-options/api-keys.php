<?php

tie_build_theme_option(
	array(
		'title' =>	esc_html__( 'API Keys', HERBS_TEXTDOMAIN ),
		'id'    => 'api-keys-tab',
		'type'  => 'tab-title',
	));

tie_build_theme_option(
	array(
		'title' => esc_html__( 'Google Maps', HERBS_TEXTDOMAIN ),
		'id'    => 'google-maps-api-key',
		'type'  => 'header',
	));

tie_build_theme_option(
	array(
		'name' => esc_html__( 'Google Maps API Key', HERBS_TEXTDOMAIN ),
		'id'   => 'api_google_maps',
		'hint' => esc_html__( 'Used for the Map post format.', HERBS_TEXTDOMAIN ),
		'type' => 'text',
	));

tie_build_theme_option(
	array(
		'title' => esc_html__( 'YouTube', HERBS_TEXTDOMAIN ),
		'id'    => 'youtube-api-key',
		'type'  => 'header',
	));

tie_build_theme_option(
	array(
		'name' => esc_html__( 'YouTube API Key', HERBS_TEXTDOMAIN ),
		'id'   => 'api_youtube',
		'hint' => esc_html__( 'Used for the Videos Playlist Block.', HERBS_TEXTDOMAIN ),
		'type' => 'text',
	));


tie_build_theme_option(
	array(
		'title' => esc_html__( 'Weather', HERBS_TEXTDOMAIN ),
		'id'    => 'weather-api-key',
		'type'  => 'header',
	));

tie_build_theme_option(
	array(
		'name'  => esc_html__( 'OpenWeather API Key', HERBS_TEXTDOMAIN ),
		'hint'  => '<a href="'. esc_url( 'http://openweathermap.org/appid#get' ) .'" target="_blank">'. esc_html__( 'How to get your API Key?', HERBS_TEXTDOMAIN ) .'</a>',
		'id'    => 'api_openweather',
		'type'  => 'text',
	));
