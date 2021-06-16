<?php





class Wp_Book_Widget extends WP_Widget{


    public function __construct(){
        parent::__construct(
            'wp_book_custom_widget',//id
            'Display Books',//title
            [
                'classname' => 'wp_book_widget',
                'description' =>'Displaying the books based on the given category',

            ]
        );

    }

    // Back-end display of widget
	public function form( $instance){

    $title = isset( $instance['title'] ) ? $instance['title'] : __('New Title','wp-book');
    $category = isset( $instance['category'] ) ? $instance['category'] : __('none','wp-book');

		$categories = get_categories(
			array(
				'taxonomy' => 'bookcategory',
			)
		);

		?>
		<br/>
		<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><strong>Choose a Category</strong></label><br/><br/>
		<select name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>" id= "<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>">
		<?php

		foreach ( $categories as $cat ) {
			?>
			<option value="<?php echo $cat->name; ?>" <?php selected($category,$cat->name,true);?>> <?php echo $cat->name; ?> </option>
			<?php
		}
		?>
		</select>
		<br/>

		<?php

        error_log(print_r($category,true));

    }

	// Front-end display of widget
	public function widget( $args, $instance){

		$title = isset( $instance['title'] ) ? $instance['title'] : '';

		$atts = array(
		'post_type'   => 'wpbook',
		'post_status' => 'publish',
		'tax_query'   => array(
			array(
				'taxonomy' => 'bookcategory',
				'field'    => 'slug',
				'terms'    => $instance['category'],
				),
			),
		);


		$query = new WP_Query( $atts );

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		echo 'Book Category : '. $instance['category'];

		if ( ! empty( $query->posts ) ) {

			?>
			<ul>
				<?php
				foreach ( $query->posts as $books ) {
					?>
						<li><a href="<?php echo get_the_permalink( $books->ID ); ?>"><?php echo get_the_title( $books->ID ); ?></a></li>

					<?php
				}

				?>
			</ul>
			<?php
		}

		echo $args['after_widget'];

	}


	// For updating new instance
	public function update( $new_instance, $old_instance ) {
		return $new_instance;
	}


}










