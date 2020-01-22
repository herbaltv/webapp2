<?php

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Mobile Settings', HERBS_TEXTDOMAIN ),
			'id'    => 'mobile-settings-tab',
			'type'  => 'tab-title',
		));

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Mobile Settings', HERBS_TEXTDOMAIN ),
			'id'    => 'mobile-settings',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Disable the Responsiveness', HERBS_TEXTDOMAIN ),
			'id'   => 'disable_responsive',
			'hint' => esc_html__( 'This option works only on Tablets and Phones.', HERBS_TEXTDOMAIN ),
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Mobile Header', HERBS_TEXTDOMAIN ),
			'id'    => 'mobile-header',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'id'      => 'mobile_header',
			'type'    => 'visual',
			'options' => array(
				'default'  => array( esc_html__( 'Default',  HERBS_TEXTDOMAIN ) => 'mobile/header-layout-1.png' ),
				'centered' => array( esc_html__( 'Centered', HERBS_TEXTDOMAIN ) => 'mobile/header-layout-2.png' ),
			)));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Sticky Header', HERBS_TEXTDOMAIN ),
			'id'     => 'stick_mobile_nav',
			'type'   => 'checkbox',
			'toggle' => '#sticky_mobile_behavior-item',
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Sticky Header behavior', HERBS_TEXTDOMAIN ),
			'id'      => 'sticky_mobile_behavior',
			'type'    => 'radio',
			'options' => array(
				'default' => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
				'upwards' => esc_html__( 'When scrolling upwards', HERBS_TEXTDOMAIN ),
			)));

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Mobile Menu', HERBS_TEXTDOMAIN ),
			'id'    => 'mobile-menu',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Mobile Menu', HERBS_TEXTDOMAIN ),
			'id'     => 'mobile_menu_active',
			'toggle' => '#mobile_menu_all_options',
			'type'   => 'checkbox',
		));

	echo '<div id="mobile_menu_all_options">';

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Mobile Menu Layout', HERBS_TEXTDOMAIN ),
			'id'      => 'mobile_menu_layout',
			'type'    => 'visual',
			'options' => array(
				''          => array( esc_html__( 'Default',  HERBS_TEXTDOMAIN )   => 'mobile/mobile-default.png' ),
				'fullwidth' => array( esc_html__( 'Full-Width', HERBS_TEXTDOMAIN ) => 'mobile/mobile-fullwidth.png' ),
			)));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Show menu text beside the icon', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_menu_text',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Parent items as links', HERBS_TEXTDOMAIN ),
			'hint' => esc_html__( 'If disabled, parent menu items will only toggle child items.', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_menu_parent_link',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Show the icons', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_menu_icons',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
			array(
				'name'   => esc_html__( 'Log In', HERBS_TEXTDOMAIN ),
				'id'     => 'mobile-components_login',
				'type'   => 'checkbox',
			));

	if ( HERBS_WOOCOMMERCE_IS_ACTIVE ){
		tie_build_theme_option(
			array(
				'name'   => esc_html__( 'Shopping Cart', HERBS_TEXTDOMAIN ),
				'id'     => 'mobile-components_cart',
				'type'   => 'checkbox',
			));
	}

	if ( HERBS_BUDDYPRESS_IS_ACTIVE ){
		tie_build_theme_option(
			array(
				'name'   => esc_html__( 'BuddyPress Notifications', HERBS_TEXTDOMAIN ),
				'id'     => 'mobile-components_bp_notifications',
				'type'   => 'checkbox',
			));
	}

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Search', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_menu_search',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Social Icons', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_menu_social',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Mobile Menu', HERBS_TEXTDOMAIN ),
			'id'      => 'mobile_the_menu',
			'type'    => 'select',
			'options' => HERBS_ADMIN_HELPER::get_menus( false, array( '' => esc_html__( 'Main Nav Menu', HERBS_TEXTDOMAIN ), 'main-secondary' => esc_html__( 'Main Nav and Secondary Nav Menus', HERBS_TEXTDOMAIN ) ) ),
		));
	
	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide Top Menu Popular Tag', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_navtag',
			'type' => 'checkbox',
		));

	echo '</div>';

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Single Post Page', HERBS_TEXTDOMAIN ),
			'id'    => 'mobile-single-post-page',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Compact the post content and show more button', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_post_show_more',
			'type' => 'checkbox',
		));


	# Mobile Elements
	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Mobile Elements', HERBS_TEXTDOMAIN ),
			'id'    => 'mobile-elements',
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide Above header Ad', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_banner_header',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide header Ad', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_banner_top',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide Below the header Ad', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_banner_below_header',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide above the footer Ad', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_banner_bottom',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide Header Breaking News', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_breaking_news',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide all sidebars', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_sidebars',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide Instagram Media Above Footer', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_footer_instagram',
			'type' => 'checkbox',
		));
	
	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide Download Apps Area', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_downloadapps',
			'type' => 'checkbox',
		));
	
	tie_build_theme_option(
			array(
				'name' => esc_html__( 'Show Mobile Featured Footer', HERBS_TEXTDOMAIN ),
				'id'   => 'mobile_footer_featured',
				'type' => 'checkbox',
			));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide the Footer', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_footer',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide copyright area', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_copyright',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide Breadcrumbs', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_breadcrumbs',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide Read More Buttons', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_read_more_buttons',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide Above Post share Buttons', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_share_post_top',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide Below Post share Buttons', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_share_post_bottom',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide Below Post Newsletter', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_post_newsletter',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide Below Post Read Next', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_read_next',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide Below Post Related posts', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_related',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide Below Post Author Box', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_post_authorbio',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide Below Post Next/Prev posts', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_post_nav',
			'type' => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name' => esc_html__( 'Hide Back to top button', HERBS_TEXTDOMAIN ),
			'id'   => 'mobile_hide_back_top_button',
			'type' => 'checkbox',
		));


	# General share buttons settings
	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Sticky Mobile Share Buttons', HERBS_TEXTDOMAIN ),
			'id'    => 'sticky-mobile-share',
			'type'  => 'header',
		));


	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Sticky Mobile Share Buttons', HERBS_TEXTDOMAIN ),
			'id'     => 'share_post_mobile',
			'type'   => 'checkbox',
			'toggle' => '#mobile-share-buttons',
		));

	echo '<div id="mobile-share-buttons">';
		tie_get_share_buttons_options( 'mobile' );
	echo '</div>'
?>
