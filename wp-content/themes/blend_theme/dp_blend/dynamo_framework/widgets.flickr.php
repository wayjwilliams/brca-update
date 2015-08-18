<?php

/**
 * 
 * DP Flickr Widget class
 *
 **/

class DP_Flickr_Widget extends WP_Widget {
	/**
	 *
	 * Constructor
	 *
	 * @return void
	 *
	 **/
	function DP_Flickr_Widget() {
		$this->WP_Widget(
			'widget_dp_flickr_gallery', 
			__( 'DP Flickr Gallery', DPTPLNAME ), 
			array( 
				'classname' => 'widget_dp_flickr_gallery', 
				'description' => __( 'Use this widget to show gallery from Flickr', DPTPLNAME) 
			)
		);
		
		$this->alt_option_name = 'widget_dp_flickr_gallery';
	}

	/**
	 *
	 * Outputs the HTML code of this widget.
	 *
	 * @param array An array of standard parameters for widgets in this theme
	 * @param array An array of settings for this widget instance
	 * @return void
	 *
	 **/
	function widget($args, $instance) {
		$cache = wp_cache_get('widget_dp_flickr_gallery', 'widget');
		
		if(!is_array($cache)) {
			$cache = array();
		}

		if(!isset($args['widget_id'])) {
			$args['widget_id'] = null;
		}

		if(isset($cache[$args['widget_id']])) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		//
		extract($args, EXTR_SKIP);
		//
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$flickr_id = empty($instance['flickr_id']) ? '' : $instance['flickr_id'];
		$flickr_limit = empty($instance['flickr_limit']) ? '' : $instance['flickr_limit'];
		$flickr_title = empty($instance['flickr_title']) ? '' : $instance['flickr_title'];
		$flickr_date = empty($instance['flickr_date']) ? '' : $instance['flickr_date'];
		$flickr_size = empty($instance['flickr_size']) ? '' : $instance['flickr_size'];
		$flickr_link = empty($instance['flickr_link']) ? '' : $instance['flickr_link'];
		//
		if ($flickr_id !== '' || $flickr_limit !== '' || $flickr_title !== '' || $flickr_date !== '') {
			echo $before_widget;
			echo $before_title;
			echo $title;
			echo $after_title;
			//
			$stream_id ="stream".mt_rand();
			$output = '<script type="text/javascript">'."\n";
			$output .= "jQuery(document).ready(function(){"."\n";
			$output .= "jQuery('#".$stream_id."').flickrfeed('".$flickr_id."','', { limit:".$flickr_limit.", title:".$flickr_title.", date:".$flickr_date.", thumbsize:".$flickr_size."});"."\n";
			$output .= "});"."\n";
			$output .= "</script>"."\n";
			$output .= '<div class="photo-stream" id="'.$stream_id.'"></div>'."\n";
			$output .= '<div class="clearboth"></div>'."\n";
			if ($flickr_link == "true") {
			$output .= '<p class="flickr_stream_link"><a href="http://www.flickr.com/photos/'.$flickr_id.'">View stream on flickr</a></p>'."\n";
			}
			echo $output;
			// 
			echo $after_widget;
		}
		// save the cache results
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_dp_flickr_gallery', $cache, 'widget');
	}

	/**
	 *
	 * Used in the back-end to update the module options
	 *
	 * @param array new instance of the widget settings
	 * @param array old instance of the widget settings
	 * @return updated instance of the widget settings
	 *
	 **/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
		$instance['flickr_limit'] = strip_tags($new_instance['flickr_limit']);
		$instance['flickr_title'] = strip_tags($new_instance['flickr_title']);
		$instance['flickr_date'] = strip_tags($new_instance['flickr_date']);
		$instance['flickr_link'] = strip_tags($new_instance['flickr_link']);
		$instance['flickr_size'] = strip_tags($new_instance['flickr_size']);
		$this->refresh_cache();

		$alloptions = wp_cache_get('alloptions', 'options');
		if(isset($alloptions['widget_dp_flickr_gallery'])) {
			delete_option( 'widget_dp_flickr_gallery' );
		}

		return $instance;
	}

	/**
	 *
	 * Refreshes the widget cache data
	 *
	 * @return void
	 *
	 **/

	function refresh_cache() {
		wp_cache_delete( 'widget_dp_flickr_gallery', 'widget' );
	}

	/**
	 *
	 * Outputs the HTML code of the widget in the back-end
	 *
	 * @param array instance of the widget settings
	 * @return void - HTML output
	 *
	 **/
	function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$flickr_id = isset($instance['flickr_id']) ? esc_attr($instance['flickr_id']) : '';
		$flickr_limit = isset($instance['flickr_limit']) ? esc_attr($instance['flickr_limit']) : '';
		$flickr_title = isset($instance['flickr_title']) ? esc_attr($instance['flickr_title']) : '';
		$flickr_date = isset($instance['flickr_date']) ? esc_attr($instance['flickr_date']) : '';
		$flickr_size = isset($instance['flickr_size']) ? esc_attr($instance['flickr_size']) : '';
		$flickr_link = isset($instance['flickr_link']) ? esc_attr($instance['flickr_link']) : '';
	?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', DPTPLNAME ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'flickr_id' ) ); ?>"><?php _e( 'Flickr user ID:', DPTPLNAME ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'flickr_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'flickr_id' ) ); ?>" type="text" value="<?php echo esc_attr( $flickr_id ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'flickr_limit' ) ); ?>"><?php _e( 'Image count limit:', DPTPLNAME ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'flickr_limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'flickr_limit' ) ); ?>" type="text" value="<?php echo esc_attr( $flickr_limit ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'flickr_size' ) ); ?>"><?php _e( 'Image size (px):', DPTPLNAME ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'flickr_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'flickr_size' ) ); ?>" type="text" value="<?php echo esc_attr( $flickr_size ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'flickr_title' ) ); ?>" class="label100"><?php _e( 'Show image title:', DPTPLNAME ); ?></label>
			
			<select id="<?php echo esc_attr( $this->get_field_id( 'flickr_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'flickr_title' ) ); ?>">
				<option value="false" <?php if(esc_attr( $flickr_title ) == 'false') : ?>selected="selected"<?php endif; ?>><?php _e('Disabled', DPTPLNAME); ?></option>
				<option value="true" <?php if(esc_attr( $flickr_title ) == 'true') : ?>selected="selected"<?php endif; ?>><?php _e('Enabled', DPTPLNAME); ?></option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'flickr_date' ) ); ?>" class="label100"><?php _e( 'Show image date:', DPTPLNAME ); ?></label>
			
			<select id="<?php echo esc_attr( $this->get_field_id( 'flickr_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'flickr_date' ) ); ?>">
				<option value="false" <?php if(esc_attr( $flickr_date ) == 'false') : ?>selected="selected"<?php endif; ?>><?php _e('Disabled', DPTPLNAME); ?></option>
				<option value="true" <?php if(esc_attr( $flickr_date ) == 'true') : ?>selected="selected"<?php endif; ?>><?php _e('Enabled', DPTPLNAME); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'flickr_link' ) ); ?>" class="label100"><?php _e( 'Show link to flickr stream:', DPTPLNAME ); ?></label>
			
			<select id="<?php echo esc_attr( $this->get_field_id( 'flickr_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'flickr_link' ) ); ?>">
				<option value="false" <?php if(esc_attr( $flickr_link ) == 'false') : ?>selected="selected"<?php endif; ?>><?php _e('Disabled', DPTPLNAME); ?></option>
				<option value="true" <?php if(esc_attr( $flickr_link ) == 'true') : ?>selected="selected"<?php endif; ?>><?php _e('Enabled', DPTPLNAME); ?></option>
			</select>
		</p>

	<?php
	}
}

// EOF