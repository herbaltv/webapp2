<?php
/**
 * The template part for displaying the post contents
 *
 * This template can be overridden by copying it to your-child-theme/templates/single-post/content.php.
 *
 * HOWEVER, on occasion Herbs will need to update template files and you
 * will need to copy the new files to your child theme to maintain compatibility.
 *
 * @author   Herbs
 * @version  2.1.0
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

?>

<div <?php tie_content_column_attr(); ?>>

	<?php
		/**
		 * Herbs/before_the_article hook.
		 *
		 * @hooked tie_above_post_ad - 5
		 */
		do_action( 'Herbs/before_the_article' );
	?>

	<article id="the-post" <?php tie_post_class( 'container-wrapper post-content' ); ?>>

		<?php
			/**
			 * Herbs/before_single_post_title hook.
			 *
			 * @hooked tie_post_index_shortcode - 10
			 * @hooked tie_show_post_head_featured - 20
			 */
			do_action( 'Herbs/before_single_post_title' );
		?>

		<div class="entry-content entry clearfix">

			<?php
				/**
				 * Herbs/before_post_content hook.
				 *
				 * @hooked tie_before_post_content_ad - 10
				 * @hooked tie_story_highlights - 20
				 */
				do_action( 'Herbs/before_post_content' );
			?>

			<?php the_content(); ?>

			<?php
				/**
				 * Herbs/after_post_content hook.
				 *
				 * @hooked tie_after_post_content_ad - 5
				 * @hooked tie_post_multi_pages - 10
				 * @hooked tie_post_source_via - 20
				 * @hooked tie_post_tags - 30
				 * @hooked tie_edit_post_button - 40
				 */
				do_action( 'Herbs/after_post_content' );
			?>

		</div><!-- .entry-content /-->

		<?php
			/**
			 * Herbs/after_post_entry hook.
			 *
			 * @hooked tie_mobile_toggle_content_button - 10
			 * @hooked tie_article_schemas - 10
			 * @hooked tie_post_share_bottom - 20
			 */
			do_action( 'Herbs/after_post_entry' );
		?>

	</article><!-- #the-post /-->

	<?php
		/**
		 * Herbs/before_post_components hook.
		 *
		 * @hooked tie_after_post_entry_ad - 5
		 */
		do_action( 'Herbs/before_post_components' );
	?>

	<div class="post-components">

		<?php
			/**
			 * Herbs/post_components hook.
			 *
			 * @hooked tie_post_about_author - 10
			 * @hooked tie_post_newsletter - 20
			 * @hooked tie_post_next_prev - 30
			 * @hooked tie_related_posts - 40
			 * @hooked tie_post_comments - 50
			 * @hooked tie_related_posts - 60
			 */
			do_action( 'Herbs/post_components' );
		?>

	</div><!-- .post-components /-->

	<?php
		/**
		 * Herbs/after_post_components hook.
		 */
		do_action( 'Herbs/after_post_components' );
	?>

</div><!-- .main-content -->

<?php
	/**
	 * Herbs/after_post_column hook.
	 *
	 * @hooked tie_post_fly_box - 10
	 */
	do_action( 'Herbs/after_post_column' );

