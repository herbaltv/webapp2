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


if( tie_get_option( 'footer_download_apps' ) && ! tie_get_option( 'mobile_hide_downloadapps' )){

	$args = array(
		'handsimage' => tie_get_option( 'footer_dd_handsimage' ),
		'description'   => tie_get_option( 'footer_dd_description' ),
		'androidlink'     => tie_get_option( 'footer_dd_link_android', 'file' ),
	);

	?>
	<div id="download-apps-section">
		<div id="android-download" class="download-apps hb-container">
			<div class="hb-row container">
				<div class="hands-on hb-column">
					<img width="300" height="250" src="<?php $args['handsimage']; ?>" class="attachment-medium size-medium" alt="" srcset="http://dev1.herbaltv.co.id/wp-content/uploads/2019/12/hphand-300x250.png 300w, http://dev1.herbaltv.co.id/wp-content/uploads/2019/12/hphand.png 474w" sizes="(max-width: 300px) 100vw, 300px">
				</div>
				<div class="dd-description hb-column">
					<table border="0">
					<tbody>
					<tr>
					<td><span style="color: #ffffff;"><?php echo $args['description']; ?></span>
					</td>
					<td><a href="<?php echo $args['androidlink']; ?>"><img src="http://dev.herbaltv.co.id/wp-content/uploads/2020/01/android.png"></a></td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<?php
}
