<?php
/**
 * Created by PhpStorm.
 * User: ManTran
 * Date: 7/11/2015
 * Time: 10:59 AM
 */


function social_register_custom_widgets() {
    register_widget( 'My_Widget_social' );
}
add_action( 'widgets_init', 'social_register_custom_widgets' );
/**
 * Recent_Posts widget class
 *
 * @since 2.8.0
 */
class My_Widget_Social extends WP_Widget {

    public function __construct() {
        $widget_ops = array('classname' => 'my_widget_social', 'description' => __( "Your social network.") );
        parent::__construct('my-social', __('My Social'), $widget_ops);
        $this->alt_option_name = 'my_widget_social';

        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    public function widget($args, $instance) {
        $cache = array();
        if ( ! $this->is_preview() ) {
            $cache = wp_cache_get( 'my_widget_social', 'widget' );
        }

        if ( ! is_array( $cache ) ) {
            $cache = array();
        }

        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Social' );

        /** This filter is documented in wp-includes/default-widgets.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        $facebook    = isset( $instance['facebook'] ) ? esc_attr( $instance['facebook'] ) : '';
        $twitter    = isset( $instance['twitter'] ) ? esc_attr( $instance['twitter'] ) : '';
        $linkedin    = isset( $instance['linkedin'] ) ? esc_attr( $instance['linkedin'] ) : '';
        $rss    = isset( $instance['rss'] ) ? esc_attr( $instance['rss'] ) : '';
        $googleplus    = isset( $instance['googleplus'] ) ? esc_attr( $instance['googleplus'] ) : '';
        ?>
        <?php echo $args['before_widget']; ?>
        <?php if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        } ?>

            <div class="navbar-social">
                <?php if(!empty($facebook)) { ?>
                    <a class="fa fa-facebook" href="<?= $facebook ?>"></a>
                <?php } ?>
                <?php if(!empty($twitter)) { ?>
                    <a class="fa fa-twitter" href="<?= $twitter ?>"></a>
                <?php } ?>
                <?php if(!empty($linkedin)) { ?>
                    <a class="fa fa-linkedin" href="<?= $linkedin ?>"></a>
                <?php } ?>
                <?php if(!empty($rss)) { ?>
                    <a class="fa fa-rss" href="<?= $rss ?>"></a>
                <?php } ?>
                <?php if(!empty($googleplus)) { ?>
                    <a class="fa fa-google-plus" href="<?= $googleplus ?>"></a>
                <?php } ?>
            </div>

        <?php echo $args['after_widget']; ?>

        <?php

        if ( ! $this->is_preview() ) {
            $cache[ $args['widget_id'] ] = ob_get_flush();
            wp_cache_set( 'my_widget_social', $cache, 'widget' );
        } else {
            ob_end_flush();
        }
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['facebook'] = strip_tags($new_instance['facebook']);
        $instance['twitter'] = strip_tags($new_instance['twitter']);
        $instance['rss'] = strip_tags($new_instance['rss']);
        $instance['googleplus'] = strip_tags($new_instance['googleplus']);
        $instance['linkedin'] = strip_tags($new_instance['linkedin']);
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['my_widget_social']) )
            delete_option('my_widget_social');

        return $instance;
    }

    public function flush_widget_cache() {
        wp_cache_delete('my_widget_social', 'widget');
    }

    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $facebook    = isset( $instance['facebook'] ) ? esc_attr( $instance['facebook'] ) : '';
        $twitter    = isset( $instance['twitter'] ) ? esc_attr( $instance['twitter'] ) : '';
        $linkedin    = isset( $instance['linkedin'] ) ? esc_attr( $instance['linkedin'] ) : '';
        $rss    = isset( $instance['rss'] ) ? esc_attr( $instance['rss'] ) : '';
        $googleplus    = isset( $instance['googleplus'] ) ? esc_attr( $instance['googleplus'] ) : '';
        ?>
        <p><label for="<?php echo $this->get_field_id( 'Title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'Facebook' ); ?>"><?php _e( 'Facebook:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo $facebook; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'Twitter' ); ?>"><?php _e( 'Twitter:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo $twitter; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'LinkedIN' ); ?>"><?php _e( 'LinkedIN:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" type="text" value="<?php echo $linkedin; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'Rss' ); ?>"><?php _e( 'Rss:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" type="text" value="<?php echo $rss; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'GooglePlus' ); ?>"><?php _e( 'Google+:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'googleplus' ); ?>" name="<?php echo $this->get_field_name( 'googleplus' ); ?>" type="text" value="<?php echo $googleplus; ?>" /></p>

    <?php
    }
}