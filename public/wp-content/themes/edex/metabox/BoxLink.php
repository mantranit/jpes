<?php
/**
 * Created by PhpStorm.
 * User: Jimmy
 * Date: 7/30/2015
 * Time: 8:21 PM
 */
/**
 * Calls the class on the post edit screen.
 */
function callBoxLinkClass() {
    new BoxLinkClass();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'callBoxLinkClass' );
    add_action( 'load-post-new.php', 'callBoxLinkClass' );
}

/**
 * The Class.
 */
class BoxLinkClass {

    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post', array( $this, 'save' ) );
    }

    /**
     * Adds the meta box container.
     */
    public function add_meta_box( $post_type ) {
        $post_types = array('testimonial');     //limit meta box to certain post types
        if ( in_array( $post_type, $post_types )) {
            add_meta_box(
                'meta_box_link'
                ,__( 'Official Website', 'html5blank' )
                ,array( $this, 'render_meta_box_content' )
                ,$post_type
                ,'advanced'
                ,'high'
            );
        }
    }

    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     * @return mixed
     */
    public function save( $post_id ) {

        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */

        // Check if our nonce is set.
        if ( ! isset( $_POST['boxlink_inner_custom_box_nonce'] ) )
            return $post_id;

        $nonce = $_POST['boxlink_inner_custom_box_nonce'];

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'boxlink_inner_custom_box' ) )
            return $post_id;

        // If this is an autosave, our form has not been submitted,
        //     so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return $post_id;

        /* OK, its safe for us to save the data now. */

        // Sanitize the user input.
        $mydata = sanitize_text_field( $_POST['boxlink_field'] );

        // Update the meta field.
        update_post_meta( $post_id, '_boxlink_value_key', $mydata );
    }


    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_content( $post ) {

        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'boxlink_inner_custom_box', 'boxlink_inner_custom_box_nonce' );

        // Use get_post_meta to retrieve an existing value from the database.
        $value = get_post_meta( $post->ID, '_boxlink_value_key', true );

        // Display the form, using the current value.
        echo '<input type="text" id="boxlink_field" name="boxlink_field"';
        echo ' value="' . esc_attr( $value ) . '" style="width:100%" />';
    }
}