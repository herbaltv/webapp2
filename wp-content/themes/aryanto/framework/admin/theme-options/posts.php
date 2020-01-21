<?php

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Single Post Page Settings', HERBS_TEXTDOMAIN ),
			'id'    => 'single-post-page-settings-tab',
			'type'  => 'tab-title',
		));

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Default Posts Layout', HERBS_TEXTDOMAIN ),
			'id'    => 'default-posts-layout',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'id'      => 'post_layout',
			'type'    => 'visual',
			'columns' => 4,
			'toggle'  => array(
				''  => '',
				'4' => '#featured_use_fea-item, #featured_custom_bg-item',
				'5' => '#featured_use_fea-item, #featured_custom_bg-item',
				'8' => '#featured_use_fea-item, #featured_custom_bg-item, #featured_bg_color-item',),
			'options' => array(
				'1' => array( esc_html__( 'Layout', HERBS_TEXTDOMAIN ). ' #1' => 'post-layouts/1.png' ),
				'2' => array( esc_html__( 'Layout', HERBS_TEXTDOMAIN ). ' #2' => 'post-layouts/2.png' ),
				'3' => array( esc_html__( 'Layout', HERBS_TEXTDOMAIN ). ' #3' => 'post-layouts/3.png' ),
				'4' => array( esc_html__( 'Layout', HERBS_TEXTDOMAIN ). ' #4' => 'post-layouts/4.png' ),
				'5' => array( esc_html__( 'Layout', HERBS_TEXTDOMAIN ). ' #5' => 'post-layouts/5.png' ),
				'6' => array( esc_html__( 'Layout', HERBS_TEXTDOMAIN ). ' #6' => 'post-layouts/6.png' ),
				'7' => array( esc_html__( 'Layout', HERBS_TEXTDOMAIN ). ' #7' => 'post-layouts/7.png' ),
				'8' => array( esc_html__( 'Layout', HERBS_TEXTDOMAIN ). ' #8' => 'post-layouts/8.png' ),
		)));

	tie_build_theme_option(
		array(
			'name'  => esc_html__( 'Use the featured image', HERBS_TEXTDOMAIN ),
			'id'    => 'featured_use_fea',
			'type'  => 'checkbox',
			'class' => 'post_layout',
		));

	tie_build_theme_option(
		array(
			'name'     => esc_html__( 'Upload Custom Image', HERBS_TEXTDOMAIN ),
			'id'       => 'featured_custom_bg',
			'type'     => 'upload',
			'pre_text' => esc_html__( '- OR -', HERBS_TEXTDOMAIN ),
			'class'    => 'post_layout',
		));

	tie_build_theme_option(
		array(
			'name'  => esc_html__( 'Background Color', HERBS_TEXTDOMAIN ),
			'id'    => 'featured_bg_color',
			'type'  => 'color',
			'class' => 'post_layout',
		));


	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'Structure Data', HERBS_TEXTDOMAIN ),
			'id'    => 'structure-data',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Enable', HERBS_TEXTDOMAIN ),
			'id'     => 'structure_data',
			'toggle' => '#schema_type-item',
			'type'   => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Default Schema type', HERBS_TEXTDOMAIN ),
			'id'      => 'schema_type',
			'type'    => 'radio',
			'options' => array(
				'Article'      => esc_html__( 'Article',      HERBS_TEXTDOMAIN ),
				'NewsArticle'  => esc_html__( 'NewsArticle',  HERBS_TEXTDOMAIN ),
				'BlogPosting'  => esc_html__( 'BlogPosting',  HERBS_TEXTDOMAIN ),
			)));

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'General Settings', HERBS_TEXTDOMAIN ),
			'id'    => 'post-general-settings',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Standard Post Format:', HERBS_TEXTDOMAIN ) .' '. esc_html__( 'Show the featured image', HERBS_TEXTDOMAIN ),
			'id'   => 'post_featured',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Image Post Format:', HERBS_TEXTDOMAIN ) .' '. esc_html__( 'Uncropped featured image', HERBS_TEXTDOMAIN ),
			'id'      => "image_uncropped",
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Image Post Format:', HERBS_TEXTDOMAIN ) .' '. esc_html__( 'Featured image lightbox', HERBS_TEXTDOMAIN ),
			'id'      => "image_lightbox",
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Video Post Format:', HERBS_TEXTDOMAIN ) .' '. esc_html__( 'Sticky the Featured Video', HERBS_TEXTDOMAIN ),
			'id'   => 'sticky_featured_video',
			'type' => 'checkbox',
		));


	if( ! class_exists( 'WPSEO_Frontend' ) ){

		tie_build_theme_option(
			array(
				'name'   => esc_html__( 'Meta Description Tag', HERBS_TEXTDOMAIN ),
				'id'     => 'post_meta_escription',
				'type'   => 'checkbox',
			));
	}


	if( ! HERBS_OPENGRAPH::is_active() ){

		tie_build_theme_option(
			array(
				'name'   => esc_html__( 'Open Graph meta', HERBS_TEXTDOMAIN ),
				'id'     => 'post_og_cards',
				'type'   => 'checkbox',
				'toggle' => '#post_og_cards_image-item',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Default Open Graph Image', HERBS_TEXTDOMAIN ),
				'id'   => 'post_og_cards_image',
				'type' => 'upload',
			));
	}

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Reading Position Indicator', HERBS_TEXTDOMAIN ),
			'id'   => 'reading_indicator',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Post Author Box', HERBS_TEXTDOMAIN ),
			'id'   => 'post_authorbio',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Next/Prev posts', HERBS_TEXTDOMAIN ),
			'id'   => 'post_nav',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'In Post Responsive Tables', HERBS_TEXTDOMAIN ),
			'id'   => 'responsive_tables',
			'hint' => esc_html__( 'Disable this option if you use a custom responsive tables plugin.', HERBS_TEXTDOMAIN ),
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Post info Settings', HERBS_TEXTDOMAIN ),
			'id'    => 'post-info-settings',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Categories', HERBS_TEXTDOMAIN ),
			'id'   => 'post_cats',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Tags', HERBS_TEXTDOMAIN ),
			'id'   => 'post_tags',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Post meta area', HERBS_TEXTDOMAIN ),
			'id'     => 'post_meta',
			'toggle' => '#post_author-all-item, #post_date-item, #post_comments-item, #post_views-item, #reading_time-item',
			'type'   => 'checkbox',
		));

	echo '<div id="post_author-all-item">';
	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Author', HERBS_TEXTDOMAIN ),
			'id'     => 'post_author',
			'toggle' => '#post_author_wrap-item',
			'type'   => 'checkbox',
		));

		echo '<div id="post_author_wrap-item">';
			tie_build_theme_option(
				array(
					'name' => esc_html__( "Author's Avatar", HERBS_TEXTDOMAIN ),
					'id'   => 'post_author_avatar',
					'type' => 'checkbox',
				));

			tie_build_theme_option(
				array(
					'name' => esc_html__( 'Twitter Icon', HERBS_TEXTDOMAIN ),
					'id'   => 'post_author_twitter',
					'type' => 'checkbox',
				));

			tie_build_theme_option(
				array(
					'name' => esc_html__( 'Email Icon', HERBS_TEXTDOMAIN ),
					'id'   => 'post_author_email',
					'type' => 'checkbox',
				));
		echo '</div>';
	echo '</div>';

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Date', HERBS_TEXTDOMAIN ),
			'id'   => 'post_date',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Comments', HERBS_TEXTDOMAIN ),
			'id'   => 'post_comments',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Views', HERBS_TEXTDOMAIN ),
			'id'   => 'post_views',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Estimated reading time', HERBS_TEXTDOMAIN ),
			'id'   => 'reading_time',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Newsletter', HERBS_TEXTDOMAIN ),
			'id'  	=> 'post-newsletter',
			'type'	=> 'header',
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Newsletter', HERBS_TEXTDOMAIN ),
			'id'     => 'post_newsletter',
			'toggle' => '#post_newsletter_text-item, #post_newsletter_mailchimp-item, #post_newsletter_feedburner-item',
			'type'   => 'checkbox',
		));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Text above the Email input field', HERBS_TEXTDOMAIN ),
				'id'   => 'post_newsletter_text',
				'hint' => esc_html__( 'Supports: Text, HTML and Shortcodes.', HERBS_TEXTDOMAIN ),
				'type' => 'textarea',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'MailChimp Form Action URL', HERBS_TEXTDOMAIN ),
				'id'   => 'post_newsletter_mailchimp',
				'type' => 'text',
			));

		tie_build_theme_option(
			array(
				'name'     => esc_html__( 'Feedburner ID', HERBS_TEXTDOMAIN ),
				'pre_text' => esc_html__( '- OR -', HERBS_TEXTDOMAIN ),
				'id'       => 'post_newsletter_feedburner',
				'type'     => 'text',
			));

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Related Posts', HERBS_TEXTDOMAIN ),
			'id'     => 'related-posts',
			'type'	=> 'header',
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Related Posts', HERBS_TEXTDOMAIN ),
			'id'     => 'related',
			'toggle' => '#related-posts-options',
			'type'   => 'checkbox',
		));

	echo '<div id="related-posts-options">';

		tie_build_theme_option(
			array(
				'name'    => esc_html__( 'Related Posts Position', HERBS_TEXTDOMAIN ),
				'id'      => 'related_position',
				'type'    => 'radio',
				'toggle'  => array(
					'post'     => '#related_number-item, #related_number_full-item',
					'comments' => '#related_number-item, #related_number_full-item',
					'footer'   => '#related_number-item',
				),
				'options' => array(
					'post'     => esc_html__( 'Below The Post', HERBS_TEXTDOMAIN ),
					'comments' => esc_html__( 'Below The Comments', HERBS_TEXTDOMAIN ),
					'footer'   => esc_html__( 'Above The Footer', HERBS_TEXTDOMAIN ),
				)));

		tie_build_theme_option(
			array(
				'name'  => esc_html__( 'Number of posts to show', HERBS_TEXTDOMAIN ),
				'id'    => 'related_number',
				'type'  => 'number',
				'class' => 'related_position',
			));

		tie_build_theme_option(
			array(
				'name'  => esc_html__( 'Number of posts to show in Full width pages', HERBS_TEXTDOMAIN ),
				'id'    => 'related_number_full',
				'type'  => 'number',
				'class' => 'related_position',
			));

		tie_build_theme_option(
			array(
				'name'    => esc_html__( 'Query Type', HERBS_TEXTDOMAIN ),
				'id'      => 'related_query',
				'type'    => 'radio',
				'options' => array(
					'category' => esc_html__( 'Posts in the same Categories', HERBS_TEXTDOMAIN ),
					'tag'      => esc_html__( 'Posts in the same Tags', HERBS_TEXTDOMAIN ),
					'author'   => esc_html__( 'Posts by the same Author', HERBS_TEXTDOMAIN ),
				)));


		//Post Order
		$post_order = array(
			'latest'   => esc_html__( 'Recent Posts',         HERBS_TEXTDOMAIN ),
			'rand'     => esc_html__( 'Random Posts',         HERBS_TEXTDOMAIN ),
			'modified' => esc_html__( 'Last Modified Posts',  HERBS_TEXTDOMAIN ),
			'popular'  => esc_html__( 'Most Commented posts', HERBS_TEXTDOMAIN ),
			'title'    => esc_html__( 'Alphabetically',       HERBS_TEXTDOMAIN ),
		);

		if( tie_get_option( 'tie_post_views' ) ){
			$post_order['views'] = esc_html__( 'Most Viewed posts', HERBS_TEXTDOMAIN );
		}

		tie_build_theme_option(
			array(
				'name'    => esc_html__( 'Sort Order', HERBS_TEXTDOMAIN ),
				'id'      => 'related_order',
				'type'    => 'select',
				'options' => apply_filters( 'Herbs/Options/Related/post_order_args', $post_order ),
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Title Length', HERBS_TEXTDOMAIN ),
				'id'   => 'related_title_length',
				'type' => 'number',
			));

	echo '</div>';

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Read Next Slider', HERBS_TEXTDOMAIN ),
			'id'     => 'read-next-title',
			'type'	=> 'header',
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Read Next Slider', HERBS_TEXTDOMAIN ),
			'id'     => 'read_next',
			'toggle' => '#read-next-options',
			'type'   => 'checkbox',
		));

	echo '<div id="read-next-options">';

		tie_build_theme_option(
			array(
				'name'    => esc_html__( 'Read Next Style', HERBS_TEXTDOMAIN ),
				'id'      => 'read_next_style',
				'type'    => 'visual',
				'options' => array(
					'50' => array(  sprintf( esc_html__( 'Read Next #%s', HERBS_TEXTDOMAIN ), 1 ) => 'blocks/block-slider_50.png' ),
					'4'  => array(  sprintf( esc_html__( 'Read Next #%s', HERBS_TEXTDOMAIN ), 2 ) => 'blocks/block-slider_4.png' ),
			)
			));

		tie_build_theme_option(
			array(
				'name'  => esc_html__( 'Number of posts to show', HERBS_TEXTDOMAIN ),
				'id'    => 'read_next_number',
				'type'  => 'number',
			));

		tie_build_theme_option(
			array(
				'name'    => esc_html__( 'Query Type', HERBS_TEXTDOMAIN ),
				'id'      => 'read_next_query',
				'type'    => 'radio',
				'options' => array(
					'category' => esc_html__( 'Posts in the same Categories', HERBS_TEXTDOMAIN ),
					'tag'      => esc_html__( 'Posts in the same Tags', HERBS_TEXTDOMAIN ),
					'author'   => esc_html__( 'Posts by the same Author', HERBS_TEXTDOMAIN ),
				)));


		//Post Order
		$post_order = array(
			'latest'   => esc_html__( 'Recent Posts',         HERBS_TEXTDOMAIN ),
			'rand'     => esc_html__( 'Random Posts',         HERBS_TEXTDOMAIN ),
			'modified' => esc_html__( 'Last Modified Posts',  HERBS_TEXTDOMAIN ),
			'popular'  => esc_html__( 'Most Commented posts', HERBS_TEXTDOMAIN ),
			'title'    => esc_html__( 'Alphabetically',       HERBS_TEXTDOMAIN ),
		);

		if( tie_get_option( 'tie_post_views' ) ){
			$post_order['views'] = esc_html__( 'Most Viewed posts', HERBS_TEXTDOMAIN );
		}

		tie_build_theme_option(
			array(
				'name'    => esc_html__( 'Sort Order', HERBS_TEXTDOMAIN ),
				'id'      => 'read_next_order',
				'type'    => 'select',
				'options' => apply_filters( 'Herbs/Options/Read_Next/post_order_args', $post_order ),
			));

	echo '</div>';

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Fly Check Also Box', HERBS_TEXTDOMAIN ),
			'id'    => 'fly-check-also-box',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Check Also', HERBS_TEXTDOMAIN ),
			'id'     => 'check_also',
			'toggle' => '#check_also_position-item, #check_also_number-item, #check_also_query-item, #check_also_order-item, #check_also_title_length-item',
			'type'   => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Number of posts to show', HERBS_TEXTDOMAIN ),
			'id'   => 'check_also_number',
			'type' => 'number',
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Check Also Box Position', HERBS_TEXTDOMAIN ),
			'id'      => 'check_also_position',
			'type'    => 'radio',
			'options' => array(
				'right'	=> esc_html__( 'Right',	HERBS_TEXTDOMAIN ),
				'left'	=> esc_html__( 'Left',	HERBS_TEXTDOMAIN ),
		)));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Query Type', HERBS_TEXTDOMAIN ),
			'id'      => 'check_also_query',
			'type'    => 'radio',
			'options' => array(
				'category' => esc_html__( 'Posts in the same Categories',	HERBS_TEXTDOMAIN ),
				'tag'      => esc_html__( 'Posts in the same Tags', HERBS_TEXTDOMAIN ),
				'author'   => esc_html__( 'Posts by the same Author', HERBS_TEXTDOMAIN ),
			)));

		tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Sort Order', HERBS_TEXTDOMAIN ),
			'id'      => 'check_also_order',
			'type'    => 'select',
			'options' => apply_filters( 'Herbs/Options/Checkalso/post_order_args', $post_order ),
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Title Length', HERBS_TEXTDOMAIN ),
			'id'      => 'check_also_title_length',
			'type'    => 'number',
		));
