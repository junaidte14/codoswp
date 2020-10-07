<?php
/**
 * Add meta box to show/hide page title
 */

function codo_page_show_hide_title( $post ){
	add_meta_box( 'page_title_meta_box', __( 'Page Settings', 'codoswp' ), 'codo_show_hide_title_meta_box_build', 'page', 'side', 'low' );
}
add_action( 'add_meta_boxes', 'codo_page_show_hide_title' );

/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function codo_show_hide_title_meta_box_build( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'codo_show_hide_title_meta_box_nonce' );

	// retrieve the _codo_show_hide_title current value
	$current_value_show_hide_title = (get_post_meta( $post->ID, '_codo_show_hide_title', true ))? get_post_meta( $post->ID, '_codo_show_hide_title', true ): '0';

	?>
	<div class='inside'>
		<h3><?php _e( 'Hide Title', 'codoswp' ); ?></h3>
		<p>
			<input type="radio" name="codo_show_hide_title" value="1" <?php checked( $current_value_show_hide_title, '1' ); ?> /> Yes<br />
			<input type="radio" name="codo_show_hide_title" value="0" <?php checked( $current_value_show_hide_title, '0' ); ?> /> No
		</p>
	</div>
	<?php
}

/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
function codo_show_hide_title_meta_box_save( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['codo_show_hide_title_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['codo_show_hide_title_meta_box_nonce'], basename( __FILE__ ) ) ){
		return;
	}

	// return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}

  // Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ){
		return;
	}

	// store custom fields values
	if ( isset( $_REQUEST['codo_show_hide_title'] ) ) {
		update_post_meta( $post_id, '_codo_show_hide_title', sanitize_text_field( $_POST['codo_show_hide_title'] ) );
	}

}
add_action( 'save_post', 'codo_show_hide_title_meta_box_save' );
