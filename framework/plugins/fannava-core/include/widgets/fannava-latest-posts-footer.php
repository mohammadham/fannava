<?php 
Class Fannava_Latest_Posts_Footer_Widget extends WP_Widget{

	public function __construct(){
		parent::__construct('fannava-latest-posts-footer', 'Fannava Footer Posts', array(
			'description'	=> 'Latest Post Widget by Fannava'
		));
	}


	public function widget($args, $instance){
			extract($args);
			extract($instance);

	 	echo $before_widget; 
	 		if($instance['title']):
     		echo $before_title; ?> 
     			<?php echo apply_filters( 'widget_title', $instance['title'] ); ?>
     		<?php echo $after_title; ?>
		 <?php endif; ?>

		 
	     	<div class="te_widget_latest_post">
				<ul>
			        	
			    <?php 
				$q = new WP_Query( array(
				    'post_type'     => 'post',
				    'posts_per_page'=> ($instance['count']) ? $instance['count'] : '2',
				    'order'			=> ($instance['posts_order']) ? $instance['posts_order'] : 'DESC',
				    'orderby' => 'comment_count'
				));

				if( $q->have_posts() ):
				while( $q->have_posts() ):$q->the_post();
				?>
					<li>
						<?php if (has_post_thumbnail()) : ?>
							<div class="te-latest-post-thumb">
								<?php the_post_thumbnail('thumbnail'); ?>
							</div>
						<?php endif; ?>
						<div class="te-latest-post-desc">
							<span class="te-latest-post-meta"><?php the_time('F d, Y'); ?></span>
							<h3 class="te-latest-post-title">
								<a href="<?php the_permalink(); ?>"><?php print wp_trim_words(get_the_title(), 8, ''); ?></a>
							</h3>
						</div>
					</li>
					<?php endwhile;            
				 endif; ?> 

				 </ul>
			</div>

		<?php echo $after_widget; ?>

		<?php
	}



	public function form($instance){
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$count = ! empty( $instance['count'] ) ? $instance['count'] : esc_html__( '3', 'tocores' );
		$posts_order = ! empty( $instance['posts_order'] ) ? $instance['posts_order'] : esc_html__( 'DESC', 'tocores' );
		$choose_style = ! empty( $instance['choose_style'] ) ? $instance['choose_style'] : esc_html__( 'style_1', 'tocores' );
	?>	
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>">How many posts you want to show ?</label>
			<input type="number" name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo esc_attr( $count ); ?>" class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('posts_order'); ?>">Posts Order</label>
			<select name="<?php echo $this->get_field_name('posts_order'); ?>" id="<?php echo $this->get_field_id('posts_order'); ?>" class="widefat">
				<option value="" disabled="disabled">Select Post Order</option>
				<option value="ASC" <?php if($posts_order === 'ASC'){ echo 'selected="selected"'; } ?>>ASC</option>
				<option value="DESC" <?php if($posts_order === 'DESC'){ echo 'selected="selected"'; } ?>>DESC</option>
			</select>
		</p>

	<?php }


}

add_action('widgets_init', function(){
	register_widget('Fannava_Latest_Posts_Footer_Widget');
});