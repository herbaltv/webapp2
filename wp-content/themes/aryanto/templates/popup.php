<?php
/**
 * Popup
 *
 * This template can be overridden by copying it to your-child-theme/templates/popup.php.
 *
 * HOWEVER, on occasion Herbs will need to update template files and you
 * will need to copy the new files to your child theme to maintain compatibility.
 *
 * @author 		Herbs
 * @version   4.0.0
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly


// Search popup module
if( tie_menu_has_search( 'top_nav', false, true ) || tie_menu_has_search( 'main_nav', false, true ) ){

	$live_search_class = '';

	if( tie_menu_has_search( 'top_nav', true ) || tie_menu_has_search( 'main_nav', true ) ){
		$live_search_class = 'class="is-ajax-search" ';
	}
	?>
	<div id="tie-popup-search-wrap" class="tie-popup">

		<a href="#" class="tie-btn-close remove big-btn light-btn">
			<span class="screen-reader-text"><?php esc_html_e( 'Close', HERBS_TEXTDOMAIN ); ?></span>
		</a>
		<div class="container">
			<div class="popup-search-wrap-inner">
				<div class="tie-row">
					<div id="pop-up-live-search" class="tie-col-md-12 live-search-parent" data-skin="live-search-popup" aria-label="<?php esc_html_e( 'Search', HERBS_TEXTDOMAIN ); ?>">
						<form method="get" id="tie-popup-search-form" action="<?php echo esc_url(home_url( '/' )); ?>/">
							<input id="tie-popup-search-input" <?php echo ( $live_search_class ); ?>type="text" name="s" title="<?php esc_html_e( 'Search for', HERBS_TEXTDOMAIN ) ?>" autocomplete="off" placeholder="<?php esc_html_e( 'Type and hit Enter', HERBS_TEXTDOMAIN ) ?>" />
							<button id="tie-popup-search-submit" type="submit">
								<span class="" aria-hidden="true">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" class="fill-currentcolor">
								<path d="M15.4,12.6l-4-4c1.1-2.2,0.7-5-1.2-6.8C9.1,0.6,7.5,0,6,0S2.9,0.6,1.8,1.8c-2.3,2.3-2.3,6.1,0,8.5
									C2.9,11.4,4.5,12,6,12c0.9,0,1.8-0.2,2.6-0.6l4,4C13,15.8,13.5,16,14,16s1-0.2,1.4-0.6C16.2,14.6,16.2,13.4,15.4,12.6z M3.2,8.8
									c-1.6-1.6-1.6-4.1,0-5.7C3.9,2.4,4.9,2,6,2s2.1,0.4,2.8,1.2c1.6,1.6,1.6,4.1,0,5.7C8.1,9.6,7.1,10,6,10S3.9,9.6,3.2,8.8z"></path>
								</svg>
								</span>
								<span class="screen-reader-text"><?php esc_html_e( 'Search for', HERBS_TEXTDOMAIN ) ?></span>
							</button>
						</form>
						<div class="response-search">
							<p><strong>Rekomendasi Pencarian Herbal TV</strong></p>
							<p class="bytag"> 
							<?php
							wp_tag_cloud( array(
								'smallest' => 1, // size of least used tag
								'largest'  => 1, // size of most used tag
								'unit'     => 'em', // unit for sizing the tags
								'number'   => 5, // displays at most 45 tags
								'format'  => 'flat',
								'orderby'  => 'count', // order tags alphabetically
								'order'    => 'ASC', // order tags by ascending order
								'taxonomy' => 'post_tag' // you can even make tags for custom taxonomies
							) );
							?>
							</p>
							<p><a href="./?s=Tanaman+Obat+Keluarga">Tanaman Obat Keluarga (TOGA)</a></p>
							<p><a href="./?s=Manfaat+Tanaman+Untuk+Kesehatan">Manfaat Tanaman Untuk Kesehatan</a></p>
							<p><a href="./?s=Obat+Herbal+Murah">Obat Herbal Murah</a></p>
							<p><a href="./?s=Parenting+Anak+dan+Keluarga">Parenting Anak dan Keluarga</a></p>
							<p><a href="./?s=Video+Herbal+Kesehatan">Video Herbal Kesehatan</a></p>
							<p><a href="./?s=Mengatasi+Penyakit+Diabetes">Mengatasi Penyakit Diabetes</a></p>
						</div>
					</div><!-- .tie-col-md-12 /-->
				</div><!-- .tie-row /-->
			</div><!-- .popup-search-wrap-inner /-->
		</div><!-- .container /-->
	</div><!-- .tie-popup-search-wrap /-->
	<?php
}

// Login popup module
if( ! is_user_logged_in() &&
		( tie_get_option( 'top_nav' ) && tie_get_option( 'top-nav-components_login'  ) ) ||
		( tie_get_option( 'main_nav' ) && tie_get_option( 'main-nav-components_login' ) ) ||
		( tie_get_option( 'mobile-components_login' ) )
	){
	?>
	<div id="tie-popup-login" class="tie-popup">
		<a href="#" class="tie-btn-close remove big-btn light-btn">
			<span class="screen-reader-text"><?php esc_html_e( 'Close', HERBS_TEXTDOMAIN ); ?></span>
		</a>
		<div class="tie-popup-container">
			<div class="container-wrapper">
				<div class="widget login-widget">

					<div <?php tie_box_class( 'widget-title' ) ?>>
						<div class="the-subtitle"><?php echo esc_html__( 'Log In', HERBS_TEXTDOMAIN ) ?> <span class="widget-title-icon fa"></span></div>
					</div>

					<div class="widget-container">
						<?php tie_login_form(); ?>
					</div><!-- .widget-container  /-->
				</div><!-- .login-widget  /-->
			</div><!-- .container-wrapper  /-->
		</div><!-- .tie-popup-container /-->
	</div><!-- .tie-popup /-->
	<?php
}
