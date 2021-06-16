<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/Anusha0070
 * @since      1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 * @author     Anusha Raju <anusha.raju@hbwsl.com>
 */
class Wp_Book_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Book_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Book_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-book-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Book_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Book_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-book-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	// Register Custom Post Type wp-book.

	public function create_wpbook_cpt() {

		$labels   = array(
			'name'               => __( 'Books Library', 'wp-book' ),
			'singular_name'      => __( 'Book', 'wp-book' ),
			'add_new'            => __( 'Add New Book', 'wp-book' ),
			'add_new_item'       => __( 'Add New Book', 'wp-book' ),
			'edit_item'          => __( 'Edit Book', 'wp-book' ),
			'new_item'           => __( 'New Book', 'wp-book' ),
			'all_items'          => __( 'All Books', 'wp-book' ),
			'view_item'          => __( 'View Book', 'wp-book' ),
			'search_items'       => __( 'Search Book', 'wp-book' ),
			'not_found'          => __( 'No books found', 'wp-book' ),
			'not_found_in_trash' => __( 'No books found in the Trash', 'wp-book' ),
			'menu_name'          => __( 'Books', 'wp-book' ),
		);
			$args = array(
				'labels'        => $labels,
				'description'   => __( 'Holds our books and book specific data', 'wp-book' ),
				'public'        => true,
				'menu_icon'     => 'dashicons-book-alt',
				'menu_position' => 3,
				'supports'      => array( 'title', 'editor', 'Category' ),
				'has_archive'   => true,
				'show_in_menu'  => true,
				'taxonomies'    => array( 'bookcategory' ),
			);

			register_post_type( 'wpbook', $args );

	}

	// Register Taxonomy book-category.

	public function create_bookcategory_tax() {

		$labels = array(
			'name'          => __( 'Book Category', 'wp-book' ),
			'singular_name' => __( 'Book Category', 'wp-book' ),
			'search_items'  => __( 'Search Book Category', 'wp-book' ),
			'all_items'     => __( 'All Categories', 'wp-book' ),
			'parent_item'   => __( 'Parent Category', 'wp-book' ),
			'edit_item'     => __( 'Edit Book Category', 'wp-book' ),
			'view_item'     => __( 'View book Category', 'wp-book' ),
			'update_item'   => __( 'Update book Category', 'wp-book' ),
			'add_new_item'  => __( 'Add New Book Category', 'wp-book' ),

		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Different book categories', 'wp-book' ),
			'hierarchical'       => true,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
		);
		register_taxonomy( 'bookcategory', array( 'wpbook' ), $args );

	}

	// Register Taxonomy Book Tag
	public function create_booktag_tax() {

		$labels = array(
			'name'              => _x( 'Book Tag', 'taxonomy general name', 'wp-book' ),
			'singular_name'     => _x( 'Book Tag', 'taxonomy singular name', 'wp-book' ),
			'search_items'      => __( 'Search Book Tag', 'wp-book' ),
			'all_items'         => __( 'All Book Tag', 'wp-book' ),
			'parent_item'       => __( 'Parent Book Tag', 'wp-book' ),
			'parent_item_colon' => __( 'Parent Book Tag:', 'wp-book' ),
			'edit_item'         => __( 'Edit Book Tag', 'wp-book' ),
			'update_item'       => __( 'Update Book Tag', 'wp-book' ),
			'add_new_item'      => __( 'Add New Book Tag', 'wp-book' ),
			'new_item_name'     => __( 'New Book Tag Name', 'wp-book' ),
			'menu_name'         => __( 'Book Tag', 'wp-book' ),
		);
		$args   = array(
			'labels'             => $labels,
			'description'        => __( 'Different book tags', 'wp-book' ),
			'hierarchical'       => false,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'show_tagcloud'      => true,
			'show_in_quick_edit' => true,
			'show_admin_column'  => false,
			'show_in_rest'       => true,
		);
		register_taxonomy( 'booktag', array( 'wpbook' ), $args );

	}


	public function create_book_meta_boxes() {
		add_meta_box(
			'wp_book_metabox_id',
			'Book Meta Information',
			array( $this, 'wp_book_metabox_callback' ),
			'wpbook'
		);

	}

	public function wp_book_metabox_callback( $post ) {

		wp_nonce_field( 'wp_book_meta_box_save', 'wp_book_meta_nounce' );

		$author    = get_metadata( 'wpbook', $post->ID, 'wp_book_author_key', true );
		$price     = get_metadata( 'wpbook',$post->ID, 'wp_book_price_key', true );
		$publisher = get_metadata('wpbook', $post->ID, 'wp_book_publisher_key', true );
		$year      = get_metadata('wpbook', $post->ID, 'wp_book_year_key', true );
		$edition   = get_metadata('wpbook', $post->ID, 'wp_book_edition_key', true );

		echo '<label for="wp_book_author">Author	</label>';
		echo '<input type ="text" id="wp_book_author"name = "wp_book_author" value="' . $author . '" ><br><br>';

		echo '<label for="wp_book_price">Price	</label>';
		echo '<input type ="text" id="wp_book_price"name = "wp_book_price" value="' . $price . '"><br><br>';

		echo '<label for="wp_book_publisher">Publisher	</label>';
		echo '<input type ="text" id="wp_book_publisher"name = "wp_book_publisher" value="' . $publisher . '"><br><br>';

		echo '<label for="wp_book_year">Year	</label>';
		echo '<input type ="text" id="wp_book_year"name = "wp_book_year" value="' . $year . '"><br><br>';

		echo '<label for="wp_book_edition">Edition	</label>';
		echo '<input type ="text" id="wp_book_edition"name = "wp_book_edition" value="' . $edition . '"><br><br>';

	}

	public function wp_book_meta_box_save( $post_id ) {

		if ( ! isset( $_POST['wp_book_meta_nounce'] ) ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		$author = $_POST['wp_book_author'];
		update_metadata( 'wpbook', $post_id, 'wp_book_author_key', $author );

		$price = $_POST['wp_book_price'];
		update_metadata( 'wpbook',$post_id, 'wp_book_price_key', $price );

		$publisher = $_POST['wp_book_publisher'];
		update_metadata('wpbook', $post_id, 'wp_book_publisher_key', $publisher );

		$year = $_POST['wp_book_year'];
		update_metadata('wpbook', $post_id, 'wp_book_year_key', $year );

		$edition = $_POST['wp_book_edition'];
		update_metadata('wpbook', $post_id, 'wp_book_edition_key', $edition );

	}


	public function wp_register_metadata_table() {
		global $wpdb;
		$wpdb->wpbookmeta = $wpdb->prefix . 'book_meta_data';
		$wpdb->tables[]   = 'book_meta_data';
	}


	public function wp_book_setting_menu(){

		add_menu_page(
			__('Book Settings','wp-book'),
			__('Book Settings','wp-book'),
			'manage_options',
			'wp-book-settings-page',//page slug
			array( $this, 'wp_book_settings_callback' ),
			'',
			null
		);

	}


	//
	public function wp_book_setting_register(){


		//register select field
		register_setting('wp-book-settings-page','wp_book_setting_select_field');


		// Setup setting section
		add_settings_section(
			'wp_book_setting_section',//section id
			'Book Settings Page',//section title
			'',//callback
			'wp-book-settings-page',//page id
		);

		// Add select field
		add_settings_field(
			'wp_book_setting_select_field',//id->match register setting option name
			__('Currency', 'wp-book'),//title
			array($this, 'wp_settings_select_field_callback'),//callback
			'wp-book-settings-page',//page id
			'wp_book_setting_section'//section id
		);


		//register input field
		register_setting('wp-book-settings-page','wp_book_setting_input_field');

		//Add input field
		add_settings_field(
			'wp_book_setting_input_field',//id->match register setting option name
			__('Number of Books displayed per page', 'wp-book'),//title
			array($this, 'wp_settings_input_field_callback'),//callback
			'wp-book-settings-page',//page id
			'wp_book_setting_section'//section id
		);
	}

	/**
	 * Select field template
	 */

	public function wp_settings_select_field_callback(){
		
		$choice= get_option('wp_book_setting_select_field');

		?>
		<select name="wp_book_setting_select_field">
			<option value=""> -- Select one -- </option>
			<option value="USD" <?php selected('USD',$choice); ?>> USD </option>
			<option value="EUR" <?php selected('EUR',$choice); ?>> EUR </option>
			<option value="JPY" <?php selected('JPY',$choice); ?>> JPY </option>
			<option value="GBP" <?php selected('GBP',$choice); ?>> GBP </option>
			<option value="CAD" <?php selected('CAD',$choice); ?>> CAD </option>
			<option value="INR" <?php selected('INR',$choice); ?>> INR </option>
		</select>
		<?php
		
	}

	/**
	 * Input field Template
	 */
	public function wp_settings_input_field_callback(){
		
		$choice= get_option('wp_book_setting_input_field');

		?>
		<input type="text" name="wp_book_setting_input_field" value="<?php echo isset($choice)? esc_attr($choice):'';?>">
		</input>
		<?php
		
	}

	public function wp_book_settings_callback(){
		?>
		<div class="wrap">
		<h1>Book Settings</h1>

		<form action="options.php" method="post">
			<?php
				settings_fields('wp-book-settings-page');
				//output settings section
				do_settings_sections('wp-book-settings-page');

				//save settings button
				submit_button('Save Settings');

			?>
		</form>
		</div>
		<?php
	}


	public function wp_book_shortcode($atts){

		$atts = extract( shortcode_atts(
            array( 
                'id'          => '',
                'author_name' => '',
                'year'        => '',
                'category'    => '',
                'tag'         => '',
                'publisher'   => '',
            ), $atts));

		$args = [
			'post_type'=>'wpbook',
			'post_status'=>'publish',
			
		];

		if($id!=='' ){
			$args['p']=$id;
		}
		
		if($category!==''){
			$args['tax_query'] = array(
                array(
                 'taxonomy' =>'bookcategory',
                 'field'=>'slug',
                 'terms'=> $category,
                 'include_children'=>false
            
                ),
            );
		}
		if($tag!=''){
			$args['tax_query'] = array(
                array(
                 'taxonomy' =>'booktag',
                 'field'=>'slug',
                 'terms'=> $tag,
                 'include_children'=>false
            
                ),
            );
		}
		
		$query = new WP_Query($args);
		$return_html = '';
		
		if ( $query->have_posts() ) {
			
			while ( $query->have_posts() ) {
				$query->the_post();

				$author = get_metadata( 'wpbook', get_the_ID(), 'wp_book_author_key', true );
				
				if($author_name!=''){

					if(strtolower($author_name) == strtolower($author)){
						return $return_html.='<h4> Title : '. get_the_title(). '</h4><h5> Author : '. $author .'</h5>';
					}else{
						
						return $return_html.="NO BOOKS FOUND!";
					}

				}

				
				$publisher_name = get_metadata( 'wpbook', get_the_ID(), 'wp_book_publisher_key', true );

				if($publisher!=''){

					if($publisher_name == $publisher){
						return $return_html.='<h4> Title : '. get_the_title(). '</h4><h5> Author : '. $author .'</h5>';
					}else{
						return $return_html.="NO BOOKS FOUND!";
					}

				}

				$year_name = get_metadata( 'wpbook', get_the_ID(), 'wp_book_year_key', true );

				if($year!=''){

					if($year_name == $year){
						return $return_html.='<h4> Title : '. get_the_title(). '</h4><h5> Author : '. $author .'</h5>';
					}else{
						return $return_html.="NO BOOKS FOUND!";
					}

				}

				$return_html.='<h4> Title : '. get_the_title(). '</h4><h5> Author : '. $author .'</h5>';
			}
		
		} else {
			echo "No Books found!";
						return;
		}

		/* Restore original Post Data */
		wp_reset_postdata();

		return $return_html;
	}


	//custom widget

	public function wp_book_register_widget(){
		register_widget('Wp_Book_Widget');
	}
 	


	// Custom dashboard widget.

	public function wp_book_dashboard_widget() {

		wp_add_dashboard_widget(
			'wp_book-widget', // id of widget
			__( 'Top 5 Books Category', 'wp-book' ), // title
			array( $this, 'wp_book_dashboard_widget_callback' )// callback function
		);
	}

	//custom dashboard widget callback function

	public function wp_book_dashboard_widget_callback(){

		wp_list_categories(
			array(
				'taxonomy' => 'bookcategory',
				'title_li' => false,
				'orderby'  => 'count',
				'order'    => 'DESC',
				'number'   => 5,
				'show_count'=>true
			)
		);
	}
	
	


	


}






