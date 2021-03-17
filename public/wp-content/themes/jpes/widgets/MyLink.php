<?php
/**
 * Created by PhpStorm.
 * User: ManTran
 * Date: 7/11/2015
 * Time: 10:59 AM
 */


function link_register_custom_widgets() {
    register_widget( 'My_Widget_Link' );
}
add_action( 'widgets_init', 'link_register_custom_widgets' );
/**
 * Recent_Posts widget class
 *
 * @since 2.8.0
 */
class My_Widget_Link extends WP_Widget {

    public function __construct() {
        $widget_ops = array('classname' => 'my_widget_link', 'description' => __( "Your link.") );
        parent::__construct('my-link', __('My Link'), $widget_ops);
        $this->alt_option_name = 'my_widget_link';

        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    public function widget($args, $instance) {
        $cache = array();
        if ( ! $this->is_preview() ) {
            $cache = wp_cache_get( 'my_widget_link', 'widget' );
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

        $text     = isset( $instance['text'] ) ? esc_attr( $instance['text'] ) : '';
        $url    = isset( $instance['url'] ) ? esc_attr( $instance['url'] ) : '';
        $target    = isset( $instance['target'] ) ? esc_attr( $instance['target'] ) : '_self';
        ?>
        <?php echo $args['before_widget']; ?>
            <a class="my-link" href="<?= $url ?>" target="<?= $target ?>"><?= $text ?></a>
        <?php echo $args['after_widget']; ?>

        <?php

        if ( ! $this->is_preview() ) {
            $cache[ $args['widget_id'] ] = ob_get_flush();
            wp_cache_set( 'my_widget_link', $cache, 'widget' );
        } else {
            ob_end_flush();
        }
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['text'] = strip_tags($new_instance['text']);
        $instance['url'] = strip_tags($new_instance['url']);
        $instance['target'] = strip_tags($new_instance['target']);
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['my_widget_link']) )
            delete_option('my_widget_link');

        return $instance;
    }

    public function flush_widget_cache() {
        wp_cache_delete('my_widget_link', 'widget');
    }

    public function form( $instance ) {
        $text     = isset( $instance['text'] ) ? esc_attr( $instance['text'] ) : '';
        $url    = isset( $instance['url'] ) ? esc_attr( $instance['url'] ) : '';
        $target    = isset( $instance['target'] ) ? esc_attr( $instance['target'] ) : '_self';
        ?>
        <p><label for="<?php echo $this->get_field_id( 'Text' ); ?>"><?php _e( 'Text:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" type="text" value="<?php echo $text; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'Url' ); ?>"><?php _e( 'Url:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo $url; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'Target' ); ?>"><?php _e( 'Target:' ); ?></label>
            <select id="<?php echo $this->get_field_id( 'target' ); ?>" name="<?php echo $this->get_field_name( 'target' ); ?>">
                <option value="_self" <?php if($target === '_self'){ echo 'selected="selected"'; } ?>>Same window</option>
                <option value="_blank" <?php if($target === '_blank'){ echo 'selected="selected"'; } ?>>Another window</option>
            </select>
        </p>

    <?php
    }
}