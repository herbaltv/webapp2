<?php

tie_build_theme_option(
	array(
		'title' =>	esc_html__( 'Share Settings', HERBS_TEXTDOMAIN ),
		'id'    => 'share-settings-tab',
		'type'  => 'tab-title',
	));


# General share buttons settings
tie_build_theme_option(
	array(
		'title' => esc_html__( 'General Settings', HERBS_TEXTDOMAIN ),
		'id'    => 'share-general-settings',
		'type'  => 'header',
	));

tie_build_theme_option(
	array(
		'name' => esc_html__( 'Share Buttons for Pages', HERBS_TEXTDOMAIN ),
		'id'   => 'share_buttons_pages',
		'type' => 'checkbox',
	));

tie_build_theme_option(
	array(
		'name' => esc_html__( "Use the post's Short Link", HERBS_TEXTDOMAIN ),
		'id'   => 'share_shortlink',
		'type' => 'checkbox',
	));

tie_build_theme_option(
	array(
		'name' => esc_html__( 'Twitter Username', HERBS_TEXTDOMAIN ) . ' <small>'. esc_html__( '(optional)', HERBS_TEXTDOMAIN ). '</small>',
		'id'   => 'share_twitter_username',
		'type' => 'text',
	));


# Above Posts share buttons
tie_build_theme_option(
	array(
		'title' => esc_html__( 'Above Post share Buttons', HERBS_TEXTDOMAIN ),
		'id'    => 'above-post-share',
		'type'  => 'header',
	));

tie_build_theme_option(
	array(
		'name'   => esc_html__( 'Above Post share Buttons', HERBS_TEXTDOMAIN ),
		'id'     => 'share_post_top',
		'type'   => 'checkbox',
		'toggle' => '#share-top-options',
	));

echo '<div id="share-top-options">';
	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Center the buttons', HERBS_TEXTDOMAIN ),
			'id'   => 'share_center_top',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Show the share title', HERBS_TEXTDOMAIN ),
			'id'   => 'share_title_top',
			'hint' => sprintf( esc_html__( 'You can change the "%s" text from the Translation tab.', HERBS_TEXTDOMAIN ), esc_html__( 'Share', HERBS_TEXTDOMAIN ) ),
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name'	  => esc_html__( 'Share Buttons Style', HERBS_TEXTDOMAIN ),
			'id'      => 'share_style_top',
			'type'    => 'visual',
			'options' => array(
				''        => 'share/share-1.png',
				'style_2' => 'share/share-2.png',
				'style_3' => 'share/share-3.png',
				'style_4' => 'share/share-4.png',
		)));

	tie_get_share_buttons_options( 'top' );
echo '</div>';


# Below Posts share buttons
tie_build_theme_option(
	array(
		'title' => esc_html__( 'Below Post Share Buttons', HERBS_TEXTDOMAIN ),
		'type'  => 'header',
	));

tie_build_theme_option(
	array(
		'name'   => esc_html__( 'Below Post Share Buttons', HERBS_TEXTDOMAIN ),
		'id'     => 'share_post_bottom',
		'type'   => 'checkbox',
		'toggle' => '#share-bottom-options',
	));

echo '<div id="share-bottom-options">';
	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Center the buttons', HERBS_TEXTDOMAIN ),
			'id'   => 'share_center_bottom',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Show the share title', HERBS_TEXTDOMAIN ),
			'id'   => 'share_title_bottom',
			'hint' => sprintf( esc_html__( 'You can change the "%s" text from the Translation tab.', HERBS_TEXTDOMAIN ), esc_html__( 'Share', HERBS_TEXTDOMAIN ) ),
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name'	  => esc_html__( 'Share Buttons Style', HERBS_TEXTDOMAIN ),
			'id'      => 'share_style_bottom',
			'type'    => 'visual',
			'options' => array(
				''        => 'share/share-1.png',
				'style_2' => 'share/share-2.png',
				'style_3' => 'share/share-3.png',
				'style_4' => 'share/share-4.png',
		)));

	tie_get_share_buttons_options();
echo '</div>';


# General share buttons settings
tie_build_theme_option(
	array(
		'title' => esc_html__( 'Select and Share', HERBS_TEXTDOMAIN ),
		'id'    => 'select-and-share',
		'type'  => 'header',
	));

tie_build_theme_option(
	array(
		'text' => esc_html__( 'When you double-click a word or highlight a few words, a small share icons are displayed. When you click an icon, a share modal will automatically launch, containing the text you selected along with a link to the post.', HERBS_TEXTDOMAIN ),
		'type' => 'message',
	));

tie_build_theme_option(
	array(
		'name'   => esc_html__( 'Select and Share', HERBS_TEXTDOMAIN ),
		'id'     => 'select_share',
		'toggle' => '#select_share_twitter-item, #select_share_linkedin-item, #select_share_facebook-item, #facebook_app_id-item, #select_share_email-item',
		'type'   => 'checkbox',
	));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Twitter', HERBS_TEXTDOMAIN ),
			'id'     => 'select_share_twitter',
			'type'   => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'LinkedIn', HERBS_TEXTDOMAIN ),
			'id'   => 'select_share_linkedin',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Email', HERBS_TEXTDOMAIN ),
			'id'   => 'select_share_email',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Facebook', HERBS_TEXTDOMAIN ),
			'id'   => 'select_share_facebook',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Facebook APP ID', HERBS_TEXTDOMAIN ),
			'id'   => 'facebook_app_id',
			'hint' => esc_html__( '(Required)', HERBS_TEXTDOMAIN ),
			'type' => 'text',
		));
