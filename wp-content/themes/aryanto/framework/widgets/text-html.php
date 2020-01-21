<?php

if( ! class_exists( 'TIE_TEXT_HTML' )){

	/**
	 * Widget API: TIE_TEXT_HTML class
	 */
	 class TIE_TEXT_HTML extends WP_Widget {


		public function __construct(){
			$widget_ops  = array( 'classname' => 'text-html'  );
			parent::__construct( 'text-html-widget', apply_filters( 'Herbs/theme_name', 'Herbs' ) .' - '.esc_html__( 'Text or HTML', HERBS_TEXTDOMAIN) , $widget_ops );
		}

		/**
		 * Outputs the content for the widget instance.
		 */
		public function widget( $args, $instance ){

			/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
			$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$text_code = ! empty( $instance['text_code'] ) ? $instance['text_code'] : '';

			# WPML
			$text_code = apply_filters( 'wpml_translate_single_string', $text_code, HERBS_THEME_SLUG, 'widget_content_'.$this->id );

			# Center the content
			$center = empty( $instance['center'] ) ? '' : 'style="text-align:center;"';


			if( empty( $instance['tran_bg'] ) ){

				echo ( $args['before_widget'] );

				if ( ! empty($instance['title']) ){
					echo ( $args['before_title'] . $instance['title'] . $args['after_title'] );
				}

				echo '<div '.$center.'>'. do_shortcode( $text_code ) .'</div>';

				echo ( $args['after_widget'] );

			}
			else { ?>
				<div <?php echo 'id="'.$args['widget_id'].'"'; ?> class="widget text-html-box" <?php echo ( $center ) ?>>
					<?php echo do_shortcode( $text_code ) ?>
				</div>
			<?php
			}
		}

		/**
		 * Handles updating settings for widget instance.
		 */
		public function update( $new_instance, $old_instance ){
			$instance              = $old_instance;
			$instance['title']     = sanitize_text_field( $new_instance['title'] );
			$instance['text_code'] = $new_instance['text_code'];
			$instance['tran_bg']   = ! empty( $new_instance['tran_bg'] ) ? 'true' : false;
			$instance['center']    = ! empty( $new_instance['center'] )  ? 'true' : false;

			# WPML
			do_action( 'wpml_register_single_string', HERBS_THEME_SLUG, 'widget_content_'.$this->id, $new_instance['text_code'] );

			return $instance;
		}

		/**
		 * Outputs the settings form for the widget.
		 */
		public function form( $instance ){
			$defaults = array( 'title' => esc_html__('Text', HERBS_TEXTDOMAIN)  );
			$instance = wp_parse_args( (array) $instance, $defaults );

			$title      = isset( $instance['title'] )     ? $instance['title']     : '';
			$text_code  = isset( $instance['text_code'] ) ? $instance['text_code'] : '';
			$tran_bg    = isset( $instance['tran_bg'] )   ? $instance['tran_bg']   : '';
			$center     = isset( $instance['center'] )    ? $instance['center']    : ''; ?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', HERBS_TEXTDOMAIN) ?></label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ) ?>" class="widefat" type="text" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'text_code' ) ); ?>"><?php esc_html_e( 'Text, Shortcodes or HTML code', HERBS_TEXTDOMAIN) ?></label>
				<textarea rows="10" id="<?php echo esc_attr( $this->get_field_id( 'text_code' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_code' ) ); ?>" class="widefat" ><?php echo esc_textarea( $text_code ) ?></textarea>
			</p>

			<p>
				<input id="<?php echo esc_attr( $this->get_field_id( 'tran_bg' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tran_bg' ) ); ?>" value="true" <?php checked( $tran_bg, 'true' ) ?> type="checkbox" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'tran_bg' ) ); ?>"><?php esc_html_e( 'Show the content only?', HERBS_TEXTDOMAIN) ?></label>
			</p>

			<p>
				<input id="<?php echo esc_attr( $this->get_field_id( 'center' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'center' ) ); ?>" value="true" <?php checked( $center, 'true' ) ?> type="checkbox" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'center' ) ); ?>"><?php esc_html_e( 'Center the content?', HERBS_TEXTDOMAIN) ?></label>
			</p>
		  <?php
		}
	}



	/**
	 * Register the widget.
	 */
	add_action( 'widgets_init', 'tie_text_html_register' );
	function tie_text_html_register(){
		register_widget( 'TIE_TEXT_HTML' );
	}

}
?>
