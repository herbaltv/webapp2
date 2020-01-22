<?php
/**
 * Weather Class
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly




if( ! class_exists( 'HERBS_WEATHER' )){

	class HERBS_WEATHER {

		public $atts;
		public $api_key;
		public $location;
		public $locale;
		public $city_slug;
		public $units;
		public $transient_name;
		public $today_high;
		public $today_low;
		public $units_display;
		public $days_to_show;


		/**
		 *
		 */
		function __construct( $atts ) {

			if( ! tie_get_option( 'api_openweather' ) ){
				return HERBS_HELPER::notice_message( esc_html__( 'You need to set the Weather API Key in the theme options page > API Keys.', HERBS_TEXTDOMAIN ) );
			}

			if( empty( $atts['location'] ) ){
				return HERBS_HELPER::notice_message( esc_html__( 'You need to set the Location.', HERBS_TEXTDOMAIN ) );
			}

			$this->atts           = $atts;
			$this->api_key        = HERBS_HELPER::remove_spaces( tie_get_option( 'api_openweather' ) );
			$this->location       = $this->atts['location'];
			$this->locale         = $this->get_locale();
			$this->city_slug      = is_numeric( $this->location ) ? $this->location : sanitize_title( $this->location );
			$this->units          = ( isset( $atts['units'] ) AND strtoupper( $atts['units'] ) == 'C' ) ? 'metric' : 'imperial';
			$this->units_display  = $this->units == 'metric' ? '&#x2103;' : '&#x2109;';
			$this->transient_name = 'tie_weather_' . $this->city_slug . '_' . strtolower( $this->units ) . '_' . $this->locale;
			$this->days_to_show   = isset( $this->atts['forecast_days'] ) ? $this->atts['forecast_days'] : 5;

			// Get the Weather
			$this->show();
		}


		/**
		 * Show the Weather
		 */
		private function show(){

			$weather_data = $this->get_weather();

			if( ! is_array( $weather_data ) ){
				return;
			}

			$output      = '';
			$today       = $weather_data['now'];
			$city_name   = ! empty( $this->atts['custom_name'] ) ? $this->atts['custom_name']   : $today->name;
			$is_animated = ! empty( $this->atts['animated'] )    ? 'is-animated'                : '';
			$speed_text  = ( $this->units == 'metric')           ? esc_html__( 'km/h', HERBS_TEXTDOMAIN ) : esc_html__( 'mph', HERBS_TEXTDOMAIN );
			$weather_id  = ! empty( $today->weather[0]->id )     ? $today->weather[0]->id : 800;
			$description = $this->get_description( $weather_id );

			// Today's Icon
			$icon_slug = ! empty( $this->atts['debug'] ) ? $this->atts['debug'] : $today->weather[0]->icon;
			$the_icon  = $this->weather_icon( $icon_slug );

			// Today's weather data
			$today_temp       = isset( $today->main->temp )     ? round( $today->main->temp )     : false;
			$this->today_high = isset( $today->main->temp_max ) ? round( $today->main->temp_max ) : false;
			$this->today_low 	= isset( $today->main->temp_min ) ? round( $today->main->temp_min ) : false;

			// Get Forecast Data
			$forecast_out = $this->forecast( $weather_data );

			// Display the weather | NORMAL LAYOUT
			if( empty( $this->atts['compact'] ) ){ ?>

				<div id="tie-weather-<?php echo $this->city_slug ?>" class="weather-wrap <?php echo $is_animated ?>">

					<div class="weather-icon-and-city">
						<?php echo $the_icon; ?>
						<div class="weather-name"><?php echo $city_name; ?></div>
						<div class="weather-desc"><?php echo $description ?></div>
					</div>

					<div class="weather-todays-stats">

						<div class="weather-current-temp">
							<?php echo $today_temp ?>
							<sup><?php echo $this->units_display; ?></sup>
						</div>

						<div class="weather-more-todays-stats">

						<?php if( ! empty( $this->today_high ) && ! empty( $this->today_low ) ){ ?>
							<div class="weather_highlow">
								<span aria-hidden="true" class="tie-icon-thermometer-half"></span> <?php echo $this->today_high; ?>&ordm; - <?php echo $this->today_low; ?>&ordm;
							</div>
						<?php } ?>

							<div class="weather_humidty">
								<span aria-hidden="true" class="tie-icon-raindrop"></span>
								<span class="screen-reader-text"><?php esc_html__( 'humidity:', HERBS_TEXTDOMAIN ) ?></span> <?php echo $today->main->humidity ?>%
							</div>

							<div class="weather_wind">
								<span aria-hidden="true" class="tie-icon-wind"></span>
								<span class="screen-reader-text"><?php esc_html__( 'wind:', HERBS_TEXTDOMAIN ) ?></span> <?php echo $today->wind->speed .' '. $speed_text ?></div>
						</div>
					</div> <!-- /.weather-todays-stats -->

					<?php if( $this->days_to_show != 'hide' ){ ?>
						<div class="weather-forecast small-weather-icons weather_days_<?php echo $this->days_to_show ?>">
							<?php echo $forecast_out ?>
						</div><!-- /.weather-forecast -->
					<?php } ?>

				</div> <!-- /.weather-wrap -->

				<?php
			}

			// Display the weather | Comapct LAYOUT
			else{ ?>

				<div class="tie-weather-widget <?php echo $is_animated ?>" title="<?php echo $description ?>">
					<div class="weather-wrap">

						<div class="weather-forecast-day small-weather-icons">
							<?php echo $the_icon; ?>
						</div><!-- .weather-forecast-day -->

						<div class="city-data">
							<span><?php echo $city_name; ?></span>
						  <span class="weather-current-temp">
						  	<?php echo $today_temp ?>
						  	<sup><?php echo $this->units_display; ?></sup>
						  </span>
						</div><!-- .city-data -->

					</div><!-- .weather-wrap -->
				</div><!-- .tie-weather-widget -->
				<?php
			}

		}


		/**
		 * Get the Forecast Weather data
		 */
		private function forecast( $weather_data ){

			if( empty( $weather_data['forecast'] )|| empty( $weather_data['forecast']->list ) ) return;

			$forecast_days = array();
			$forecast_out  = '';
			$today_date    = date( 'Ymd', current_time( 'timestamp', 0 ) );

			// The Api Returns 5 day / 3 hour forecast data so we need to collapse them and
			foreach( (array) $weather_data['forecast']->list as $forecast ){

				$day_of_week = date( 'Ymd', $forecast->dt );

				// Days after today only ----------
				if( $today_date > $day_of_week ) continue;

				// If it is today lets get the max and min
				if( $today_date == $day_of_week ){

					if( ! empty( $forecast->main->temp_max ) && $forecast->main->temp_max > $this->today_high ){
						$this->today_high = round( $forecast->main->temp_max );
					}

					if( ! empty( $forecast->main->temp_min ) && $forecast->main->temp_min < $this->today_low ){
						$this->today_low = round( $forecast->main->temp_min );
					}
				}

				// Rest Days
				if( empty( $forecast_days[ $day_of_week ] ) ){

					$forecast_days[ $day_of_week ] = array(
						'utc'  => $forecast->dt,
						'icon' => $forecast->weather[0]->icon,
						'temp' => ! empty( $forecast->main->temp_max ) ? round( $forecast->main->temp_max ) : '',
					);
				}
				else{

					// Get the max temp in the day
					if( $forecast->main->temp_max > $forecast_days[ $day_of_week ]['temp'] ){
						$forecast_days[ $day_of_week ]['temp'] = round( $forecast->main->temp_max );

						// Chnage the icon of the day to the max icon
						$forecast_days[ $day_of_week ]['icon'] = $forecast->weather[0]->icon;
					}
				}
			}

			// Show the Forecast data
			$days = 1;
			foreach( $forecast_days as $forecast_day ){

				$forecast_icon = $this->weather_icon( $forecast_day['icon'] );
				$the_day = date_i18n( 'D', $forecast_day['utc'] );

				$forecast_out .= "
					<div class=\"weather-forecast-day\">
						{$forecast_icon}
						<div class=\"weather-forecast-day-temp\">{$forecast_day['temp']}<sup>{$this->units_display}</sup></div>
						<div class=\"weather-forecast-day-abbr\">{$the_day}</div>
					</div>
				";

				if( $days == $this->days_to_show ){
					break;
				}

				$days++;
			}

			return $forecast_out;
		}


		/**
		 * Get Locale
		 */
		private function get_locale(){

			$available_locales = array( 'en', 'ru', 'it', 'es', 'uk', 'de', 'pt', 'ro', 'pl', 'fi', 'nl', 'fr', 'bg', 'sv', 'zh_tw', 'zh_cn', 'tr', 'hr', 'ca' );

			// Set the language
			$locale = in_array( get_locale(), $available_locales ) ? get_locale() : 'en';

			// Check for locale by first two digits
			if( in_array( substr( get_locale(), 0, 2 ), $available_locales )){
				$locale = substr( get_locale(), 0, 2 );
			}

			return $locale;
		}


		/**
		 * Get Weather Description
		 */
		private function get_description( $id ){

			if( $id < 300 )
				return esc_html__( 'Thunderstorm', HERBS_TEXTDOMAIN );

			elseif( $id < 400 )
				return esc_html__( 'Drizzle', HERBS_TEXTDOMAIN );

			elseif( $id == 500 )
				return esc_html__( 'Light Rain', HERBS_TEXTDOMAIN );

			elseif( $id == 502 || $id == 503 || $id == 504 )
				return esc_html__( 'Heavy Rain', HERBS_TEXTDOMAIN );

			elseif( $id < 600 )
				return esc_html__( 'Rain', HERBS_TEXTDOMAIN );

			elseif( $id < 700 )
				return esc_html__( 'Snow', HERBS_TEXTDOMAIN );

			elseif( $id < 800 )
				return esc_html__( 'Mist', HERBS_TEXTDOMAIN );

			elseif( $id == 800 )
				return esc_html__( 'Clear Sky', HERBS_TEXTDOMAIN );

			elseif( $id > 800 )
				return esc_html__( 'Scattered Clouds', HERBS_TEXTDOMAIN );

		}


		/**
		 * Get the Weather data array
		 */
		private function get_weather(){

			if( ! $weather_data = get_transient( $this->transient_name ) ){

				$weather_data = array(
					'now'      => $this->remote_get('weather'),
					'forecast' => $this->remote_get('forecast'),
				);

				foreach ( $weather_data as $key => $value ){
					if( is_array( $value ) && ! empty( $value['error'] ) ){
						return HERBS_HELPER::notice_message( $value['error'] );
						break;
					}
				}

				if( $weather_data['now'] && $weather_data['forecast'] ){
					set_transient( $this->transient_name, $weather_data, 2 * HOUR_IN_SECONDS );
				}
			}

			return $weather_data;
		}


		/**
		 * API connection with the API
		 */
		private function remote_get( $type = 'weather' ){

			$query = is_numeric( $this->location ) ? array( 'id' => $this->location ) : array( 'q' => strtolower( $this->location ) );
			$query['lang']  = $this->locale;
			$query['units'] = $this->units;
			$query['appid'] = $this->api_key;

			$api_url = add_query_arg( $query, 'http://api.openweathermap.org/data/2.5/'.$type );

			$api_connect = wp_remote_get( $api_url, array( 'timeout' => 10 ) );

			// return if there is an error
			if( is_wp_error( $api_connect ) ){

				tie_debug_log( $api_connect->get_error_message() );

				return array( 'error' => $api_connect->get_error_message() );
			}

			$the_data = json_decode( $api_connect['body'] );

			// return if there is an error
			if( isset( $the_data->cod ) && $the_data->cod != 200 ){

				tie_debug_log( $the_data->message );

				return array( 'error' => $the_data->message );
			}

			return $the_data;
		}


		/**
		 * Get the Weather Icon
		 */
		function weather_icon( $icon ){

			// Sunny
			if( $icon == '01d' ){
				$weather_icon = '
					<div class="weather-icon">
						<div class="icon-sun"></div>
					</div>
				';
			}
			// Moon
			elseif( $icon == '01n' ){
				$weather_icon = '
					<div class="weather-icon">
						<div class="icon-moon"></div>
					</div>
				';
			}
			// Cloudy Sunny
			elseif( $icon == '02d' || $icon == '03d' || $icon == '04d' ){
				$weather_icon = '
					<div class="weather-icon">
	          <div class="icon-cloud"></div>
	          <div class="icon-cloud-behind"></div>
	          <div class="icon-basecloud-bg"></div>
	          <div class="icon-sun-animi"></div>
	        </div>
				';
			}
			// Cloudy Night
			elseif( $icon == '02n' || $icon == '03n'  || $icon == '04n' ){
				$weather_icon = '
					<div class="weather-icon">
						<div class="icon-cloud"></div>
						<div class="icon-cloud-behind"></div>
						<div class="icon-basecloud-bg"></div>
						<div class="icon-moon-animi"></div>
					</div>
				';
			}
			// Showers
			elseif( $icon == '09d' ||  $icon == '09n'){
				$weather_icon = '
					<div class="weather-icon drizzle-icons showers-icons">
						<div class="basecloud"></div>
						<div class="animi-icons-wrap">
							<div class="icon-rainy-animi"></div>
							<div class="icon-rainy-animi-2"></div>
							<div class="icon-rainy-animi-4"></div>
							<div class="icon-rainy-animi-5"></div>
						</div>
					</div>
				';
			}
			// Rainy Sunny
			elseif( $icon == '10d' ){
				$weather_icon = '
					<div class="weather-icon">
	          <div class="basecloud"></div>
	          <div class="icon-basecloud-bg"></div>
	          <div class="animi-icons-wrap">
	            <div class="icon-rainy-animi"></div>
	            <div class="icon-rainy-animi-2"></div>
	            <div class="icon-rainy-animi-4"></div>
	            <div class="icon-rainy-animi-5"></div>
	          </div>
	          <div class="icon-sun-animi"></div>
	        </div>
				';
			}
			// Rainy Night
			elseif( $icon == '10n' ){
				$weather_icon = '
					<div class="weather-icon">
	          <div class="basecloud"></div>
	          <div class="icon-basecloud-bg"></div>
	          <div class="animi-icons-wrap">
	            <div class="icon-rainy-animi"></div>
	            <div class="icon-rainy-animi-2"></div>
	            <div class="icon-rainy-animi-4"></div>
	            <div class="icon-rainy-animi-5"></div>
	          </div>
	          <div class="icon-moon-animi"></div>
	        </div>
				';
			}
			// Thunder
			elseif( $icon == '11d' || $icon == '11n'){
				$weather_icon = '
					<div class="weather-icon">
	          <div class="basecloud"></div>
	          <div class="animi-icons-wrap">
	            <div class="icon-thunder-animi"></div>
	          </div>
	        </div>
				';
			}
			// Snowing
			elseif( $icon == '13d' || $icon == '13n' ){
				$weather_icon = '
					<div class="weather-icon weather-snowing">
	          <div class="basecloud"></div>
	          <div class="animi-icons-wrap">
	            <div class="icon-windysnow-animi"></div>
	            <div class="icon-windysnow-animi-2"></div>
	          </div>
	        </div>
				';
			}
			// Mist
			elseif( $icon == '50d'  || $icon == '50n' ){
				$weather_icon = '
					<div class="weather-icon">
	          <div class="icon-mist"></div>
	          <div class="icon-mist-animi"></div>
	        </div>
				';
			}
			/// Default icon | Cloudy
			else{
				$weather_icon = '
					<div class="weather-icon">
		        <div class="icon-cloud"></div>
		        <div class="icon-cloud-behind"></div>
		        <div class="icon-basecloud-bg"></div>
		      </div>
				';
			}

			// Debug Icons ----
			// $weather_icon = '<img src="http://openweathermap.org/img/w/'. $today_icon .'.png">' .$weather_icon;

			return apply_filters( 'Herbs/Weather/icon', $weather_icon, $icon );
		}


		/**
		 * Clear the Cached data for specfic City
		 */
		public static function clear_cache( $location = false ){

			if( ! $location ){
				return;
			}

			global $wpdb;
			$location = is_numeric( $location ) ? $location : sanitize_title( $location );
			$wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->options} WHERE option_name LIKE %s", '_transient_tie_weather_'. $location .'%' ));
		}


		/**
		 * Update the Cached Weather data after saving the settings
		 */
		public static function clear_header_cache( $options ){

			$positions = array( 'top-nav', 'main-nav' );

			foreach ( $positions as $pos ){

				if( ! empty( $options[ $pos.'-components_weather' ] ) && ! empty( $options[ $pos.'-components_wz_location' ] ) && tie_get_option( 'api_openweather' ) ){
					self::clear_cache( $options[ $pos.'-components_wz_location' ] );
				}
			}
		}


	}
}


add_action( 'Herbs/Options/before_update', 'HERBS_WEATHER::clear_header_cache' );


