<?php
/**
 * Social Widget
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

namespace App\Widgets;

class SocialWidget extends \WP_Widget
{
	/**
     * Sets up a new Social Widget widget instance.
     *
     * @since 2.8.0
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'widget_eboursa_social block block-block footer-social clearfix',
            'description' => __('Eboursa Social widget'),
            'customize_selective_refresh' => true,
        );
        parent::__construct('eboursa-social', __('Eboursa Social'), $widget_ops);
    }

    /**
     * Outputs the content for the current Social Widget widget instance.
     *
     * @since 2.8.0
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Social Widget widget instance.
     */
    public function widget( $args, $instance ) {
        global $post;

        if(!isset( $args['widget_id'])) {
            $args['widget_id'] = $this->id;
        }        
        
        echo $args['before_widget'];
        
        echo render_template_part('template-parts/widgets/social', [
            'instance' => $instance,
        ]);
        
        echo $args['after_widget'];
    }

    /**
     * Handles updating the settings for the current Social Widget widget instance.
     *
     * @since 2.8.0
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance, $old_instance ) {
        $instance               = $old_instance;
        $instance['facebook']   = sanitize_text_field( $new_instance['facebook'] );
        $instance['twitter']    = sanitize_text_field( $new_instance['twitter'] );
        $instance['instagram']    = sanitize_text_field( $new_instance['instagram'] );
        $instance['linked-in']  = sanitize_text_field( $new_instance['linked-in'] );
        return $instance;
    }

    /**
     * Outputs the settings form for the Social Widget widget.
     *
     * @since 2.8.0
     *
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $facebook   = isset( $instance['facebook'] )    ? esc_attr( $instance['facebook'] )     : '';
        $twitter    = isset( $instance['twitter'] )     ? esc_attr( $instance['twitter'] )      : '';
        $instagram  = isset( $instance['instagram'] )     ? esc_attr( $instance['instagram'] )      : '';
        $linkedIn   = isset( $instance['linked-in'] )   ? esc_attr( $instance['linked-in'] )    : '';

        echo render_template_part('template-parts/widgets/social-form', [
            'instance'  => $this,
            'facebook'  => $facebook,
            'twitter'   => $twitter,
            'instagram' => $instagram,
            'linkedIn'  => $linkedIn,
        ]);
    }
}