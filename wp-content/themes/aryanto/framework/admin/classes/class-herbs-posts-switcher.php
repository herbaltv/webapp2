<?php
/**
 * Posts Switcher
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly



if( ! class_exists( 'HERBS_POSTS_SWITCHER' )){

	class HERBS_POSTS_SWITCHER{


		public $menu_slug = 'tie-posts-switcher';
		public static $switcher_themes;


		/**
		 * __construct
		 *
		 * Class constructor where we will call our filter and action hooks.
		 */
		function __construct(){

			// Check if the current user role
			if( ! current_user_can( 'switch_themes' ) ){
				return;
			}

			// Disable the switcher if the Disable option is on
			if( tie_get_option( 'disable_switcher' ) ){
				return;
			}

			// Filters
			add_filter( 'Herbs/panel_submenus', array( $this, '_add_options_menu' ), 400 );
			add_filter( 'Herbs/about_tabs',     array( $this, '_add_about_tabs' )  , 30 );
			add_filter( 'admin_notices',          array( $this, '_switcher_notices' ), 30 );

			// Themes Supported by the Switcher-
			self::$switcher_themes = array( 'braxton', 'click-mag', 'flex-mag', 'goodlife-wp', 'goodnews5', 'hottopix', 'maxmag', 'multinews', 'Newsmag', 'Newspaper', 'publisher', 'simplemag', 'thevoux-wp', 'topnews', 'valenti' );
		}


		/**
		 * _add_about_tabs
		 *
		 * Add the Switcher Page to the about page's tabs
		 */
		function _add_about_tabs( $tabs ){

			$tabs['switcher'] = array(
				'text' => esc_html__( 'Posts Switcher', HERBS_TEXTDOMAIN ),
				'url'  => menu_page_url( $this->menu_slug, false ),
			);

			return $tabs;
		}


		/**
		 * _add_options_menu
		 *
		 */
		function _add_options_menu( $menus ){

			$menus[] = array(
				'page_title' => esc_html__( 'Posts Switcher', HERBS_TEXTDOMAIN ),
				'menu_title' => esc_html__( 'Posts Switcher', HERBS_TEXTDOMAIN ),
				'menu_slug'  => $this->menu_slug,
				'function'   => array( $this, '_page_content' ),
			);

			return $menus;
		}


		/**
		 * _detect_themes
		 *
		 */
		static function _detect_themes( $single = true ){

			global $wpdb;

			// Get the slug of all themes installed before
			$query  = 'SELECT option_name FROM ' . $wpdb->options . ' WHERE option_name LIKE "theme_mods_%"';
			$themes = $wpdb->get_results( $query );

			if( ! empty( $themes ) && is_array( $themes ) ){

				$previous_themes = array();
				foreach( $themes as $key => $value ){

					if( ! empty( $value->option_name ) ){
						$previous_themes[] = str_replace( 'theme_mods_', '', $value->option_name );
					}
				}
			}

			// Let's do some check
			if( ! empty( $previous_themes ) && is_array( $previous_themes ) ){

				$all_previous_themes = array();

				# Check for Herbs Themes First
				if( in_array( 'sahifa', $previous_themes ) || in_array( 'jarida', $previous_themes ) || get_option( 'tie_options' ) ){

					// YAY this is a Loyal Customer ;)
					if( in_array( 'jarida', $previous_themes ) ){
						$detected_theme = 'Jarida';

						$all_previous_themes[] = $detected_theme;
					}
					else{
						$detected_theme = 'Sahifa';
						$all_previous_themes[] = $detected_theme;
					}
				}

				// Check if the site used one of our Switcher suported themes
				if( empty( $detected_theme ) ){
					foreach ( $previous_themes as $theme ){

						if( in_array( $theme, self::$switcher_themes ) ){

							$detected_theme = $theme;
							$detected_theme = str_replace( array( '5', '-wp' ), '', $detected_theme );

							if( $single ){
								break;
							}
							else{
								$all_previous_themes[] = $detected_theme;
							}
						}
					}
				}

				if( ! empty( $detected_theme ) ){

					if( $single ){
						return $detected_theme;
					}

					# Return the Full Array
					return $all_previous_themes;
				}

				return false;
			}
		}


		/**
		 * _switcher_notices
		 *
		 */
		function _switcher_notices(){

			$notice_id = 'tie_switcher_notice_'. HERBS_THEME_ID;

			if ( ! HERBS_ADMIN_HELPER::is_theme_options_page() || HERBS_NOTICES::is_dismissed( $notice_id ) || get_option( 'tie_switch_to_'. HERBS_THEME_ID ) ){
				return false;
			}

			// Get the theme name
			$detected_theme = self::_detect_themes();

			// We just found the old theme
			if( ! empty( $detected_theme ) ){
				$is_on = true;
				$title = sprintf( esc_html__( 'Are You Megrating from %s?', HERBS_TEXTDOMAIN ), $detected_theme );
				$image = WP_PLUGIN_URL . '/herbal-switcher/assets/images/'. strtolower( $detected_theme ) .'.png';
				$mssge = sprintf( esc_html__( 'It seems you are megrating from %1s%2s%3s theme, click on the button below to complete the switching process.', HERBS_TEXTDOMAIN ), '<strong>', $detected_theme, '</strong>' );
			}
			elseif( get_option( 'tie_published_posts_'. HERBS_THEME_ID ) > 30 ){
				$is_on = true;
				$title = esc_html__( 'Are You Megrating from another theme?', HERBS_TEXTDOMAIN );
				$image = false;
				$mssge = sprintf( esc_html__( 'It seems you are megrating from another theme, it is recommended to check our Switcher it supports %1s%2s%3s themes, click on the button below to check them.', HERBS_TEXTDOMAIN ), '<strong>', count( self::$switcher_themes ) + 2, '</strong>' );
			}

			if( ! empty( $is_on ) ){
				HERBS_NOTICES::message( array(
					'notice_id'   => $notice_id,
					'title'       => $title,
					'message'     => '<p>'. $mssge .'</p>',
					'dismissible' => true,
					'standard'    => true,
					'class'       => 'warning',
					'img'         => class_exists( 'HERBAL_SWITCHER_CLASS' ) ? $image : false,
					'button_text' => esc_html__( 'Run the Switcher', HERBS_TEXTDOMAIN ),
					'button_url'  => menu_page_url( 'tie-posts-switcher', false ),
					'button_class'=> 'green',
				));
			}
		}


		/**
		 * _out
		 *
		 */
		function _page_content() {

			echo '<div class="wrap about-wrap tie-about-wrap">';

				HERBS_WELCOME_PAGE::_head_section( 'switcher' );

				// is the theme activated
				if( ! get_option( 'tie_token_'.HERBS_THEME_ID ) ){
					HERBS_VERIFICATION::authorize_notice( false );
				}

				// Is the Switcher plugin active
				elseif( ! class_exists( 'HERBAL_SWITCHER_CLASS' ) ){

					echo '<h2>'. sprintf( esc_html__( 'Switch to %s Theme', HERBS_TEXTDOMAIN ), apply_filters( 'Herbs/theme_name', 'Herbs' ) ) .'</h2>';

					HERBS_NOTICES::message( array(
						'notice_id'   => 'switcher_is_requried',
						'title'       => sprintf( esc_html__( '%s Plugin is required', HERBS_TEXTDOMAIN ), 'Herbal Switcher' ),
						'message'     => '<p>'. sprintf( esc_html__( '%s Plugin is required, click on the button below to go to the plugins page to install it.', HERBS_TEXTDOMAIN ), 'Herbal Switcher' ) .'</p>',
						'dismissible' => false,
						'standard'    => false,
						'class'       => 'error',
						'button_text' => esc_html__( 'Go to the Plugins Page', HERBS_TEXTDOMAIN ),
						'button_url'  => menu_page_url( 'tie-install-plugins', false ),
					));
				}

				else{
					do_action( 'herbal_switcher_content' );
				}

			echo '</div>';
		}

	}


	new HERBS_POSTS_SWITCHER();
}
