<?php
/**
 * Category Settings Class
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly



if( ! class_exists( 'HERBS_SETTINGS_CATEGORY' )){

	class HERBS_SETTINGS_CATEGORY{


		/**
		 * __construct
		 *
		 * Class constructor where we will call our filter and action hooks.
		 */
		function __construct(){

			add_action( 'edited_category',           array( $this, 'save' ) );
			add_action( 'edit_category_form_fields', array( $this, 'custom_options' ) );

			// Category Settings
			add_filter( 'Herbs/Settings/Category/category-layout', array( $this, 'category_layout_settings' ), 10, 2 );
			add_filter( 'Herbs/Settings/Category/posts-settings',  array( $this, 'posts_layout_settings' ),    10, 2 );
			add_filter( 'Herbs/Settings/Category/slider',          array( $this, 'slider_settings' ),          10, 2 );
			add_filter( 'Herbs/Settings/Category/logo',            array( $this, 'logo_settings' ),            10, 2 );
			add_filter( 'Herbs/Settings/Category/menu',            array( $this, 'menu_settings' ),            10, 2 );
			add_filter( 'Herbs/Settings/Category/sidebar',         array( $this, 'sidebar_settings'),          10, 2 );
			add_filter( 'Herbs/Settings/Category/styles',          array( $this, 'styles_settings' ),          10, 2 );
		}


		/**
		 * Build The Category Option
		 */
		function build_option( $option, $category_id ){

			$id   = ! empty( $option['id'] ) ? $option['id'] : '';
			$data = tie_get_category_option( $id, $category_id );

			tie_build_option( $option, 'tie_cat['. $id .']', $data );
		}


		/**
		 * Save Category Options
		 */
		function save( $category_id ){

			if( empty( $_POST['tie_cat'] ) ){
				return;
			}

			$tie_cats_options = get_option( 'tie_cats_options' );
			$category_data    = apply_filters( 'Herbs/save_category', $_POST['tie_cat'] );

			$tie_cats_options[ $category_id ] = $category_data;
			update_option( 'tie_cats_options', $tie_cats_options, 'yes' );
		}


		/**
		 * Category Custom Options
		 */
		function custom_options( $category ){

			wp_enqueue_media();
			wp_enqueue_script( 'wp-color-picker' );
			?>

			<tr class="form-field">
				<td colspan="2">

					<?php

					$settings_tabs = apply_filters( 'Herbs/Settings/Category', array(

						'category-layout' => array(
							'icon'  => 'admin-settings',
							'title' => esc_html__( 'Category Layout', HERBS_TEXTDOMAIN ),
						),

						'posts-settings' => array(
							'icon'	=> 'schedule',
							'title'	=> esc_html__( 'Posts Settings', HERBS_TEXTDOMAIN ),
						),

						'slider' => array(
							'icon'	=> 'format-gallery',
							'title'	=> esc_html__( 'Slider', HERBS_TEXTDOMAIN ),
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
							'title' => esc_html__( 'Styling', HERBS_TEXTDOMAIN ),
						),

						'menu' => array(
							'icon'  => 'menu',
							'title' => esc_html__( 'Main Menu', HERBS_TEXTDOMAIN ),
						),
					));

					?>

					<div id="poststuff">
						<div id="tie_post_options" class="postbox ">
							<h2 class="hndle ui-sortable-handle"><span><?php echo apply_filters( 'Herbs/theme_name', 'Herbs' ) .' - '. esc_html__( 'Category Options', HERBS_TEXTDOMAIN ) ?></span></h2>
							<div class="inside">
								<div class="tie-panel">
									<div class="tie-panel-tabs">
										<ul>
											<?php
												foreach( $settings_tabs as $tab => $settings ){

													$icon  = $settings['icon'];
													$title = $settings['title'];
													?>

													<li class="tie-tabs tie-options-tab-<?php echo $tab ?>">
														<a href="#tie-options-tab-<?php echo $tab ?>">
															<span class="dashicons-before dashicons-<?php echo $icon ?> tie-icon-menu"></span>
															<?php echo $title; ?>
														</a>
													</li>

													<?php
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

														do_action( 'Herbs/Settings/Category/before_'.$tab );

														$tab_options = apply_filters( 'Herbs/Settings/Category/'.$tab, array(), $category->term_id );

														if( ! empty( $tab_options ) && is_array( $tab_options ) ){
															foreach ( $tab_options as $option ){
																$this->build_option( $option, $category->term_id );
															}
														}

														do_action( 'Herbs/Settings/Category/after_'.$tab );
													?>
												</div>

												<?php
											}
										?>
									</div><!-- .tie-panel-content -->

									<div class="clear"></div>
								</div><!-- .tie-panel -->
							</div><!-- .inside /-->
						</div><!-- #tie_post_options /-->
					</div><!-- #poststuff /-->

				</td>
			</tr>
			<?php
		}


		/**
		 * Category Layout Settings
		 */
		function category_layout_settings( $current_settings, $category_id ){

			$settings = array(

				array(
					'title' => esc_html__( 'Category Layout', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'id'      => 'category_layout',
					'type'    => 'visual',
					'options' => array(
						''               => array( esc_html__( 'Default', HERBS_TEXTDOMAIN )          => 'default.png' ),
						'excerpt'        => array( esc_html__( 'Classic', HERBS_TEXTDOMAIN )          => 'archives/blog.png' ),
						'full_thumb'     => array( esc_html__( 'Large Thumbnail', HERBS_TEXTDOMAIN )  => 'archives/full-thumb.png' ),
						'content'        => array( esc_html__( 'Content', HERBS_TEXTDOMAIN )          => 'archives/content.png' ),
						'timeline'       => array( esc_html__( 'Timeline', HERBS_TEXTDOMAIN )         => 'archives/timeline.png' ),
						'masonry'        => array( esc_html__( 'Masonry', HERBS_TEXTDOMAIN ).' #1'    => 'archives/masonry.png' ),
						'overlay'        => array( esc_html__( 'Masonry', HERBS_TEXTDOMAIN ).' #2'    => 'archives/overlay.png' ),
						'overlay-spaces' => array( esc_html__( 'Masonry', HERBS_TEXTDOMAIN ).' #3'    => 'archives/overlay-spaces.png' ),
						'first_big'      => array( esc_html__( 'Large Post Above', HERBS_TEXTDOMAIN ) => 'archives/first_big.png' ),
						'overlay-title'  => array( esc_html__( 'Overlay Title', HERBS_TEXTDOMAIN )    => 'archives/overlay-title.png' ),
						'overlay-title-center' => array( esc_html__( 'Overlay Title Centered', HERBS_TEXTDOMAIN ) => 'archives/overlay-title-center.png' ),
						'classic-small'  => array( esc_html__( 'Classic Small', HERBS_TEXTDOMAIN )    => 'archives/blog-small.png' ),
				)),

				array(
					'name' => esc_html__( 'Excerpt Length', HERBS_TEXTDOMAIN ),
					'id'   => 'category_excerpt_length',
					'type' => 'number',
				),

				array(
					'name'    => esc_html__( 'Pagination', HERBS_TEXTDOMAIN ),
					'id'      => 'category_pagination',
					'type'    => 'radio',
					'options' => array(
						''          => esc_html__( 'Default',           HERBS_TEXTDOMAIN ),
						'next-prev' => esc_html__( 'Next and Previous', HERBS_TEXTDOMAIN ),
						'numeric'   => esc_html__( 'Numeric',           HERBS_TEXTDOMAIN ),
						'load-more' => esc_html__( 'Load More',         HERBS_TEXTDOMAIN ),
						'infinite'  => esc_html__( 'Infinite Scroll',   HERBS_TEXTDOMAIN ),
				)),

				array(
					'name'  => esc_html__( 'Media Icon', HERBS_TEXTDOMAIN ),
					'id'    => 'category_media_overlay',
					'type'  => 'checkbox',
				),

				array(
					'title' => esc_html__( 'Don\'t duplicate posts', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'name' => esc_html__( 'Don\'t duplicate posts', HERBS_TEXTDOMAIN ),
					'id'   => 'do_not_dublicate',
					'type' => 'checkbox',
					'hint' => esc_html__( 'Note: This option doesn\'t work with the AJAX pagination.', HERBS_TEXTDOMAIN ),
				),

				array(
					'title' => esc_html__( 'Category Page Layout', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'id'      => 'cat_theme_layout',
					'type'    => 'visual',
					'options' => array(
						''       => array( esc_html__( 'Default',    HERBS_TEXTDOMAIN ) => 'default.png' ),
						'full'   => array( esc_html__( 'Full-Width', HERBS_TEXTDOMAIN ) => 'layouts/layout-full.png' ),
						'boxed'  => array( esc_html__( 'Boxed',      HERBS_TEXTDOMAIN ) => 'layouts/layout-boxed.png' ),
						'framed' => array( esc_html__( 'Framed',     HERBS_TEXTDOMAIN ) => 'layouts/layout-framed.png' ),
						'border' => array( esc_html__( 'Bordered',   HERBS_TEXTDOMAIN ) => 'layouts/layout-border.png' ),
				)),
			);


			if( ! empty( $current_settings ) && is_array( $current_settings ) ){
				$settings = array_merge( $current_settings, $settings );
			}

			return apply_filters( 'Herbs/Settings/Category/category-layout/defaults', $settings );
		}


		/**
		 * Post Layout Settings
		 */
		function posts_layout_settings( $current_settings, $category_id ){

			$settings = array(

				array(
					'title' => esc_html__( 'Post Layout', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'id'      => 'cat_post_layout',
					'type'    => 'visual',
					'toggle'  => array(
						'' => '',
						'4' => '#cat_featured_bg_title, #cat_featured_use_fea-item, #cat_featured_custom_bg-item',
						'5' => '#cat_featured_bg_title, #cat_featured_use_fea-item, #cat_featured_custom_bg-item',
						'8' => '#cat_featured_bg_title, #cat_featured_use_fea-item, #cat_featured_custom_bg-item, #cat_featured_bg_color-item',),
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
					)),

				array(
					'title' => esc_html__( 'Featured area background', HERBS_TEXTDOMAIN ),
					'id'    => 'cat_featured_bg_title',
					'type'  => 'header',
					'class' => 'cat_post_layout',
				),

				array(
					'name'  => esc_html__( 'Use the featured image', HERBS_TEXTDOMAIN ),
					'id'    => 'cat_featured_use_fea',
					'type'  => 'select',
					'class' => 'cat_post_layout',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Yes',     HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'No',      HERBS_TEXTDOMAIN ),
					)),

				array(
					'name'     => esc_html__( 'Upload Custom Image', HERBS_TEXTDOMAIN ),
					'id'       => 'cat_featured_custom_bg',
					'type'     => 'upload',
					'pre_text' => esc_html__( '- OR -', HERBS_TEXTDOMAIN ),
					'class'    => 'cat_post_layout',
				),

				array(
					'name'  => esc_html__( 'Background Color', HERBS_TEXTDOMAIN ),
					'id'    => 'cat_featured_bg_color',
					'type'  => 'color',
					'class' => 'cat_post_layout',
				),

				array(
					'title' => esc_html__( 'Post Format Settings', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'name'    => esc_html__( 'Standard Post Format:', HERBS_TEXTDOMAIN ) .' '. esc_html__( 'Show the featured image', HERBS_TEXTDOMAIN ),
					'id'      => 'cat_post_featured',
					'type'    => 'select',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Yes',     HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'No',      HERBS_TEXTDOMAIN ),
				)),

				array(
					'name'    => esc_html__( 'Image Post Format:', HERBS_TEXTDOMAIN ) .' '. esc_html__( 'Uncropped featured image', HERBS_TEXTDOMAIN ),
					'id'      => 'cat_image_uncropped',
					'type'    => 'select',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Yes',     HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'No',      HERBS_TEXTDOMAIN ),
				)),

				array(
					'name'    => esc_html__( 'Image Post Format:', HERBS_TEXTDOMAIN ) .' '. esc_html__( 'Featured image lightbox', HERBS_TEXTDOMAIN ),
					'id'      => 'cat_image_lightbox',
					'type'    => 'select',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Yes',     HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'No',      HERBS_TEXTDOMAIN ),
				)),

				array(
					'title' =>	esc_html__( 'Structure Data', HERBS_TEXTDOMAIN ),
					'id'    => 'structure-data',
					'type'  => 'header',
				),

				array(
					'name'    => esc_html__( 'Schema type', HERBS_TEXTDOMAIN ),
					'id'      => 'cat_schema_type',
					'type'    => 'radio',
					'options' => array(
						'Article'      => esc_html__( 'Article',      HERBS_TEXTDOMAIN ),
						'NewsArticle'  => esc_html__( 'NewsArticle',  HERBS_TEXTDOMAIN ),
						'BlogPosting'  => esc_html__( 'BlogPosting',  HERBS_TEXTDOMAIN ),
					)),

			);


			if( ! empty( $current_settings ) && is_array( $current_settings ) ){
				$settings = array_merge( $current_settings, $settings );
			}

			return apply_filters( 'Herbs/Settings/Category/posts-settings/defaults', $settings );
		}


		/**
		 * Slider Settings
		 */
		function slider_settings( $current_settings, $category_id ){

			$sliders_list   = HERBS_ADMIN_HELPER::get_sliders( true );
			$current_slider = tie_get_category_option( 'featured_posts_style', $category_id );
			$current_slider = ! empty( $current_slider ) ? $current_slider : 1 ;

			$slider_styles = array();

			$slider_path = 'blocks/block-';
			for( $slider = 1; $slider <= 17; $slider++ ){

				$slide_class 	= 'slider_'.$slider;
				$slide_img 		= $slider_path.'slider_'.$slider.'.png';

				$slider_styles[ $slider ] = array( sprintf( esc_html__( 'Slider #%s', HERBS_TEXTDOMAIN ), $slider ) => array( $slide_class => $slide_img ) );
			}

			$slider_styles[ '50' ] = array( sprintf( esc_html__( 'Slider #%s', HERBS_TEXTDOMAIN ), 18 ) => array( 'slider_50 slider_4' => $slider_path.'slider_50.png' ) );

			$slider_styles['videos_list'] = array( esc_html__( 'Videos Playlist', HERBS_TEXTDOMAIN ) => array( 'video_play_list' => $slider_path. 'videos_list.png' ) );


			$settings = array(

				array(
					'title' => esc_html__( 'Herbs Slider', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'name'   => esc_html__( 'Enable', HERBS_TEXTDOMAIN ),
					'id'     => 'featured_posts',
					'toggle' => '#main-slider-options',
					'type'   => 'checkbox',
				),

				array(
					'content' => '<div id="main-slider-options" style="display: none;" class="slider_'. esc_attr( $current_slider ) .'-container">',
					'type'    => 'html',
				),

				array(
					'id'      => 'featured_posts_style',
					'type'    => 'visual',
					'options' => $slider_styles,
				),

				array(
					'name'    =>  esc_html__( 'Number of posts to show', HERBS_TEXTDOMAIN ),
					'id'      => 'featured_posts_number',
					'class'   => 'featured-posts',
					'default' => 10,
					'type'    => 'number',
				),

				array(
					'name'   => esc_html__( 'Query Type', HERBS_TEXTDOMAIN ),
					'id'     => 'featured_posts_query',
					'class'  => 'featured-posts',
					'type'   => 'radio',
					'toggle' => array(
						'recent' => '',
						'random' => '',
						'custom' => '#featured_posts_custom-item' ),
					'options' => array(
						'recent' => esc_html__( 'Recent Posts',  HERBS_TEXTDOMAIN ),
						'random' => esc_html__( 'Random Posts',  HERBS_TEXTDOMAIN ),
						'custom' => esc_html__( 'Custom Slider', HERBS_TEXTDOMAIN ),
				)),

				array(
					'content' => '<div class="featured-posts-options">',
					'type'    => 'html',
				),

				array(
					'name'    => esc_html__( 'Custom Slider', HERBS_TEXTDOMAIN ),
					'id'      => 'featured_posts_custom',
					'class'   => 'featured_posts_query',
					'type'    => 'select',
					'options' => $sliders_list,
				),

				array(
					'content' => '</div>', // .featured-posts-options
					'type'    => 'html',
				),

				array(
					'name'  => esc_html__( 'Colored Mask', HERBS_TEXTDOMAIN ),
					'id'    => 'featured_posts_colored_mask',
					'class' => 'featured-posts',
					'type'  => 'checkbox',
				),

				array(
					'name'  => esc_html__( 'Disable Gradient Overlay', HERBS_TEXTDOMAIN ),
					'id'    => 'featured_posts_gradiant_overlay',
					'class' => 'featured-posts',
					'type'  => 'checkbox',
				),

				array(
					'name'  => esc_html__( 'Media Icon', HERBS_TEXTDOMAIN ),
					'id'    => 'featured_posts_media_overlay',
					'class' => 'featured-posts',
					'type'  => 'checkbox',
				),

				array(
					'name'  =>  esc_html__( 'Animate Automatically', HERBS_TEXTDOMAIN ),
					'id'    => 'featured_auto',
					'class' => 'featured-posts',
					'type'  => 'checkbox',
				),

				array(
					'name'  => esc_html__( 'Title Length', HERBS_TEXTDOMAIN ),
					'id'    => 'featured_posts_title_length',
					'class'	=> 'featured-posts',
					'type'  => 'number',
				),

				array(
					'content' => '<div class="excerpt-options featured-posts-options">',
					'type'    => 'html',
				),

				array(
					'name'   => esc_html__( 'Posts Excerpt', HERBS_TEXTDOMAIN ),
					'id'     => 'featured_posts_excerpt',
					'type'   => 'checkbox',
					'toggle' => '#featured_posts_excerpt_length-item',
				),

				array(
					'name'  => esc_html__( 'Posts Excerpt Length', HERBS_TEXTDOMAIN ),
					'id'    => 'featured_posts_excerpt_length',
					'type'  => 'number',
				),

				array(
					'content' => '</div>', // excerpt-options featured-posts-options
					'type'    => 'html',
				),

				array(
					'name'  => esc_html__( 'Post Primary Category', HERBS_TEXTDOMAIN ),
					'id'    => 'featured_posts_category',
					'class'	=> 'slider-category-option block-slider-categories-meta-options featured-posts',
					'type'  => 'checkbox',
				),

				array(
					'name'  => esc_html__( 'Review Rating', HERBS_TEXTDOMAIN ),
					'id'    => 'featured_posts_review',
					'class'	=> 'slider-review-option block-slider-review-meta-options featured-posts',
					'type'  => 'checkbox',
				),

				array(
					'name'  => esc_html__( 'Post Meta', HERBS_TEXTDOMAIN ),
					'id'    => 'featured_posts_date',
					'class'	=> 'featured-posts',
					'type'  => 'checkbox',
				),

				array(
					'name'  => esc_html__( 'Playlist title', HERBS_TEXTDOMAIN ),
					'id'    => 'featured_videos_list_title',
					'class' => 'featured-videos',
					'type'	=> 'text',
				),

				array(
					'name'  => esc_html__( 'Videos List', HERBS_TEXTDOMAIN ),
					'hint'  => esc_html__( 'Enter each video url in a seprated line.', HERBS_TEXTDOMAIN ) . ' <strong>' . esc_html__( 'Supports: YouTube and Vimeo videos only.', HERBS_TEXTDOMAIN ).'</strong>',
					'id'    => 'featured_videos_list',
					'class' => 'featured-videos',
					'type'  => 'textarea',
				),

				array(
					'title' => esc_html__( 'Styling', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'name'   => esc_html__( 'Dark Skin', HERBS_TEXTDOMAIN ),
					'id'    => 'dark_skin',
					'class' => 'featured-videos',
					'type'  => 'checkbox',
				),

				array(
					'name' => esc_html__( 'Background Color', HERBS_TEXTDOMAIN ),
					'id'   => 'featured_posts_color',
					'type' => 'color',
				),

				array(
					'name' => esc_html__( 'Background Image', HERBS_TEXTDOMAIN ),
					'id'   => 'featured_posts_bg',
					'type' => 'upload',
				),

				array(
					'name' => esc_html__( 'Background Video', HERBS_TEXTDOMAIN ),
					'id'   => 'featured_posts_bg_video',
					'type' => 'text',
				),

				array(
					'name'   => esc_html__( 'Parallax', HERBS_TEXTDOMAIN ),
					'id'     => 'featured_posts_parallax',
					'type'   => 'checkbox',
					'toggle' => '#featured_posts_parallax_effect-item',
				),

				array(
					'name' => esc_html__( 'Parallax Effect', HERBS_TEXTDOMAIN ),
					'id'   => 'featured_posts_parallax_effect',
					'type' => 'select',
					'options' => array(
						'scroll'         => esc_html__( 'Scroll',           HERBS_TEXTDOMAIN ),
						'scale'          => esc_html__( 'Scale',            HERBS_TEXTDOMAIN ),
						'opacity'        => esc_html__( 'Opacity',          HERBS_TEXTDOMAIN ),
						'scroll-opacity' => esc_html__( 'Scroll + Opacity', HERBS_TEXTDOMAIN ),
						'scale-opacity'  => esc_html__( 'Scale + Opacity',  HERBS_TEXTDOMAIN ),
				)),

				array(
					'content' => '</div>', // main-slider-options
					'type'    => 'html',
				),
			);

			// Revolution Slider
			if( HERBS_REVSLIDER_IS_ACTIVE ){

				$settings[] =	array(
					'title' => esc_html__( 'Revolution Slider', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				);

				$rev_slider = new RevSlider();
				$rev_slider = $rev_slider->getArrSlidersShort();

				if( ! empty( $rev_slider ) && is_array( $rev_slider )){

					$arrSliders = array( '' => esc_html__( 'Disable', HERBS_TEXTDOMAIN ) );

					foreach( $rev_slider as $id => $item ){
						$name = empty( $item ) ? esc_html__( 'Unnamed', HERBS_TEXTDOMAIN ) : $item;
						$arrSliders[ $id ] = $name . ' | #' .$id;
					}

					$settings[] = array(
						'text' => esc_html__( 'Will override the sliders above.', HERBS_TEXTDOMAIN ),
						'type' => 'message',
					);

					$settings[] = array(
						'name'    => esc_html__( 'Choose Slider', HERBS_TEXTDOMAIN ),
						'id'      => 'revslider',
						'type'    => 'select',
						'options' => $arrSliders,
					);
				}
				else{

					$settings[] = array(
						'text' => esc_html__( 'No sliders found, Please create a slider.', HERBS_TEXTDOMAIN ),
						'type' => 'error',
					);
				}
			}

			// LayerSlider
			if( HERBS_LS_Sliders_IS_ACTIVE ){

				$settings[] = array(
					'title' => esc_html__( 'LayerSlider', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				);

				$ls_sliders = LS_Sliders::find(array('limit' => 100));

				if( ! empty( $ls_sliders ) && is_array( $ls_sliders ) ){

					$settings[] =	array(
						'text' => esc_html__( 'Will override the sliders above.', HERBS_TEXTDOMAIN ),
						'type' => 'message',
					);

					$arrSliders = array( '' => esc_html__( 'Disable', HERBS_TEXTDOMAIN ) );

					foreach( $ls_sliders as $item ){
						$name = empty( $item['name'] ) ? esc_html__( 'Unnamed', HERBS_TEXTDOMAIN ) : $item['name'];
						$arrSliders[ $item['id'] ] = $name . ' | #' .$item['id'];
					}

					$settings[] =	array(
						'name'    => esc_html__( 'Choose Slider', HERBS_TEXTDOMAIN ),
						'id'      => 'lsslider',
						'type'    => 'select',
						'options' => $arrSliders,
					);
				}
				else{

					$settings[] =	array(
						'text' => esc_html__( 'No sliders found, Please create a slider.', HERBS_TEXTDOMAIN ),
						'type' => 'error',
					);
				}
			}


			if( ! empty( $current_settings ) && is_array( $current_settings ) ){
				$settings = array_merge( $current_settings, $settings );
			}

			return apply_filters( 'Herbs/Settings/Category/slider/defaults', $settings );
		}


		/**
		 * Logo Settings
		 */
		function logo_settings( $current_settings, $category_id ){

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
						'logo'  => esc_html__( 'Image', HERBS_TEXTDOMAIN ),
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

			return apply_filters( 'Herbs/Settings/Category/logo/defaults', $settings );
		}


		/**
		 * Menu Settings
		 */
		function menu_settings( $current_settings, $category_id ){

			$settings = array(
				array(
					'title' => esc_html__( 'Custom Menu', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'name'    => esc_html__( 'Custom Menu', HERBS_TEXTDOMAIN ),
					'id'      => 'cat_menu',
					'type'    => 'select',
					'options' => HERBS_ADMIN_HELPER::get_menus( true ),
				),
			);

			if( ! empty( $current_settings ) && is_array( $current_settings ) ){
				$settings = array_merge( $current_settings, $settings );
			}

			return apply_filters( 'Herbs/Settings/Category/menu/defaults', $settings );
		}



		/**
		 * Sidebar Settings
		 */
		function sidebar_settings( $current_settings, $category_id ){

			$settings = array(

				array(
					'title' => esc_html__( 'Category Sidebar', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'id'      => 'cat_sidebar_pos',
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
					'id'     => 'cat_sticky_sidebar',
					'type'   => 'select',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Yes',     HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'No',      HERBS_TEXTDOMAIN ),
				)),

				array(
					'name'    => esc_html__( 'Custom Sidebar', HERBS_TEXTDOMAIN ),
					'id'      => 'cat_sidebar',
					'type'    => 'select',
					'options' => HERBS_ADMIN_HELPER::get_sidebars(),
				),

				//--
				array(
					'title' => esc_html__( 'Global Sidebar Settings for Posts in this Category', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'id'      => 'cat_posts_sidebar_pos',
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
					'id'     => 'cat_posts_sticky_sidebar',
					'type'   => 'select',
					'options' => array(
						''    => esc_html__( 'Default', HERBS_TEXTDOMAIN ),
						'yes' => esc_html__( 'Yes',     HERBS_TEXTDOMAIN ),
						'no'  => esc_html__( 'No',      HERBS_TEXTDOMAIN ),
				)),

				array(
					'name'    => esc_html__( 'Custom Sidebar', HERBS_TEXTDOMAIN ),
					'id'      => 'cat_posts_sidebar',
					'type'    => 'select',
					'options' => HERBS_ADMIN_HELPER::get_sidebars(),
				),
			);


			if( ! empty( $current_settings ) && is_array( $current_settings ) ){
				$settings = array_merge( $current_settings, $settings );
			}

			return apply_filters( 'Herbs/Settings/Category/sidebar/defaults', $settings );
		}



		/**
		 * Styles Settings
		 */
		function styles_settings( $current_settings, $category_id ){

			$settings = array(

				array(
					'title' => esc_html__( 'Category Style', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				),

				array(
					'name' => esc_html__( 'Primary Color', HERBS_TEXTDOMAIN ),
					'id'   => 'cat_color',
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
					'id'    => 'cat_custom_css',
					'class' => 'tie-css',
					'type'  => 'textarea',
					'hint'  => sprintf( esc_html__( 'Use %s and it will be replaced with the primary color.', HERBS_TEXTDOMAIN ), '<code>primary-color</code>' ),
				),
			);


			if( ! empty( $current_settings ) && is_array( $current_settings ) ){
				$settings = array_merge( $current_settings, $settings );
			}

			return apply_filters( 'Herbs/Settings/Category/styles/defaults', $settings );
		}

	}

	new HERBS_SETTINGS_CATEGORY();
}
