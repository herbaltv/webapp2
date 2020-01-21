<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



/*-----------------------------------------------------------------------------------*/
# Register main Scripts and Styles
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_enqueue_scripts', 'herbal_extensions_shortcodes_enqueue_scripts', 25 );
function herbal_extensions_shortcodes_enqueue_scripts() {

	$load_css_js = apply_filters( 'tie_plugin_shortcodes_enqueue_assets', true );

	if( true === $load_css_js ) {
		wp_enqueue_style ( 'herbal-extensions-shortcodes-styles',  plugins_url( 'assets/style.css', __FILE__ ),     array(), '', 'all' );
		wp_enqueue_script( 'herbal-extensions-shortcodes-scripts', plugins_url( 'assets/js/scripts.js', __FILE__ ), array( 'jquery' ), false, true );
	}
}



/*-----------------------------------------------------------------------------------*/
# Shortcode styles and scripts
/*-----------------------------------------------------------------------------------*/
add_action( 'admin_enqueue_scripts', 'herbal_extensions_shortcodes_scripts' );
function herbal_extensions_shortcodes_scripts() {

	$lang_text = array(
		'herbal_theme_active'    => function_exists( 'tie_get_option') ? true : false,
		'shortcode_herbs'      => esc_html__( 'Herbal Shortcodes', 'herbal-extensions' ),
		'shortcode_help'         => esc_html__( 'Need help?',   'herbal-extensions' ),
		'shortcode_docs_url'     => apply_filters( 'tie_extensions_shortcodes_docs_url', 'https://herbaltv.co.id/help/' ),
		'shortcode_blockquote'   => esc_html__( 'Quote',        'herbal-extensions' ),
		'shortcode_author'       => esc_html__( 'Author',       'herbal-extensions' ),
		'shortcode_box'          => esc_html__( 'Box',          'herbal-extensions' ),
		'shortcode_alignment'    => esc_html__( 'Alignment',    'herbal-extensions' ),
		'shortcode_class'        => esc_html__( 'Custom Class', 'herbal-extensions' ),
		'shortcode_style'        => esc_html__( 'Style',        'herbal-extensions' ),
		'shortcode_dark'         => esc_html__( 'Dark',         'herbal-extensions' ),
		'shortcode_light'        => esc_html__( 'Light',        'herbal-extensions' ),
		'shortcode_simple'       => esc_html__( 'Simple',       'herbal-extensions' ),
		'shortcode_shadow'       => esc_html__( 'Shadow',       'herbal-extensions' ),
		'shortcode_info'         => esc_html__( 'Info',         'herbal-extensions' ),
		'shortcode_success'      => esc_html__( 'Success',      'herbal-extensions' ),
		'shortcode_warning'      => esc_html__( 'Warning',      'herbal-extensions' ),
		'shortcode_error'        => esc_html__( 'Error',        'herbal-extensions' ),
		'shortcode_download'     => esc_html__( 'Download',     'herbal-extensions' ),
		'shortcode_note'         => esc_html__( 'Note',         'herbal-extensions' ),
		'shortcode_right'        => esc_html__( 'Right',        'herbal-extensions' ),
		'shortcode_left'         => esc_html__( 'Left',         'herbal-extensions' ),
		'shortcode_center'       => esc_html__( 'Center',       'herbal-extensions' ),
		'shortcode_width'        => esc_html__( 'Width',        'herbal-extensions' ),
		'shortcode_content'      => esc_html__( 'Content',      'herbal-extensions' ),
		'shortcode_button'       => esc_html__( 'Button',       'herbal-extensions' ),
		'shortcode_nofollow'     => esc_html__( 'Nofollow?',    'herbal-extensions' ),
		'shortcode_color'        => esc_html__( 'Color',        'herbal-extensions' ),
		'shortcode_red'          => esc_html__( 'Red',          'herbal-extensions' ),
		'shortcode_orange'       => esc_html__( 'Orange',       'herbal-extensions' ),
		'shortcode_blue'         => esc_html__( 'Blue',         'herbal-extensions' ),
		'shortcode_green'        => esc_html__( 'Green',        'herbal-extensions' ),
		'shortcode_black'        => esc_html__( 'Black',        'herbal-extensions' ),
		'shortcode_gray'         => esc_html__( 'Gray',         'herbal-extensions' ),
		'shortcode_white'        => esc_html__( 'White',        'herbal-extensions' ),
		'shortcode_pink'         => esc_html__( 'Pink',         'herbal-extensions' ),
		'shortcode_purple'       => esc_html__( 'Purple',       'herbal-extensions' ),
		'shortcode_yellow'       => esc_html__( 'Yellow',       'herbal-extensions' ),
		'shortcode_size'         => esc_html__( 'Size',         'herbal-extensions' ),
		'shortcode_small'        => esc_html__( 'Small',        'herbal-extensions' ),
		'shortcode_medium'       => esc_html__( 'Medium',       'herbal-extensions' ),
		'shortcode_big'          => esc_html__( 'Big',          'herbal-extensions' ),
		'shortcode_link'         => esc_html__( 'Link',         'herbal-extensions' ),
		'shortcode_text'         => esc_html__( 'Text',         'herbal-extensions' ),
		'shortcode_icon'         => esc_html__( 'Icon (use full Font Awesome name)', 'herbal-extensions' ),
		'shortcode_new_window'   => esc_html__( 'Open link in a new window/tab',     'herbal-extensions' ),
		'shortcode_tabs'         => esc_html__( 'Tabs',                   'herbal-extensions' ),
		'shortcode_tab_title1'   => esc_html__( 'Tab 1 Title',            'herbal-extensions' ),
		'shortcode_tab_title2'   => esc_html__( 'Tab 2 Title',            'herbal-extensions' ),
		'shortcode_tab_title3'   => esc_html__( 'Tab 3 Title',            'herbal-extensions' ),
		'shortcode_tab_content1' => esc_html__( 'Tab 1 | Your Content',   'herbal-extensions' ),
		'shortcode_tab_content2' => esc_html__( 'Tab 2 | Your Content',   'herbal-extensions' ),
		'shortcode_tab_content3' => esc_html__( 'Tab 3 | Your Content',   'herbal-extensions' ),
		'shortcode_slide1'       => esc_html__( 'Slide 1 | Your Content', 'herbal-extensions' ),
		'shortcode_slide2'       => esc_html__( 'Slide 2 | Your Content', 'herbal-extensions' ),
		'shortcode_slide3'       => esc_html__( 'Slide 3 | Your Content', 'herbal-extensions' ),
		'shortcode_vertical'     => esc_html__( 'Vertical',               'herbal-extensions' ),
		'shortcode_horizontal'   => esc_html__( 'Horizontal',             'herbal-extensions' ),
		'shortcode_toggle'       => esc_html__( 'Toggle Box',             'herbal-extensions' ),
		'shortcode_title'        => esc_html__( 'Title',                  'herbal-extensions' ),
		'shortcode_state'        => esc_html__( 'State',                  'herbal-extensions' ),
		'shortcode_opened'       => esc_html__( 'Opened',                 'herbal-extensions' ),
		'shortcode_closed'       => esc_html__( 'Closed',                 'herbal-extensions' ),
		'shortcode_slideshow'    => esc_html__( 'Content Slideshow',      'herbal-extensions' ),
		'shortcode_bio'          => esc_html__( 'Author Bio',             'herbal-extensions' ),
		'shortcode_avatar'       => esc_html__( 'Author Image URL',       'herbal-extensions' ),
		'shortcode_flickr'       => esc_html__( 'Flickr',                 'herbal-extensions' ),
		'shortcode_add_flickr'   => esc_html__( 'Add photos from Flickr', 'herbal-extensions' ),
		'shortcode_flickr_id'    => esc_html__( 'Account ID  ( get it from http//idgettr.com )', 'herbal-extensions' ),
		'shortcode_flickr_num'   => esc_html__( 'Number of photos',       'herbal-extensions' ),
		'shortcode_sorting'      => esc_html__( 'Sorting',                'herbal-extensions' ),
		'shortcode_recent'       => esc_html__( 'Recent',                 'herbal-extensions' ),
		'shortcode_random'       => esc_html__( 'Random',                 'herbal-extensions' ),
		'shortcode_feed'         => esc_html__( 'Display Feeds',          'herbal-extensions' ),
		'shortcode_feed_url'     => esc_html__( 'URL of the RSS feed',    'herbal-extensions' ),
		'shortcode_feeds_num'    => esc_html__( 'Number of Feeds',        'herbal-extensions' ),
		'shortcode_map'          => esc_html__( 'Google Maps',            'herbal-extensions' ),
		'shortcode_map_url'      => esc_html__( 'Google Maps URL',        'herbal-extensions' ),
		'shortcode_height'       => esc_html__( 'Height',                 'herbal-extensions' ),
		'shortcode_video'        => esc_html__( 'Video',                  'herbal-extensions' ),
		'shortcode_video_url'    => esc_html__( 'Video URL',              'herbal-extensions' ),
		'shortcode_audio'        => esc_html__( 'Audio',                  'herbal-extensions' ),
		'shortcode_mp3'          => esc_html__( 'MP3 file URL',           'herbal-extensions' ),
		'shortcode_m4a'          => esc_html__( 'M4A file URL',           'herbal-extensions' ),
		'shortcode_ogg'          => esc_html__( 'OGG file URL',           'herbal-extensions' ),
		'shortcode_lightbox'     => esc_html__( 'Lightbox',               'herbal-extensions' ),
		'shortcode_lightbox_url' => esc_html__( 'Full Image or YouTube / Vimeo Video URL', 'herbal-extensions' ),
		'shortcode_tooltip'      => esc_html__( 'Tooltip',                'herbal-extensions' ),
		'shortcode_direction'    => esc_html__( 'Direction',              'herbal-extensions' ),
		'shortcode_top'          => esc_html__( 'Top',                    'herbal-extensions' ),
		'shortcode_left'         => esc_html__( 'Left',                   'herbal-extensions' ),
		'shortcode_right'        => esc_html__( 'Right',                  'herbal-extensions' ),
		'shortcode_bottom'       => esc_html__( 'Bottom',                 'herbal-extensions' ),
		'shortcode_share'        => esc_html__( 'Share Buttons',          'herbal-extensions' ),
		'shortcode_facebook'     => esc_html__( 'Facebook Like Button',   'herbal-extensions' ),
		'shortcode_tweet'        => esc_html__( 'Tweet Button',           'herbal-extensions' ),
		'shortcode_stumble'			 => esc_html__( 'Stumble Button',         'herbal-extensions' ),
		'shortcode_pinterest'		 => esc_html__( 'Pinterest Button',       'herbal-extensions' ),
		'shortcode_follow'			 => esc_html__( 'Twitter Follow Button',  'herbal-extensions' ),
		'shortcode_username'		 => esc_html__( 'Twitter Username',       'herbal-extensions' ),
		'shortcode_login'			   => esc_html__( 'Login Form',             'herbal-extensions' ),
		'shortcode_tags'         => esc_html__( 'Tags Cloud',             'herbal-extensions' ),
		'shortcode_dropcap'			 => esc_html__( 'Dropcap',                'herbal-extensions' ),
		'shortcode_highlight'		 => esc_html__( 'Highlight Text',         'herbal-extensions' ),
		'shortcode_padding'			 => esc_html__( 'Padding',                'herbal-extensions' ),
		'shortcode_padding_top'  => esc_html__( 'Padding Top',            'herbal-extensions' ),
		'shortcode_padding_bottom' => esc_html__( 'Padding Bottom',       'herbal-extensions' ),
		'shortcode_padding_right'=> esc_html__( 'Padding right',          'herbal-extensions' ),
		'shortcode_padding_left' => esc_html__( 'Padding Left',           'herbal-extensions' ),
		'shortcode_divider'      => esc_html__( 'Divider Line',           'herbal-extensions' ),
		'shortcode_solid'        => esc_html__( 'Solid',                  'herbal-extensions' ),
		'shortcode_dashed'       => esc_html__( 'Dashed',                 'herbal-extensions' ),
		'shortcode_normal'       => esc_html__( 'Normal',                 'herbal-extensions' ),
		'shortcode_double'       => esc_html__( 'Double',                 'herbal-extensions' ),
		'shortcode_dotted'       => esc_html__( 'Dotted',                 'herbal-extensions' ),
		'shortcode_margin_top'   => esc_html__( 'Margin Top',             'herbal-extensions' ),
		'shortcode_margin_bottom'=> esc_html__( 'Margin Bottom',          'herbal-extensions' ),
		'shortcode_lists'        => esc_html__( 'Lists',                  'herbal-extensions' ),
		'shortcode_star'         => esc_html__( 'Star',                   'herbal-extensions' ),
		'shortcode_check'        => esc_html__( 'Check',                  'herbal-extensions' ),
		'shortcode_thumb_up'     => esc_html__( 'Thumb Up',               'herbal-extensions' ),
		'shortcode_thumb_down'   => esc_html__( 'Thumb Down',             'herbal-extensions' ),
		'shortcode_plus'         => esc_html__( 'Plus',                   'herbal-extensions' ),
		'shortcode_minus'        => esc_html__( 'Minus',                  'herbal-extensions' ),
		'shortcode_heart'        => esc_html__( 'Heart',                  'herbal-extensions' ),
		'shortcode_light_bulb'   => esc_html__( 'Light Bulb',             'herbal-extensions' ),
		'shortcode_cons'         => esc_html__( 'Cons',                   'herbal-extensions' ),
		'shortcode_ads'          => esc_html__( 'Ads',                    'herbal-extensions' ),
		'shortcode_ads1'         => esc_html__( 'Ads Shortcode 1',        'herbal-extensions' ),
		'shortcode_ads2'         => esc_html__( 'Ads Shortcode 2',        'herbal-extensions' ),
		'shortcode_ads3'         => esc_html__( 'Ads Shortcode 3',        'herbal-extensions' ),
		'shortcode_ads4'         => esc_html__( 'Ads Shortcode 4',        'herbal-extensions' ),
		'shortcode_ads5'         => esc_html__( 'Ads Shortcode 5',        'herbal-extensions' ),
		'shortcode_columns'      => esc_html__( 'Columns',                'herbal-extensions' ),
		'shortcode_add_content'  => esc_html__( 'Add content here',       'herbal-extensions' ),
		'shortcode_full_img'     => esc_html__( 'Full Width Image',       'herbal-extensions' ),
		'shortcode_index'        => esc_html__( 'Content Index',          'herbal-extensions' ),
		'shortcode_Restrict'     => esc_html__( 'Restrict Content',       'herbal-extensions' ),
		'shortcode_registered'   => esc_html__( 'For Registered Users only', 'herbal-extensions' ),
		'shortcode_guests'       => esc_html__( 'For Guests only',           'herbal-extensions' ),
	);

	wp_localize_script( 'jquery', 'herbal_extensions_lang', $lang_text );
}


/*-----------------------------------------------------------------------------------*/
# Fix Shortcodes
/*-----------------------------------------------------------------------------------*/
add_filter( 'the_content', 'herbal_extensions_sc_fix_shortcodes' );
function herbal_extensions_sc_fix_shortcodes( $content ){

	$array_to_avoid = array(
		'<p>[dropcap'   => '<p_tag>[dropcap',
		'<p>[highlight' => '<p_tag>[highlight',
	);

	$content = strtr( $content, $array_to_avoid );

	$array = array(
		'[raw]'        => '',
		'[/raw]'       => '',
		'<p>[raw]'     => '',
		'[/raw]</p>'   => '',
		'[/raw]<br />' => '',
		'<p>['         => '[',
		']</p>'        => ']',
		']<br />'      => ']',
		']<br>'        => ']',
	);

	$content = strtr( $content, $array );

	return str_replace( '<p_tag>', '<p>', $content );
}


/*-----------------------------------------------------------------------------------*/
# Old Review Shortcode
/*-----------------------------------------------------------------------------------*/
if( function_exists( 'taqyeem_shortcode_review' ) ){
	add_shortcode( 'review', 'taqyeem_shortcode_review' );
}


/*-----------------------------------------------------------------------------------*/
# WP 3.6.0 | # For old theme versions Video shortcode
/*-----------------------------------------------------------------------------------*/
add_filter( 'the_content', 'herbal_extensions_sc_video_fix_shortcodes', 0);
function herbal_extensions_sc_video_fix_shortcodes( $content ){
	$videos  = '/(\[(video)\s?.*?\])(.+?)(\[(\/video)\])/';
	$content = preg_replace( $videos, '[embed]$3[/embed]', $content );
	return $content;
}


/*-----------------------------------------------------------------------------------*/
# Register the shortcode button
/*-----------------------------------------------------------------------------------*/
add_action( 'admin_init', 'herbal_extensions_sc_add_mce_button' );
function herbal_extensions_sc_add_mce_button() {
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
		return;
	}

	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'herbal_extensions_sc_add_tinymce_plugin' );
		add_filter( 'mce_buttons',          'herbal_extensions_sc_register_mce_button' );
	}
}


/*-----------------------------------------------------------------------------------*/
# Add the button to the button array
/*-----------------------------------------------------------------------------------*/
function herbal_extensions_sc_register_mce_button( $buttons ) {
	array_push( $buttons, 'herbal_extensions_mce_button' );
	return $buttons;
}


/*-----------------------------------------------------------------------------------*/
# Declare script for new button
/*-----------------------------------------------------------------------------------*/
function herbal_extensions_sc_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['herbal_extensions_mce_button'] = plugins_url( 'assets/js/mce.js', __FILE__ );
	return $plugin_array;
}





/*-----------------------------------------------------------------------------------*/
# [tie_tags] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'tie_tags', 'herbal_extensions_sc_tags' );
function herbal_extensions_sc_tags( $atts, $content = null ) {

	$args = array(
		'smallest' => 8,
		'largest'  => 22,
		'unit'     => 'pt',
		'number'   => 0,
		'echo'     => false,
	);
	return '
		<div class="tags-shortcode">'.
			wp_tag_cloud( $args ) .'
		</div><!-- .tags-shortcode /-->
	';
}


/*-----------------------------------------------------------------------------------*/
# [tie_login] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'tie_login', 'herbal_extensions_sc_login' );
function herbal_extensions_sc_login( $atts, $content = null ) {

	if( ! function_exists( 'tie_login_form' ) ){
		return;
	}

	ob_start();

	tie_login_form();

	return '
		<div class="login-widget container-wrapper login-shortcode">'.
			ob_get_clean() .'
		</div><!-- .login-shortcode /-->
	';
}


/*-----------------------------------------------------------------------------------*/
# [ads1] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'ads1', 'herbal_extensions_sc_ads1' );
function herbal_extensions_sc_ads1( $atts, $content = null ) {

	if( ! function_exists( 'tie_get_option') || ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) ){
		return;
	}

	return '
		<div class="stream-item stream-item-in-post stream-item-in-post-1">'.
			do_shortcode( apply_filters( 'Herbs/custom_ad_code', tie_get_option( 'ads1_shortcode' ) ) ) .'
		</div>
	';
}


/*-----------------------------------------------------------------------------------*/
# [ads2] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'ads2', 'herbal_extensions_sc_ads2' );
function herbal_extensions_sc_ads2( $atts, $content = null ) {

	if( ! function_exists( 'tie_get_option') || ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) ){
		return;
	}

	return '
		<div class="stream-item stream-item-in-post stream-item-in-post-2">'.
			do_shortcode( apply_filters( 'Herbs/custom_ad_code', tie_get_option( 'ads2_shortcode' ) ) ) .'
		</div>
	';
}


/*-----------------------------------------------------------------------------------*/
# [ads3] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'ads3', 'herbal_extensions_sc_ads3' );
function herbal_extensions_sc_ads3( $atts, $content = null ) {

	if( ! function_exists( 'tie_get_option') || ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) ){
		return;
	}

	return '
		<div class="stream-item stream-item-in-post stream-item-in-post-3">'.
			do_shortcode( apply_filters( 'Herbs/custom_ad_code', tie_get_option( 'ads3_shortcode' ) ) ) .'
		</div>
	';
}


/*-----------------------------------------------------------------------------------*/
# [ads4] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'ads4', 'herbal_extensions_sc_ads4' );
function herbal_extensions_sc_ads4( $atts, $content = null ) {

	if( ! function_exists( 'tie_get_option') || ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) ){
		return;
	}

	return '
		<div class="stream-item stream-item-in-post stream-item-in-post-4">'.
			do_shortcode( apply_filters( 'Herbs/custom_ad_code', tie_get_option( 'ads4_shortcode' ) ) ) .'
		</div>
	';
}


/*-----------------------------------------------------------------------------------*/
# [ads5] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'ads5', 'herbal_extensions_sc_ads5' );
function herbal_extensions_sc_ads5( $atts, $content = null ) {

	if( ! function_exists( 'tie_get_option') || ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) ){
		return;
	}

	return '
		<div class="stream-item stream-item-in-post stream-item-in-post-5">'.
			do_shortcode( apply_filters( 'Herbs/custom_ad_code', tie_get_option( 'ads5_shortcode' ) ) ) .'
		</div>
	';
}


/*-----------------------------------------------------------------------------------*/
# [box] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'box', 'herbal_extensions_sc_box' );
function herbal_extensions_sc_box( $atts, $content = null ) {

	$atts = wp_parse_args( $atts, array(
		'type'  => 'shadow',
		'align' => '',
		'class' => '',
		'width' => '',
	));

	extract( $atts );

	if( ! empty( $width ) ){
		$width = ' style="width:'.$width.'"';
	}

	return '
		<div class="box '.$type.' '.$class.' '.$align.'"'.$width.'>
			<div class="box-inner-block">
				<span class="fa tie-shortcode-boxicon"></span>'.
					do_shortcode( $content ) .'
			</div>
		</div>
	';
}


/*-----------------------------------------------------------------------------------*/
# [lightbox] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'lightbox', 'herbal_extensions_sc_lightbox' );
function herbal_extensions_sc_lightbox( $atts, $content = null ) {

	$atts = wp_parse_args( $atts, array(
		'full'  => '',
		'title' => '',
	));

	extract( $atts );

	if( function_exists( 'tie_get_video_embed' )){
		$full = tie_get_video_embed( $full );
	}

	return '<a class="lightbox-enabled" href="'. esc_url( $full ) .'" data-caption="'. $title .'" title="'. $title .'">'. do_shortcode( $content ) .'</a>';
}


/*-----------------------------------------------------------------------------------*/
# [toggle] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'toggle', 'herbal_extensions_sc_toggle' );
function herbal_extensions_sc_toggle( $atts, $content = null ) {

	$atts = wp_parse_args( $atts, array(
		'state' => 'open',
		'title' => '',
	));

	extract( $atts );

	$state = ( $state == 'open' ) ? 'tie-sc-open' : 'tie-sc-close';

	return '
		<div class="clearfix"></div>
		<div class="toggle '. $state .'">
			<h3 class="toggle-head">'. $title .' <span class="fa fa-angle-down" aria-hidden="true"></span></h3>
			<div class="toggle-content">'.
				do_shortcode( $content ) .'
			</div>
		</div>
	';
}


/*-----------------------------------------------------------------------------------*/
# [author] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'author', 'herbal_extensions_sc_author_info' );
function herbal_extensions_sc_author_info( $atts, $content = null ) {

	$title = esc_html__( 'About the author', 'herbal-extensions' );

	$atts = wp_parse_args( $atts, array(
		'image' => '',
	));

	extract( $atts );

	return '
		<div class="clearfix"></div>
		<div class="about-author about-author-box container-wrapper">
			<div class="author-avatar">
				<img src="'. esc_attr( $image ) .'" alt="">
			</div>
			<div class="author-info">
				<h4>'. $title .'</h4>'.
					do_shortcode( $content ) .'
			</div>
		</div>
	';
}


/*-----------------------------------------------------------------------------------*/
# [button] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'button', 'herbal_extensions_sc_button' );
function herbal_extensions_sc_button( $atts, $content = null ) {

	$atts = wp_parse_args( $atts, array(
		'size'      => 'small',
		'color'     => 'gray',
		'link'      => '',
		'nofollow'  => '',
		'align'     => '',
		'icon'      => '',
		'target'    => '',
	));

	extract( $atts );

	$nofollow = ( $nofollow == 'true' ) ? ' rel="nofollow"' : '';
	$target = ( $target == 'true' ) ? ' target="_blank"' : '';

	if( ! empty( $icon ) ){
		$icon = '<span class="fa '. $icon .'" aria-hidden="true"></span> ';
	}

	return '<a href="'. esc_url( $link ) .'"'. $target . $nofollow .' class="shortc-button '. $size .' '. $color .' '. $align .'">'. $icon . do_shortcode( $content ). '</a>';
}


/*-----------------------------------------------------------------------------------*/
# [flickr] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'flickr', 'herbal_extensions_sc_flickr' );
function herbal_extensions_sc_flickr( $atts, $content = null ) {

	$atts = wp_parse_args( $atts, array(
		'number'  => 5,
		'orderby' => 'random',
		'id'      => '',
	));

	extract( $atts );

	return '
		<div class="flickr-wrapper">
			<script src="https://www.flickr.com/badge_code_v2.gne?count='. $number .'&amp;display='. $orderby .'&amp;size=s&amp;layout=x&amp;source=user&amp;user='. $id .'"></script>
		</div>
	';
}


/*-----------------------------------------------------------------------------------*/
# [feed] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'feed', 'herbal_extensions_sc_feed' );
function herbal_extensions_sc_feed( $atts, $content = null ) {

	$atts = wp_parse_args( $atts, array(
		'number' => 5,
		'url'    => '',
	));

	extract( $atts );

	if( empty( $url )){
		return;
	}

	include_once( ABSPATH . WPINC . '/feed.php' );

	$rss = fetch_feed( $url );

	if ( is_wp_error( $rss ) ){
		return;
	}

	$maxitems  = $rss->get_item_quantity( $number );
	$rss_items = $rss->get_items( 0, $maxitems );

	$out = '<ul>';

	if ( ( isset( $maxitems ) && $maxitems == 0 ) || empty( $maxitems ) ) {
		$out .= '<li>'. esc_html__( 'No items.', 'herbal-extensions' ) .'</li>';
	}
	else{
		foreach ( $rss_items as $item ){
			$out .= '<li><a target="_blank" href="'. esc_url( $item->get_permalink() ) .'" title="'.  esc_html__( 'Posted', 'herbal-extensions' ) .' '. $item->get_date( 'j F Y | g:i a' ).'">'. esc_html( $item->get_title() ) .'</a></li>';
		}
	}

	$out .='</ul>';

	return $out;
}


/*-----------------------------------------------------------------------------------*/
# [googlemap] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'googlemap', 'herbal_extensions_sc_googlemap' );
function herbal_extensions_sc_googlemap( $atts, $content = null ) {

	if( ! empty( $atts['src'] ) && function_exists( 'tie_google_maps' ) ){

		if( ! function_exists( 'tie_google_maps' )){
			return $atts['src'];
		}

		return tie_google_maps( $atts['src'] );
	}
}


/*-----------------------------------------------------------------------------------*/
# [is_logged_in] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'is_logged_in', 'herbal_extensions_sc_is_logged_in' );
function herbal_extensions_sc_is_logged_in( $atts, $content = null ) {

	if( is_user_logged_in() ){
		return do_shortcode( $content );
	}
}


/*-----------------------------------------------------------------------------------*/
# [is_guest] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'is_guest', 'herbal_extensions_sc_is_guest' );
function herbal_extensions_sc_is_guest( $atts, $content = null ) {

	if( ! is_user_logged_in() ){
		return do_shortcode( $content );
	}
}


/*-----------------------------------------------------------------------------------*/
# [follow] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'follow', 'herbal_extensions_sc_follow' );
function herbal_extensions_sc_follow( $atts, $content = null ) {

	$atts = wp_parse_args( $atts, array(
		'count' => 'false',
		'id'    => '',
		'size'  => '',
	));

	extract( $atts );

	$size = ( $size == 'large' ) ? 'data-size="large"' : '';

	return '
		<a href="https://twitter.com/'. $id .'" class="twitter-follow-button" data-show-count="'. $count .'" '. $size .'>Follow @'. $id .'</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	';
}


/*-----------------------------------------------------------------------------------*/
# [tooltip] Shortcode | The OLD shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'tooltip', 'herbal_extensions_sc_tooltip' );
function herbal_extensions_sc_tooltip( $atts, $content = null ) {

	$tooltip_title = ! empty( $atts['text'] ) ? $atts['text'] : '';
	$atts['text']  = $content;

	return herbal_extensions_sc_tie_tooltip( $atts, $tooltip_title );
}


/*-----------------------------------------------------------------------------------*/
# [tie_tooltip] Shortcode | The NEW shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'tie_tooltip', 'herbal_extensions_sc_tie_tooltip' );
function herbal_extensions_sc_tie_tooltip( $atts, $content = null ) {

	$atts = wp_parse_args( $atts, array(
		'text'    => 'false',
		'gravity' => '',
	));

	extract( $atts );


	if( $gravity == 'w' ){
		$gravity = 'left';
	}
	elseif( $gravity == 'e' ){
		$gravity = 'right';
	}
	elseif( $gravity == 's' || $gravity == 'sw' || $gravity == 'se' ){
		$gravity = 'bottom';
	}
	else{
		$gravity = 'top';
	}

	return '<a data-toggle="tooltip" data-placement="'. $gravity .'" class="post-tooltip tooltip-'. $gravity .'" title="'. $text .'">'. do_shortcode( $content ) .'</a>';
}


/*-----------------------------------------------------------------------------------*/
# [highlight] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'highlight', 'herbal_extensions_sc_highlight' );
function herbal_extensions_sc_highlight( $atts, $content = null ) {

	$atts = wp_parse_args( $atts, array(
		'color' => 'yellow',
	));

	extract( $atts );

	return '<span class="tie-highlight tie-highlight-'. $color .'">'. $content .'</span>';
}


/*-----------------------------------------------------------------------------------*/
# [tie_full_img] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'tie_full_img', 'herbal_extensions_sc_full_width_img' );
function herbal_extensions_sc_full_width_img( $atts, $content = null ) {
	return '
		<div class="tie-full-width-img">
			'. do_shortcode( $content ) .'
		</div>
	';
}


/*-----------------------------------------------------------------------------------*/
# [dropcap] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'dropcap', 'herbal_extensions_sc_dropcap' );
function herbal_extensions_sc_dropcap( $atts, $content = null ) {

	$atts = wp_parse_args( $atts, array(
		'type' => '',
	));

	extract( $atts );

	return '<span class="tie-dropcap '. $type .'">'. $content .'</span>';
}


/*-----------------------------------------------------------------------------------*/
# [tie_list] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'tie_list', 'herbal_extensions_sc_lists' );
function herbal_extensions_sc_lists( $atts, $content = null ) {

	$atts = wp_parse_args( $atts, array(
		'type' => 'checklist',
	));

	extract( $atts );

	return '
		<div class="'. $type .' tie-list-shortcode">'.
			do_shortcode( $content ) .'
		</div>
	';
}


/*-----------------------------------------------------------------------------------*/
# [checklist] Shortcode | ** Old Versions replaced with tie_list
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'checklist', 'herbal_extensions_sc_checklist' );
function herbal_extensions_sc_checklist( $atts, $content = null ) {
	return '
		<div class="checklist tie-list-shortcode">'.
			do_shortcode( $content ) .'
		</div>
	';
}


/*-----------------------------------------------------------------------------------*/
# [starlist] Shortcode | ** Old Versions replaced with tie_list
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'starlist', 'herbal_extensions_sc_starlist' );
function herbal_extensions_sc_starlist( $atts, $content = null ) {
	return '
		<div class="starlist tie-list-shortcode">'.
			do_shortcode( $content ) .'
		</div>
	';
}


/*-----------------------------------------------------------------------------------*/
# [facebook] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'facebook', 'herbal_extensions_sc_facebook' );
function herbal_extensions_sc_facebook( $atts, $content = null ) {
	$post_id = get_the_ID();
	return '<iframe src="https://www.facebook.com/plugins/like.php?href='. get_permalink( $post_id ) .'&amp;layout=box_count&amp;show_faces=false&amp;width=100&amp;action=like&amp;font&amp;colorscheme=light&amp;height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:65px;" allowTransparency="true" async></iframe>';
}


/*-----------------------------------------------------------------------------------*/
# [digg] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'digg', 'herbal_extensions_sc_digg' );
function herbal_extensions_sc_digg( $atts, $content = null ) {
	return;
}


/*-----------------------------------------------------------------------------------*/
# [tweet] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'tweet', 'herbal_extensions_sc_tweet' );
function herbal_extensions_sc_tweet( $atts, $content = null ) {
	$post_id  = get_the_ID();
	$username = '';

	if( function_exists( 'tie_get_option' )){
		$username = tie_get_option( 'share_twitter_username' );
	}

	return '<a href="'. esc_url( 'https://twitter.com/share' ) .'" class="twitter-share-button" data-url="'. get_permalink( $post_id ) .'" data-text="'. get_the_title( $post_id ) .'" data-via="'. $username .'" data-lang="en" data-count="vertical" >tweet</a><script async src="http://platform.twitter.com/widgets.js"></script>';
}


/*-----------------------------------------------------------------------------------*/
# [stumble] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'stumble', 'herbal_extensions_sc_stumble' );
function herbal_extensions_sc_stumble( $atts, $content = null ) {
	$post_id = get_the_ID();
	return '
		<su:badge layout="5" location="'. get_permalink( $post_id ) .'"></su:badge>
		<script>
			(function() {
				var li   = document.createElement("script");
				li.type  = "text/javascript";
				li.async = true;
    		li.src   = "https://platform.stumbleupon.com/1/widgets.js";
				var s    = document.getElementsByTagName( "script" )[0];
				s.parentNode.insertBefore(li, s);
			})();
		</script>
	';
}


/*-----------------------------------------------------------------------------------*/
# [pinterest] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'pinterest', 'herbal_extensions_sc_pinterest' );
function herbal_extensions_sc_pinterest( $atts, $content = null ) {
	$post_id = get_the_ID();

	return '
		<script src="//assets.pinterest.com/js/pinit.js"></script>
		<a href="http://pinterest.com/pin/create/button/?url='. get_permalink( $post_id ) .'&amp;media='. get_the_post_thumbnail( $post_id, 'large' ) .'" class="pin-it-button" count-layout="vertical">
			<img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" />
		</a>
	';
}


/*-----------------------------------------------------------------------------------*/
# [tie_slideshow] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'tie_slideshow', 'herbal_extensions_sc_post_slideshow' );
function herbal_extensions_sc_post_slideshow( $atts, $content = null ) {

	$loader_icon = function_exists( 'tie_get_ajax_loader' ) ? tie_get_ajax_loader( false ) : '';

	do_action( 'tie_extensions_sc_before_post_slideshow' );

	return "
		<div class=\"post-content-slideshow-outer\">
			<div class=\"post-content-slideshow\">

			$loader_icon

				<div class=\"tie-slick-slider\">" .

					do_shortcode( $content ) ."

					<div class=\"slider-nav-wrapper\">
						<ul class=\"tie-slider-nav\"></ul>
					</div>
				</div><!-- tie-slick-slider -->
			</div><!-- post-content-slideshow -->
		</div><!-- post-content-slideshow-outer -->
	";
}


/*-----------------------------------------------------------------------------------*/
# [tie_slide] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'tie_slide', 'herbal_extensions_sc_post_slide' );
function herbal_extensions_sc_post_slide( $atts, $content = null ) {
	return '
		<div class="slide post-content-slide">
			'.do_shortcode( $content ) .'
		</div><!-- post-content-slide -->
	';
}


/*-----------------------------------------------------------------------------------*/
# [tabs] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'tabs', 'herbal_extensions_sc_tabs' );
function herbal_extensions_sc_tabs( $atts, $content = null ) {

	$atts = wp_parse_args( $atts, array(
		'type' => '',
	));

	extract( $atts );

	$class_type = ( $type == 'vertical' ) ? 'tabs-vertical' : 'tabs-horizontal flex-tabs is-flex-tabs-shortcodes';

	return '
		<div class="tabs-shortcode tabs-wrapper container-wrapper '. $class_type .'">'.
			do_shortcode( $content ) .'
			<div class="clearfix"></div>
		</div>
	';
}


/*-----------------------------------------------------------------------------------*/
# [tab] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'tab', 'herbal_extensions_sc_tab' );
function herbal_extensions_sc_tab( $atts, $content = null ) {
	STATIC $id = 1;

	$out ='
		<div class="tab-content" id="tab-content-'. $id .'">
			<div class="tab-content-wrap">'.
				do_shortcode( $content ) .'
			</div>
		</div>
	';

	$id++;

	return $out;
}


/*-----------------------------------------------------------------------------------*/
# [tabs_head] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'tabs_head', 'herbal_extensions_sc_tabs_head' );
function herbal_extensions_sc_tabs_head( $atts, $content = null ) {
	return '
		<ul class="tabs">'.
			do_shortcode( $content ) .'
		</ul>
	';
}


/*-----------------------------------------------------------------------------------*/
# [tab_title] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'tab_title', 'herbal_extensions_sc_tab_title' );
function herbal_extensions_sc_tab_title( $atts, $content = null ) {
	STATIC $id = 1;
	$out ='
		<li>
			<a href="#tab-content-' . $id . '">'.
				do_shortcode($content).'
			</a>
		</li>
	';

	$id++;

	return $out;
}


/*-----------------------------------------------------------------------------------*/
# [divider] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'divider', 'herbal_extensions_sc_divider' );
function herbal_extensions_sc_divider( $atts, $content = null ) {

	$atts = wp_parse_args( $atts, array(
		'style'  => 'normal',
		'top'    => 10,
		'bottom' => 10,
	));

	extract( $atts );

	return '
		<div class="clearfix"></div>
		<hr style="margin-top:'.$top.'px; margin-bottom:'.$bottom.'px;" class="divider divider-'.$style.'">
	';
}


/*-----------------------------------------------------------------------------------*/
# [tie_index] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'tie_index', 'herbal_extensions_sc_index' );
function herbal_extensions_sc_index( $atts, $content = null ) {

	if( ! function_exists( 'tie_get_option') || empty( $content )){
		return;
	}

	$index_id = sanitize_title( $content );
	$index_id = preg_replace( '/[^A-Za-z0-9\-]/', '', $index_id ); // Remove all special characters to fix an issue with non-latin languages

	return '
		<div id="'. $index_id .'" data-title="'. $content .'" class="index-title"></div>
	';
}



/*-----------------------------------------------------------------------------------*/
# [padding] Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'padding', 'herbal_extensions_sc_padding' );
function herbal_extensions_sc_padding( $atts, $content = null ) {

	// Disable on Amp
	if( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) return $content;

	$atts = wp_parse_args( $atts, array(
		'top'    => '0',
		'bottom' => '0',
		'left'   => '0',
		'right'  => '0',
		'class'  => '',
	));

	extract( $atts );

	$class .= ! empty( $top  )   ? ' has-padding-top'    : '';
	$class .= ! empty( $bottom ) ? ' has-padding-bottom' : '';
	$class .= ! empty( $left  )  ? ' has-padding-left'   : '';
	$class .= ! empty( $right )  ? ' has-padding-right'  : '';

	return '
		<div class="tie-padding '.$class.'" style="padding-left:'.$left.'; padding-right:'.$right.'; padding-top:'.$top.'; padding-bottom:'.$bottom.';">

			<p>'. do_shortcode( $content ) .'</p>

		</div>
	';
}


/*-----------------------------------------------------------------------------------*/
# Columns Shortcodes
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'one_third', 'herbal_extensions_one_third' );
function herbal_extensions_one_third( $atts, $content = null ) {
	return '
		<div class="one_third tie-columns">'.
			do_shortcode( $content ) .'
		</div>
	';
}

add_shortcode( 'one_third_last', 'herbal_extensions_one_third_last' );
function herbal_extensions_one_third_last( $atts, $content = null ) {
	return '
		<div class="one_third tie-columns last">'.
			do_shortcode( $content ) .'
		</div>
		<div class="clearfix"></div>
	';
}

add_shortcode( 'two_third', 'herbal_extensions_two_third' );
function herbal_extensions_two_third( $atts, $content = null ) {
	return '
		<div class="two_third tie-columns">'.
			do_shortcode( $content ) .'
		</div>
	';
}

add_shortcode( 'two_third_last', 'herbal_extensions_two_third_last' );
function herbal_extensions_two_third_last( $atts, $content = null ) {
	return '
		<div class="two_third tie-columns last">'.
			do_shortcode( $content ) .'
		</div>
		<div class="clearfix"></div>
	';
}

add_shortcode( 'one_half', 'herbal_extensions_one_half' );
function herbal_extensions_one_half( $atts, $content = null ) {
	return '
		<div class="one_half tie-columns">'.
			do_shortcode( $content ) .'
		</div>
	';
}

add_shortcode( 'one_half_last', 'herbal_extensions_one_half_last' );
function herbal_extensions_one_half_last( $atts, $content = null ) {
	return '
		<div class="one_half tie-columns last">'.
			do_shortcode( $content ) .'
		</div>
		<div class="clearfix"></div>
	';
}

add_shortcode( 'one_fourth', 'herbal_extensions_one_fourth' );
function herbal_extensions_one_fourth( $atts, $content = null ) {
	return '
		<div class="one_fourth tie-columns">'.
			do_shortcode( $content ) .'
		</div>
	';
}

add_shortcode( 'one_fourth_last', 'herbal_extensions_one_fourth_last' );
function herbal_extensions_one_fourth_last( $atts, $content = null ) {
	return '
		<div class="one_fourth tie-columns last">'.
			do_shortcode( $content ) .'
		</div>
		<div class="clearfix"></div>
	';
}

add_shortcode( 'three_fourth', 'herbal_extensions_three_fourth' );
function herbal_extensions_three_fourth( $atts, $content = null ) {
	return '
		<div class="three_fourth tie-columns">'.
			do_shortcode( $content ) .'
		</div>
	';
}

add_shortcode( 'three_fourth_last', 'herbal_extensions_three_fourth_last' );
function herbal_extensions_three_fourth_last( $atts, $content = null ) {
	return '
		<div class="three_fourth tie-columns last">'.
			do_shortcode( $content ) .'
		</div>
		<div class="clearfix"></div>
	';
}

add_shortcode( 'one_fifth', 'herbal_extensions_one_fifth' );
function herbal_extensions_one_fifth( $atts, $content = null ) {
	return '
		<div class="one_fifth tie-columns">'.
			do_shortcode( $content ) .'
		</div>
	';
}

add_shortcode( 'one_fifth_last', 'herbal_extensions_one_fifth_last' );
function herbal_extensions_one_fifth_last( $atts, $content = null ) {
	return '
		<div class="one_fifth tie-columns last">'.
			do_shortcode( $content ) .'
		</div>
		<div class="clearfix"></div>
	';
}

add_shortcode( 'two_fifth', 'herbal_extensions_two_fifth' );
function herbal_extensions_two_fifth( $atts, $content = null ) {
	return '
		<div class="two_fifth tie-columns">'.
			do_shortcode( $content ) .'
		</div>
	';
}

add_shortcode( 'two_fifth_last', 'herbal_extensions_two_fifth_last' );
function herbal_extensions_two_fifth_last( $atts, $content = null ) {
	return '
		<div class="two_fifth tie-columns last">'.
			do_shortcode( $content ) .'
		</div>
		<div class="clearfix"></div>
	';
}

add_shortcode( 'three_fifth', 'herbal_extensions_three_fifth' );
function herbal_extensions_three_fifth( $atts, $content = null ) {
	return '
		<div class="three_fifth tie-columns">'.
			do_shortcode( $content ) .'
		</div>
	';
}

add_shortcode( 'three_fifth_last', 'herbal_extensions_three_fifth_last' );
function herbal_extensions_three_fifth_last( $atts, $content = null ) {
	return '
		<div class="three_fifth tie-columns last">'.
			do_shortcode( $content ) .'
		</div>
		<div class="clearfix"></div>
	';
}

add_shortcode( 'four_fifth', 'herbal_extensions_four_fifth' );
function herbal_extensions_four_fifth( $atts, $content = null ) {
	return '
		<div class="four_fifth tie-columns">'.
			do_shortcode( $content ) .'
		</div>
	';
}

add_shortcode( 'four_fifth_last', 'herbal_extensions_four_fifth_last' );
function herbal_extensions_four_fifth_last( $atts, $content = null ) {
	return '
		<div class="four_fifth tie-columns last">'.
			do_shortcode( $content ) .'
		</div>
		<div class="clearfix"></div>
	';
}

add_shortcode( 'one_sixth', 'herbal_extensions_one_sixth' );
function herbal_extensions_one_sixth( $atts, $content = null ) {
	return '
		<div class="one_sixth tie-columns">'.
			do_shortcode( $content ) .'
		</div>
	';
}

add_shortcode( 'one_sixth_last', 'herbal_extensions_one_sixth_last' );
function herbal_extensions_one_sixth_last( $atts, $content = null ) {
	return '
		<div class="one_sixth tie-columns last">'.
			do_shortcode( $content ) .'
		</div>
		<div class="clearfix"></div>
	';
}

add_shortcode( 'five_sixth', 'herbal_extensions_five_sixth' );
function herbal_extensions_five_sixth( $atts, $content = null ) {
	return '
		<div class="five_sixth tie-columns">'.
			do_shortcode( $content ) .'
		</div>
	';
}

add_shortcode( 'five_sixth_last', 'herbal_extensions_five_sixth_last' );
function herbal_extensions_five_sixth_last( $atts, $content = null ) {
	return '
		<div class="five_sixth tie-columns last">'.
			do_shortcode( $content ) .'
		</div>
		<div class="clearfix"></div>
	';
}
