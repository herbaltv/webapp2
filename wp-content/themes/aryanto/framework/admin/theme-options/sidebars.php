<?php

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Sidebars Settings', HERBS_TEXTDOMAIN ),
			'id'    => 'sidebars-settings-tab',
			'type'  => 'tab-title',
		));

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Sidebars Settings', HERBS_TEXTDOMAIN ),
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Sticky Sidebar', HERBS_TEXTDOMAIN ),
			'id'     => 'sticky_sidebar',
			'type'   => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'name'  => esc_html__( 'Widgets icon', HERBS_TEXTDOMAIN ),
			'id'    => 'widgets_icon',
			'type'  => 'checkbox',
		));

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Default Sidebar Position', HERBS_TEXTDOMAIN ),
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'id'      => 'sidebar_pos',
			'type'    => 'visual',
			'options' => array(
				'right'	     => array( esc_html__( 'Sidebar Right', HERBS_TEXTDOMAIN ) => 'sidebars/sidebar-right.png' ),
				'left'	     => array( esc_html__( 'Sidebar Left', HERBS_TEXTDOMAIN ) => 'sidebars/sidebar-left.png' ),
				'full'	     => array( esc_html__( 'Without Sidebar', HERBS_TEXTDOMAIN ) => 'sidebars/sidebar-full-width.png' ),
				'one-column' => array( esc_html__( 'One Column', HERBS_TEXTDOMAIN ) => 'sidebars/sidebar-one-column.png' ),
			)));

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Add Custom Sidebar', HERBS_TEXTDOMAIN ),
			'type'  => 'header',
		));

	?>

	<div class="option-item">

		<span class="tie-label"><?php esc_html_e( 'Sidebar Name', HERBS_TEXTDOMAIN ) ?></span>

		<input id="sidebarName" type="text" size="56" style="direction:ltr; text-laign:left" name="sidebarName" value="">
		<input id="sidebarAdd" class="button" type="button" value="<?php esc_html_e( 'Add', HERBS_TEXTDOMAIN ) ?>">

		<?php

			tie_build_theme_option(
				array(
					'text' => esc_html__( 'Please add a name for the sidebar.', HERBS_TEXTDOMAIN ),
					'id'   => 'custom_sidebar_error',
					'type' => 'error',
				));

		?>

		<ul id="sidebarsList">

			<?php

				$sidebars = tie_get_option( 'sidebars' );
				if( ! empty( $sidebars ) && is_array( $sidebars ) ){
					foreach ( $sidebars as $sidebar ){ ?>
						<li class="parent-item">
							<div class="tie-block-head">
								<?php echo esc_html( $sidebar ) ?>
								<input id="tie_sidebars" name="tie_options[sidebars][]" type="hidden" value="<?php echo esc_attr( $sidebar ) ?>" />
								<a class="del-custom-sidebar del-item dashicons dashicons-trash"></a>
							</div>
						</li>
						<?php
					}
				}

			?>

		</ul>
	</div>

	<?php



	echo "<div id=\"custom-sidebars\">";

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Custom Sidebars', HERBS_TEXTDOMAIN ),
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Home Sidebar', HERBS_TEXTDOMAIN ),
			'id'      => 'sidebar_home',
			'type'    => 'select',
			'options' => HERBS_ADMIN_HELPER::get_sidebars(),
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Single Page Sidebar', HERBS_TEXTDOMAIN ),
			'id'      => 'sidebar_page',
			'type'    => 'select',
			'options' => HERBS_ADMIN_HELPER::get_sidebars(),
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Single Article Sidebar', HERBS_TEXTDOMAIN ),
			'id'      => 'sidebar_post',
			'type'    => 'select',
			'options' => HERBS_ADMIN_HELPER::get_sidebars(),
		));

	tie_build_theme_option(
		array(
			'name'    => esc_html__( 'Archives Sidebar', HERBS_TEXTDOMAIN ),
			'id'      => 'sidebar_archive',
			'type'    => 'select',
			'options' => HERBS_ADMIN_HELPER::get_sidebars(),
		));

	echo "</div>";
