<?php
/**
 * General Functions
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly


/**
 * Get Theme Options
 */
if( ! function_exists( 'tie_get_option' )){

	function tie_get_option( $name, $default = false ){

		// Cache the theme settings
		if( ! empty( $GLOBALS['tie_options'] ) ){
			$get_options = $GLOBALS['tie_options'];
		}
		else{
			$get_options = get_option( apply_filters( 'Herbs/theme_options', '' ) );
			$GLOBALS['tie_options'] = $get_options;
		}

		if( ! empty( $get_options[ $name ] )){
			return $get_options[ $name ];
		}

		if ( $default ){
			return $default;
		}

		return false;
	}
}


/**
 * Get Post custom option
 */
if( ! function_exists( 'tie_get_postdata' )){

	function tie_get_postdata( $key, $default = false, $post_id = null ){

		if( ! $post_id ){
			$post_id = get_the_ID();
		}

		if( $value = get_post_meta( $post_id, $key, $single = true ) ){
			return $value;
		}
		elseif( $default ){
			return $default;
		}

		return false;
	}
}


/**
 * Get Category custom option
 */
if( ! function_exists( 'tie_get_category_option' )){

	function tie_get_category_option( $key, $category_id = 0 ){

		if( is_category() && empty( $category_id )){
			$category_id = get_query_var('cat');
		}

		if( empty( $category_id )){
			return false;
		}

		$categories_options = get_option( 'tie_cats_options' );

		if( ! empty( $categories_options[ $category_id ][ $key ] )){
			return $categories_options[ $category_id ][ $key ];
		}

		return false;
	}
}


/**
 * Get custom option > post > primary category > theme options
 */
if( ! function_exists( 'tie_get_object_option' )){

	function tie_get_object_option( $key = false, $cat_key = false, $post_key = false ){

		// CHeck if the $cat_key or $post_key are empty
		if( ! empty( $key ) ){
			$cat_key  = ! empty( $cat_key  ) ? $cat_key  : $key;
			$post_key = ! empty( $post_key ) ? $post_key : $key;
		}

		// BuddyPress
		if( HERBS_BUDDYPRESS_IS_ACTIVE && is_buddypress() ){

			$option = HERBS_BUDDYPRESS::get_page_data( $post_key );
			$option = ( $option == 'default') ? '' : $option; //Compatability Sahifa
		}

		// WooCommerce
		elseif( HERBS_WOOCOMMERCE_IS_ACTIVE && is_woocommerce() ){

			$option = HERBS_WOOCOMMERCE::get_page_data( $post_key );
			$option = ( $option == 'default') ? '' : $option; //Compatability Sahifa
		}

		// Get Single options
		elseif( is_singular() ){

			// Get the post option if exists
			$option = tie_get_postdata( $post_key );

			$option = ( $option == 'default') ? '' : $option; //Compatability Sahifa

			// Get the category option if the post option isn't exists
			if( ( empty( $option ) || ( is_array( $option ) && ! array_filter( $option )) ) && is_singular( 'post' ) ){

				$category_id = tie_get_primary_category_id();
				$option      = tie_get_category_option( $cat_key, $category_id );
			}
		}

		// Get Category options
		elseif( is_category() ){
			$option = tie_get_category_option( $cat_key );
		}

		// Get the global value
		if( ( empty( $option ) || ( is_array( $option ) && ! array_filter( $option )) ) && ! empty( $key ) ){
			$option = tie_get_option( $key );
		}

		if( ! empty( $option )){
			return $option;
		}

		return false;
	}
}


/**
 * Logo args
 */
if( ! function_exists( 'tie_logo_args' )){

	function tie_logo_args( $type = false ){

		$logo_args   = array();
		$logo_suffix = ( $type == 'sticky' ) ? '_sticky' : '';

		// Custom Post || Page logo
		if( is_singular() ){

			if( tie_get_postdata( 'custom_logo'.$logo_suffix )){

				$logo_args['logo_type']          = tie_get_postdata( 'logo_setting'.$logo_suffix );
				$logo_args['logo_img']           = tie_get_postdata( 'logo'.$logo_suffix );
				$logo_args['logo_retina']        = tie_get_postdata( 'logo_retina'.$logo_suffix );
				$logo_args['logo_width']         = tie_get_postdata( 'logo_retina_width'.$logo_suffix );
				$logo_args['logo_height']        = tie_get_postdata( 'logo_retina_height'.$logo_suffix );
				$logo_args['logo_margin_top']    = tie_get_postdata( 'logo_margin'.$logo_suffix );
				$logo_args['logo_margin_bottom'] = tie_get_postdata( 'logo_margin_bottom'.$logo_suffix );
				$logo_args['logo_title']         = tie_get_postdata( 'logo_text', get_bloginfo() );
				$logo_args['logo_url']           = tie_get_postdata( 'logo_url' );

			}
			// Get the category option if the post option isn't exists
			else{
				if( is_singular( 'post' ) ){
					$category_id = tie_get_primary_category_id();
				}
			}
		}

		// Custom category logo or primary category logo for a single post
		if( is_category() || ! empty( $category_id ) ){

			if( is_category() ){
				$category_id = get_query_var('cat');
			}

			if( tie_get_category_option( 'custom_logo'.$logo_suffix, $category_id )){

				$logo_args['logo_type']          = tie_get_category_option( 'logo_setting'.$logo_suffix,       $category_id );
				$logo_args['logo_img']           = tie_get_category_option( 'logo'.$logo_suffix,               $category_id );
				$logo_args['logo_retina']        = tie_get_category_option( 'logo_retina'.$logo_suffix,        $category_id );
				$logo_args['logo_width']         = tie_get_category_option( 'logo_retina_width'.$logo_suffix,  $category_id );
				$logo_args['logo_height']        = tie_get_category_option( 'logo_retina_height'.$logo_suffix, $category_id );
				$logo_args['logo_margin_top']    = tie_get_category_option( 'logo_margin'.$logo_suffix,        $category_id );
				$logo_args['logo_margin_bottom'] = tie_get_category_option( 'logo_margin_bottom'.$logo_suffix, $category_id );
				$logo_args['logo_title']         = tie_get_category_option( 'logo_text',                       $category_id ) ? tie_get_category_option( 'logo_text', $category_id ) : get_cat_name( $category_id );
				$logo_args['logo_url']           = tie_get_category_option( 'logo_url',                        $category_id );

			}
		}

		// Allow filtering the args
		$logo_args = apply_filters( 'Herbs/Logo/args', $logo_args, $logo_suffix );


		// Get the theme default logo
		if( empty( $logo_args ) ){

			$logo_args['logo_type']          = tie_get_option( 'logo_setting'.$logo_suffix );
			$logo_args['logo_img']           = tie_get_option( 'logo'.$logo_suffix ) ? tie_get_option( 'logo'.$logo_suffix ) : get_theme_file_uri( '/assets/images/logo.png' );
			$logo_args['logo_width']         = tie_get_option( 'logo_retina_width'.$logo_suffix, 300 );
			$logo_args['logo_height']        = tie_get_option( 'logo_retina_height'.$logo_suffix, 49 );
			$logo_args['logo_margin_top']    = tie_get_option( 'logo_margin'.$logo_suffix );
			$logo_args['logo_margin_bottom'] = tie_get_option( 'logo_margin_bottom'.$logo_suffix );
			$logo_args['logo_title']         = tie_get_option( 'logo_text' ) ? tie_get_option( 'logo_text' ) : get_bloginfo();
			$logo_args['logo_url']           = tie_get_option( 'logo_url' );

			if( tie_get_option( 'logo_retina'.$logo_suffix ) ){
				$logo_args['logo_retina'] = tie_get_option( 'logo_retina'.$logo_suffix );
			}
			elseif( tie_get_option( 'logo'.$logo_suffix ) ){
				$logo_args['logo_retina'] = tie_get_option( 'logo'.$logo_suffix );
			}
			else{
				$logo_args['logo_retina'] = get_theme_file_uri( '/assets/images/logo@2x.png' );
			}
		}


		return $logo_args;
	}
}


/**
 * Sticky Logo args Function
 */
if( ! function_exists( 'tie_logo_sticky_args' )){

	function tie_logo_sticky_args(){

		// Sticky Logo is disabled
		if( ! tie_get_option( 'sticky_logo_type' ) ){
			return;
		}

		// Custom Site Sticky Logo
		if( tie_get_option( 'custom_logo_sticky' ) ){
			return tie_logo_args( 'sticky' );
		}

		// Site Logo
		return tie_logo_args();
	}
}


/**
 * Logo Function
 */
if( ! function_exists( 'tie_logo' )){

	function tie_logo(){

		$logo_args  = tie_logo_args();
		$logo_style = '';

		extract( $logo_args );

		// Logo URL
		$logo_url = ! empty( $logo_url ) ? $logo_url : home_url( '/' );

		// Logo Margin
		if( $logo_margin_top || $logo_margin_bottom ){

			$logo_style   = array();
			$logo_style[] = $logo_margin_top    ? "margin-top: {$logo_margin_top}px;"       : '';
			$logo_style[] = $logo_margin_bottom ? "margin-bottom: {$logo_margin_bottom}px;" : '';

			$logo_style = 'style="'. join( ' ', array_filter( $logo_style ) ) .'"';
		}

		// Logo Type : Title
		if( $logo_type == 'title' ){

			$logo_class  = 'text-logo';
			$logo_output = apply_filters( 'Herbs/Logo/text_logo', '<div class="logo-text">'. $logo_title .'</div>', $logo_title );
		}

		// Logo Type : Image
		else{

			$logo_size 	= '';
			$logo_class	= 'image-logo';

			// Logo Width and Height
			if( $logo_width && $logo_height ){
				$logo_size = 'width="'. esc_attr( $logo_width ) .'" height="'. esc_attr( $logo_height ) .'" style="max-height:'. esc_attr( $logo_height ) .'px; width: auto;"';
			}

			// Logo Retina & Non Retina
			if( $logo_retina ){
				$logo_output = '
					<img src="'. esc_attr( $logo_img ) .'" alt="'. esc_attr( $logo_title ) .'" class="logo_normal" '. $logo_size .'>
					<img src="'. esc_attr( $logo_retina ) .'" alt="'. esc_attr( $logo_title ) .'" class="logo_2x" '. $logo_size .'>
				';
			}

			// Logo Non Retina
			else{
				$logo_output =
					'<img src="'. esc_attr( $logo_img ) .'" alt="'. esc_attr( $logo_title ) .'" '. $logo_size .'>';
			}
		}

		// H1 for the site title in Homepage
		if( is_home() || is_front_page() ){
			$logo_output .= apply_filters( 'Herbs/Logo/h1', '<h1 class="h1-off">'. $logo_title .'</h1>', $logo_title );
		}
		// H1 for internal pages built via the page builder
		elseif( HERBS_HELPER::has_builder() ){
			$logo_output .= apply_filters( 'Herbs/Logo/h1', '<h1 class="h1-off">'. get_the_title() .'</h1>', get_the_title() );
		}

		?>

		<div id="logo" class="<?php echo esc_attr( $logo_class ) ?>" <?php echo ( $logo_style ) ?>>

			<?php do_action( 'Herbs/Logo/before_link' ); ?>

			<a title="<?php echo $logo_title ?>" href="<?php echo esc_url( apply_filters( 'Herbs/Logo/url', $logo_url ) ) ?>">
				<?php
					do_action( 'Herbs/Logo/before_img_text' );
					echo $logo_output;
					do_action( 'Herbs/Logo/after_img_text' );
				?>
			</a>

			<?php do_action( 'Herbs/Logo/after_link' ); ?>

		</div><!-- #logo /-->

		<?php
	}
}


/**
 * Sticky Logo Function
 */
if( ! function_exists( 'tie_sticky_logo' )){

	function tie_sticky_logo(){

		// Get the Sticky logo args
		$logo_args = tie_logo_sticky_args();

		if( ! $logo_args ){
			return;
		}

		extract( $logo_args );

		// Logo URL
		$logo_url = ! empty( $logo_url ) ? $logo_url : home_url( '/' );

		// Logo Type : Title
		if( $logo_type == 'title' ){

			// return if the type is text not image
			return;

			/*
				$logo_class  = 'text-logo';
				$logo_output = apply_filters( 'Herbs/Logo/Sticky/text_logo', '<div class="logo-text">'. $logo_title .'</div>', $logo_title );
			*/
		}

		// Logo Type : Image
		else{

			$logo_size 	= '';
			$logo_class	= 'image-logo';

			// Logo Width and Height
			if( $logo_height && $logo_height < 50 ){
				$logo_size = 'style="max-height:'. esc_attr( $logo_height ) .'px; width: auto;"';
			}

			// Logo Retina & Non Retina
			if( $logo_retina ){
				$logo_output = '
					<img src="'. esc_attr( $logo_img ) .'" alt="'. esc_attr( $logo_title ) .'" class="logo_normal" '. $logo_size .'>
					<img src="'. esc_attr( $logo_retina ) .'" alt="'. esc_attr( $logo_title ) .'" class="logo_2x" '. $logo_size .'>
				';
			}
			// Logo Non Retina
			else{
				$logo_output =
					'<img src="'. esc_attr( $logo_img ) .'" alt="'. esc_attr( $logo_title ) .'" '. $logo_size .'>';
			}
		}

		?>

		<div id="sticky-logo" class="<?php echo esc_attr( $logo_class ) ?>">

			<?php do_action( 'Herbs/Logo/Sticky/before_link' ); ?>

			<a title="<?php echo $logo_title ?>" href="<?php echo esc_url( apply_filters( 'Herbs/Logo/Sticky/url', $logo_url ) ) ?>">
				<?php
					do_action( 'Herbs/Logo/Sticky/before_img_text' );
					echo $logo_output;
					do_action( 'Herbs/Logo/Sticky/after_img_text' );
				?>
			</a>

			<?php do_action( 'Herbs/Logo/Sticky/after_link' ); ?>

		</div><!-- #Sticky-logo /-->

		<div class="flex-placeholder"></div>

		<?php
	}
}


/*
 * Custom Quries
 */
if( ! function_exists( 'tie_query' )){

	function tie_query( $block = array() ){

		$args = array(
			'post_status'         => array( 'publish' ),
			'posts_per_page'      => 5,
			'ignore_sticky_posts' => true,
		);

		// Posts Status for the Ajax Requests
		if( is_user_logged_in() && current_user_can('read_private_posts') ){
			$args['post_status'] = array( 'publish', 'private' );
		}

		// Posts Number
		if( ! empty( $block['number'] )){
			$args['posts_per_page'] = $block['number'];
		}


		// Tags : Post Query
		if( ! empty( $block['tags'] )){

			$tags = array_unique( explode( ',', $block['tags'] ) );

			$args['tag__in'] = array();

			foreach ( $tags as $tag ){
				$post_tag = HERBS_WP_HELPER::get_term_by( 'name', trim( $tag ), 'post_tag' );

				if( ! empty( $post_tag )){
					$args['tag__in'][] = $post_tag->term_id;
				}
			}
		}

		// Tags_array : Post Query
		elseif( ! empty( $block['tags_ids'] )){

			$args['tag__in'] = $block['tags_ids'];
		}

		// Posts : Post Query - Used by the JetPack quries
		elseif( ! empty( $block['posts'] )){

			$selective_posts  = explode ( ',', $block['posts'] );
			$args['orderby']  = 'post__in';
			$args['post__in'] = $selective_posts;

			// Use the count Added posts as the number of posts value
			if( ! empty( $block['use_posts_count'] ) ){

				$selective_posts_number	= count( $selective_posts );
				$args['posts_per_page']	= $selective_posts_number;
			}
		}

		// Pages : Post Query
		elseif( ! empty( $block['pages'] )){

			$selective_pages        = explode ( ',', $block['pages'] );
			$selective_pages_number = count( $selective_pages );
			$args['orderby']        = 'post__in';
			$args['post__in']       = $selective_pages;
			$args['posts_per_page']	= $selective_pages_number;
			$args['post_type']      = 'page';
		}

		// Author : Post Query
		elseif( ! empty( $block['author'] )){

			$args['author'] = $block['author'];
		}

		// Categories : Post Query
		else{

			if( ! empty( $block['id'] ) ){
				$block_cat = maybe_unserialize( $block['id'] );
				$args['cat'] = is_array( $block_cat ) ? implode( ',', $block_cat ) : $block_cat;
			}
		}

		// Exclude Posts
		if( ! empty( $block['exclude_posts'] ) ){
			$args['post__not_in'] = explode( ',', $block['exclude_posts'] );
		}

		// Posts Order
		if( ! empty( $block['order'] ) ){

			if( $block['order'] == 'views' && tie_get_option( 'tie_post_views' ) ){ // Most Viewd posts
				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = apply_filters( 'Herbs/views_meta_field', 'tie_views' );
			}
			elseif( $block['order'] == 'popular' ){ // Popular Posts by comments
				$args['orderby'] = 'comment_count';
			}
			elseif( $block['order'] == 'title' ){
				$args['orderby'] = 'title';
				$args['order']   = 'ASC';
			}
			else{
				$args['orderby'] = $block['order'];
			}
		}

		// Pagination
		if ( ! empty( $block['pagi'] ) ){

			$paged = 1;

			if( ! empty( $block['target_page'] ) ){
				$paged = intval( $block['target_page'] );
			}

			elseif( $block['pagi'] == 'numeric' ){
				$paged   = intval( get_query_var( 'paged' ));
				$paged_2 = intval( get_query_var( 'page'  ));

				if( empty( $paged ) && ! empty( $paged_2 )  ){
					$paged = intval( get_query_var('page') );
				}
			}

			$args['paged'] = $paged;
		}
		else{
			$args['no_found_rows'] = true ;
		}

		// Offset
		if( ! empty( $block['offset'] ) ){

			if( ! empty( $block['pagi'] ) && ! empty( $paged ) ){
				$args['offset'] = $block['offset'] + ( ($paged-1) * $args['posts_per_page'] );
			}

			else{
				$args['offset'] = $block['offset'];
			}
		}

		// Do not duplicate posts
		if( ! empty( $GLOBALS['tie_do_not_duplicate'] ) && is_array( $GLOBALS['tie_do_not_duplicate'] )){
			$args['post__not_in'] = $GLOBALS['tie_do_not_duplicate'];
		}

		// Allow making changes on the Query
		$args = apply_filters( 'Herbs/Query/args', $args, $block );

		// Run the Query
		$block_query = tie_run_the_query( $args );

		// Fix the numbe of pages WordPress Offset bug with pagination
		if(	! empty( $block['pagi'] )){

			if( ! empty( $block['offset'] )){

				// Modify the found_posts
				$found_posts = $block_query->found_posts;
				$found_posts = $found_posts - $block['offset'];
				$block_query->set( 'new_found_posts', $found_posts );

				// Modify the max_num_pages
				$block_query->set( 'new_max_num_pages', ceil( $found_posts/$args['posts_per_page'] ) );
			}
			else{
				$block_query->set( 'new_max_num_pages', $block_query->max_num_pages );
			}
		}

		return $block_query;
	}
}


/*
 * Run the Quries and Cache them
 */
function tie_run_the_query( $args = array() ){

	// Check if the theme cache is enabled
	if ( ! tie_get_option( 'jso_cache' )){
		return new WP_Query( $args );
	}

	// Prepare the cache key
	$cache_key = http_build_query( $args );

  // Check for the custom key in the theme group
  $custom_query = wp_cache_get( $cache_key, 'tie_theme' );

  // If nothing is found, build the object.
  if ( false === $custom_query ) {
    $custom_query = new WP_Query( $args );

    if ( ! is_wp_error( $custom_query ) && $custom_query->have_posts() ) {
			wp_cache_set( $cache_key, $custom_query, 'tie_theme' );
    }
  }

  return $custom_query;
}


/**
 * Block title
 */
if( ! function_exists( 'tie_block_title' )){

	function tie_block_title( $block = false ){

		if( empty( $block['title'] ) && empty( $block['icon'] ) ){
			return;
		}

		?>

		<div <?php tie_box_class( 'mag-box-title' ) ?>>
			<h3>
				<?php

					// Title
					$title  = '';

					if( $block['icon'] ){
						$title .= '<span class="fa '. $block['icon'] .'"></span>';
					}

					if( $block['title'] ){
						if( ! empty( $title ) ){
							$title .= ' ';
						}
						$title .= $block['title'];
					}

					if( ! empty( $block['url'] )){
						echo '<a href="'. esc_url( $block['url'] ) .'">';
						echo $title;
						echo '</a>';
					}
					else{
						echo $title;
					}
				?>
			</h3>

			<?php
			$block_options = '';

			// Block filter
			if( ! empty( $block['filters'] ) && $block['pagi'] != 'numeric' ){

				$block_options .= '
				<ul class="mag-box-filter-links is-flex-tabs">
					<li><a href="#" class="block-ajax-term active" >'. esc_html__( 'All', HERBS_TEXTDOMAIN ) .'</a></li>';

					// Filter by tags
					if( ! empty( $block['tags'] )){

						$tags = HERBS_HELPER::remove_spaces( $block['tags'] );
						$tags = array_unique( explode( ',', $tags ) );

						foreach ( $tags as $tag ){
							$post_tag = HERBS_WP_HELPER::get_term_by( 'name', $tag, 'post_tag' );

							if( ! empty( $post_tag ) && ! empty( $post_tag->count ) && ( $block['offset'] < $post_tag->count )){
								$block_options .= '<li><a href="#" data-id="'.$post_tag->name.'" class="block-ajax-term" >'. $post_tag->name .'</a></li>';
							}
						}
					}

					// Filter by categories
					elseif( ! empty( $block['id'] ) && is_array( $block['id'] )){
						foreach ( $block['id'] as $cat_id ){
							$get_category = HERBS_WP_HELPER::get_term_by( 'id', $cat_id, 'category');

							if( ! empty( $get_category ) && ! empty( $get_category->count ) && ( $block['offset'] < $get_category->count )){
								$block_options .= '<li><a href="#" data-id="'.$cat_id.'" class="block-ajax-term" >'. $get_category->name .'</a></li>';
							}
						}
					}
				$block_options .= '</ul>';
			}

			// More Button
			if( ! empty( $block['more'] ) && ! empty( $block['url'] ) ){
				$block_options .= '<a class="block-more-button" href="'. esc_url( $block['url'] ) .'">'. esc_html__( 'More', HERBS_TEXTDOMAIN ) .'</a>';
			}

			// Ajax Block Arrows
			if( ! empty( $block['pagi'] ) && $block['pagi'] == 'next-prev' ){
				$block_options .= '
					<ul class="slider-arrow-nav">
						<li>
							<a class="block-pagination prev-posts pagination-disabled" href="#">
								<span class="fa fa-angle-left" aria-hidden="true"></span>
								<span class="screen-reader-text">'. esc_html__( 'Previous page', HERBS_TEXTDOMAIN ) .'</span>
							</a>
						</li>
						<li>
							<a class="block-pagination next-posts" href="#">
								<span class="fa fa-angle-right" aria-hidden="true"></span>
								<span class="screen-reader-text">'. esc_html__( 'Next page', HERBS_TEXTDOMAIN ) .'</span>
							</a>
						</li>
					</ul>
				';
			}

			// Scrolling Block Arrows
			if( ! empty( $block['scrolling_box'] )){
				$block_options .= '<ul class="slider-arrow-nav"></ul>';
			}


			if( ! empty( $block_options ) ){
				echo '
					<div class="tie-alignright">
						<div class="mag-box-options">
							'. $block_options .'
						</div><!-- .mag-box-options /-->
					</div><!-- .tie-alignright /-->
				';
			}

		echo '</div><!-- .mag-box-title /-->';
	}
}


/**
 * Author Box
 */
if( ! function_exists( 'tie_author_box' )){

	function tie_author_box( $author = false ){

		// Current object
		if( empty( $author ) ){
			$author = get_queried_object();
		}

		// Profile URL
		$profile = tie_get_author_profile_url( $author );

		// Author name
		$display_name = tie_get_the_author( $author );

		?>

		<div class="about-author container-wrapper about-author-<?php echo $author->ID ?>">

			<?php

				// Show the avatar if it is active only
				if( get_option( 'show_avatars' ) ){ ?>
					<div class="author-avatar">
						<a href="<?php echo $profile; ?>">
							<?php echo get_avatar( $author->user_email, apply_filters( 'Herbs/Author_Box/avatar_size', 180 ), '', sprintf( esc_html__( 'Photo of %s', HERBS_TEXTDOMAIN ), esc_html( $display_name ) ) ); ?>
						</a>
					</div><!-- .author-avatar /-->
					<?php
				}

			?>

			<div class="author-info">
				<h3 class="author-name"><a href="<?php echo $profile; ?>"><?php echo esc_html( $display_name ) ?></a></h3>

				<div class="author-bio">
					<?php the_author_meta( 'description', $author->ID ); ?>
				</div><!-- .author-bio /-->

				<?php

					// Add the website URL
					$author_social = tie_author_social_array();
					$website = array(
						'url' => array(
							'text' => esc_html__( 'Website', HERBS_TEXTDOMAIN ),
							'icon' => 'home',
						));

					$author_social = array_merge( $website, $author_social );

					// Generate the social icons
					echo '<ul class="social-icons">';

					foreach ( $author_social as $network => $button ){
						if( get_the_author_meta( $network , $author->ID )){
							$icon = empty( $button['icon'] ) ? $network : $button['icon'];

							echo '
								<li class="social-icons-item">
									<a href="'. esc_url( get_the_author_meta( $network, $author->ID ) ) .'" rel="external noopener" target="_blank" class="social-link '. $network .'-social-icon">
										<span class="fa fa-'. $icon .'" aria-hidden="true"></span>
										<span class="screen-reader-text">'. $button['text'] .'</span>
									</a>
								</li>
							';
						}
					}

					echo '</ul>';
				?>
			</div><!-- .author-info /-->
			<div class="clearfix"></div>
		</div><!-- .about-author /-->
		<?php
	}
}


/**
 * Get posts in a Widget
*/
if( ! function_exists( 'tie_widget_posts' )){

	function tie_widget_posts( $query_args = array(), $args = array() ){

		$args = wp_parse_args( $args, array(
			'thumbnail'       => HERBS_THEME_SLUG.'-image-small',
			'thumbnail_first' => '',
			'review'          => 'small',
			'review_first'    => '',
			'count'           => 0,
			'show_score'      => true,
			'title_length'    => '',
			'exclude_current' => false,
			'media_icon'      => false,
		));

		// Exclude the Current Post
		if( $args['exclude_current'] && is_single() ){
			$query_args['exclude_posts'] = get_the_id();
		}

		$query_args = apply_filters( 'Herbs/posts_widget_query', $query_args );

		// Related Posts Order
		if( ! empty( $query_args['order'] ) && strpos( $query_args['order'], 'related' ) !== false  ){

			$related_type = $query_args['order'];

			// Exclude the Current Post from the related posts
			$query_args['exclude_posts'] = get_the_id();

			// Unset the attrs
			unset( $query_args['id'] );
			unset( $query_args['order'] );

			// Related By Author
			if( $related_type == 'related-author' ){
				$query_args['author'] = get_the_author_meta( 'ID' );
			}

			// Related By Tags
			elseif( $related_type == 'related-tag' ){

				$post_tags = get_the_terms( get_the_id(), 'post_tag' );

				if( ! empty( $post_tags ) ){
					foreach( $post_tags as $individual_tag ){
						$tags_ids[] = $individual_tag->term_id;
					}

					$query_args['tags_ids'] = $tags_ids;
				}
			}

			// Related by Cats
			elseif( $related_type == 'related-cat' ){

				$category_ids = array();
				$categories   = get_the_category( get_the_id() );

				foreach( $categories as $individual_category ){
					$category_ids[] = $individual_category->term_id;
				}

				$query_args['id'] = $category_ids;
			}
		}

		// Run the query
		$query = tie_query( $query_args );

		if ( $query->have_posts() ){
			while ( $query->have_posts() ){ $query->the_post();

				$args['count']++;

				if( ! empty( $args['style'] ) && $args['style'] == 'timeline' ){ ?>
					<li>
						<a href="<?php the_permalink(); ?>">
							<?php tie_get_time() ?>
							<h3><?php the_title();?></h3>
						</a>
					</li>
					<?php
				}

				elseif( ! empty( $args['style'] ) && $args['style'] == 'grid' ){
					if ( has_post_thumbnail() ){ ?>
						<div <?php tie_post_class( 'tie-col-xs-4' ); ?>>
							<?php
								tie_post_thumbnail( HERBS_THEME_SLUG.'-image-large', false, false, true, $args['media_icon']  );
							?>
						</div>
						<?php
					}
				}

				elseif( ! empty( $args['style'] ) && $args['style'] == 'authors' ){
					HERBS_HELPER::get_template_part( 'templates/loops/loop', 'authors-widget', $args );
				}

				else{
					HERBS_HELPER::get_template_part( 'templates/loops/loop', 'widgets', $args );
				}
			}
		}

		wp_reset_postdata();
	}
}


/**
 * Get recent comments
 */
if( ! function_exists( 'tie_recent_comments' )){

	function tie_recent_comments( $comment_posts = 5, $avatar_size = 70 ){

		$comments = get_comments( 'status=approve&number='.$comment_posts );

		foreach ($comments as $comment){ ?>
			<li>
				<?php

				$no_thumb = 'no-small-thumbs';

				// Show the avatar if it is active only
				if( get_option( 'show_avatars' ) ){

					$no_thumb = ''; ?>
					<div class="post-widget-thumbnail" style="width:<?php echo esc_attr( $avatar_size ) ?>px">
						<a class="author-avatar" href="<?php echo get_permalink($comment->comment_post_ID ); ?>#comment-<?php echo esc_attr( $comment->comment_ID ); ?>">
							<?php echo get_avatar( $comment, $avatar_size, '', sprintf( esc_html__( 'Photo of %s', HERBS_TEXTDOMAIN ), esc_html( $comment->comment_author ) ) ); ?>
						</a>
					</div>
					<?php
				}

				?>

				<div class="comment-body <?php echo esc_attr( $no_thumb ) ?>">
					<a class="comment-author" href="<?php echo get_permalink($comment->comment_post_ID ); ?>#comment-<?php echo esc_attr( $comment->comment_ID ); ?>">
						<?php echo strip_tags($comment->comment_author); ?>
					</a>
					<p><?php echo wp_html_excerpt( $comment->comment_content, 60 ); ?>...</p>
				</div>

			</li>
			<?php
		}
	}
}


/**
 * Login Form
 */
if( ! function_exists( 'tie_login_form' )){

	function tie_login_form(){
		HERBS_HELPER::get_template_part( 'templates/login' );
	}
}



/**
 * Rich Snippets
 */
if( ! function_exists( 'tie_article_schemas' )){

	add_action( 'Herbs/after_post_entry',  'tie_article_schemas' );
	function tie_article_schemas(){

		if( ! tie_get_option( 'structure_data' ) ){
			return false;
		}

		$post    = get_post();
		$post_id = $post->ID;

		// Check if the rich snippts supported on pages?
		if( is_page() && ! apply_filters( 'Herbs/is_page_rich_snippet', false ) ){
			return;
		}

		// Site Logo
		$site_logo = tie_get_option( 'logo_retina' ) ? tie_get_option( 'logo_retina' ) : tie_get_option( 'logo' );
		$site_logo = ! empty( $site_logo ) ? $site_logo : get_stylesheet_directory_uri().'/assets/images/logo@2x.png';

		// Post data
		$article_body   = strip_tags(strip_shortcodes( apply_filters( 'Herbs/exclude_content', $post->post_content ) ));
		$description    = wp_html_excerpt( $article_body, 200 );
		$puplished_date = ( get_the_time( 'c' ) ) ? get_the_time( 'c' ) : get_the_modified_date( 'c' );
		$modified_date  = ( get_the_modified_date( 'c' ) ) ? get_the_modified_date( 'c' ) : $puplished_date;

		$schema_type    = tie_get_object_option( 'schema_type', 'cat_schema_type', false );
		$schema_type    = ! empty( $schema_type ) ? $schema_type : 'Article';

		// The Scemas Array
		$schema = array(
			'@context'       => 'http://schema.org',
			'@type'          => $schema_type,
			'dateCreated'    => $puplished_date,
			'datePublished'  => $puplished_date,
			'dateModified'   => $modified_date,
			'headline'       => get_the_title(),
			'name'           => get_the_title(),
			'keywords'       => tie_get_plain_terms( $post_id, 'post_tag' ),
			'url'            => get_permalink(),
			'description'    => $description,
			'copyrightYear'  => get_the_time( 'Y' ),
			'articleSection' => tie_get_plain_terms( $post_id, 'category' ),
			'articleBody'    => $article_body,
			'publisher'      => array(
				'@id'   => '#Publisher',
				'@type' => 'Organization',
				'name'  => get_bloginfo(),
				'logo'  => array(
					'@type' => 'ImageObject',
					'url'   => $site_logo,
				)
			),
			'sourceOrganization' => array(
				'@id' => '#Publisher'
			),
			'copyrightHolder' => array(
				'@id' => '#Publisher'
			),
			'mainEntityOfPage' => array(
				'@type' => 'WebPage',
				'@id'   => get_permalink(),
			),
			'author' => array(
				'@type' => 'Person',
				'name'  => get_the_author(),
				'url'   => tie_get_author_profile_url(),
			),
		);

		// Post image
		$image_id   = get_post_thumbnail_id();
		$image_data = wp_get_attachment_image_src( $image_id, 'full' );

		if( ! empty( $image_data ) ){
			$schema['image'] = array(
				'@type'  => 'ImageObject',
				'url'    => $image_data[0],
				'width'  => ( $image_data[1] > 696 ) ? $image_data[1] : 696,
				'height' => $image_data[2],
			);
		}

		// Breadcrumbs
		if( tie_get_option( 'breadcrumbs' ) ){
			$schema['mainEntityOfPage']['breadcrumb'] = array(
				'@id' => '#Breadcrumb'
			);
		}

		// Social links
		$social = tie_get_option( 'social' );
		if( ! empty( $social ) && is_array( $social )){
			$schema['publisher']['sameAs'] = array_values( $social );
		}

		//-
		$schema = apply_filters( 'Herbs/rich_snippet_schema', $schema );

		// Print the schema
		if( $schema ){
			echo '<script type="application/ld+json">'. json_encode( $schema ) .'</script>';
		}

	}
}


/*
 * Get the Ajax loader icon
 */
if( ! function_exists( 'tie_get_ajax_loader' )){

	function tie_get_ajax_loader( $echo = true ){

		$out = '<div class="loader-overlay">';

		if( tie_get_option( 'loader-icon' ) == 2 ){
			$out .= '
				<div class="spinner">
					<div class="bounce1"></div>
					<div class="bounce2"></div>
					<div class="bounce3"> </div>
				</div>
			';
		}
		else{
			$out .= '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;display:block;" width="100px" height="80px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
			<g transform="translate(20 50)">
			<circle cx="0" cy="0" r="6" fill="#e15b64" transform="scale(0.342835 0.342835)">
			  <animateTransform attributeName="transform" type="scale" begin="-0.375s" calcMode="spline" keySplines="0.3 0 0.7 1;0.3 0 0.7 1" values="0;1;0" keyTimes="0;0.5;1" dur="1s" repeatCount="indefinite"></animateTransform>
			</circle>
			</g><g transform="translate(40 50)">
			<circle cx="0" cy="0" r="6" fill="#f8b26a" transform="scale(0.0587772 0.0587772)">
			  <animateTransform attributeName="transform" type="scale" begin="-0.25s" calcMode="spline" keySplines="0.3 0 0.7 1;0.3 0 0.7 1" values="0;1;0" keyTimes="0;0.5;1" dur="1s" repeatCount="indefinite"></animateTransform>
			</circle>
			</g><g transform="translate(60 50)">
			<circle cx="0" cy="0" r="6" fill="#abbd81" transform="scale(0.0394063 0.0394063)">
			  <animateTransform attributeName="transform" type="scale" begin="-0.125s" calcMode="spline" keySplines="0.3 0 0.7 1;0.3 0 0.7 1" values="0;1;0" keyTimes="0;0.5;1" dur="1s" repeatCount="indefinite"></animateTransform>
			</circle>
			</g><g transform="translate(80 50)">
			<circle cx="0" cy="0" r="6" fill="#81a3bd" transform="scale(0.306063 0.306063)">
			  <animateTransform attributeName="transform" type="scale" begin="0s" calcMode="spline" keySplines="0.3 0 0.7 1;0.3 0 0.7 1" values="0;1;0" keyTimes="0;0.5;1" dur="1s" repeatCount="indefinite"></animateTransform>
			</circle>
			</g>
			</svg>';
		}

		$out .= '</div>';

		if( $echo ){
			echo ( $out );
		}

		return $out;
	}
}



/*
 * Check if the Search is active in the menus
 */
if( ! function_exists( 'tie_menu_has_search' )){

	function tie_menu_has_search( $position = false, $ajax = false, $compact = false ){

		if( empty( $position ) || ! tie_get_option( $position ) ){ // check if the menu itself is active
			return false;
		}

		$position  = str_replace( '_', '-', $position );

		$is_active = false;

		if( tie_get_option( $position.'-components_search' ) ){ // search is active

			$is_active = true;

			// check if compact layout
			if( $compact && tie_get_option( $position.'-components_search_layout' ) == 'compact' ){ // check if compact layout
				$is_active = true;
			}

			// Ajax search check
			if( $ajax ){
				$is_active = false;

				if( tie_get_option( $position.'-components_live_search' ) ){
					$is_active = true;
				}
			}
		}

		return $is_active;
	}
}


/*
 * Get the author profile link
 */
if( ! function_exists( 'tie_get_author_profile_url' )){

	function tie_get_author_profile_url( $author = false ){

		// Author is object
		if( ! empty( $author ) && is_object( $author ) ){

			if( isset( $author->type ) && 'guest-author' == $author->type ){
				return get_author_posts_url( $author->ID, $author->user_nicename );
			}

			$author = $author->ID;
		}

		// Empty Author
		if( empty( $author ) ){
			$author = get_the_author_meta( 'ID' );
		}

		// Use the BuddyPress member profile page
		if( HERBS_BUDDYPRESS_IS_ACTIVE && tie_get_option( 'bp_use_member_profile' ) ){
			return bp_core_get_user_domain( $author );
		}

		// Use the default Author profile page
		return get_author_posts_url( $author );
	}
}



/*
 * Mobile Menu icon
 */
if( ! function_exists( 'tie_add_mobile_menu_trigger' )){

	add_action( 'Herbs/Logo/before', 'tie_add_mobile_menu_trigger' );
	function tie_add_mobile_menu_trigger(){

		if( ! tie_get_option( 'mobile_menu_active' ) ){
			return;
		}

		?>

		<a href="#" id="mobile-menu-icon">
			<span class="nav-icon"></span>

				<?php
					if( tie_get_option( 'mobile_menu_text' ) ){
						echo '<span class="menu-text">'. esc_html__( 'Menu', HERBS_TEXTDOMAIN ) .'</span>';
					}
					else{
						echo '<span class="screen-reader-text">'. esc_html__( 'Menu', HERBS_TEXTDOMAIN ) .'</span>';
					}
				?>
		</a>
		<?php
	}
}




/*
 * Social
 */
if( ! function_exists( 'tie_get_social' )){

	function tie_get_social( $options = array() ){

		$defaults = array(
			'reverse'   => false,
			'show_name' => false,
			'before'    => "<ul>",
			'after'     => "</ul> \n",
		);

		$options = wp_parse_args( $options, $defaults );

		extract( $options );

		/*
		 * Get the cached social networks
		 * There are multiple places for the social networks, to avoid walking throw the whole process and to avoid
		 * calling tie_social_networks multiple times, we cache the social array
		 */
		if( ! empty( $GLOBALS['tie_social_networks'] ) ){
			$social = $GLOBALS['tie_social_networks'];
		}

		// No cached version
		else{

			$social = tie_get_option( 'social' );

			// RSS
			if ( tie_get_option( 'rss_icon' ) ){
				$social['rss'] = ! empty( $social['rss'] ) ? $social['rss'] : get_bloginfo( 'rss2_url' );
			}

			$social_array = ! empty( $social ) ? tie_social_networks() : array();

			// Custom Social Networks
			for( $i=1 ; $i<=5 ; $i++ ){
				if ( ( tie_get_option( "custom_social_icon_img_$i" ) || tie_get_option( "custom_social_icon_$i" ) ) && tie_get_option( "custom_social_url_$i" ) && tie_get_option( "custom_social_title_$i" ) ){

					$network = "custom-link-$i";

					$icon_format = array(
						'title'	=> tie_get_option( "custom_social_title_$i" ),
						'class'	=> 'social-custom-link ' . $network,
					);

					if( tie_get_option( "custom_social_icon_img_$i" ) ){
						$icon_format['img']  = tie_get_option( "custom_social_icon_img_$i" );
						$icon_format['icon'] = "fa fa-share social-icon-img-$i";
					}
					else{
						$icon_format['icon'] = 'fa ' . tie_get_option( "custom_social_icon_$i" );
					}

					$social[ $network ] = array(
						'url'    => esc_url( tie_get_option( "custom_social_url_$i" ) ),
						'format' => $icon_format
					);
				}
			}

			// Create one array hold the social and it's icon, link, etc
			if( ! empty( $social ) && is_array( $social ) ){
				foreach ( $social as $network => $link ){

					if( ! empty( $link ) && ! empty( $social_array[ $network ] ) ){
						$social[ $network ] = array(
							'url'    => esc_url( $link ),
							'format' => $social_array[ $network ]
						);
					}
				}
			}

			// Cache the social networks
			$GLOBALS['tie_social_networks'] = $social;
		}

		//---
		if( $reverse && is_array( $social ) ){
			$social = array_reverse( $social );
		}

		// Print the Icons
		echo ( $before );

		if( ! empty( $social ) ){

			foreach ( $social as $network => $data ){

				// Check if we have icon or img to continue
				if( ! empty( $data['format']['img'] ) || ! empty( $data['format']['icon'] ) ){

					// URL
					$link = ! empty( $data['url'] ) ? $data['url'] : '#';

					//
					$icon  = ! empty( $data['format']['icon'] )  ? $data['format']['icon']  : '';
					$title = ! empty( $data['format']['title'] ) ? $data['format']['title'] : '';
					$class = ! empty( $data['format']['class'] ) ? $data['format']['class'] . '-social-icon' : '';

					$text_class = ! empty( $show_name ) ? 'social-text' : 'screen-reader-text';

					if( ! empty ( $data['format']['img'] ) ){
						$class .= ' custom-social-img';
					}

					echo '<li class="social-icons-item"><a class="social-link '. $class .'" rel="nofollow noopener" target="_blank" href="'. $link .'"><span class="'. $icon .'"></span><span class="'.$text_class.'">'.$title.'</span></a></li>';
				}
			}
		}

		echo ( $after );
	}
}


/*
 * Social Networks
 */
if( ! function_exists( 'tie_social_networks' )){

	function tie_social_networks(){

		$social_array = array(
			'rss' => array(
				'title' => esc_html__( 'RSS', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-rss',
				'class' => 'rss',
			),

			'facebook' => array(
				'title' => esc_html__( 'Facebook', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-facebook',
				'class' => 'facebook',
			),

			'twitter' => array(
				'title' => esc_html__( 'Twitter', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-twitter',
				'class' => 'twitter',
			),

			'Pinterest' => array(
				'title' => esc_html__( 'Pinterest', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-pinterest',
				'class' => 'pinterest',
			),

			'dribbble' => array(
				'title' => esc_html__( 'Dribbble', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-dribbble',
				'class' => 'dribbble',
			),

			'linkedin' => array(
				'title' => esc_html__( 'LinkedIn', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-linkedin',
				'class' => 'linkedin',
			),

			'flickr' => array(
				'title' => esc_html__( 'Flickr', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-flickr',
				'class' => 'flickr',
			),

			'youtube' => array(
				'title' => esc_html__( 'YouTube', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-youtube-play',
				'class' => 'youtube',
			),

			'reddit' => array(
				'title' => esc_html__( 'Reddit', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-reddit',
				'class' => 'reddit',
			),

			'tumblr' => array(
				'title' => esc_html__( 'Tumblr', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-tumblr',
				'class' => 'tumblr',
			),

			'vimeo' => array(
				'title' => esc_html__( 'Vimeo', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-vimeo',
				'class' => 'vimeo',
			),

			'wordpress' => array(
				'title' => esc_html__( 'WordPress', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-wordpress',
				'class' => 'wordpress',
			),

			'yelp' => array(
				'title' => esc_html__( 'Yelp', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-yelp',
				'class' => 'yelp',
			),

			'lastfm' => array(
				'title' => esc_html__( 'Last.FM', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-lastfm',
				'class' => 'lastfm',
			),

			'xing' => array(
				'title' => esc_html__( 'Xing', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-xing',
				'class' => 'xing',
			),

			'deviantart' => array(
				'title' => esc_html__( 'DeviantArt', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-deviantart',
				'class' => 'deviantart',
			),

			'apple' => array(
				'title' => esc_html__( 'Apple', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-apple',
				'class' => 'apple',
			),

			'foursquare' => array(
				'title' => esc_html__( 'Foursquare', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-foursquare',
				'class' => 'foursquare',
			),

			'github' => array(
				'title' => esc_html__( 'GitHub', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-github',
				'class' => 'github',
			),

			'soundcloud' => array(
				'title' => esc_html__( 'SoundCloud', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-soundcloud',
				'class' => 'soundcloud',
			),

			'behance'	=> array(
				'title' => esc_html__( 'Behance', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-behance',
				'class' => 'behance',
			),

			'instagram' => array(
				'title' => esc_html__( 'Instagram', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-instagram',
				'class' => 'instagram',
			),

			'paypal' => array(
				'title' => esc_html__( 'Paypal', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-paypal',
				'class' => 'paypal',
			),

			'spotify' => array(
				'title' => esc_html__( 'Spotify', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-spotify',
				'class' => 'spotify',
			),

			'google_play'=> array(
				'title' => esc_html__( 'Google Play', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-play',
				'class' => 'google_play',
			),

			'px500' => array(
				'title' => esc_html__( '500px', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-500px',
				'class' => 'px500',
			),

			'vk' => array(
				'title' => esc_html__( 'vk.com', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-vk',
				'class' => 'vk',
			),

			'odnoklassniki' => array(
				'title' => esc_html__( 'Odnoklassniki', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-odnoklassniki',
				'class' => 'odnoklassniki',
			),

			'bitbucket'	=> array(
				'title' => esc_html__( 'Bitbucket', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-bitbucket',
				'class' => 'bitbucket',
			),

			'mixcloud' => array(
				'title' => esc_html__( 'Mixcloud', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-mixcloud',
				'class' => 'mixcloud',
			),

			'medium' => array(
				'title' => esc_html__( 'Medium', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-medium',
				'class' => 'medium',
			),

			'twitch' => array(
				'title' => esc_html__( 'Twitch', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-twitch',
				'class' => 'twitch',
			),

			'viadeo' => array(
				'title' => esc_html__( 'Viadeo', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-viadeo',
				'class' => 'viadeo',
			),

			'snapchat' => array(
				'title' => esc_html__( 'Snapchat', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-snapchat-ghost',
				'class' => 'snapchat',
			),

			'telegram' => array(
				'title' => esc_html__( 'Telegram', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-paper-plane',
				'class' => 'telegram',
			),

			'tripadvisor' => array(
				'title' => esc_html__( 'TripAdvisor', HERBS_TEXTDOMAIN ),
				'icon'  => 'fa fa-tripadvisor',
				'class' => 'tripadvisor',
			),
		);

		// Add the RSS hint in the backend only.
		if( is_admin() ){
			$social_array['rss']['hint'] = esc_html__( 'Optional Custom Feed URL, Leave it empty to use the default WordPress feed URL.', HERBS_TEXTDOMAIN );
		}

		return apply_filters( 'Herbs/social_networks', $social_array );
	}
}


/*
 * Author social networks
 */
if( ! function_exists( 'tie_author_social_array' )){

	function tie_author_social_array(){

		$author_social = array(
			'facebook'    => array( 'text' => esc_html__( 'Facebook',  HERBS_TEXTDOMAIN )),
			'twitter'     => array( 'text' => esc_html__( 'Twitter',   HERBS_TEXTDOMAIN )),
			'linkedin'    => array( 'text' => esc_html__( 'LinkedIn',  HERBS_TEXTDOMAIN )),
			'flickr'      => array( 'text' => esc_html__( 'Flickr',    HERBS_TEXTDOMAIN )),
			'youtube'     => array( 'text' => esc_html__( 'YouTube',   HERBS_TEXTDOMAIN )),
			'pinterest'   => array( 'text' => esc_html__( 'Pinterest', HERBS_TEXTDOMAIN )),
			'behance'     => array( 'text' => esc_html__( 'Behance',   HERBS_TEXTDOMAIN )),
			'instagram'   => array( 'text' => esc_html__( 'Instagram', HERBS_TEXTDOMAIN )),
		);

		return apply_filters( 'Herbs/author_social_array', $author_social );
	}
}


/*
 * Translations texts
 */
if( ! function_exists( 'tie_default_translation_texts' )){

	add_filter( 'Herbs/translation_texts', 'tie_default_translation_texts' );
	function tie_default_translation_texts( $texts ){

		$default_texts = array(
			'Share'                  => esc_html__( 'Share',                 HERBS_TEXTDOMAIN ),
			'No More Posts'          => esc_html__( 'No More Posts',         HERBS_TEXTDOMAIN ),
			'View all results'       => esc_html__( 'View all results',      HERBS_TEXTDOMAIN ),
			'Home'                   => esc_html__( 'Home',                  HERBS_TEXTDOMAIN ),
			'Type and hit Enter'     => esc_html__( 'Type and hit Enter',    HERBS_TEXTDOMAIN ),
			'page'                   => esc_html__( 'page',                  HERBS_TEXTDOMAIN ),
			'All'                    => esc_html__( 'All',                   HERBS_TEXTDOMAIN ),
			'Previous page'          => esc_html__( 'Previous page',         HERBS_TEXTDOMAIN ),
			'Next page'              => esc_html__( 'Next page',             HERBS_TEXTDOMAIN ),
			'First'                  => esc_html__( 'First',                 HERBS_TEXTDOMAIN ),
			'Last'                   => esc_html__( 'Last',                  HERBS_TEXTDOMAIN ),
			'More'                   => esc_html__( 'More',                  HERBS_TEXTDOMAIN ),
			'%s ago'                 => esc_html__( '%s ago',                HERBS_TEXTDOMAIN ),
			'Menu'                   => esc_html__( 'Menu',                  HERBS_TEXTDOMAIN ),
			'Welcome'                => esc_html__( 'Welcome',               HERBS_TEXTDOMAIN ),
			'Pages'                  => esc_html__( 'Pages',                 HERBS_TEXTDOMAIN ),
			'Categories'             => esc_html__( 'Categories',            HERBS_TEXTDOMAIN ),
			'Tags'                   => esc_html__( 'Tags',                  HERBS_TEXTDOMAIN ),
			'Authors'                => esc_html__( 'Authors',               HERBS_TEXTDOMAIN ),
			'Archives'               => esc_html__( 'Archives',              HERBS_TEXTDOMAIN ),
			'Trending'               => esc_html__( 'Trending',              HERBS_TEXTDOMAIN ),
			'Via'                    => esc_html__( 'Via',                   HERBS_TEXTDOMAIN ),
			'Source'                 => esc_html__( 'Source',                HERBS_TEXTDOMAIN ),
			'Views'                  => esc_html__( 'Views',                 HERBS_TEXTDOMAIN ),
			'One Comment'            => esc_html__( 'One Comment',           HERBS_TEXTDOMAIN ),
			'%s Comments'            => esc_html__( '%s Comments',           HERBS_TEXTDOMAIN ),
			'Read More &raquo;'      => esc_html__( 'Read More &raquo;',     HERBS_TEXTDOMAIN ),
			'Share via Email'        => esc_html__( 'Share via Email',       HERBS_TEXTDOMAIN ),
			'Print'                  => esc_html__( 'Print',                 HERBS_TEXTDOMAIN ),
			'About %s'               => esc_html__( 'About %s',              HERBS_TEXTDOMAIN ),
			'By %s'                  => esc_html__( 'By %s',                 HERBS_TEXTDOMAIN ),
			'Popular'                => esc_html__( 'Popular',               HERBS_TEXTDOMAIN ),
			'Recent'                 => esc_html__( 'Recent',                HERBS_TEXTDOMAIN ),
			'Comments'               => esc_html__( 'Comments',              HERBS_TEXTDOMAIN ),
			'Search Results for: %s' => esc_html__( 'Search Results for: %s',HERBS_TEXTDOMAIN ),
			'404 :('                 => esc_html__( '404 :(',                HERBS_TEXTDOMAIN ),
			'No products found'      => esc_html__( 'No products found',     HERBS_TEXTDOMAIN ),
			'Nothing Found'          => esc_html__( 'Nothing Found',         HERBS_TEXTDOMAIN ),
			'Dashboard'              => esc_html__( 'Dashboard',             HERBS_TEXTDOMAIN ),
			'Your Profile'           => esc_html__( 'Your Profile',          HERBS_TEXTDOMAIN ),
			'Log Out'                => esc_html__( 'Log Out',               HERBS_TEXTDOMAIN ),
			'Username'               => esc_html__( 'Username',              HERBS_TEXTDOMAIN ),
			'Password'               => esc_html__( 'Password',              HERBS_TEXTDOMAIN ),
			'Forget?'                => esc_html__( 'Forget?',               HERBS_TEXTDOMAIN ),
			'Remember me'            => esc_html__( 'Remember me',           HERBS_TEXTDOMAIN ),
			'Log In'                 => esc_html__( 'Log In',                HERBS_TEXTDOMAIN ),
			'Search for'             => esc_html__( 'Search for',            HERBS_TEXTDOMAIN ),
			'Subtotal:'              => esc_html__( 'Cart Subtotal:',        HERBS_TEXTDOMAIN ),
			'View Cart'              => esc_html__( 'View Cart',             HERBS_TEXTDOMAIN ),
			'Checkout'               => esc_html__( 'Checkout',              HERBS_TEXTDOMAIN ),
			'Go to the shop'         => esc_html__( 'Go to the shop',        HERBS_TEXTDOMAIN ),
			'Random Article'         => esc_html__( 'Random Article',        HERBS_TEXTDOMAIN ),
			'Follow'                 => esc_html__( 'Follow',                HERBS_TEXTDOMAIN ),
			'Check Also'             => esc_html__( 'Check Also',            HERBS_TEXTDOMAIN ),
			'Story Highlights'       => esc_html__( 'Story Highlights',      HERBS_TEXTDOMAIN ),
			'Subscribe'              => esc_html__( 'Subscribe',             HERBS_TEXTDOMAIN ),
			'Related Articles'       => esc_html__( 'Related Articles',      HERBS_TEXTDOMAIN ),
			'Read Next'              => esc_html__( 'Read Next',             HERBS_TEXTDOMAIN ),
			'Videos'                 => esc_html__( 'Videos',                HERBS_TEXTDOMAIN ),
			'Follow us on Flickr'    => esc_html__( 'Follow us on Flickr',   HERBS_TEXTDOMAIN ),
			'Follow Us'              => esc_html__( 'Follow Us',             HERBS_TEXTDOMAIN ),
			'Follow us on Twitter'   => esc_html__( 'Follow us on Twitter',  HERBS_TEXTDOMAIN ),
			'Less than a minute'     => esc_html__( 'Less than a minute',    HERBS_TEXTDOMAIN ),
			'%s hours read'          => esc_html__( '%s hours read',         HERBS_TEXTDOMAIN ),
			'1 minute read'          => esc_html__( '1 minute read',         HERBS_TEXTDOMAIN ),
			'%s minutes read'        => esc_html__( '%s minutes read',       HERBS_TEXTDOMAIN ),
			'No new notifications'   => esc_html__( 'No new notifications',  HERBS_TEXTDOMAIN ),
			'Notifications'          => esc_html__( 'Notifications',         HERBS_TEXTDOMAIN ),
			'Show More'              => esc_html__( 'Show More',             HERBS_TEXTDOMAIN ),
			'Load More'              => esc_html__( 'Load More',             HERBS_TEXTDOMAIN ),
			'Show Less'              => esc_html__( 'Show Less',             HERBS_TEXTDOMAIN ),
			'and'                    => esc_html__( 'and',                   HERBS_TEXTDOMAIN ),
			'km/h'                   => esc_html__( 'km/h',                  HERBS_TEXTDOMAIN ),
			'mph'                    => esc_html__( 'mph',                   HERBS_TEXTDOMAIN ),
			'Thunderstorm'           => esc_html__( 'Thunderstorm',          HERBS_TEXTDOMAIN ),
			'Drizzle'                => esc_html__( 'Drizzle',               HERBS_TEXTDOMAIN ),
			'Light Rain'             => esc_html__( 'Light Rain',            HERBS_TEXTDOMAIN ),
			'Heavy Rain'             => esc_html__( 'Heavy Rain',            HERBS_TEXTDOMAIN ),
			'Rain'                   => esc_html__( 'Rain',                  HERBS_TEXTDOMAIN ),
			'Snow'                   => esc_html__( 'Snow',                  HERBS_TEXTDOMAIN ),
			'Mist'                   => esc_html__( 'Mist',                  HERBS_TEXTDOMAIN ),
			'Clear Sky'              => esc_html__( 'Clear Sky',             HERBS_TEXTDOMAIN ),
			'Scattered Clouds'       => esc_html__( 'Scattered Clouds',      HERBS_TEXTDOMAIN ),

			'View your shopping cart'       => esc_html__( 'View your shopping cart',       HERBS_TEXTDOMAIN ),
			'Enter your Email address'      => esc_html__( 'Enter your Email address',      HERBS_TEXTDOMAIN ),
			"Don't have an account?"        => esc_html__( "Don't have an account?",        HERBS_TEXTDOMAIN ),
			'Your cart is currently empty.' => esc_html__( 'Your cart is currently empty.', HERBS_TEXTDOMAIN ),

			'Oops! That page can&rsquo;t be found.'   => esc_html__( 'Oops! That page can&rsquo;t be found.',   HERBS_TEXTDOMAIN ),
			'Type your search words then press enter' => esc_html__( 'Type your search words then press enter', HERBS_TEXTDOMAIN ),
			'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.'      => esc_html__( "It seems we can't find what you're looking for. Perhaps searching can help.", HERBS_TEXTDOMAIN ),
			'Sorry, but nothing matched your search terms. Please try again with some different keywords.' => esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', HERBS_TEXTDOMAIN ),
		);

		if( ! empty( $texts ) && is_array( $texts ) ){
			$default_texts = array_merge( $texts, $default_texts );
		}

		return apply_filters( 'Herbs/default_translation_texts', $default_texts );
	}
}
