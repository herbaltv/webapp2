<?php

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Advertisement Settings', HERBS_TEXTDOMAIN ),
			'id'    => 'advertisements-settings-tab',
			'type'  => 'tab-title',
		));

	tie_build_theme_option(
		array(
			'text' => esc_html__( 'It is recommended to avoid using words like ad, ads, adv, advert, advertisement, banner, banners, sponsor, 300x250, 728x90, etc. in the image names or image path to avoid AdBlocks from blocking your Ad.', HERBS_TEXTDOMAIN ),
			'type' => 'message',
		));

	tie_build_theme_option(
		array(
			'title'   => esc_html__( 'Ad Blocker Detector', HERBS_TEXTDOMAIN ),
			'id'    => 'ad-blocker-detector',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Ad Blocker Detector', HERBS_TEXTDOMAIN ),
			'id'     => 'ad_blocker_detector',
			'toggle' => '#adblock_title-item, #adblock_message-item, #adblock_background-item',
			'type'   => 'checkbox',
			'hint'   => esc_html__( 'Block the adblockers from browsing the site, till they turnoff the Ad Blocker', HERBS_TEXTDOMAIN ),
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Title', HERBS_TEXTDOMAIN ),
			'id'   => 'adblock_title',
			'type' => 'text',
			'placeholder' => esc_html__( 'Adblock Detected', HERBS_TEXTDOMAIN ),
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Message', HERBS_TEXTDOMAIN ),
			'id'   => 'adblock_message',
			'type' => 'textarea',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Background Color', HERBS_TEXTDOMAIN ),
			'id'   => 'adblock_background',
			'type' => 'color',
		));

	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'Background Image Ad', HERBS_TEXTDOMAIN ),
			'id'    => 'background-image-ad',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Full Page Takeover', HERBS_TEXTDOMAIN ),
			'id'     => 'banner_bg',
			'toggle' => '#banner_bg_url-item, #banner_bg_img-item, #banner_bg_site_margin-item',
			'type'   => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Link', HERBS_TEXTDOMAIN ),
			'id'   => 'banner_bg_url',
			'type' => 'text',
		));

	tie_build_theme_option(
		array(
			'name'  => esc_html__( 'Background Image', HERBS_TEXTDOMAIN ),
			'id'    => 'banner_bg_img',
			'type'  => 'background',
		));

	tie_build_theme_option(
		array(
			'name'  => esc_html__( 'Site margin top', HERBS_TEXTDOMAIN ),
			'id'    => 'banner_bg_site_margin',
			'type'  => 'number',
		));


	$theme_ads = array(
		'banner_header'        => esc_html__( 'Above Header Ad', HERBS_TEXTDOMAIN ),
		'banner_top'           => esc_html__( 'Header Ad', HERBS_TEXTDOMAIN ),
		'banner_bottom'        => esc_html__( 'Above Footer Ad', HERBS_TEXTDOMAIN ),
		'banner_below_header'  => esc_html__( 'Below the Header Ad', HERBS_TEXTDOMAIN ),
		'banner_above'         => esc_html__( 'Above Article Ad', HERBS_TEXTDOMAIN ),
		'banner_above_content' => esc_html__( 'Above Article Content Ad', HERBS_TEXTDOMAIN ),
		'banner_below_content' => esc_html__( 'Below Article Content Ad', HERBS_TEXTDOMAIN ),
		'banner_below'         => esc_html__( 'Below Article Ad', HERBS_TEXTDOMAIN ),

		'banner_category_below_slider' => esc_html__( 'Category Pages: Below the slider', HERBS_TEXTDOMAIN ),
		'banner_category_above_title'  => esc_html__( 'Category Pages: Above the title', HERBS_TEXTDOMAIN ),
		'banner_category_below_title'  => esc_html__( 'Category Pages: Below the title', HERBS_TEXTDOMAIN ),

		'banner_category_below_posts'      => esc_html__( 'Category Pages: Below Posts', HERBS_TEXTDOMAIN ),
		'banner_category_below_pagination' => esc_html__( 'Category Pages: Below Pagination', HERBS_TEXTDOMAIN ),

		'between_posts_1'      => sprintf( esc_html__( 'Between Posts in Archives #%s', HERBS_TEXTDOMAIN ), 1 ),
		'between_posts_2'      => sprintf( esc_html__( 'Between Posts in Archives #%s', HERBS_TEXTDOMAIN ), 2 ),

		'article_inline_ad_1'  => sprintf( esc_html__( 'Article inline ad #%s', HERBS_TEXTDOMAIN ), 1 ),
		'article_inline_ad_2'  => sprintf( esc_html__( 'Article inline ad #%s', HERBS_TEXTDOMAIN ), 2 ),
	);

	foreach( $theme_ads as $ad => $name ){

		tie_build_theme_option(
			array(
				'title' => $name,
				'type'  => 'header',
				'id'    => $ad . '-ad',
			));

		tie_build_theme_option(
			array(
				'name'   => $name,
				'id'     => $ad,
				'type'   => 'checkbox',
				'toggle' => '#'.$ad.'_title-item, #'.$ad.'_title_link-item, #'.$ad.'_img-item, #'.$ad.'_posts_number-item, #'.$ad.'_paragraphs_number-item, #'.$ad.'_align-item, #'.$ad.'_url-item, #'.$ad.'_alt-item, #'.$ad.'_tab-item, #'.$ad.'_nofollow-item, #' .$ad. '_adsense-item, #'.$ad.'-adrotate-options',
			));


		// Custom Ads Options
		if( strpos( $ad, 'between_posts' ) !== false ){

			tie_build_theme_option(
				array(
					'name' => esc_html__( 'Number of posts before the Ad', HERBS_TEXTDOMAIN ),
					'id'   => $ad.'_posts_number',
					'type' => 'number',
				));
		}
		elseif( strpos( $ad, 'article_inline_ad' ) !== false ){

			tie_build_theme_option(
				array(
					'name' => esc_html__( 'Number of paragraphs before the Ad', HERBS_TEXTDOMAIN ),
					'id'   => $ad.'_paragraphs_number',
					'type' => 'number',
				));


			tie_build_theme_option(
				array(
					'name'    => esc_html__( 'Ad Alignment', HERBS_TEXTDOMAIN ),
					'id'      => $ad.'_align',
					'type'    => 'radio',
					'options' => array(
						'center' => esc_html__( 'Center', HERBS_TEXTDOMAIN ),
						'right'  => esc_html__( 'Right',  HERBS_TEXTDOMAIN ),
						'left'   => esc_html__( 'Left',   HERBS_TEXTDOMAIN ),
					)));
		}


		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Ad Title', HERBS_TEXTDOMAIN ),
				'hint' => esc_html__( 'A title for the Ad, like Advertisement - leave this empty to disable.', HERBS_TEXTDOMAIN ),
				'id'   => $ad.'_title',
				'type' => 'text',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Ad Title Link', HERBS_TEXTDOMAIN ),
				'id'   => $ad.'_title_link',
				'type' => 'text',
			));

		tie_build_theme_option(
			array(
				'name'     => esc_html__( 'Ad Image', HERBS_TEXTDOMAIN ),
				'id'       => $ad.'_img',
				'pre_text' => esc_html__( 'Ad Image', HERBS_TEXTDOMAIN ),
				'type'     => 'upload',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Ad URL', HERBS_TEXTDOMAIN ),
				'id'   => $ad.'_url',
				'type' => 'text',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Alternative Text For The image', HERBS_TEXTDOMAIN ),
				'id'   => $ad.'_alt',
				'type' => 'text',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Open The Link In a new Tab', HERBS_TEXTDOMAIN ),
				'id'   => $ad.'_tab',
				'type' => 'checkbox',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Nofollow?', HERBS_TEXTDOMAIN ),
				'id'   => $ad.'_nofollow',
				'type' => 'checkbox',
			));

		tie_build_theme_option(
			array(
				'name'     => esc_html__( 'Custom Ad Code', HERBS_TEXTDOMAIN ),
				'id'       => $ad.'_adsense',
				'pre_text' => esc_html__( '- OR -', HERBS_TEXTDOMAIN ) . ' ' . esc_html__( 'Custom Ad Code', HERBS_TEXTDOMAIN ),
				'hint'     => esc_html__( 'Supports: Text, HTML and Shortcodes.', HERBS_TEXTDOMAIN ),
				'type'     => 'textarea',
			));

		if( function_exists( 'adrotate_ad' )){

			echo '<div id="'.$ad.'-adrotate-options">';

			tie_build_theme_option(
				array(
					'name'     => esc_html__( 'AdRotate', HERBS_TEXTDOMAIN ),
					'id'       => $ad.'_adrotate',
					'pre_text' => esc_html__( '- OR -', HERBS_TEXTDOMAIN ),
					'toggle'   => '#'.$ad.'_adrotate_type-item, #'.$ad.'_adrotate_id-item',
					'type'     => 'checkbox',
				));

			tie_build_theme_option(
				array(
					'name'    => esc_html__( 'Type', HERBS_TEXTDOMAIN ),
					'id'      => $ad.'_adrotate_type',
					'type'    => 'radio',
					'options' => array(
						'single' => esc_html__( 'Advert - Use Advert ID', HERBS_TEXTDOMAIN ),
						'group'  => esc_html__( 'Group - Use group ID', HERBS_TEXTDOMAIN ),
					)));

			tie_build_theme_option(
				array(
					'name' => esc_html__( 'ID', HERBS_TEXTDOMAIN ),
					'id'   => $ad.'_adrotate_id',
					'type' => 'number',
				));

			echo '</div>';
		}
	}

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Shortcodes Ads', HERBS_TEXTDOMAIN ),
			'id'    => 'shortcodes-ads',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name' => '[ads1] '. esc_html__( 'Ad Shortcode', HERBS_TEXTDOMAIN ),
			'id'   => 'ads1_shortcode',
			'type' => 'textarea',
		));

	tie_build_theme_option(
		array(
			'name' => '[ads2] '. esc_html__( 'Ad Shortcode', HERBS_TEXTDOMAIN ),
			'id'   => 'ads2_shortcode',
			'type' => 'textarea',
		));

	tie_build_theme_option(
		array(
			'name' => '[ads3] '. esc_html__( 'Ad Shortcode', HERBS_TEXTDOMAIN ),
			'id'   => 'ads3_shortcode',
			'type' => 'textarea',
		));

	tie_build_theme_option(
		array(
			'name' => '[ads4] '. esc_html__( 'Ad Shortcode', HERBS_TEXTDOMAIN ),
			'id'   => 'ads4_shortcode',
			'type' => 'textarea',
		));

	tie_build_theme_option(
		array(
			'name' => '[ads5] '. esc_html__( 'Ad Shortcode', HERBS_TEXTDOMAIN ),
			'id'   => 'ads5_shortcode',
			'type' => 'textarea',
		));
