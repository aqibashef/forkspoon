<?php
/**
 * Plugin Name: About Widget
 */

add_action( 'widgets_init', 'themewagon_about_load_widget' );

function themewagon_about_load_widget() {
	register_widget( 'themewagon_about_widget' );
}

class themewagon_about_widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		parent::__construct(
			'about_widget', // Base ID
			__( 'Forkspoon: About Me', 'forkspoon' ), // Name
			array( 'description' => __( 'An About Me Widget', 'forkspoon' ), ) // Args
		);
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$image = $instance['image'];
		$subtitle = $instance['subtitle'];
		$description = $instance['description'];
		
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		?>
			
			<div class="about-widget">
				
				<?php if($image) : ?>
				<div class="about-img">
					<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_html($title); ?>" />
				</div>
				<?php endif; ?>
				
				<?php if($subtitle) : ?>
				<span class="about-title"><?php echo wp_kses_post($subtitle); ?></span>
				<?php endif; ?>
				
				<?php if($description) : ?>
				<p><?php echo wp_kses_post($description); ?></p>
				<?php endif; ?>
				
			</div>
			
		<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['image'] = strip_tags( $new_instance['image'] );
		$instance['subtitle'] = $new_instance['subtitle'];
		$instance['description'] = $new_instance['description'];
		$instance['signing'] = strip_tags( $new_instance['signing'] );

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'About Me', 'image' => '', 'subtitle' => '', 'description' => '', 'signing' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:96%;" />
		</p>
		
		<!-- image url -->
		<p>
			<label for="<?php echo $this->get_field_id( 'image' ); ?>">Image URL:</label>
			<input id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" style="width:96%;" /><br />
		</p>
		
		<!-- subtitle -->
		<p>
			<label for="<?php echo $this->get_field_id( 'subtitle' ); ?>">Sub title:</label>
			<input id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" value="<?php echo $instance['subtitle']; ?>" style="width:96%;" /><br />
		</p>
		
		<!-- description -->
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>">About me text:</label>
			<textarea id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" style="width:95%;" rows="6"><?php echo $instance['description']; ?></textarea>
		</p>


	<?php
	}
}

?>