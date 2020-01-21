<?php
/**
 * Top Tag
 *
**/

defined( 'ABSPATH' ) || exit; // Exit if accessed directly
?>
<div id="popular-tags" class="front-page popular-list">
	<div class="pc-container">
		<div class="pc-wrapper scroll">
			<nav>
			<?php
			wp_tag_cloud( array(
				'smallest' => 1, // size of least used tag
				'largest'  => 1, // size of most used tag
				'unit'     => 'em', // unit for sizing the tags
				'number'   => 5, // displays at most 45 tags
				'orderby'  => 'count', // order tags alphabetically
				'order'    => 'ASC', // order tags by ascending order
				'taxonomy' => 'post_tag' // you can even make tags for custom taxonomies
			 ) );
			?>
			</nav>
		</ul>
	</div>
</div>