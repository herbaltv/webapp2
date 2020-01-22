<?php
/**
 * Instagram Above Footer
 *
 * This template can be overridden by copying it to your-child-theme/templates/footers/footer-instagram.php.
 *
 * HOWEVER, on occasion Herbs will need to update template files and you
 * will need to copy the new files to your child theme to maintain compatibility.
 *
 * @author 		Herbs
 * @version   4.0.0
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly


if( tie_get_option( 'footer_mobile_featured' ) && tie_is_mobile()){

	$args = array(
		'logo' => tie_get_option( 'footer_mobile_featured_logo' ),
		'menu' => tie_get_option( 'footer_mobile_featured_menu' ),
		'socialicon' => tie_get_option( 'footer_mobile_featured_socialicon' ),
		'copyright' => tie_get_option( 'footer_mobile_featured_copyright' ),
	);

	?>
	<div id="footer-mobile-featured">
		<div class="mobile-featured container">
			<div class="fm-logo fm-row">
				<img width="200px" height="62px" src="<?php echo $args['logo']; ?>" class="attachment-medium size-medium" alt="">
			</div>
			<div class="fm-menu fm-row">
				<?php echo $args['menu']; ?>
			</div>
			<div class="fm-socialmedia fm-row">
				<?php echo $args['socialicon']; ?>
			</div>
			<div class="fm-copyright fm-row">
				<?php echo $args['copyright']; ?>
			</div>
		</div>
	</div>

	<?php
}
