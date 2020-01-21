<?php

/**
 * Register Widgets
 */
add_action( 'widgets_init', 'tie_widgets_init' );
function tie_widgets_init(){

	// Remove recent comments style
	add_filter( 'show_recent_comments_widget_style', '__return_false' );

	// Widgets icon
	$widget_icon = tie_get_option( 'widgets_icon' ) ? '<span class="widget-title-icon fa"></span>' : '';

	// Widget HTML markup
	$before_widget = apply_filters( 'Herbs/Widgets/before_widget', '<div id="%1$s" class="container-wrapper widget %2$s">' );
	$after_widget  = apply_filters( 'Herbs/Widgets/after_widget',  '<div class="clearfix"></div></div><!-- .widget /-->' );
	$before_title  = apply_filters( 'Herbs/Widgets/before_title',  '<div '. tie_box_class( 'widget-title', false ) .'><div class="the-subtitle">' );
	$after_title   = apply_filters( 'Herbs/Widgets/after_title',   $widget_icon .'</div></div>' );

	// Default Sidebar
	register_sidebar( array(
		'id'            => 'primary-widget-area',
		'name'          => esc_html__( 'Primary Widget Area', HERBS_TEXTDOMAIN ),
		'before_widget' => $before_widget,
		'after_widget'  => $after_widget,
		'before_title'  => $before_title,
		'after_title'   => $after_title,
	));

	// Slide Sidebar
	register_sidebar( array(
		'id'            => 'slide-sidebar-area',
		'name'          => esc_html__( 'Slide Widget Area', HERBS_TEXTDOMAIN ),
		'before_widget' => $before_widget,
		'after_widget'  => $after_widget,
		'before_title'  => $before_title,
		'after_title'   => $after_title,
	));

	// WooCommerce Sidebar
	if ( HERBS_WOOCOMMERCE_IS_ACTIVE ){
		register_sidebar( array(
			'id'            => 'shop-widget-area',
			'name'          => esc_html__( 'Shop - For WooCommerce Pages', HERBS_TEXTDOMAIN ),
			'description'   => esc_html__( 'This widget area uses in the WooCommerce pages.', HERBS_TEXTDOMAIN ),
			'before_widget' => $before_widget,
			'after_widget'  => $after_widget,
			'before_title'  => $before_title,
			'after_title'   => $after_title,
		));
	}

	// Custom Sidebars
	$sidebars = tie_get_option( 'sidebars' );
	if( ! empty( $sidebars ) && is_array( $sidebars )){
		foreach ($sidebars as $sidebar){
			register_sidebar( array(
				'id' 			      => sanitize_title($sidebar),
				'name'          => $sidebar,
				'before_widget' => $before_widget,
				'after_widget' 	=> $after_widget,
				'before_title' 	=> $before_title,
				'after_title' 	=> $after_title,
			));
		}
	}

	// Footer Widgets
	$footer_widgets_areas = array(
		'area_1' => esc_html__( 'First Footer',  HERBS_TEXTDOMAIN ),
		'area_2' => esc_html__( 'Second Footer', HERBS_TEXTDOMAIN )
	);

	foreach( $footer_widgets_areas as $name => $description ){

		if( tie_get_option( 'footer_widgets_'.$name ) ){

			$footer_widgets = tie_get_option( 'footer_widgets_layout_'.$name );

			# Footer Widgets Column 1
			register_sidebar( array(
				'id'            => 'first-footer-widget-'.$name,
				'name'          => $description. ' - '.esc_html__( '1st Column', HERBS_TEXTDOMAIN ),
				'before_widget' => $before_widget,
				'after_widget'  => $after_widget,
				'before_title'  => $before_title,
				'after_title'   => $after_title,
			));


			# Footer Widgets Column 2
			if( $footer_widgets == 'footer-2c'      ||
				  $footer_widgets == 'narrow-wide-2c' ||
				  $footer_widgets == 'wide-narrow-2c' ||
				  $footer_widgets == 'footer-3c'      ||
				  $footer_widgets == 'wide-left-3c'   ||
				  $footer_widgets == 'wide-right-3c'  ||
				  $footer_widgets == 'footer-4c'      ){

						register_sidebar( array(
							'id' 			      => 'second-footer-widget-'.$name,
							'name'			    => $description. ' - '.esc_html__( '2d Column', HERBS_TEXTDOMAIN ),
							'before_widget' => $before_widget,
							'after_widget'  => $after_widget,
							'before_title'  => $before_title,
							'after_title'   => $after_title,
						));
					}


			# Footer Widgets Column 3
			if( $footer_widgets == 'footer-3c'     ||
				  $footer_widgets == 'wide-left-3c'  ||
				  $footer_widgets == 'wide-right-3c' ||
				  $footer_widgets == 'footer-4c'     ){

						register_sidebar( array(
							'id'            => 'third-footer-widget-'.$name,
							'name'          => $description. ' - '.esc_html__( '3rd Column', HERBS_TEXTDOMAIN ),
							'before_widget' => $before_widget,
							'after_widget'  => $after_widget,
							'before_title'  => $before_title,
							'after_title'   => $after_title,
						));
					}


			# Footer Widgets Column 4
			if( $footer_widgets == 'footer-4c' ){
				register_sidebar( array(
					'id'            => 'fourth-footer-widget-'.$name,
					'name'          => $description. ' - '.esc_html__( '4th Column', HERBS_TEXTDOMAIN ),
					'before_widget' => $before_widget,
					'after_widget'  => $after_widget,
					'before_title'  => $before_title,
					'after_title'   => $after_title,
				));
			}

		}
	}


	$custom_widgets = get_option( 'tie_sidebars_widgets', array() );

	foreach ( $custom_widgets as $post_id => $sections ) {
		$i = 1;
		if( ! empty( $sections ) && is_array( $sections ) ){
			foreach ( $sections as $section => $widgets ) {
				register_sidebar(array(
					'name'          => get_the_title( $post_id ). ' - '. sprintf( esc_html__( 'Section #%s', HERBS_TEXTDOMAIN ), $i ),
					'id'            => $section,
					'before_widget' => $before_widget,
					'after_widget'  => $after_widget,
					'before_title'  => $before_title,
					'after_title'   => $after_title,
				));

				$i++;
			}
		}
	}
}



/**
 * Import the Default Widgets
 */
$theme_widgets = array( 'ads', 'tabs', 'posts', 'login', 'about', 'flickr', 'author', 'social', 'slider', 'weather', 'youtube', 'twitter', 'facebook', 'text-html', 'instagram', 'newsletter', 'soundcloud', 'categories', 'comments-avatar', 'social-counters' );
$theme_widgets = apply_filters( 'Herbs/Widgets/default_widgets', $theme_widgets );

if( ! empty( $theme_widgets ) && is_array( $theme_widgets ) ){
	foreach ( $theme_widgets as $widget ){
		locate_template( "framework/widgets/$widget.php", true, true );
	}
}
