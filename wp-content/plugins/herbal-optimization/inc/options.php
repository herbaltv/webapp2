<?php
/**
 * Options
 **/

defined( 'ABSPATH' ) || exit; // Exit if accessed directly


class HERBAL_OPTIMIZATION_OPTIONS{


	/**
	 * Fire Filters and actions
	 */
	function __construct(){

		// Check if the theme is enabled
		if( ! class_exists( 'HERBS_HELPER' ) || ! function_exists( 'herbal_theme_name' ) ){
			return;
		}

		add_action( 'Herbs/Options/before_update',      array( $this, 'update_critical_css' ) );

		add_filter( 'admin_head',                         array( $this, 'admin_head' ) );
		add_filter( 'Herbs/options_tab_title',          array( $this, 'tab_title' ) );
		add_action( 'tie_theme_options_tab_optimization', array( $this, 'tab_content' ) );
	}


	/**
	 * update_critical_css
	 */
	function update_critical_css( $settings ){

		if ( empty( $settings['jso_critical_css'] ) && false !== get_transient( 'tie_critical_css_'.HERBS_THEME_ID ) ) {
			delete_transient( 'tie_critical_css_'.HERBS_THEME_ID );
		}
	}


	/**
	 * tab_title
	 *
	 * Add a tab for the optimization settings in the theme options page
	 */
	function tab_title( $settings_tabs ){

		$settings_tabs['optimization'] = array(
			'icon'  => 'dashboard',
			'title' => esc_html__( 'Performance', HERBS_TEXTDOMAIN ),
		);

		return $settings_tabs;
	}


	/**
	 * tab_content
	 *
	 * Add new section for the optimization settings in the theme options page
	 */
	function tab_content(){

		tie_build_theme_option(
			array(
				'title' => esc_html__( 'Speed Optimization', HERBS_TEXTDOMAIN ),
				'id'    => 'speed-optimization-tab',
				'type'  => 'tab-title',
			));


		// This method available in v4.0.0 and above
		if( ! method_exists( 'HERBS_HELPER','has_builder' ) ){

			tie_build_theme_option(
				array(
					'text' => esc_html__( 'You need to upgrade your theme to v4.0.0 to access these options. ', HERBS_TEXTDOMAIN ),
					'type' => 'error',
				));

			return;
		}

		tie_build_theme_option(
			array(
				'text' => esc_html__( 'Deactivate if you notice any visually broken items on your website.', HERBS_TEXTDOMAIN ),
				'type' => 'error',
			));

		tie_build_theme_option(
			array(
				'title' =>	esc_html__( 'General', HERBS_TEXTDOMAIN ),
				'type'  => 'header',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Cache Static Sections', HERBS_TEXTDOMAIN ),
				'id'   => 'jso_cache',
				'type' => 'checkbox',
				'hint' => esc_html__( 'If enabled, some static parts like widgets, main menu and breaking news will be cached to reduce MySQL queries. Saving the theme settings, adding/editing/removing posts, adding comments, updating menus, activating/deactivating plugins, adding/editing/removing terms or updating WordPress, will flush the cache.', HERBS_TEXTDOMAIN ),
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Disable Lightbox Resources on Homepage', HERBS_TEXTDOMAIN ),
				'id'   => 'jso_homepage_lightbox',
				'type' => 'checkbox',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Remove query strings from static resources', HERBS_TEXTDOMAIN ),
				'id'   => 'jso_remove_query_strings',
				'type' => 'checkbox',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Disable Emoji and Smilies', HERBS_TEXTDOMAIN ),
				'id'   => 'jso_disable_emoji_smilies',
				'type' => 'checkbox',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Disable XML-RPC and RSD Link', HERBS_TEXTDOMAIN ),
				'hint' => esc_html__( 'More info', HERBS_TEXTDOMAIN ) .' https://codex.wordpress.org/XML-RPC_Support',
				'id'   => 'jso_disable_xml_rpc',
				'type' => 'checkbox',
			));


		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Remove wlwmanifest Link', HERBS_TEXTDOMAIN ),
				'hint' => esc_html__( 'If you don’t use Windows Live Writer', HERBS_TEXTDOMAIN ),
				'id'   => 'jso_disable_wlwmanifest',
				'type' => 'checkbox',
			));

		tie_build_theme_option(
			array(
				'title' =>	esc_html__( 'CSS', HERBS_TEXTDOMAIN ),
				'type'  => 'header',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Optimize CSS delivery', HERBS_TEXTDOMAIN ),
				'id'   => 'jso_css_delivery',
				'type' => 'checkbox',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Inline Critical Path CSS', HERBS_TEXTDOMAIN ),
				'id'   => 'jso_critical_css',
				'type' => 'checkbox',
			));


		tie_build_theme_option(
			array(
				'title' =>	esc_html__( 'JavaScript', HERBS_TEXTDOMAIN ),
				'type'  => 'header',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Load JS files deferred', HERBS_TEXTDOMAIN ),
				'id'   => 'jso_js_deferred',
				'type' => 'checkbox',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Dequeue Jquery Migrate File', HERBS_TEXTDOMAIN ),
				'id'   => 'jso_dequeue_jquery_migrate',
				'type' => 'checkbox',
			));

		tie_build_theme_option(
			array(
				'title' =>	esc_html__( 'HTML', HERBS_TEXTDOMAIN ),
				'type'  => 'header',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Minify HTML', HERBS_TEXTDOMAIN ),
				'id'   => 'jso_minify_html',
				'type' => 'checkbox',
			));

		/*
		tie_build_theme_option(
			array(
				'title' =>	esc_html__( 'Ajax Requests', HERBS_TEXTDOMAIN ),
				'type'  => 'header',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Optimize Ajax Requests', HERBS_TEXTDOMAIN ),
				'id'   => 'jso_ajax',
				'type' => 'checkbox',
			));
		*/

		tie_build_theme_option(
			array(
				'title' =>	esc_html__( 'Google Fonts', HERBS_TEXTDOMAIN ),
				'type'  => 'header',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Disable Google Fonts on slow connections', HERBS_TEXTDOMAIN ),
				'id'   => 'jso_disable_fonts_2g',
				'type' => 'checkbox',
				'hint' => esc_html__( 'Partially Supported', HERBS_TEXTDOMAIN ) .' https://caniuse.com/#feat=netinfo',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Disable Google Fonts on mobiles', HERBS_TEXTDOMAIN ),
				'id'   => 'jso_disable_fonts_mobile',
				'type' => 'checkbox',
			));


		tie_build_theme_option(
			array(
				'title' =>	esc_html__( 'Lazy Load', HERBS_TEXTDOMAIN ),
				'id'    => 'lazy-load-head',
				'type'  => 'header',
			));

		tie_build_theme_option(
			array(
				'name'   => esc_html__( 'Lazy Load For Images', HERBS_TEXTDOMAIN ),
				'id'     => 'lazy_load',
				'type'   => 'checkbox',
				'toggle' => '#lazy_load_img-item, #lazy_load_dark_img-item, #lazy_load_post_content-item, #lazy_load_ads-item',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Image Placeholder', HERBS_TEXTDOMAIN ),
				'id'   => 'lazy_load_img',
				'type' => 'upload',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'Dark Skin Image Placeholder', HERBS_TEXTDOMAIN ),
				'id'   => 'lazy_load_dark_img',
				'type' => 'upload',
			));

		tie_build_theme_option(
			array(
				'name'   => esc_html__( 'Lazy Load For Images in Post Content', HERBS_TEXTDOMAIN ),
				'id'     => 'lazy_load_post_content',
				'type'   => 'checkbox',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'LazyLoad for blocks and Widgets Images Ads', HERBS_TEXTDOMAIN ),
				'id'   => 'lazy_load_ads',
				'type' => 'checkbox',
			));

		$plugins = array();

		if( HERBS_WOOCOMMERCE_IS_ACTIVE ){
			$plugins['woocommerce'] = esc_html__( 'WooCommerce', HERBS_TEXTDOMAIN );
		}

		if( HERBS_BBPRESS_IS_ACTIVE ){
			$plugins['bbpress'] = esc_html__( 'bbPress', HERBS_TEXTDOMAIN );
		}

		if( HERBS_BUDDYPRESS_IS_ACTIVE ){
			$plugins['buddypress'] = esc_html__( 'BuddyPress', HERBS_TEXTDOMAIN );
		}

		if( HERBS_EXTENSIONS_IS_ACTIVE ){
			$plugins['shortcodes'] = esc_html__( 'Shortcodes', HERBS_TEXTDOMAIN );
		}

		if( ! empty( $plugins ) ){

			$pages = array(
				'homepage' => esc_html__( 'The Homepage', HERBS_TEXTDOMAIN ),
				'builder'  => esc_html__( 'Pages built by the Herbs Page Builder', HERBS_TEXTDOMAIN ),
				'post'     => esc_html__( 'Posts', HERBS_TEXTDOMAIN ),
				'category' => esc_html__( 'Categories', HERBS_TEXTDOMAIN ),
				'tag'      => esc_html__( 'Tags', HERBS_TEXTDOMAIN ),
				'author'   => esc_html__( 'Author Pages', HERBS_TEXTDOMAIN ),
			);

			foreach ( $plugins as $plugin => $text ){

				tie_build_theme_option(
					array(
						'title' => $text . ' | '. esc_html__( 'Don\'t load CSS and JS files on', HERBS_TEXTDOMAIN ),
						'type' => 'header',
					));

				foreach ( $pages as $page => $text ) {

					if( ( $plugin == 'shortcodes' || $plugin == 'woocommerce' ) && $page == 'builder' ){

						tie_build_theme_option(
							array(
								'name'   => $text,
								'id'     => 'jso_disable_'. $plugin .'_'. $page,
								'type'   => 'checkbox',
								'toggle' => '#jso_exclude_'. $plugin .'_pages-item',
							));

						tie_build_theme_option(
							array(
								'name' => esc_html__( 'Exclude these pages', HERBS_TEXTDOMAIN ),
								'hint' => esc_html__( 'Enter a page ID, or IDs separated by comma.', HERBS_TEXTDOMAIN ),
								'id'   => 'jso_exclude_'. $plugin .'_pages',
								'type' => 'text',
							));
					}
					elseif( ! ( $plugin == 'shortcodes' && $page == 'post' ) ){

						tie_build_theme_option(
							array(
								'name'   => $text,
								'id'     => 'jso_disable_'. $plugin .'_'. $page,
								'type'   => 'checkbox',
							));
					}

				}
			}
		}

	}

	/**
	 * admin_head
	 *
	 * Set custom style for the optimization tab title
	 */
	function admin_head() {
		echo '
			<style>
				.tie-panel-tabs li.tie-options-tab-optimization:not(.active) a{
					background-color: #109010;
				}
			</style>
		';
	}


} // class


//
add_filter( 'admin_init', 'herbal_optimization_options_init' );
function herbal_optimization_options_init(){
	new HERBAL_OPTIMIZATION_OPTIONS();
}
