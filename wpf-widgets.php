<?php 
/***********************************************
## Custom widget for WP Flicker Plugin
***********************************************/
add_action( 'widgets_init', 'my_widget' );


function my_widget() {
  register_widget( 'MY_Widget' );
}

class MY_Widget extends WP_Widget {

	function MY_Widget() {
		$widget_ops = array( 'classname' => 'wpflicker', 'description' => __('A nice and easy flicker image gallery cycle.', 'wpflicker') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'wpflicker' );
		$this->WP_Widget( 'wpflicker', __('WP Flicker Cycle', 'wpflicker'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$flicker_id 		= $instance['flicker_id'] ;
		$number_of_images   = $instance['number_of_images'] ;
		$slider_time 		= $instance['slider_time'] ;
		$link 				= $instance['link'] ;
		$slider_type 		= $instance['slider_type'] ;

		$display_link = isset( $instance['display_link'] ) ? $instance['display_link'] : false;
		$id = rand(100,999);
		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;
		?>
			<ul class="cycle" id="cycle_<?php echo $id; ?>"></ul>
		<?php	
			$html="";
			$html .= "<script type=\"text/javascript\">
				
				jQuery(document).ready(function(){
					jQuery('#cycle_$id').jflickrfeed({
						limit: $number_of_images,
						qstrings: {
							id: '$flicker_id'
						},
						itemTemplate: '<li><img src=\"{{image_m}}\" alt=\"{{title}}\" /><div>{{title}}</div></li>'
					}, function(data) {
						jQuery('#cycle_$id div').hide();
						jQuery('#cycle_$id').cycle({
							fx:     '$slider_type', 
							timeout: $slider_time
						});
					});
				});	
			</script>";	
		?>	
		<?php	
		echo $html;	
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flicker_id'] 			= strip_tags( $new_instance['flicker_id'] );
		$instance['number_of_images'] 		= strip_tags( $new_instance['number_of_images'] );
		$instance['slider_time'] 			= strip_tags( $new_instance['slider_time'] );
		$instance['link'] 					= strip_tags( $new_instance['link'] );
		$instance['slider_type'] 			= $new_instance['slider_type'];
		$instance['display_link'] 			= $new_instance['display_link'];


		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array(
			 'title' => __('WP FLicker Cycle', 'wpfc'),
			 'flicker_id' => __('37304598@N02', 'wpfc'), 
			 'show_info' => false,
			 'slider_time' => 5000,
		 );

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'wpfc'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'flicker_id' ); ?>"><?php _e('Flicker User ID:', 'wpfc'); ?></label>
			<input id="<?php echo $this->get_field_id( 'flicker_id' ); ?>" name="<?php echo $this->get_field_name( 'flicker_id' ); ?>" value="<?php echo $instance['flicker_id']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number_of_images' ); ?>"><?php _e('Number of Image:', 'wpfc'); ?></label>
			<input id="<?php echo $this->get_field_id( 'number_of_images' ); ?>" name="<?php echo $this->get_field_name( 'number_of_images' ); ?>" value="<?php echo $instance['number_of_images']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'slider_type' ); ?>"><?php _e('Slider Type:', 'wpfc'); ?></label>
			<?php $slidertype = $instance['slider_type'];  ?>
			<select id="<?php echo $this->get_field_id( 'slider_type' ); ?>" name="<?php echo $this->get_field_name( 'slider_type' ); ?>">
				<option <?php if($slidertype == "zoom") { echo " Selected"; } ?> value="zoom">Zoom</option>
				<option <?php if($slidertype == "shuffle") { echo " Selected"; } ?> value="shuffle">Shuffle</option>
				<option <?php if($slidertype == "turnDown") { echo " Selected"; } ?>  value="turnDown">TurnDown</option>
				<option <?php if($slidertype == "curtainX") { echo " Selected"; } ?> value="curtainX">CurtainX</option>
				<option <?php if($slidertype == "scrollRight") { echo " Selected"; } ?> value="scrollRight">ScrollRight</option>
				<option <?php if($slidertype == "scrollLeft") { echo " Selected"; } ?> value="scrollLeft">ScrollLeft</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'slider_time' ); ?>"><?php _e('Sliding Time (in milesecond):', 'wpfc'); ?></label>
			<input id="<?php echo $this->get_field_id( 'slider_time' ); ?>" name="<?php echo $this->get_field_name( 'slider_time' ); ?>" value="<?php echo $instance['slider_time']; ?>" style="width:100%;" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['display_link'], true ); ?> id="<?php echo $this->get_field_id( 'display_link' ); ?>" name="<?php echo $this->get_field_name( 'display_link' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'display_link' ); ?>"><?php _e('Use Link over the Gallery?', 'wpfc'); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e('Link:', 'wpfc'); ?></label>
			<input id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}
