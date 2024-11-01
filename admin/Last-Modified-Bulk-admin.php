<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Last_Modified_Bulk
 * @subpackage Last_Modified_Bulk/admin
 * @author     Brian David <brian@advertise.com>
 */
class Last_Modified_Bulk_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function lmb_enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/Last-Modified-Bulk-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function lmb_enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/Last-Modified-Bulk-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function lmb_bulk_add_posts_columns($columns, $post_type) {
	    if ($post_type == 'post') {
			$new_columns = array();
			foreach($columns as $k => $v) {
				$new_columns[$k] = $v;
			    if ($k == 'date') {
					$new_columns['modified_date'] = 'Modified Date';
                }
            }

            return $new_columns;
        }

		return $columns;
	}

	public function lmb_save_custom_bulk_modified_update() {
		$post_ids = array();

		if (!empty($_POST['post_ids'])) {
			foreach($_POST['post_ids'] as $post_id) {
				$post_ids[] = (int)$post_id;
			}
		} else {
			die();
		}

		foreach($post_ids as $post_id) {
			$post_data = array();

			$post_data['ID'] = $post_id;
			$post_data['post_modified'] = current_time( 'mysql' );
			$post_data['post_modified_gmt'] = gmdate( 'Y-m-d H:i:s' );

			wp_update_post( $post_data );
		}

		wp_send_json(array(
            'success' => true,
        ));
	}

	public function lmb_bulk_add_post_posts_columns($column_name, $post_id) {
	    if ($column_name == 'modified_date') {
	        echo '<div id="modified_date-' . $post_id . '">' . get_the_modified_date( 'Y/m/d', $post_id ) . '</div>';
        }
    }

    public function lmb_bulk_add_edit_post_sortable_columns($sortable_columns) {
		$sortable_columns[ 'modified_date' ] = 'modified_date';

		return $sortable_columns;
    }

    public function lmb_manage_wp_posts_be_qe_posts_clauses($pieces, $query) {
	    global $wpdb;
		/**
		 * We only want our code to run in the main WP query
		 * AND if an orderby query variable is designated.
		 */
		if ( $query->is_main_query() && ( $orderby = $query->get( 'orderby' ) ) ) {

			// Get the order query variable - ASC or DESC
			$order = strtoupper( $query->get( 'order' ) );

			// Make sure the order setting qualifies. If not, set default as ASC
			if ( ! in_array( $order, array( 'ASC', 'DESC' ) ) ) {
				$order = 'ASC';
            }

			switch( $orderby ) {
				case 'modified_date':
					$pieces[ 'orderby' ] = "wp_posts.post_modified $order, " . $pieces[ 'orderby' ];
					break;
			}
		}

		return $pieces;
    }

	public function lmb_custom_bulk_edit_custom_box($column_name, $post_type) {
		if($post_type !== 'post') {
			return false;
		}

		if ($column_name == 'modified_date') {
		    include 'partials/Last-Modified-Bulk-display.php';
        }
	}
}
