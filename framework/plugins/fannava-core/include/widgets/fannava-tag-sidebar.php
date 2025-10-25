<?php 
Class Fannava_Tag_Sidebar extends WP_Widget{

	public function __construct(){
		parent::__construct('fannava-tag-sidebar', 'Fannava Sidebar Tag', array(
			'description'	=> 'Sidebar tag by Fannava'
		));
	}


	public function widget($args, $instance){

		extract($args);
	 	echo $before_widget; 
	 	if($instance['title']):
     		echo $before_title; ?> 
     		<?php echo apply_filters( 'widget_title', $instance['title'] ); ?>
     		<?php echo $after_title; ?>
		 <?php endif; ?>
		 
		 	<div class="widget te_widget_tag_cloud">
				<div class="tagcloud">
					
				<?php 
					$tags = get_terms( array(
						'taxonomy' => 'post_tag',
						'hide_empty' => true,
					) );
					?>
					<?php if ( !empty($tags) ) : ?>
						<?php foreach ( $tags as $tag ) : ?>
								<a href="<?php echo esc_url( get_category_link( $tag->term_id)); ?>">
									<?php echo esc_html($tag->name); ?>
								</a>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>

		<?php echo $after_widget; ?>

		<?php
	}



	public function form($instance){
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$count = ! empty( $instance['count'] ) ? $instance['count'] : esc_html__( '5', 'tocores' );
		$posts_order = ! empty( $instance['posts_order'] ) ? $instance['posts_order'] : esc_html__( 'DESC', 'tocores' );
	?>	
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>">How many category you want to show ?</label>
			<input type="number" name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo esc_attr( $count ); ?>" class="widefat">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('posts_order'); ?>">Category Order</label>
			<select name="<?php echo $this->get_field_name('posts_order'); ?>" id="<?php echo $this->get_field_id('posts_order'); ?>" class="widefat">
				<option value="" disabled="disabled">Select Category Order</option>
				<option value="ASC" <?php if($posts_order === 'ASC'){ echo 'selected="selected"'; } ?>>ASC</option>
				<option value="DESC" <?php if($posts_order === 'DESC'){ echo 'selected="selected"'; } ?>>DESC</option>
			</select>
		</p>

	<?php }


}

add_action('widgets_init', function(){
	register_widget('Fannava_Tag_Sidebar');
});