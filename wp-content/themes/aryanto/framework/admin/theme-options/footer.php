<?php

	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'Footer Settings', HERBS_TEXTDOMAIN ),
			'id'    => 'footer-settings-tab',
			'type'  => 'tab-title',
		));

	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'Instagram Footer Area', HERBS_TEXTDOMAIN ),
			'id'    => 'instagram-footer-area',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Enable', HERBS_TEXTDOMAIN ),
			'id'     => 'footer_instagram',
			'toggle' => '#footer_instagram_options',
			'type'   => 'checkbox',
		));

	echo '<div id="footer_instagram_options">';

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Username', HERBS_TEXTDOMAIN ),
			'id'   => 'footer_instagram_username',
			'type' => 'text',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'User ID', HERBS_TEXTDOMAIN ),
			'id'   => 'footer_instagram_userid',
			'hint' => '<a href="https://herbaltv.co.id/go/find-instagram-user-id" target="_blank" rel="nofollow noopener">'. esc_html__( 'Find your Instagram User ID.', HERBS_TEXTDOMAIN ) .'</a>',
			'type' => 'text',
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Number of Rows', HERBS_TEXTDOMAIN ),
			'id'      => 'footer_instagram_rows',
			'type'    => 'select',
			'options' => array(
				'1' => esc_html__( 'One Row',	HERBS_TEXTDOMAIN ),
				'2' => esc_html__( 'Two Rows', HERBS_TEXTDOMAIN ),
			)));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Link Images to', HERBS_TEXTDOMAIN ).' *',
			'id'      => 'footer_instagram_media_link',
			'type'    => 'select',
			'hint'    => '<small>*'. esc_html__( 'Videos always linked to the Media Page on Instagram.', HERBS_TEXTDOMAIN ) .'</small>',
			'options' => array(
				'file' => esc_html__( 'Media File',	HERBS_TEXTDOMAIN ),
				'page' => esc_html__( 'Media Page on Instagram', HERBS_TEXTDOMAIN ),
			)));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Follow Us Button', HERBS_TEXTDOMAIN ),
			'id'     => 'footer_instagram_button',
			'toggle' => '#footer_instagram_button_text-item, #footer_instagram_button_url-item',
			'type'   => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Follow Us Button Text', HERBS_TEXTDOMAIN ),
			'id'   => 'footer_instagram_button_text',
			'type' => 'text',
		));

	tie_build_theme_option(
		array(
			'name'        => esc_html__( 'Follow Us Button URL', HERBS_TEXTDOMAIN ),
			'id'          => 'footer_instagram_button_url',
			'placeholder' => 'https://',
			'type'        => 'text',
		));

	echo '</div>';
	
	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'Mobile Only Footer Area', HERBS_TEXTDOMAIN ),
			'id'    => 'footer-mobile-area',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Enable', HERBS_TEXTDOMAIN ),
			'id'     => 'footer_mobile_featured',
			'toggle' => '#footer_mobile_featured_options',
			'type'   => 'checkbox',
		));

	echo '<div id="footer_mobile_featured_options">';

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Logo Link', HERBS_TEXTDOMAIN ),
			'id'   => 'footer_mobile_featured_logo',
			'type' => 'text',
		));
	
	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Menu html link', HERBS_TEXTDOMAIN ),
			'id'   => 'footer_mobile_featured_menu',
			'type' => 'text',
		));
	
	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Social Media', HERBS_TEXTDOMAIN ),
			'id'   => 'footer_mobile_featured_socialicon',
			'type' => 'text',
		));
	
	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Copyright', HERBS_TEXTDOMAIN ),
			'id'   => 'footer_mobile_featured_copyright',
			'type' => 'text',
		));

	echo '</div>';


	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'Footer Widgets layout', HERBS_TEXTDOMAIN ),
			'id'    => 'footer-widgets-layout',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'First Footer Widgets Area', HERBS_TEXTDOMAIN ),
			'id'     => 'footer_widgets_area_1',
			'toggle' => '#footer_widgets_layout_area_1-item, #footer_widgets_border_area_1-item',
			'type'   => 'checkbox',
		));
	
	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Download Apps', HERBS_TEXTDOMAIN ),
			'id'     => 'footer_download_apps',
			'toggle' => '#footer_downloads_app',
			'type'   => 'checkbox',
		));

	echo '<div id="footer_downloads_app">';

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hands Image URL', HERBS_TEXTDOMAIN ),
			'id'   => 'footer_dd_handsimage',
			'type' => 'text',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Description', HERBS_TEXTDOMAIN ),
			'id'   => 'footer_dd_description',
			'type' => 'text',
		));
	
	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Android Image', HERBS_TEXTDOMAIN ),
			'id'   => 'footer_dd_androidimage',
			'type' => 'text',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Android Link', HERBS_TEXTDOMAIN ),
			'id'   => 'footer_dd_androidlink',
			'type' => 'text',
		));
	
	echo '</div>';

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Add border around the widgets area', HERBS_TEXTDOMAIN ),
			'id'   => 'footer_widgets_border_area_1',
			'type' => 'checkbox',
		));


	tie_build_theme_option(
		array(
			'id'      => 'footer_widgets_layout_area_1',
			'type'    => 'visual',
			'options' => array(
				'footer-1c'      => 'footers/footer-1c.png',
				'footer-2c'      => 'footers/footer-2c.png',
				'narrow-wide-2c' => 'footers/footer-2c-narrow-wide.png',
				'wide-narrow-2c' => 'footers/footer-2c-wide-narrow.png',
				'footer-3c'      => 'footers/footer-3c.png',
				'wide-left-3c'   => 'footers/footer-3c-wide-left.png',
				'wide-right-3c'  => 'footers/footer-3c-wide-right.png',
				'footer-4c'      => 'footers/footer-4c.png',
			)));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Second Footer Widgets Area', HERBS_TEXTDOMAIN ),
			'id'     => 'footer_widgets_area_2',
			'toggle' => '#footer_widgets_layout_area_2-item, #footer_widgets_border_area_2-item',
			'type'   => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Add border around the widgets area', HERBS_TEXTDOMAIN ),
			'id'     => 'footer_widgets_border_area_2',
			'type'   => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'id'		=> 'footer_widgets_layout_area_2',
			'type'    => 'visual',
			'options' => array(
				'footer-1c'      => 'footers/footer-1c.png',
				'footer-2c'      => 'footers/footer-2c.png',
				'narrow-wide-2c' => 'footers/footer-2c-narrow-wide.png',
				'wide-narrow-2c' => 'footers/footer-2c-wide-narrow.png',
				'footer-3c'      => 'footers/footer-3c.png',
				'wide-left-3c'   => 'footers/footer-3c-wide-left.png',
				'wide-right-3c'  => 'footers/footer-3c-wide-right.png',
				'footer-4c'      => 'footers/footer-4c.png',
			)));

	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'Copyright Area', HERBS_TEXTDOMAIN ),
			'id'    => 'copyright-area',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Enable', HERBS_TEXTDOMAIN ),
			'id'     => 'copyright_area',
			'type'   => 'checkbox',
			'toggle' => '#copyright_area_options',
		));

	echo '<div id="copyright_area_options">';

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Centered Layout', HERBS_TEXTDOMAIN ),
				'id'   => 'footer_centered',
				'type' => 'checkbox',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Social Icons', HERBS_TEXTDOMAIN ),
				'id'   => 'footer_social',
				'type' => 'checkbox',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Footer Menu', HERBS_TEXTDOMAIN ),
				'id'   => 'footer_menu',
				'type' => 'checkbox',
			));

		$footer_codes = esc_html__( 'Supports: Text, HTML and Shortcodes.', HERBS_TEXTDOMAIN ).'
			<br />
			<strong>'. esc_html__( 'Variables', HERBS_TEXTDOMAIN ) .'</strong> '.
			esc_html__( 'These tags can be included in the textarea above and will be replaced when a page is displayed.', HERBS_TEXTDOMAIN ) .'
			<br />
			<code>%year%</code> : <em>'.esc_html__( 'Replaced with the current year.', HERBS_TEXTDOMAIN ) .'</em><br />
			<code>%site%</code> : <em>'.esc_html__( "Replaced with The site's name.",  HERBS_TEXTDOMAIN ) .'</em><br />
			<code>%url%</code>  : <em>'.esc_html__( "Replaced with The site's URL.",   HERBS_TEXTDOMAIN ) .'</em>';

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Footer Text One', HERBS_TEXTDOMAIN ),
				'id'   => 'footer_one',
				'hint' => $footer_codes,
				'type' => 'textarea',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Footer Text Two', HERBS_TEXTDOMAIN ),
				'id'   => 'footer_two',
				'hint' => $footer_codes,
				'type' => 'textarea',
			));

	echo '</div>';

	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'Back to top button', HERBS_TEXTDOMAIN ),
			'id'    => 'back-to-top-button',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Back to top button', HERBS_TEXTDOMAIN ),
			'id'   => 'footer_top',
			'type' => 'checkbox',
		));
