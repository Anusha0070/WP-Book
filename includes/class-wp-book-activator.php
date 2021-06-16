<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/Anusha0070
 * @since      1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 * @author     Anusha Raju <anusha.raju@hbwsl.com>
 */
class Wp_Book_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		

		global $wpdb;
		
		$charset_collate = $wpdb->get_charset_collate();

		$table_name = $wpdb->prefix . 'book_meta_data';
		
		$max_index_length = 191;

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		
		error_log("heyyyy");
		
		$install_query = "CREATE TABLE $table_name (
			meta_id bigint(20) unsigned NOT NULL auto_increment,
			wpbook_id bigint(20) unsigned NOT NULL default '0',
			meta_key varchar(255) default NULL,
			meta_value longtext,
			PRIMARY KEY  (meta_id),
			KEY book (wpbook_id),
			KEY meta_key (meta_key($max_index_length))
		)$charset_collate;";
		
		dbDelta( $install_query );

		flush_rewrite_rules();
	}

}
