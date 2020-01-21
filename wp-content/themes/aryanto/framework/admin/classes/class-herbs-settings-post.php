<?php
/**
 * Post Settings Class
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly



if( ! class_exists( 'HERBS_SETTINGS_POST' )){

	class HERBS_SETTINGS_POST{


		/**
		 * __construct
		 *
		 * Class constructor where we will call our filter and action hooks.
		 */
		function __construct(){

			add_action( 'admin_head',     array( $this, 'post_subtitle' ) );
			add_action( 'save_post',      array( $this, 'save' ) );
			add_action( 'add_meta_boxes', array( $this, 'meta_boxes' ), 3 );

			add_filter( 'Herbs/Settings/Post/general', array( $this, 'posts_page_template' ) );
			add_filter( 'Herbs/Settings/Post/general', array( $this, 'authors_page_template' ) );

			add_filter( 'Herbs/Settings/Post/general', array( $this, 'general_page_settings' ) );
			add_filter( 'Herbs/Settings/Post/general', array( $this, 'general_post_settings' ) );
			add_filter( 'Herbs/Settings/Post/general', array( $this, 'post_format_settings' ) );

			add_filter( 'Herbs/Settings/Post/layout',  array( $this, 'layout_settings' ) );
			add_filter( 'Herbs/Settings/Post/logo',    array( $this, 'logo_settings' ) );
			add_filter( 'Herbs/Settings/Post/sidebar', array( $this, 'sidebar_settings' ) );
			add_filter( 'Herbs/Settings/Post/styles',  array( $this, 'styles_settings' ) );
			add_filter( 'Herbs/Settings/Post/menu',    array( $this, 'menu_settings' ) );

			add_filter( 'Herbs/Settings/Post/components', array( $this, 'components_settings' ) );
			add_filter( 'Herbs/Settings/Post/components', array( $this, 'post_components_settings' ) );
			add_filter( 'Herbs/Settings/Post/e3lan',      array( $this, 'e3lan_settings' ) );

			add_action( 'Herbs/Settings/Post/after_source-via', array( $this, 'source_settings' ) );
			add_action( 'Herbs/Settings/Post/after_source-via', array( $this, 'via_settings' ) );
			add_action( 'Herbs/Settings/Post/after_highlights', array( $this, 'highlights_settings' ) );
		}


		/**
		 * post_subtitle
		 *
		 * Handle the position of the post subtitle depending on the Editor
		 */
		function post_subtitle(){

			// Enable/Disable Sub Title
			if( ! apply_filters( 'Herbs/Settings/Post/is_subtitle', true ) ){
				return;
			}

			// is Gutenberg?
			if( HERBS_ADMIN_HELPER::is_edit_gutenberg() ){

				add_meta_box(
					'tie_post_secondry_title',
					esc_html__( 'Subtitle', HERBS_TEXTDOMAIN ),
					array( $this, 'secondry_title' ),
					HERBS_HELPER::get_supported_post_types(),
					'side',
					'high'
				);
			}
			else{
				add_action( 'edit_form_after_title', array( $this, 'secondry_title' ), 40 );
			}
		}


		/**
		 * Register The Meta Boxes
		 */
		function meta_boxes(){

			add_meta_box(
				'tie_post_options',
				apply_filters( 'Herbs/theme_name', 'Herbs' ) .' - '. esc_html__( 'Settings', HERBS_TEXTDOMAIN ),
				array( $this, 'custom_options' ),
				apply_filters( 'Herbs/settings_post_types', array( 'post', 'page' ) ),
				'normal',
				'high'
			);

			add_meta_box(
				'tie_frontpage_option',
				apply_filters( 'Herbs/theme_name', 'Herbs' ) .' - '. esc_html__( 'Front Page', HERBS_TEXTDOMAIN ),
				array( $this, 'frontpage_option' ),
				'page',
				'side',
				'low'
			);
		}


		/**
		 * Secondry post title
		 *
		 * CLASSIC EDITOR
		 */
		function secondry_title(){

			$post_id = get_the_id();

			// Get current post type
			if( ! empty( $post_id ) ){
				$current_post_type = get_post_type( $post_id );
			}

			if( empty( $current_post_type ) && get_current_screen()->post_type ){
				$current_post_type = get_current_screen()->post_type;
			}

			// return if it is not supported
			if( ! in_array( $current_post_type, HERBS_HELPER::get_supported_post_types() ) ){
				return;
			}

			?>

			<div id="subtitlediv">
				<div id="subtitlewrap">
					<label class="screen-reader-text" id="sub-title-prompt-text" for="tie-sub-title"><?php esc_html_e( 'Enter sub title here', HERBS_TEXTDOMAIN ) ?></label>
					<input type="text" name="tie_post_sub_title" size="30" value="<?php echo esc_attr( get_post_meta( $post_id, 'tie_post_sub_title', true ) ) ?>" id="tie-sub-title" placeholder="<?php esc_html_e( 'Enter sub title here', HERBS_TEXTDOMAIN ) ?>" spellcheck="true" autocomplete="off">
				</div>
			</div>

			<?php
		}


		/**
		 * Set the page as a front page
		 */
		function frontpage_option(){

			$notice = $data  = '';

			if( get_option( 'show_on_front' ) == 'page' ){

				$current_page_id = get_the_id();
				$front_page_id   = get_option( 'page_on_front' );

				if( $current_page_id == $front_page_id ){
					$data = 'true';
				}
				else{

					$link = add_query_arg( array( 'post' => $front_page_id, 'action' => 'edit' ), admin_url( 'post.php' ) );
					$page = '<a href='. $link .' target="_blank">'. get_the_title( $front_page_id ) .'</a>';
					$notice = '
						<p>'. sprintf( esc_html__( 'Current Front Page: %s', HERBS_TEXTDOMAIN ), $page ) .'</p>
					';
				}
			}

			$option = array(
				'name'   => esc_html__( 'Set as the site Front Page?', HERBS_TEXTDOMAIN ),
				'id'     => 'tie-set-front-page',
				'type'   => 'checkbox',
			);

			tie_build_option( $option, 'page_on_front', $data );

			echo $notice;
		}


		/**
		 * Add Button in the Gutenburg page to the Herbs Builder
		 */
		function gutenburg_use_classic_builder(){
			?>
				<a class="tie-primary-button button button-hero button-primary" id="gutenburg-use-classic-builder" style="width: 100%;"><?php echo esc_html__( 'Use the Herbs Builder', HERBS_TEXTDOMAIN ); ?></a>
			<?php
		}


		/**
		 * Build The Post Option
		 */
		function build_option( $option ){

			$id   = ! empty( $option['id'] ) ? $option['id'] : '';
			$data = tie_get_postdata( $id );

			tie_build_option( $option, $id, $data );
		}


		/**
		 * Save Category Options
		 */
		function save( $post_id ){

			// Check if this is an auto save
			if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
				return $post_id;
			}

			// Begin to save ---------
			if ( ! isset( $_POST['tie_hidden_flag'] ) ){
				return;
			}

			// Prevent set the revision pages as frontpage
			if( ! wp_is_post_revision( $post_id ) ){

				// Update the Front Page option
				if( ! empty( $_POST['page_on_front'] ) ){

					update_option( 'show_on_front', 'page' );
					update_option( 'page_on_front', $post_id );
				}
				else{

					if( get_option( 'show_on_front' ) == 'page' && $post_id == get_option( 'page_on_front' ) ){
						update_option( 'show_on_front', 'posts' );
						update_option( 'page_on_front', 0 );
					}
				}
			}


			// Post / Page Options
			$custom_meta_fields = apply_filters( 'Herbs/post_options_meta', array(

				// Misc
				'tie_post_sub_title',
				'tie_primary_category',
				'tie_trending_post',
				'tie_hide_title',
				'tie_hide_header',
				'tie_hide_footer',
				'tie_do_not_dublicate',
				'tie_header_extend_bg',

				// Post Layout
				'tie_theme_layout',
				'tie_post_layout',
				'tie_featured_use_fea',
				'tie_featured_custom_bg',
				'tie_featured_bg_color',

				// Logo
				'custom_logo' => array(
					'logo_setting',
					'logo_text',
					'logo',
					'logo_retina',
					'logo_retina_width',
					'logo_retina_height',
					'logo_margin',
					'logo_margin_bottom',
					'logo_url',
				),

				// Post Sidebar
				'tie_sidebar_pos',
				'tie_sidebar_post',
				'tie_sticky_sidebar',

				// Post Format settings
				'tie_post_head',

				'tie_post_featured',
				'tie_image_uncropped',
				'tie_image_lightbox',

				'tie_post_slider',
				'tie_post_gallery',

				'tie_googlemap_url',

				'tie_video_url',
				'tie_video_self',
				'tie_embed_code',

				'tie_audio_m4a',
				'tie_audio_mp3',
				'tie_audio_oga',
				'tie_audio_soundcloud',
				'tie_audio_embed',

				// Custom Ads
				'tie_hide_above',
				'tie_get_banner_above',
				'tie_hide_below',
				'tie_get_banner_below',
				'tie_hide_above_content',
				'tie_get_banner_above_content',
				'tie_hide_below_content',
				'tie_get_banner_below_content',

				// Post Components
				'tie_hide_meta',
				'tie_hide_tags',
				'tie_hide_categories',
				'tie_hide_author',
				'tie_hide_nav',
				'tie_hide_share_top',
				'tie_hide_share_bottom',
				'tie_hide_newsletter',
				'tie_hide_related',
				'tie_hide_read_next',
				'tie_hide_check_also',

				// Story Highlights
				'tie_highlights_text',

				// Source & Via
				'tie_source',
				'tie_via',

				// Post Color and background
				'post_color',
				'tie_custom_css',
				'background_color',
				'background_color_2',
				'background_type' => array(
					'background_pattern',
					'background_image',
				),
				'background_dots',
				'background_dimmer' => array(
					'background_dimmer_value',
					'background_dimmer_color',
				),

				// Custom Menu
				'tie_menu',

				// Page templates
				'tie_blog_excerpt' => array(
					'tie_blog_length',
				),
				'tie_blog_uncropped_image',
				'tie_blog_category_meta',
				'tie_blog_meta',
				'tie_posts_num',
				'tie_blog_cats',
				'tie_blog_layout',
				'tie_authors',
				'tie_blog_pagination',
			));

			foreach( $custom_meta_fields as $key => $custom_meta_field ){

				// Dependency Options fields
				if( is_array( $custom_meta_field ) ){

					if( ! empty( $_POST[ $key ] )){

						update_post_meta( $post_id, $key, $_POST[ $key ] );

						foreach ( $custom_meta_field as $single_field ){
							if( ! empty( $_POST[ $single_field ] )){
								update_post_meta( $post_id, $single_field, $_POST[ $single_field ] );
							}
							else{
								delete_post_meta( $post_id, $single_field );
							}
						}
					}
					else{
						delete_post_meta( $post_id, $key );
					}
				}

				// Single Options fields
				else{
					if( ! empty( $_POST[ $custom_meta_field ] )){
						update_post_meta( $post_id, $custom_meta_field, $_POST[ $custom_meta_field ] );
					}
					else{
						delete_post_meta( $post_id, $custom_meta_field );
					}
				}
			}
		}


		/**
		 * Post Custom Options
		 */
		function custom_options( ){

			$settings_tabs = array(

				'general' => array(
					'icon'  => 'admin-settings',
					'title' => esc_html__( 'General', HERBS_TEXTDOMAIN ),
				),

				'layout' => array(
					'icon'	=> 'schedule',
					'title'	=> esc_html__( 'Layout', HERBS_TEXTDOMAIN ),
				),

				'logo' => array(
					'icon'	=> 'lightbulb',
					'title'	=> esc_html__( 'Logo', HERBS_TEXTDOMAIN ),
				),

				'sidebar' => array(
					'icon'  => 'slides',
					'title' => esc_html__( 'Sidebar', HERBS_TEXTDOMAIN ),
				),

				'styles' => array(
					'icon'  => 'art',
					'title' => esc_html__( 'Styles', HERBS_TEXTDOMAIN ),
				),

				'menu' => array(
					'icon'  => 'menu',
					'title' => esc_html__( 'Main Menu', HERBS_TEXTDOMAIN ),
				),

				'e3lan' => array( // Avoid elemnt blocking by the AdBlockers
					'icon'  => 'megaphone',
					'title' => esc_html__( 'Advertisement', HERBS_TEXTDOMAIN ),
				),

				'components' => array(
					'icon'  => 'admin-settings',
					'title' => esc_html__( 'Components', HERBS_TEXTDOMAIN ),
				),
			);

			if( HERBS_HELPER::is_supported_post_type() ){

				$settings_tabs['highlights'] = array(
					'icon'  => 'editor-alignleft',
					'title' => esc_html__( 'Story Highlights', HERBS_TEXTDOMAIN ),
				);

				$settings_tabs['source-via'] = array(
					'icon'  => 'share-alt2',
					'title' => esc_html__( 'Source and Via', HERBS_TEXTDOMAIN ),
				);
			}

			$settings_tabs = apply_filters( 'Herbs/Settings/Post', $settings_tabs );

			?>

			<input type="hidden" name="tie_hidden_flag" value="true" />

			<div class="tie-panel">
				<div class="tie-panel-tabs">
					<ul>
						<?php
							foreach( $settings_tabs as $tab => $settings ){

								$icon  = $settings['icon'];
								$title = $settings['title'];

								echo "
									<li class=\"tie-tabs tie-options-tab-$tab\">
										<a href=\"#tie-options-tab-$tab\">
											<span class=\"dashicons-before dashicons-$icon tie-icon-menu\"></span>
											$title
										</a>
									</li>
								";
							}
						?>
					</ul>
					<div class="clear"></div>
				</div> <!-- .tie-panel-tabs -->

				<div class="tie-panel-content">

					<?php
						foreach( $settings_tabs as $tab => $settings ){
							?>

							<div id="tie-options-tab-<?php echo $tab ?>" class="tabs-wrap">
								<?php

									do_action( 'Herbs/Settings/Post/before_'.$tab );

									$tab_options = apply_filters( 'Herbs/Settings/Post/'.$tab, array() );

									if( ! empty( $tab_options ) && is_array( $tab_options ) ){
										foreach ( $tab_options as $option ){
											$this->build_option( $option );
										}
									}

									do_action( 'Herbs/Settings/Post/after_'.$tab );

								?>
							</div>

							<?php
						}
					?>

				</div><!-- .tie-panel-content -->

				<div class="clear"></div>
			</div><!-- .tie-panel -->

			<div class="clear"></div>

			<?php
		}


		/**
		 * Page Templates Settings
		 */
		function posts_page_template( $current_settings ){

			// These options available in Pages only
			if( get_post_type() != 'page' ){
				return $current_settings;
			}

			$settings = array(

				array(
					'content' => '<div id="tie-page-template-categories" class="tie-page-templates-options">',
					'type'    => 'html',
				),

				array(
					'title' => esc_html__( 'Masonry Page', HERBS_TEXTDOMAIN ),
					'id'    => 'tie_categories_title',
					'type'  => 'header',
				),

				array(
					'id'      => 'tie_blog_layout',
					'type'    => 'visual',
					'columns' => 5,
					'options' => array(
						'masonry'        => array( esc_html__( 'Masonry', HERBS_TEXTDOMAIN ).' #1' => 'archives/masonry.png' ),
						'overlay'        => array( esc_html__( 'Masonry', HERBS_TEXTDOMAIN ).' #2' => 'archives/overlay.png' ),
						'overlay-spaces' => array( esc_html__( 'Masonry', HERBS_TEXTDOMAIN ).' #3' => 'archives/overlay-spaces.png' ),
				)),

				array(
					'name' => esc_html__( 'Uncropped featured image', HERBS_TEXTDOMAIN ),
					'id'   => 'tie_blog_uncropped_image',
					'type' => 'checkbox',
				),

				array(
					'name' => esc_html__( 'Post Meta', HERBS_TEXTDOMAIN ),
					'id'   => 'tie_blog_meta',
					'type' => 'checkbox',
				),

				array(
					'name' => esc_html__( 'Categories Meta', HERBS_TEXTDOMAIN ),
					'id'   => 'tie_blog_category_meta',
					'type' => 'checkbox',
				),

				array(
					'name'   => esc_html__( 'Posts Excerpt', HERBS_TEXTDOMAIN ),
					'id'     => 'tie_blog_excerpt',
					'toggle' => '#tie_blog_length-item',
					'type'   => 'checkbox',
				),

				array(
					'name' => esc_html__( 'Posts Excerpt Length', HERBS_TEXTDOMAIN ),
					'id'   => 'tie_blog_length',
					'type' => 'number',
				),

				array(
					'name'    => esc_html__( 'Categories', HERBS_TEXTDOMAIN ),
					'id'      => 'tie_blog_cats',
					'type'    => 'select-multiple',
					'options' => HERBS_ADMIN_HELPER::get_categories(),
				),

				array(
					'name' => esc_html__( 'Number of posts to show', HERBS_TEXTDOMAIN ),
					'id'   => 'tie_posts_num',
					'type' => 'number',
				),

				array(
					'name'    => esc_html__( 'Pagination', HERBS_TEXTDOMAIN ),
					'id'      => 'tie_blog_pagination',
					'type'    => 'radio',
					'options' => array(
						''          => esc_html__( 'Default',           HERBS_TEXTDOMAIN ),
						'next-prev' => esc_html__( 'Next and Previous', HERBS_TEXTDOMAIN ),
						'numeric'   => esc_html__( 'Numeric',           HERBS_TEXTDOMAIN ),
						'load-more' => esc_html__( 'Load More',         HERBS_TEXTDOMAIN ),
						'infinite'  => esc_html__( 'Infinite Scroll',   HERBS_TEXTDOMAIN ),
				)),

				array(
					'content' => '</div>',
					'type'    => 'html',
				),
			);

			if( ! empty( $current_settings ) && is_array( $current_settings ) ){
				$settings = array_merge( $current_settings, $settings );
			}

			return apply_filters( 'Herbs/Settings/Post/posts_page_template/defaults', $settings );
		}


		/**
		 * Authors Templates Settings
		 */
		function authors_page_template( $current_settings ){

			// These options available in Pages only
			if( get_post_type() != 'page' ){
				return $current_settings;
			}

			// Authors options for the page templates
			$get_roles  = wp_roles();
			$user_roles = $get_roles->get_names();

			$settings = array(

				array(
					'content' => '<div id="tie-page-template-authors" class="tie-page-templates-options">',
					'type'    => 'html',
				),

				array(
					'title' => esc_html__( 'User Roles', HERBS_TEXTDOMAIN ),
					'id'    => 'tie_authors_title',
					'type'  => 'header',
				),

				array(
					'name'    => esc_html__( 'User Roles', HERBS_TEXTDOMAIN ),
					'id'      => 'tie_authors',
					'type'    => 'select-multiple',
					'options' => $user_roles,
				),

				array(
					'content' => '</div>',
					'type'    => 'html',
				),

			);

			if( ! empty( $current_settings ) && is_array( $current_settings ) ){
				$settings = array_merge( $current_settings, $settings );
			}

			return apply_filters( 'Herbs/Settings/Post/authors_page_template/defaults', $settings );
		}


		/**
		 * General Pages Settings
		 */
		function general_page_settings( $current_settings ){

			// These options available in Pages only
			if( get_post_type() != 'page' ){
				return $current_settings;
			}

			$settings = array(

				// Header and Footer Settings
				array(
					'title' => esc_html__( 'Header and Footer Settings', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'name' => esc_html__( 'Hide the Header', HERBS_TEXTDOMAIN ),
					'id'   => 'tie_hide_header',
					'type' => 'checkbox',
				),

				array(
					'name' => esc_html__( 'Hide the Footer', HERBS_TEXTDOMAIN ),
					'id'   => 'tie_hide_footer',
					'type' => 'checkbox',
				),

				// Hide Page title
				array(
					'content' => '<div id="tie_hide_page_title_option">',
					'type'    => 'html',
				),

				array(
					'title' => esc_html__( 'Hide the page title', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'name' => esc_html__( 'Hide the page title', HERBS_TEXTDOMAIN ),
					'id'   => 'tie_hide_title',
					'type' => 'checkbox',
				),

				array(
					'content' => '</div>',
					'type'    => 'html',
				),

				// Do Not Dublicate Posts
				array(
					'content' => '<div id="tie_do_not_dublicate_option">',
					'type'    => 'html',
				),

				array(
					'title' => esc_html__( 'Don\'t duplicate posts', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'name' => esc_html__( 'Don\'t duplicate posts', HERBS_TEXTDOMAIN ),
					'id'   => 'tie_do_not_dublicate',
					'type' => 'checkbox',
					'hint' => esc_html__( 'Note: This option doesn\'t work with the AJAX pagination.', HERBS_TEXTDOMAIN ),
				),

				array(
					'content' => '</div>',
					'type'    => 'html',
				),
			);

			if( ! empty( $current_settings ) && is_array( $current_settings ) ){
				$settings = array_merge( $current_settings, $settings );
			}

			return apply_filters( 'Herbs/Settings/Post/general_page/defaults', $settings );

		}


		/**
		 * General Post Settings
		 */
		function general_post_settings( $current_settings ){

			if( ! HERBS_HELPER::is_supported_post_type() ){
				return $current_settings;
			}

			$settings = array(

				array(
					'title' => esc_html__( 'Primary Category', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'name'    => esc_html__( 'Primary Category', HERBS_TEXTDOMAIN ),
					'id'      => 'tie_primary_category',
					'type'    => 'select',
					'hint'    => esc_html__( 'If the post has multiple categories, the one selected here will be used for settings and it appears in the category labels.', HERBS_TEXTDOMAIN ),
					'options' => HERBS_ADMIN_HELPER::get_categories( true ),
				),

				array(
					'title' => esc_html__( 'Trending Post', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'name' => esc_html__( 'Trending Post', HERBS_TEXTDOMAIN ),
					'id'   => 'tie_trending_post',
					'type' => 'checkbox',
				),
			);


			// Post Views
			if( tie_get_option( 'tie_post_views') == 'theme' ){

				$settings[] = array(
					'title' => esc_html__( 'Post Views', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				);

				$settings[] = array(
					'name'    => esc_html__( 'Post Views', HERBS_TEXTDOMAIN ),
					'id'      => apply_filters( 'Herbs/views_meta_field', 'tie_views' ),
					'type'    => 'number',
					'default' => tie_get_option( 'views_starter_number', 0 )
				);
			}


			if( ! empty( $current_settings ) && is_array( $current_settings ) ){
				$settings = array_merge( $current_settings, $settings );
			}

			return apply_filters( 'Herbs/Settings/Post/general/defaults', $settings );
		}


		/**
		 * Post Format Settings
		 */
		function post_format_settings( $current_settings ){

			if( ! HERBS_HELPER::is_supported_post_type() ){
				return $current_settings;
			}

			$settings = array(

				array(
					'title' => esc_html__( 'Post format', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'id'      => 'tie_post_head',
					'type'    => 'visual',
					'columns' => 6,
					'toggle'  => array(
						'standard' => '#tie_post_featured-item',
						'thumb'    => '#tie_image_uncropped-item, #tie_image_lightbox-item',
						'video'    => '#tie_embed_code-item, #tie_video_url-item, #tie_video_self-item',
						'audio'    => '#tie_audio_embed-item, #tie_audio_mp3-item, #tie_audio_m4a-item, #tie_audio_oga-item, #tie_audio_soundcloud-item, #tie_audio_soundcloud_play-item , #tie_audio_soundcloud_visual-item',
						'slider'   => '#tie_post_slider-item, #tie_post_gallery-item',
						'map'      => '#tie_googlemap_url-item, #tie_googlemap_notice-item', ),
					'options' => array(
						'standard' => array( esc_html__( 'Standard', HERBS_TEXTDOMAIN ) => 'formats/format-standard.png' ),
						'thumb'    => array( esc_html__( 'Image',    HERBS_TEXTDOMAIN ) => 'formats/format-img.png' ),
						'video'    => array( esc_html__( 'Video',    HERBS_TEXTDOMAIN ) => 'formats/format-video.png' ),
						'audio'    => array( esc_html__( 'Audio',    HERBS_TEXTDOMAIN ) => 'formats/format-audio.png' ),
						'slider'   => array( esc_html__( 'Slider',   HERBS_TEXTDOMAIN ) => 'formats/format-slider.png' ),
						'map'      => array( esc_html__( 'Map',      HERBS_TEXTDOMAIN ) => 'formats/format-map.png' ),
				)),

				// Standard
				array(
					'name'    => esc_html__( 'Show the featured image', HERBS_TEXTDOMAIN ),
					'id'      => 'tie_post_featured',
					'type'    => 'select',
					'class'   => 'tie_post_head',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Yes',     HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'No',      HERBS_TEXTDOMAIN ),
				)),

				// Image
				array(
					'name'    => esc_html__( 'Uncropped featured image', HERBS_TEXTDOMAIN ),
					'id'      => 'tie_image_uncropped',
					'type'    => 'select',
					'class'   => 'tie_post_head',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Yes',     HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'No',      HERBS_TEXTDOMAIN ),
				)),

				array(
					'name'    => esc_html__( 'Featured image lightbox', HERBS_TEXTDOMAIN ),
					'id'      => 'tie_image_lightbox',
					'type'    => 'select',
					'class'   => 'tie_post_head',
					'options' => array(
							''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
							'yes' => esc_html__( 'Yes',     HERBS_TEXTDOMAIN ),
							'no'  => esc_html__( 'No',      HERBS_TEXTDOMAIN ),
				)),

				// Video
				array(
					'name'  => esc_html__( 'Embed Code', HERBS_TEXTDOMAIN ),
					'id'    => 'tie_embed_code',
					'type'  => 'textarea',
					'class' => 'tie_post_head',
				),

				array(
					'name'     => esc_html__( 'Self Hosted Video', HERBS_TEXTDOMAIN ),
					'id'       => 'tie_video_self',
					'pre_text' => esc_html__( '- OR -', HERBS_TEXTDOMAIN ),
					'type'     => 'text',
					'class'    => 'tie_post_head',
				),

				array(
					'name'     => esc_html__( 'Video URL', HERBS_TEXTDOMAIN ),
					'id'       => 'tie_video_url',
					'pre_text' => esc_html__( '- OR -', HERBS_TEXTDOMAIN ),
					'type'     => 'text',
					'hint'     => esc_html__( 'supports : YouTube, Vimeo, Viddler, Qik, Hulu, FunnyOrDie, DailyMotion, WordPress.tv and blip.tv', HERBS_TEXTDOMAIN ),
					'class'    => 'tie_post_head',
				),

				// Audio
				array(
					'name'  => esc_html__( 'Embed Code', HERBS_TEXTDOMAIN ),
					'id'    => 'tie_audio_embed',
					'type'  => 'textarea',
					'class' => 'tie_post_head',
				),

				array(
					'name'     => esc_html__( 'MP3 file URL', HERBS_TEXTDOMAIN ),
					'id'       => 'tie_audio_mp3',
					'pre_text' => esc_html__( '- OR -', HERBS_TEXTDOMAIN ),
					'type'     => 'text',
					'class'    => 'tie_post_head',
				),

				array(
					'name'  => esc_html__( 'M4A file URL', HERBS_TEXTDOMAIN ),
					'id'    => 'tie_audio_m4a',
					'type'  => 'text',
					'class' => 'tie_post_head',
				),

				array(
					'name'  => esc_html__( 'OGA file URL', HERBS_TEXTDOMAIN ),
					'id'    => 'tie_audio_oga',
					'type'  => 'text',
					'class' => 'tie_post_head',
				),

				array(
					'name'     => esc_html__( 'SoundCloud URL', HERBS_TEXTDOMAIN ),
					'id'       => 'tie_audio_soundcloud',
					'pre_text' => esc_html__( '- OR -', HERBS_TEXTDOMAIN ),
					'type'     => 'text',
					'class'    => 'tie_post_head',
				),

				// Slider
				array(
					'id'    => 'tie_post_gallery',
					'type'  => 'gallery',
					'class' => 'tie_post_head',
				),

				array(
					'name'     => esc_html__( 'Custom Slider', HERBS_TEXTDOMAIN ),
					'id'       => 'tie_post_slider',
					'type'     => 'select',
					'pre_text' => esc_html__( '- OR -', HERBS_TEXTDOMAIN ),
					'class'    => 'tie_post_head',
					'options'  => HERBS_ADMIN_HELPER::get_sliders( true ),
				),
			);

			// Maps
			if( ! tie_get_option( 'api_google_maps' ) ){
				$settings[] = array(
					'id'    => 'tie_googlemap_notice',
					'type'  => 'error',
					'class' => 'tie_post_head',
					'text' => esc_html__( 'You need to set the Google Map API Key in the theme options page > API Keys.', HERBS_TEXTDOMAIN ),
				);
			}

			$settings[] = array(
				'name'  => esc_html__( 'Google Maps URL', HERBS_TEXTDOMAIN ),
				'id'    => 'tie_googlemap_url',
				'type'  => 'text',
				'class' => 'tie_post_head',
			);


			if( ! empty( $current_settings ) && is_array( $current_settings ) ){
				$settings = array_merge( $current_settings, $settings );
			}

			return apply_filters( 'Herbs/Settings/Post/formats/defaults', $settings );
		}


		/**
		 * Post Layout Settings
		 */
		function layout_settings( $current_settings ){

			// General Layout
			$settings = array(

				array(
					'title' => esc_html__( 'Page Layout', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'id'      => 'tie_theme_layout',
					'type'    => 'visual',
					'columns' => 5,
					'options' => array(
						''       => array( esc_html__( 'Default',    HERBS_TEXTDOMAIN ) => 'default.png' ),
						'full'   => array( esc_html__( 'Full-Width', HERBS_TEXTDOMAIN ) => 'layouts/layout-full.png'   ),
						'boxed'  => array( esc_html__( 'Boxed',      HERBS_TEXTDOMAIN ) => 'layouts/layout-boxed.png'  ),
						'framed' => array( esc_html__( 'Framed',     HERBS_TEXTDOMAIN ) => 'layouts/layout-framed.png' ),
						'border' => array( esc_html__( 'Bordered',   HERBS_TEXTDOMAIN ) => 'layouts/layout-border.png' ),
				)),
			);


			// Post layout
			if( HERBS_HELPER::is_supported_post_type() ){

				$settings[] =	array(
					'title' => esc_html__( 'Post Layout', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				);

				$settings[] =	array(
					'id'      => 'tie_post_layout',
					'type'    => 'visual',
					'toggle'  => array(
						'' => '',
						'4' => '#tie_featured_bg_title, #tie_featured_use_fea-item, #tie_featured_custom_bg-item',
						'5' => '#tie_featured_bg_title, #tie_featured_use_fea-item, #tie_featured_custom_bg-item',
						'8' => '#tie_featured_bg_title, #tie_featured_use_fea-item, #tie_featured_custom_bg-item, #tie_featured_bg_color-item',),
					'options' => array(
						''  => array( esc_html__( 'Default', HERBS_TEXTDOMAIN )       => 'default.png' ),
						'1' => array( esc_html__( 'Layout',  HERBS_TEXTDOMAIN ).' #1' => 'post-layouts/1.png' ),
						'2' => array( esc_html__( 'Layout',  HERBS_TEXTDOMAIN ).' #2' => 'post-layouts/2.png' ),
						'3' => array( esc_html__( 'Layout',  HERBS_TEXTDOMAIN ).' #3' => 'post-layouts/3.png' ),
						'4' => array( esc_html__( 'Layout',  HERBS_TEXTDOMAIN ).' #4' => 'post-layouts/4.png' ),
						'5' => array( esc_html__( 'Layout',  HERBS_TEXTDOMAIN ).' #5' => 'post-layouts/5.png' ),
						'6' => array( esc_html__( 'Layout',  HERBS_TEXTDOMAIN ).' #6' => 'post-layouts/6.png' ),
						'7' => array( esc_html__( 'Layout',  HERBS_TEXTDOMAIN ).' #7' => 'post-layouts/7.png' ),
						'8' => array( esc_html__( 'Layout',  HERBS_TEXTDOMAIN ).' #8' => 'post-layouts/8.png' ),
				));

				$settings[] =	array(
					'title' => esc_html__( 'Featured area background', HERBS_TEXTDOMAIN ),
					'id'    => 'tie_featured_bg_title',
					'type'  => 'header',
					'class' => 'tie_post_layout',
				);

				$settings[] =	array(
					'name'  => esc_html__( 'Use the featured image', HERBS_TEXTDOMAIN ),
					'id'    => 'tie_featured_use_fea',
					'type'  => 'select',
					'class' => 'tie_post_layout',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Yes',     HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'No',      HERBS_TEXTDOMAIN ),
					));

				$settings[] =	array(
					'name'     => esc_html__( 'Upload Custom Image', HERBS_TEXTDOMAIN ),
					'id'       => 'tie_featured_custom_bg',
					'type'     => 'upload',
					'pre_text' => esc_html__( '- OR -', HERBS_TEXTDOMAIN ),
					'class'    => 'tie_post_layout',
				);

				$settings[] =	array(
					'name'  => esc_html__( 'Background Color', HERBS_TEXTDOMAIN ),
					'id'    => 'tie_featured_bg_color',
					'type'  => 'color',
					'class' => 'tie_post_layout',
				);

			} // post if



			if( ! empty( $current_settings ) && is_array( $current_settings ) ){
				$settings = array_merge( $current_settings, $settings );
			}

			return apply_filters( 'Herbs/Settings/Post/layout/defaults', $settings );
		}


		/**
		 * Post Logo Settings
		 */
		function logo_settings( $current_settings ){

			$settings = array(

				array(
					'title' => esc_html__( 'Custom Logo', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'name'   => esc_html__( 'Custom Logo', HERBS_TEXTDOMAIN ),
					'id'     => 'custom_logo',
					'toggle' => '#tie-post-logo-item',
					'type'   => 'checkbox',
				),

				array(
					'content' => '<div id="tie-post-logo-item">',
					'type'    => 'html',
				),

				array(
					'name'    => esc_html__( 'Logo Settings', HERBS_TEXTDOMAIN ),
					'id'      => 'logo_setting',
					'type'    => 'radio',
					'toggle'  => array(
						'logo'  => '#logo-item, #logo_retina-item, #logo_retina_width-item, #logo_retina_height-item',
						'title' => ''),
					'options'	=> array(
						'logo'  => esc_html__( 'Image',      HERBS_TEXTDOMAIN ),
						'title' => esc_html__( 'Site Title', HERBS_TEXTDOMAIN ),
				)),

				array(
					'name'  => esc_html__( 'Logo Image', HERBS_TEXTDOMAIN ),
					'id'    => 'logo',
					'type'  => 'upload',
					'class' => 'logo_setting',
				),

				array(
					'name'  => esc_html__( 'Logo Image (Retina Version @2x)', HERBS_TEXTDOMAIN ),
					'id'    => 'logo_retina',
					'type'  => 'upload',
					'class' => 'logo_setting',
					'hint'	=> esc_html__( 'Please choose an image file for the retina version of the logo. It should be 2x the size of main logo.', HERBS_TEXTDOMAIN ),
				),

				array(
					'name'  => esc_html__( 'Standard Logo Width for Retina Logo', HERBS_TEXTDOMAIN ),
					'id'    => 'logo_retina_width',
					'type'  => 'number',
					'class' => 'logo_setting',
					'hint'  => esc_html__( 'If retina logo is uploaded, please enter the standard logo (1x) version width, do not enter the retina logo width.', HERBS_TEXTDOMAIN ),
				),

				array(
					'name'  => esc_html__( 'Standard Logo Height for Retina Logo', HERBS_TEXTDOMAIN ),
					'id'    => 'logo_retina_height',
					'type'  => 'number',
					'class' => 'logo_setting',
					'hint'  => esc_html__( 'If retina logo is uploaded, please enter the standard logo (1x) version height, do not enter the retina logo height.', HERBS_TEXTDOMAIN ),
				),

				array(
					'name'  => esc_html__( 'Logo Text', HERBS_TEXTDOMAIN ),
					'id'    => 'logo_text',
					'type'  => 'text',
					'hint'  => esc_html__( 'In the Logo Image type this will be used as the ALT text.', HERBS_TEXTDOMAIN ),
				),

				array(
					'name' => esc_html__( 'Logo Margin Top', HERBS_TEXTDOMAIN ),
					'id'   => 'logo_margin',
					'type' => 'number',
					'hint' => esc_html__( 'Leave it empty to use the default value.', HERBS_TEXTDOMAIN ),
				),

				array(
					'name' => esc_html__( 'Logo Margin Bottom', HERBS_TEXTDOMAIN ),
					'id'   => 'logo_margin_bottom',
					'type' => 'number',
					'hint' => esc_html__( 'Leave it empty to use the default value.', HERBS_TEXTDOMAIN ),
				),

				array(
					'name'  => esc_html__( 'Custom Logo URL', HERBS_TEXTDOMAIN ),
					'id'    => 'logo_url',
					'type'  => 'text',
					'hint'  => esc_html__( 'Leave it empty to use the Site URL.', HERBS_TEXTDOMAIN ),
				),

				array(
					'content' => '</div>',
					'type'    => 'html',
				),
			);



			if( ! empty( $current_settings ) && is_array( $current_settings ) ){
				$settings = array_merge( $current_settings, $settings );
			}

			return apply_filters( 'Herbs/Settings/Post/logo/defaults', $settings );
		}


		/**
		 * Post Logo Settings
		 */
		function sidebar_settings( $current_settings ){

			$settings = array(

				array(
					'title' => esc_html__( 'Sidebar Position', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'id'      => 'tie_sidebar_pos',
					'type'    => 'visual',
					'columns' => 5,
					'options' => array(
						''           => array( esc_html__( 'Default',         HERBS_TEXTDOMAIN ) => 'default.png' ),
						'right'	     => array( esc_html__( 'Sidebar Right',   HERBS_TEXTDOMAIN ) => 'sidebars/sidebar-right.png' ),
						'left'	     => array( esc_html__( 'Sidebar Left',    HERBS_TEXTDOMAIN ) => 'sidebars/sidebar-left.png' ),
						'full'	     => array( esc_html__( 'Without Sidebar', HERBS_TEXTDOMAIN ) => 'sidebars/sidebar-full-width.png' ),
						'one-column' => array( esc_html__( 'One Column',      HERBS_TEXTDOMAIN ) => 'sidebars/sidebar-one-column.png' ),
				)),

				array(
					'name'   => esc_html__( 'Sticky Sidebar', HERBS_TEXTDOMAIN ),
					'id'     => 'tie_sticky_sidebar',
					'type'   => 'select',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Yes',     HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'No',      HERBS_TEXTDOMAIN ),
				)),

				array(
					'title' => esc_html__( 'Custom Sidebar', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'name'    => esc_html__( 'Choose Sidebar', HERBS_TEXTDOMAIN ),
					'id'      => 'tie_sidebar_post',
					'type'    => 'select',
					'options' => HERBS_ADMIN_HELPER::get_sidebars(),
				),
			);


			if( ! empty( $current_settings ) && is_array( $current_settings ) ){
				$settings = array_merge( $current_settings, $settings );
			}

			return apply_filters( 'Herbs/Settings/Post/sidebar/defaults', $settings );
		}


		/**
		 * Post Styles Settings
		 */
		function styles_settings( $current_settings ){

			$settings = array(

				array(
					'content' => '<div id="tie_header_extend_bg_option">',
					'type'    => 'html',
				),

				array(
					'title' => esc_html__( 'Header Background', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'name' => esc_html__( 'Extend the background of the first section to cover the Header', HERBS_TEXTDOMAIN ),
					'id'   => 'tie_header_extend_bg',
					'type' => 'checkbox',
				),

				array(
					'content' => '</div>',
					'type'    => 'html',
				),

				array(
					'title' => esc_html__( 'Primary Color', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'name' => esc_html__( 'Primary Color', HERBS_TEXTDOMAIN ),
					'id'   => 'post_color',
					'type' => 'color',
				),

				array(
					'title' =>	esc_html__( 'Background', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'text'  => esc_html__( 'Bordered Layout supports plain background color only.', HERBS_TEXTDOMAIN ),
					'type'  => 'message',
				),

				array(
					'name'  => esc_html__( 'Background Color', HERBS_TEXTDOMAIN ),
					'id'    => 'background_color',
					'type'  => 'color',
				),

				array(
					'name'  => esc_html__( 'Background Color 2', HERBS_TEXTDOMAIN ),
					'id'    => 'background_color_2',
					'type'  => 'color',
				),

				array(
					'name'   => esc_html__( 'Background Image type', HERBS_TEXTDOMAIN ),
					'id'     => 'background_type',
					'type'   => 'radio',
					'toggle' => array(
						''        => '',
						'pattern' => '#background_pattern-item',
						'image'   => '#background_image-item',),
					'options' => array(
						''        => esc_html__( 'None',    HERBS_TEXTDOMAIN ),
						'pattern' => esc_html__( 'Pattern', HERBS_TEXTDOMAIN ),
						'image'   => esc_html__( 'Image',   HERBS_TEXTDOMAIN ),
				)),

				array(
					'name'    => esc_html__( 'Background Pattern', HERBS_TEXTDOMAIN ),
					'id'      => 'background_pattern',
					'type'    => 'visual',
					'class'   => 'background_type',
					'options' => HERBS_ADMIN_HELPER::get_patterns(),
				),

				array(
					'name'  => esc_html__( 'Background Image', HERBS_TEXTDOMAIN ),
					'id'    => 'background_image',
					'class' => 'background_type',
					'type'  => 'background',
				),

				array(
					'type'  => 'header',
					'title' => esc_html__( 'Background Settings', HERBS_TEXTDOMAIN ),
				),

				array(
					'name' => esc_html__( 'Dots overlay layer', HERBS_TEXTDOMAIN ),
					'id'   => 'background_dots',
					'type' => 'checkbox',
				),

				array(
					'name'   => esc_html__( 'Background dimmer', HERBS_TEXTDOMAIN ),
					'id'     => 'background_dimmer',
					'toggle' => '#background_dimmer_value-item, #background_dimmer_color-item',
					'type'   => 'checkbox',
				),

				array(
					'name' => esc_html__( 'Background dimmer', HERBS_TEXTDOMAIN ),
					'id'   => 'background_dimmer_value',
					'hint' => esc_html__( 'Value between 0 and 100 to dim background image. 0 - no dim, 100 - maximum dim.', HERBS_TEXTDOMAIN ),
					'type' => 'number',
				),

				array(
					'name'    => esc_html__( 'Background dimmer color', HERBS_TEXTDOMAIN ),
					'id'      => 'background_dimmer_color',
					'type'    => 'radio',
					'options'	=> array(
						'black' => esc_html__( 'Black', HERBS_TEXTDOMAIN ),
						'white' => esc_html__( 'White', HERBS_TEXTDOMAIN ),
				)),

				array(
					'title' =>	esc_html__( 'Custom CSS', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'text' => esc_html__( 'Paste your CSS code, do not include any tags or HTML in the field. Any custom CSS entered here will override the theme CSS. In some cases, the !important tag may be needed.', HERBS_TEXTDOMAIN ),
					'type' => 'message',
				),

				array(
					'name'  => esc_html__( 'Custom CSS', HERBS_TEXTDOMAIN ),
					'id'    => 'tie_custom_css',
					'class' => 'tie-css',
					'type'  => 'textarea',
					'hint'  => sprintf( esc_html__( 'Use %s and it will be replaced with the primary color.', HERBS_TEXTDOMAIN ), '<code>primary-color</code>' ),
				),
			);


			if( ! empty( $current_settings ) && is_array( $current_settings ) ){
				$settings = array_merge( $current_settings, $settings );
			}

			return apply_filters( 'Herbs/Settings/Post/styles/defaults', $settings );
		}


		/**
		 * Post Menu Settings
		 */
		function menu_settings( $current_settings ){

			$settings = array(

				array(
					'title' => esc_html__( 'Custom Menu', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'name'    => esc_html__( 'Custom Menu', HERBS_TEXTDOMAIN ),
					'id'      => 'tie_menu',
					'type'    => 'select',
					'options' => HERBS_ADMIN_HELPER::get_menus( true ),
				),
			);


			if( ! empty( $current_settings ) && is_array( $current_settings ) ){
				$settings = array_merge( $current_settings, $settings );
			}

			return apply_filters( 'Herbs/Settings/Post/components/defaults', $settings );
		}


		/**
		 * General Components Settings
		 */
		function components_settings( $current_settings ){

			$settings = array(

				array(
					'title' => esc_html__( 'Post Components', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'name'	  => esc_html__( 'Above Post share Buttons', HERBS_TEXTDOMAIN ),
					'id'		  => 'tie_hide_share_top',
					'type'	  => 'select',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Hide',    HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'Show',    HERBS_TEXTDOMAIN ),
				)),

				array(
					'name'	  => esc_html__( 'Below Post Share Buttons', HERBS_TEXTDOMAIN ),
					'id'		  => 'tie_hide_share_bottom',
					'type'	  => 'select',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Hide',    HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'Show',    HERBS_TEXTDOMAIN ),
				)),

			);


			if( ! empty( $current_settings ) && is_array( $current_settings ) ){
				$settings = array_merge( $current_settings, $settings );
			}

			return apply_filters( 'Herbs/Settings/Post/menu/defaults', $settings );
		}


		/**
		 * Post Components Settings
		 */
		function post_components_settings( $current_settings ){

			if( ! HERBS_HELPER::is_supported_post_type() ){
				return $current_settings;
			}

			$settings = array(

				array(
					'name'    => esc_html__( 'Categories', HERBS_TEXTDOMAIN ),
					'id'      => 'tie_hide_categories',
					'type'    => 'select',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Hide',    HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'Show',    HERBS_TEXTDOMAIN ),
				)),

				array(
					'name'    => esc_html__( 'Tags', HERBS_TEXTDOMAIN ),
					'id'      => 'tie_hide_tags',
					'type'    => 'select',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Hide',    HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'Show',    HERBS_TEXTDOMAIN ),
				)),

				array(
					'name'    => esc_html__( 'Post Meta', HERBS_TEXTDOMAIN ),
					'id'      => 'tie_hide_meta',
					'type'    => 'select',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Hide',    HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'Show',    HERBS_TEXTDOMAIN ),
				)),

				array(
					'name'    => esc_html__( 'Post Author box', HERBS_TEXTDOMAIN ),
					'id'      => 'tie_hide_author',
					'type'    => 'select',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Hide',    HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'Show',    HERBS_TEXTDOMAIN ),
				)),

				array(
					'name'	  => esc_html__( 'Next/Prev posts', HERBS_TEXTDOMAIN ),
					'id'		  => 'tie_hide_nav',
					'type'	  => 'select',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Hide',    HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'Show',    HERBS_TEXTDOMAIN ),
				)),

				array(
					'name'    => esc_html__( 'Newsletter', HERBS_TEXTDOMAIN ),
					'id'      => 'tie_hide_newsletter',
					'type'    => 'select',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Hide',    HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'Show',    HERBS_TEXTDOMAIN ),
				)),

				array(
					'name'    => esc_html__( 'Related Posts', HERBS_TEXTDOMAIN ),
					'id'      => 'tie_hide_related',
					'type'    => 'select',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Hide',    HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'Show',    HERBS_TEXTDOMAIN ),
				)),

				array(
					'name'    => esc_html__( 'Read Next Slider', HERBS_TEXTDOMAIN ),
					'id'      => 'tie_hide_read_next',
					'type'    => 'select',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Hide',    HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'Show',    HERBS_TEXTDOMAIN ),
				)),

				array(
					'name'    => esc_html__( 'Fly Check Also Box', HERBS_TEXTDOMAIN ),
					'id'      => 'tie_hide_check_also',
					'type'    => 'select',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Hide',    HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'Show',    HERBS_TEXTDOMAIN ),
				)),

			);


			if( ! empty( $current_settings ) && is_array( $current_settings ) ){
				$settings = array_merge( $current_settings, $settings );
			}

			return apply_filters( 'Herbs/Settings/Post/post_components/defaults', $settings );
		}


		/**
		 * Post Ads Settings
		 */
		function e3lan_settings( $current_settings ){

			$settings = array(

				array(
					'title' => esc_html__( 'Advertisement', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'name' => esc_html__( 'Hide Above Post Ad', HERBS_TEXTDOMAIN ),
					'id'   => 'tie_hide_above',
					'type' => 'checkbox',
				),

				array(
					'name' => esc_html__( 'Custom Above Post Ad', HERBS_TEXTDOMAIN ),
					'id'   => 'tie_get_banner_above',
					'type' => 'textarea',
				),

				array(
					'name' => esc_html__( 'Hide Below Post Ad', HERBS_TEXTDOMAIN ),
					'id'   => 'tie_hide_below',
					'type' => 'checkbox',
				),

				array(
					'name' => esc_html__( 'Custom Below Post Ad', HERBS_TEXTDOMAIN ),
					'id'   => 'tie_get_banner_below',
					'type' => 'textarea',
				),

				array(
					'name' => esc_html__( 'Hide Above Content Ad', HERBS_TEXTDOMAIN ),
					'id'   => 'tie_hide_above_content',
					'type' => 'checkbox',
				),

				array(
					'name' => esc_html__( 'Custom Above Content Ad', HERBS_TEXTDOMAIN ),
					'id'   => 'tie_get_banner_above_content',
					'type' => 'textarea',
				),

				array(
					'name' => esc_html__( 'Hide Below Content Ad', HERBS_TEXTDOMAIN ),
					'id'   => 'tie_hide_below_content',
					'type' => 'checkbox',
				),

				array(
					'name' => esc_html__( 'Custom Below Content Ad', HERBS_TEXTDOMAIN ),
					'id'   => 'tie_get_banner_below_content',
					'type' => 'textarea',
				),
			);


			if( ! empty( $current_settings ) && is_array( $current_settings ) ){
				$settings = array_merge( $current_settings, $settings );
			}

			return apply_filters( 'Herbs/Settings/Post/e3lan/defaults', $settings );
		}


		/**
		 * Source Settings
		 */
		function source_settings(){

			$this->build_option(
				array(
					'title' => esc_html__( 'Source', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
			));

			?>

			<div class="option-item source-via-options">

				<p><?php esc_html_e( 'These links will appear at the end of the article in the Source section.', HERBS_TEXTDOMAIN ) ?></p>

				<input id="source_name" type="text" size="56" name="source_name" placeholder="<?php esc_html_e( 'Source', HERBS_TEXTDOMAIN ) ?>" value="" />
				<input id="source_link" type="text" size="56" name="source_link" placeholder="<?php esc_html_e( 'Link', HERBS_TEXTDOMAIN ) ?>" value="" />
				<input id="add_source_button"  class="button" type="button" value="<?php esc_html_e( 'Add', HERBS_TEXTDOMAIN ) ?>" />

				<?php
					$this->build_option(
						array(
							'text' => esc_html__( 'Source name is required.', HERBS_TEXTDOMAIN ),
							'id'   => 'add-source-error',
							'type' => 'error',
						));
				?>

				<div class="clear"></div>
				<ul id="sources-list">
					<?php

						$sources = tie_get_postdata( 'tie_source' );
						$sources_count = 0;

						if( ! empty( $sources ) && is_array( $sources )){

							foreach ( $sources as $single_source ){

								$sources_count++; ?>

								<li class="parent-item">
									<div class="tie-block-head">

										<?php
											if( ! empty( $single_source['url'] ) ){ ?>
												<a href="<?php echo esc_url( $single_source['url'] ) ?>" target="_blank"><?php echo esc_html( $single_source['text'] ) ?></a>
												<input name="tie_source[<?php echo esc_attr( $sources_count ) ?>][url]"  type="hidden" value="<?php echo esc_attr( $single_source['url']  ) ?>" />
												<?php
											}
											else{
												echo esc_html( $single_source['text'] );
											}
										?>

										<input name="tie_source[<?php echo esc_attr( $sources_count ) ?>][text]" type="hidden" value="<?php echo esc_attr( $single_source['text'] ) ?>" />
										<a class="del-item dashicons dashicons-trash"></a>
									</div>
								</li>
								<?php
							}
						}
					?>
				</ul>

				<script>
					var source_next = <?php echo esc_js( $sources_count+1 ); ?>;

					jQuery(function(){
						jQuery( '#sources-list' ).sortable({placeholder: 'tie-state-highlight'});
					});
				</script>
			</div>
			<?php
		}


		/**
		 * Via Settings
		 */
		function via_settings(){

			$this->build_option(
				array(
					'title' => esc_html__( 'Via', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				));
			?>

			<div class="option-item source-via-options">

				<p><?php esc_html_e( 'These links will appear at the end of the article in the Via section.', HERBS_TEXTDOMAIN ) ?></p>

				<input id="via_name" type="text" size="56" name="via_name" placeholder="<?php esc_html_e( 'Via', HERBS_TEXTDOMAIN ) ?>" value="" />
				<input id="via_link" type="text" size="56" name="via_link" placeholder="<?php esc_html_e( 'Link', HERBS_TEXTDOMAIN ) ?>" value="" />
				<input id="add_via_button"  class="button" type="button" value="<?php esc_html_e( 'Add', HERBS_TEXTDOMAIN ) ?>" />

				<?php
					$this->build_option(
						array(
							'text' => esc_html__( 'Via name is required.', HERBS_TEXTDOMAIN ),
							'id'   => 'add-via-error',
							'type' => 'error',
					));
				?>

				<div class="clear"></div>
				<ul id="via-list">
					<?php

						$via = tie_get_postdata( 'tie_via' );
						$via_count = 0;

						if( ! empty( $via ) && is_array( $via )){
							foreach ( $via as $single_via ){
								$via_count++; ?>

								<li class="parent-item">
									<div class="tie-block-head">

										<?php
											if( ! empty( $single_via['url'] ) ){ ?>
												<a href="<?php echo esc_url( $single_via['url'] ) ?>" target="_blank"><?php echo esc_html( $single_via['text'] ) ?></a>
												<input name="tie_via[<?php echo esc_attr( $via_count ) ?>][url]"  type="hidden" value="<?php echo esc_attr( $single_via['url']  ) ?>" />
												<?php
											}
											else{
												echo esc_html( $single_via['text'] );
											}
										?>

										<input name="tie_via[<?php echo esc_attr( $via_count ) ?>][text]" type="hidden" value="<?php echo esc_attr( $single_via['text'] ) ?>" />
										<a class="del-item dashicons dashicons-trash"></a>
									</div>
								</li>
								<?php
							}
						}
					?>
				</ul>

				<script>
					var via_next = <?php echo esc_js( $via_count+1 ); ?>;

					jQuery(function(){
						jQuery( '#via-list' ).sortable({placeholder: 'tie-state-highlight'});
					});
				</script>
			</div>
			<?php
		}


		/**
		 * Highlights Settings
		 */
		function highlights_settings(){

			$this->build_option(
				array(
					'title' => esc_html__( 'Story Highlights', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
			));
			?>

			<div class="option-item breaking_type-options" id="breaking_custom-item">

				<span class="tie-label"><?php esc_html_e( 'Add Custom Text', HERBS_TEXTDOMAIN ) ?></span>
				<input id="custom_text" type="text" size="56" name="custom_text" placeholder="<?php esc_html_e( 'Custom Text', HERBS_TEXTDOMAIN ) ?>" value="" />
				<input id="add_highlights_button"  class="button" type="button" value="<?php esc_html_e( 'Add', HERBS_TEXTDOMAIN ) ?>" />

				<?php
					$this->build_option(
						array(
							'text' => esc_html__( 'Text is required.', HERBS_TEXTDOMAIN ),
							'id'   => 'highlights_custom_error',
							'type' => 'error',
					));
				?>

				<script>
					jQuery(function(){
						jQuery( "#customList" ).sortable({placeholder: "tie-state-highlight"});
					});
				</script>

				<div class="clear"></div>
				<ul id="customList">
					<?php
						$highlights_text = tie_get_postdata( 'tie_highlights_text' );
						$custom_count    = 0;

						if( ! empty( $highlights_text ) && is_array( $highlights_text )){
							foreach ( $highlights_text as $custom_text ){
								$custom_count++; ?>

								<li class="parent-item">
									<div class="tie-block-head">
										<?php echo esc_html( $custom_text ) ?>
										<input name="tie_highlights_text[<?php echo esc_attr( $custom_count ) ?>]" type="hidden" value="<?php echo esc_attr( $custom_text ) ?>" />
										<a class="del-item dashicons dashicons-trash"></a>
									</div>
								</li>
								<?php
							}
						}
					?>
				</ul>

				<script>
					var customnext = <?php echo esc_js( $custom_count+1 ); ?>;
				</script>

			</div><!-- #breaking_custom-item /-->

			<?php
		}

	}

	$HERBS_SETTINGS_POST = new HERBS_SETTINGS_POST();
}
