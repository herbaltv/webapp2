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


if( tie_get_option( 'mobile_footer_featured' ) && tie_is_mobile()){

	$args = array(
		'logo' => tie_get_option( 'logo' )
	);

	?>
	<div id="footer-mobile-featured">
		<div class="mobile-featured container">
			<div class="fm-logo fm-row">
				<img width="200px" height="62px" src="http://dev.herbaltv.co.id/wp-content/uploads/2020/01/herbaltv-new-logo-mini-sticky.png" class="attachment-medium size-medium" alt="">
			</div>
			<div class="fm-menu fm-row">
				<ul class="nav nav--center">
					<li class="nav__item">
						<a onclick="_pt(this, &quot;footer&quot;, &quot;menu footer&quot;, &quot;menu redaksi&quot;)" href="https://m.detik.com/redaksi">Redaksi</a>
					</li>
					<li class="nav__item">
						<a onclick="_pt(this, &quot;footer&quot;, &quot;menu footer&quot;, &quot;menu pedoman media siber&quot;)" href="https://m.detik.com/pedoman-media">Pedoman Media Siber</a>
					</li>
					<li class="nav__item">
						<a onclick="_pt(this, &quot;footer&quot;, &quot;menu footer&quot;, &quot;menu karir&quot;)" href="https://www.detik.com/karir">Karir</a>
					</li>
					<li class="nav__item">
						<a onclick="_pt(this, &quot;footer&quot;, &quot;menu footer&quot;, &quot;menu kotak pos&quot;)" href="https://m.detik.com/kotak-pos">Kotak Pos</a>
					</li>
					<li class="nav__item">
						<a onclick="_pt(this, &quot;footer&quot;, &quot;menu footer&quot;, &quot;menu info iklan&quot;)" href="https://m.detik.com/beriklan">Info Iklan</a>
					</li>
					<li class="nav__item">
						<a onclick="_pt(this, &quot;footer&quot;, &quot;menu footer&quot;, &quot;menu privacy policy&quot;)" href="https://m.detik.com/privacy-policy">Privacy Policy</a>
					</li>
					<li class="nav__item">
						<a onclick="_pt(this, &quot;footer&quot;, &quot;menu footer&quot;, &quot;menu disclaimer&quot;)" href="https://m.detik.com/disclaimer">Disclaimer</a>
					</li>
				</ul>
			</div>
			<div class="fm-socialmedia fm-row">
				<div class="widget social-icons-widget widget-content-only"><ul class="solid-social-icons"><li class="social-icons-item"><a class="social-link facebook-social-icon" rel="nofollow noopener" target="_blank" href="#"><span class="fa fa-facebook"></span><span class="screen-reader-text">Facebook</span></a></li><li class="social-icons-item"><a class="social-link twitter-social-icon" rel="nofollow noopener" target="_blank" href="#"><span class="fa fa-twitter"></span><span class="screen-reader-text">Twitter</span></a></li><li class="social-icons-item"><a class="social-link youtube-social-icon" rel="nofollow noopener" target="_blank" href="#"><span class="fa fa-youtube-play"></span><span class="screen-reader-text">YouTube</span></a></li><li class="social-icons-item"><a class="social-link instagram-social-icon" rel="nofollow noopener" target="_blank" href="#"><span class="fa fa-instagram"></span><span class="screen-reader-text">Instagram</span></a></li></ul> 
				<div class="clearfix"></div></div>
			</div>
			<div class="fm-copyright fm-row">
				2020 Copyright Herbal TV
			</div>
		</div>
	</div>

	<?php
}
