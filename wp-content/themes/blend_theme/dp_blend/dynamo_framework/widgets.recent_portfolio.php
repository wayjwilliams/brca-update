<?php
/**
 * 
 * DP Recent Portfolio Widget class
 *
 **/

class DP_Recent_Port_Widget extends WP_Widget {
	/**
	 *
	 * Constructor
	 *
	 * @return void
	 *
	 **/
	function DP_Recent_Port_Widget() {
		$this->WP_Widget(
			'widget_dp_recent_port', 
			__( 'DP Recent Portfolio', DPTPLNAME ), 
			array( 
				'classname' => 'widget_dp_recent_port', 
				'description' => __( 'Use this widget to show recent portfolio items', DPTPLNAME) 
			)
		);
		
		$this->alt_option_name = 'widget_dp_recent_port';
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
		$cache = wp_cache_get('widget_dp_recent_port', 'widget');
		
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
		$port_cat = empty($instance['port_cat']) ? '' : $instance['port_cat'];
		$show_num = empty($instance['$show_num']) ? '' : $instance['$show_num'];
		$word_limit = empty($instance['$word_limit']) ? '' : $instance['$word_limit'];
		$thumb_width = empty($instance['$thumb_width']) ? '' : $instance['$thumb_width'];
		$show_thumb = empty($instance['$show_thumb']) ? 'true' : $instance['$show_thumb'];
		$show_title = empty($instance['$show_title']) ? 'true' : $instance['$show_title'];
		$show_date = empty($instance['$show_date']) ? 'true' : $instance['$show_date'];
		if ($thumb_width == "") $thumb_width = '70';
		//
		
		
			echo $before_widget;
			echo $before_title;
			echo $title;
			echo $after_title;
			//
			$custom_posts = get_posts('post_type=portfolio&showposts='.$show_num.'&portfolios='.$port_cat);
			if( !empty($custom_posts) ){ 
			echo "<div class='dp-recent-post-widget'>";
			foreach($custom_posts as $custom_post) { 
				?>
				<div class="recent-post-widget">
				<?php
								$thumbnail_id = get_post_thumbnail_id( $custom_post->ID );				
								$thumbnail = wp_get_attachment_image_src( $thumbnail_id);
								$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);	
								if( !empty($thumbnail) && $show_thumb == 'true' ){
									?>
					<div class="thumbnail">
						<a href="<?php echo get_permalink( $custom_post->ID ); ?>">
						<span class="icn-more"></span>	
									<?php echo '<img width="'.$thumb_width.'" src="' . $thumbnail[0] . '" alt="'. $alt_text .'"/>'; ?>
							
						</a>
					</div>
					<?php	}
							?>
					<div class="content">
                    <?php if ($show_title == 'true') { ?>
                    <h5><a href="<?php echo get_permalink( $custom_post->ID ); ?>"><?php echo get_the_title($custom_post->ID);  ?></a></h5>
                    <?php } ?>
                    <?php if ($word_limit > 0) { ?>
                        <div class="excerpt"><a href="<?php echo get_permalink( $custom_post->ID ); ?>"> <?php  $excerpt =  get_post_field('post_content', $custom_post->ID); 			                        $excerpt = strip_shortcodes( $excerpt ); ;
						echo string_limit_words($excerpt,$word_limit);?>&hellip;</a></div>
                    <?php } ?>
                    <?php if ($show_date == 'true') { ?>
						<div class="date">
                        <?php echo mysql2date('j M Y',$custom_post->post_date); ?> 
						</div>
                    <?php } ?>
					</div>
					<div class="clearboth"></div>
				</div>						
				<?php 
				
			}
			echo "</div>";
		}
			// 
			echo $after_widget;
		// save the cache results
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_dp_recent_port', $cache, 'widget');
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
		$instance['port_cat'] = strip_tags($new_instance['port_cat']);
		$instance['$show_num'] = strip_tags($new_instance['$show_num']);
		$instance['$word_limit'] = strip_tags($new_instance['$word_limit']);
		$instance['$thumb_width'] = strip_tags($new_instance['$thumb_width']);
		$instance['$show_thumb'] = strip_tags($new_instance['$show_thumb']);
		$instance['$show_title'] = strip_tags($new_instance['$show_title']);
		$instance['$show_date'] = strip_tags($new_instance['$show_date']);
		$this->refresh_cache();

		$alloptions = wp_cache_get('alloptions', 'options');
		if(isset($alloptions['widget_dp_recent_port'])) {
			delete_option( 'widget_dp_recent_port' );
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
		wp_cache_delete( 'widget_dp_recent_port', 'widget' );
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
		$port_cat = isset($instance['port_cat']) ? esc_attr($instance['port_cat']) : '';
		$show_num = isset($instance['$show_num']) ? esc_attr($instance['$show_num']) : '';
		$word_limit = isset($instance['$word_limit']) ? esc_attr($instance['$word_limit']) : '';
		$thumb_width = isset($instance['$thumb_width']) ? esc_attr($instance['$thumb_width']) : '';
		$show_thumb = isset($instance['$show_thumb']) ? esc_attr($instance['$show_thumb']) : '';
		$show_title = isset($instance['$show_title']) ? esc_attr($instance['$show_title']) : '';
		$show_date = isset($instance['$show_date']) ? esc_attr($instance['$show_date']) : '';
	?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', DPTPLNAME ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'port_cat' ) ); ?>"><?php _e( 'Portfolio category:', DPTPLNAME ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'port_cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'port_cat' ) ); ?>" type="text" value="<?php echo esc_attr( $port_cat ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( '$show_num' ) ); ?>"><?php _e( 'Item count:', DPTPLNAME ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( '$show_num' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( '$show_num' ) ); ?>" type="text" value="<?php echo esc_attr( $show_num ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( '$word_limit' ) ); ?>"><?php _e( 'Word limit in excerpt:', DPTPLNAME ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( '$word_limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( '$word_limit' ) ); ?>" type="text" value="<?php echo esc_attr( $word_limit ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( '$thumb_width' ) ); ?>"><?php _e( 'Thumnail width (px):', DPTPLNAME ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( '$thumb_width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( '$thumb_width' ) ); ?>" type="text" value="<?php echo esc_attr( $thumb_width ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( '$show_thumb' ) ); ?>" class="label100"><?php _e( 'Show featured image:', DPTPLNAME ); ?></label>
			
			<select id="<?php echo esc_attr( $this->get_field_id( '$show_thumb' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( '$show_thumb' ) ); ?>">
				<option value="true" <?php if(esc_attr( $show_thumb ) == 'true') : ?>selected="selected"<?php endif; ?>><?php _e('Enabled', DPTPLNAME); ?></option>
				<option value="false" <?php if(esc_attr( $show_thumb ) == 'false') : ?>selected="selected"<?php endif; ?>><?php _e('Disabled', DPTPLNAME); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_title' ) ); ?>" class="label100"><?php _e( 'Show post title:', DPTPLNAME ); ?></label>
			
			<select id="<?php echo esc_attr( $this->get_field_id( 'show_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( '$show_title' ) ); ?>">
				<option value="true" <?php if(esc_attr( $show_title ) == 'true') : ?>selected="selected"<?php endif; ?>><?php _e('Enabled', DPTPLNAME); ?></option>
				<option value="false" <?php if(esc_attr( $show_title ) == 'false') : ?>selected="selected"<?php endif; ?>><?php _e('Disabled', DPTPLNAME); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" class="label100"><?php _e( 'Show date:', DPTPLNAME ); ?></label>
			
			<select id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( '$show_date' ) ); ?>">
				<option value="true" <?php if(esc_attr( $show_date ) == 'true') : ?>selected="selected"<?php endif; ?>><?php _e('Enabled', DPTPLNAME); ?></option>
				<option value="false" <?php if(esc_attr( $show_date ) == 'false') : ?>selected="selected"<?php endif; ?>><?php _e('Disabled', DPTPLNAME); ?></option>
			</select>
		</p>
	<?php
	}
}
// EOF