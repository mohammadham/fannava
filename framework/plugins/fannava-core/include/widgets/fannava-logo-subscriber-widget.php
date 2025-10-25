<?php
class Fannava_Logo_Subscriber_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct('fannava-logo-subscriber-footer', 'Fannava Logo and Subscriber', array(
			'description'	=> 'Logo and Subscriber Footer Widget by Fannava'
		));
    }

    public function widget( $args, $instance ) {
        extract( $args );
        extract( $instance );

        $widget_id =  $args['widget_id'];

        print $before_widget;
        ?>

            <?php
                if ( !empty( $title ) ) {
                    print $before_title . apply_filters( 'widget_title', $title ) . $after_title;
                }
            ?>

            <div class="te-footer-widget-info">
                <div class="te-footer-logo">
                    <?php if( !empty($image_box_image) ): ?>
                        <a href="<?php  print home_url(); ?>"><img src="<?php print $image_box_image; ?>" alt=""></a>
                    <?php endif; ?>
                </div>
                <p>
                    <?php 
                    if ( !empty( $footer_description ) ) {
                        print $footer_description;
                    }
                    ?>
                </p>
                <div class="te-subscribe-form-widget">
                    <?php print do_shortcode( $mailchimp_shortcode );?>
                </div>
            </div>


	    <?php print $after_widget;?>

		<?php
}

    /**
     * widget function.
     *
     * @see WP_Widget
     * @access public
     * @param array $instance
     * @return void
     */
    public function form( $instance ) {
        // $title = isset( $instance['title'] ) ? $instance['title'] : '';
        $author_img  = isset($instance['image_box_image'])? $instance['image_box_image']:'';
        $footer_description = isset( $instance['footer_description'] ) ? $instance['footer_description'] : '';
        $mailchimp_shortcode = isset( $instance['mailchimp_shortcode'] ) ? $instance['mailchimp_shortcode'] : '';

        $mailchimp_text = isset( $instance['mailchimp_text'] ) ? $instance['mailchimp_text'] : '';
        ?>

            <p>
				<button type="submit" class="button button-secondary" id="author_info_image">Upload Logo</button>
				<input type="hidden" name="<?php print esc_attr($this->get_field_name('image_box_image')); ?>" class="image_er_link" value="<?php print $author_img ; ?>">
				<div class="author-image-show">
					<img src="<?php print $author_img ; ?>" alt="" width="150" height="auto">
				</div>	
            </p>
            
            <p><label for="footer_description"><?php esc_html_e( 'Description:', 'fannavacore' );?></label></p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'footer_description' ) );?>"  class="widefat" name="<?php print esc_attr( $this->get_field_name( 'footer_description' ) );?>" value="<?php print esc_attr( $footer_description );?>">

			<p><label for="title"><?php esc_html_e( 'Subscribe Form Shortcode:', 'fannavacore' );?></label></p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'mailchimp_shortcode' ) );?>" class="widefat" name="<?php print esc_attr( $this->get_field_name( 'mailchimp_shortcode' ) );?>" value="<?php print esc_attr( $mailchimp_shortcode );?>">

			<?php
}

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        // $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['image_box_image'] = ( ! empty( $new_instance['image_box_image'] ) ) ? strip_tags( $new_instance['image_box_image'] ) : '';
        $instance['footer_description'] = ( !empty( $new_instance['footer_description'] ) ) ? strip_tags( $new_instance['footer_description'] ) : '';
        $instance['mailchimp_shortcode'] = ( !empty( $new_instance['mailchimp_shortcode'] ) ) ? strip_tags( $new_instance['mailchimp_shortcode'] ) : '';


        return $instance;
    }
}

add_action('widgets_init', function(){
	register_widget('Fannava_Logo_Subscriber_Widget');
});
