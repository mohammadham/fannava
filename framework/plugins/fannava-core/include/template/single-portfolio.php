<?php 
/** 
 * The main template file
 *
 * @package  WordPress
 * @subpackage  tpcore
 */
get_header(); 
?>
   <!-- Project Details Page Start !-->
   <div class="project-details-page">       
      <div class="container">
         <div class="row">
            <div class="col-12">
               <?php 
               if( have_posts() ):
                  while( have_posts() ): the_post();
                     $project_details_image = function_exists('get_field') ? get_field('project_details_image') : '';
                     $project_info_repeater = function_exists('get_field') ? get_field('project_info_repeater') : '';
                  ?> 
                     <div class="te-project-details-wrapper">
                        <div class="content">
                           <div class="text">
                              <h2 class="title"><?php the_title(); ?></h2>
                              <p><?php the_content(); ?></p>
                           </div>
                        </div>
                     </div>
                  <?php 
                  endwhile; wp_reset_query();
               endif; ?>
            </div>
         </div>
      </div>
   </div>
   <!-- Project Details Page End !-->

<?php get_footer();  ?>