<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package fannava
 */

get_header();
?>

<div class="tp-page-area pt-120 pb-120">
   <div class="container">
      <div class="row justify-content-center">
			<div class="col-xl-8">
            <div class="tp-page-content">
               <?php 
               $fannava_404_bg = get_theme_mod('fannava_404_bg',get_template_directory_uri() . '/assets/img/error/error.png');
               $fannava_error_title = get_theme_mod('fannava_error_title', __('Page not found', 'fannava'));
               $fannava_error_link_text = get_theme_mod('fannava_error_link_text', __('Back To Home', 'fannava'));
               $fannava_error_desc = get_theme_mod('fannava_error_desc', __('Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'fannava'));
               ?>
               <div class="error-item">
                  <div class="error-thumb">
                     <img src="<?php echo esc_url($fannava_404_bg); ?>" alt="<?php print esc_attr__('Error 404','fannava'); ?>">
                  </div>
                  <div class="error-content">
                     <h2 class="error-title"><?php print esc_html($fannava_error_title);?></h2>
                     <p><?php print esc_html($fannava_error_desc);?></p>
                     <a href="<?php print esc_url(home_url('/'));?>" class="link-anime v2"><?php print esc_html($fannava_error_link_text);?></a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php
get_footer();
