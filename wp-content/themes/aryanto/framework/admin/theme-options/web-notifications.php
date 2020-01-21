<?php

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Web Notifications', HERBS_TEXTDOMAIN ),
			'id'    => 'web-notifications-tab',
			'type'  => 'tab-title',
		));

	?>


	<div class="foxpush-intro">
		<a href="<?php echo apply_filters( 'Herbs/External/foxpush', '' ); ?>" target="_blank" class="navbar-brand smooth-scroll">
			<object type="image/svg+xml" style="max-width: 380px;pointer-events: none;" data="<?php echo HERBS_TEMPLATE_URL ?>/framework/admin/assets/images/foxpush.svg"></object>
		</a>

		<h3><?php esc_html_e( "Web Push notifications allow your users to opt-in to timely updates from your website. and allow you to effectively re-engage them with customized, engaging content whenever they are online, wherever they may be - even on their phones! It's easy to set up, and no technical skills are required.", HERBS_TEXTDOMAIN ); ?></h3>

		<a class="tie-primary-button button button-primary button-hero" href="<?php echo apply_filters( 'Herbs/External/foxpush', '' ); ?>" target="_blank"><?php esc_html_e( 'Sign up for FREE', HERBS_TEXTDOMAIN ) ?></a>

	</div>

	<?php

	$foxpush_class = get_option( 'tie_foxpush_code_'. HERBS_THEME_ID ) ? 'foxpush-is-active' : 'foxpush-is-not-active';

	tie_build_theme_option(
		array(
			'title' =>	esc_html__( 'FoxPush Setup', HERBS_TEXTDOMAIN ),
			'type'  => 'header',
		));

	tie_build_theme_option(
		array(
			'name'   => esc_html__( 'Enable', HERBS_TEXTDOMAIN ),
			'id'     => 'web_notifications',
			'toggle' => '#foxpush-all-options',
			'type'   => 'checkbox',
		));

	echo '<div id="foxpush-all-options" class="'. $foxpush_class .'">';





		# SSl Setup
		if( HERBS_HELPER::is_ssl() && ! file_exists( $_SERVER['DOCUMENT_ROOT'].'/foxpush_worker.js' ) ){

			$foxpush_code   = explode( '_',  get_option( 'tie_foxpush_code_'. HERBS_THEME_ID ) );
			tie_build_theme_option(
				array(
					'id'   => 'foxpush-ssl-file',
					'text' => '<strong>'. esc_html__( 'One more step!', HERBS_TEXTDOMAIN ) .'</strong><br>' . sprintf( wp_kses_post( '<a href="%s">Download the setup files</a>. Unzip the archive and upload the files into the top-level directory ( public_html , or "/") of your website.', HERBS_TEXTDOMAIN ), "https://www.foxpush.com/downloads/native-$foxpush_code[0].zip" ),
					'type' => 'message',
				));
		}

		# Instructions
		echo '
			<div id="foxpush-instructions" class="option-item">
				<h5>'. esc_html__( 'How to get your API Key?', HERBS_TEXTDOMAIN ) .'</h5>
				<ul style="list-style-type: disc; list-style-position: inside; padding: 0 20px;">
				 <li>'. esc_html__( 'Make sure you are logged into FoxPush.', HERBS_TEXTDOMAIN ) .'</li>
				 <li>'. esc_html__( 'From the navigation panel on the admin dashboard, click on Settings and then on API Keys.', HERBS_TEXTDOMAIN ) .'</li>
				 <li>'. esc_html__( 'Click on Generate New Key.', HERBS_TEXTDOMAIN ) .'</li>
				 <li>'. esc_html__( 'Choose your Domain Name. then click the Generate button.', HERBS_TEXTDOMAIN ) .'</li>
				 <li>'. esc_html__( 'Copy the Domain and the key and add them in the fields below.', HERBS_TEXTDOMAIN ) .'</li>
				</ul>
			</div>
		';

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'FoxPush Domain', HERBS_TEXTDOMAIN ),
				'id'   => 'foxpush_domain',
				'type' => 'text',
			));

		tie_build_theme_option(
			array(
				'name' => esc_html__( 'API Key', HERBS_TEXTDOMAIN ),
				'id'   => 'foxpush_api',
				'type' => 'text',
			));

	?>


	<div id="foxpush-stats">

	<?php

		$get_foxpush = new HERBS_FOXPUSH();

		$chart = $get_foxpush->get_statistics();
		$stats = $get_foxpush->get_statistics( 'stats' );

		if( ! empty( $chart ) || ! empty( $stats ) ){

			tie_build_theme_option(
				array(
					'title' =>	esc_html__( 'Statistics (Updated Hourly)', HERBS_TEXTDOMAIN ),
					'type'  => 'header',
				));
		}


		# Statistics
		if( ! empty( $stats ) && is_array( $stats ) ){

			$stats_data[] = array( $stats['total_subscribers'], esc_html__( 'Subscribers',  HERBS_TEXTDOMAIN ) );
			$stats_data[] = array( $stats['total_campaigns'],   esc_html__( 'Campaigns',    HERBS_TEXTDOMAIN ) );
			$stats_data[] = array( $stats['total_views'],       esc_html__( 'Total Views',  HERBS_TEXTDOMAIN ) );
			$stats_data[] = array( $stats['total_clicks'],      esc_html__( 'Total Clicks', HERBS_TEXTDOMAIN ) );

			echo '<div class="web-notifications-stats-box option-item">';
			foreach ( $stats_data as $stats ){
				echo '
				  <div class="web-notifications-stats">
						<span class="box-desc">'. $stats[1] .'</span>
						<p class="box-num">'. number_format_i18n( $stats[0] ) .'</p>
				  </div>
				';
			}
			echo '</div>';
		}


		# Charts
		if( ! empty( $chart ) && is_array( $chart ) ){
			?>

			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

			<script type="text/javascript">

			  google.charts.load('current', {'packages':['corechart']});
			  google.charts.setOnLoadCallback(tieWebNotificationsDrawChart);

				function tieWebNotificationsDrawChart(){

					if ( typeof google.visualization !== 'undefined' ){

						var data = google.visualization.arrayToDataTable([
						  ['Date', '<?php esc_html_e( 'Subscribers', HERBS_TEXTDOMAIN )  ?>',],
						  <?php

								foreach ( $chart as $value ){
									$date = $value['date'];
									$subs = $value['subscribers'];

									echo "['$date',  $subs ],";
								}

						   ?>
						]);

						var options = {
						  curveType: 'function',
						  width: document.getElementById('tie_form').offsetWidth,
						  height: 450,
						  chartArea: {'width': '90%'},
						  legend: { position: 'bottom' },
						  hAxis: {
							  textStyle: {
									color: '#afafaf',
									fontSize: 11,
									fontName: '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
							  },
							},
							vAxis: {
							  textStyle: {
									color: '#888',
									fontSize: 16,
									fontName: '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
							  },
							  gridlines: {color: '#eee'},
							  baselineColor: '#999',
							},
							reverseCategories: true,
							colors: ['#65b70e'],
						};

						var chart = new google.visualization.LineChart(document.getElementById('tie_WebNotifications_curve_chart'));

						chart.draw(data, options);
					}
				}

				jQuery(window).resize(function(){
					tieWebNotificationsDrawChart();
				});
			</script>
			<div id="tie_WebNotifications_curve_chart"></div>
		<?php
	}

	echo '</div> <!-- FoxPush Stats -->';
	echo '</div><!-- foxpush-all-options -->';
