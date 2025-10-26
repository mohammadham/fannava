<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

class Fannava_OCDI_Demo_Importer {

    public function __construct() {
        add_filter( 'pt-ocdi/import_files', [$this, 'import_files_config'] );
        add_filter( 'pt-ocdi/after_import', [$this, 'ocdi_after_import_setup'] );
        add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
        add_action( 'init', [$this, 'fannava_ocdi_rewrite_flush'] );
        
        // فیلترها برای تبدیل به local assets
        add_filter( 'wp_get_attachment_url', [$this, 'convert_demo_urls_to_local'], 10, 2 );
        add_filter( 'wp_calculate_image_srcset', [$this, 'fix_srcset_for_local_assets'], 10, 5 );
        
        // صفحه admin برای گزارش
        add_action( 'admin_menu', [$this, 'add_assets_report_page'] );
    }
    
    /**
     * Add admin page for assets report
     * اضافه کردن صفحه admin برای گزارش فایل‌ها
     */
    public function add_assets_report_page() {
        add_submenu_page(
            'tools.php',
            __( 'گزارش فایل‌های دمو Fannava', 'fannavacore' ),
            __( 'گزارش دمو Fannava', 'fannavacore' ),
            'manage_options',
            'fannava-demo-assets-report',
            [$this, 'render_assets_report_page']
        );
    }
    
    /**
     * Render assets report page
     * نمایش صفحه گزارش فایل‌ها
     */
    public function render_assets_report_page() {
        // اجرای چک دستی
        if ( isset( $_POST['check_assets'] ) && check_admin_referer( 'fannava_check_assets' ) ) {
            $this->manual_check_assets();
        }
        
        $report = get_option( 'fannava_demo_assets_report', array() );
        
        ?>
        <div class="wrap" dir="rtl">
            <h1>گزارش فایل‌های دمو Fannava</h1>
            
            <div class="card" style="max-width: 100%; margin-top: 20px;">
                <h2>خلاصه گزارش</h2>
                
                <?php if ( empty( $report ) ) : ?>
                    <p>هنوز گزارشی ایجاد نشده است. لطفاً دمو را import کنید یا دکمه "بررسی مجدد" را بزنید.</p>
                <?php else : ?>
                    <table class="widefat" style="margin-top: 15px;">
                        <tbody>
                            <tr>
                                <th style="width: 200px;">تعداد کل فایل‌ها</th>
                                <td><strong><?php echo esc_html( $report['total_files'] ); ?></strong></td>
                            </tr>
                            <tr>
                                <th>فایل‌های موجود</th>
                                <td style="color: green;"><strong><?php echo esc_html( $report['found_files'] ); ?></strong></td>
                            </tr>
                            <tr>
                                <th>فایل‌های گم شده</th>
                                <td style="color: <?php echo $report['missing_files'] > 0 ? 'red' : 'green'; ?>;"><strong><?php echo esc_html( $report['missing_files'] ); ?></strong></td>
                            </tr>
                            <tr>
                                <th>آخرین بررسی</th>
                                <td><?php echo esc_html( $report['checked_at'] ?? '-' ); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <?php if ( ! empty( $report['missing_list'] ) ) : ?>
                        <h3 style="margin-top: 30px;">لیست فایل‌های گم شده (<?php echo count( $report['missing_list'] ); ?> فایل)</h3>
                        <div style="max-height: 400px; overflow-y: auto; background: #f9f9f9; padding: 15px; border: 1px solid #ddd;">
                            <ol style="font-family: monospace; font-size: 12px; line-height: 1.8;">
                                <?php foreach ( array_slice( $report['missing_list'], 0, 100 ) as $file ) : ?>
                                    <li><?php echo esc_html( $file ); ?></li>
                                <?php endforeach; ?>
                                <?php if ( count( $report['missing_list'] ) > 100 ) : ?>
                                    <li><em>... و <?php echo count( $report['missing_list'] ) - 100; ?> فایل دیگر</em></li>
                                <?php endif; ?>
                            </ol>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                
                <form method="post" style="margin-top: 20px;">
                    <?php wp_nonce_field( 'fannava_check_assets' ); ?>
                    <button type="submit" name="check_assets" class="button button-primary">
                        🔄 بررسی مجدد فایل‌ها
                    </button>
                </form>
            </div>
            
            <div class="card" style="max-width: 100%; margin-top: 20px;">
                <h2>راهنما</h2>
                <p><strong>این صفحه چه کاری انجام می‌دهد؟</strong></p>
                <p>این ابزار فایل‌های مورد نیاز دمو را که در فایل XML ذکر شده‌اند با فایل‌های موجود در پوشه <code>local-assets</code> مقایسه می‌کند.</p>
                
                <p><strong>اگر فایل‌هایی گم شده باشند چه کنم؟</strong></p>
                <ul style="list-style: disc; margin-right: 25px;">
                    <li>فایل‌های گم شده به طور خودکار از سرور اصلی دانلود می‌شوند</li>
                    <li>می‌توانید فایل‌ها را به صورت دستی در <code>/admin/demo-data/local-assets/uploads/</code> قرار دهید</li>
                    <li>برای کاهش حجم و سرعت بیشتر، توصیه می‌شود همه فایل‌ها را local داشته باشید</li>
                </ul>
            </div>
        </div>
        <?php
    }
    
    /**
     * Manual check assets
     * بررسی دستی فایل‌ها
     */
    private function manual_check_assets() {
        $this->check_missing_local_assets();
        
        add_action( 'admin_notices', function() {
            echo '<div class="notice notice-success is-dismissible"><p>بررسی فایل‌ها با موفقیت انجام شد!</p></div>';
        } );
    }
    
    /**
     * Convert demo URLs to local asset URLs
     * تبدیل URLهای دمو به فایل‌های لوکال
     */
    public function convert_demo_urls_to_local( $url, $attachment_id ) {
        // لیست دامنه‌های دمو که باید به لوکال تبدیل شوند
        $demo_domains = array(
            'https://ekobyte.themeearth.com',
            'http://ekobyte.themeearth.com',
            'https://fannava.themeearth.com',
            'http://fannava.themeearth.com',
            'https://fannava.local',
            'http://fannava.local',
            'https://techsometimes.com/products/wp/ekobyte',
            'http://techsometimes.com/products/wp/ekobyte',
        );
        
        foreach ( $demo_domains as $domain ) {
            if ( strpos( $url, $domain ) !== false ) {
                // استخراج مسیر فایل از URL
                $path = str_replace( $domain . '/wp-content/', '', $url );
                
                // ساخت URL لوکال
                $local_url = FANNAVA_ADDONS_URL . 'admin/demo-data/local-assets/' . $path;
                
                // بررسی وجود فایل در local-assets
                $local_path = FANNAVA_ADDONS_PATH . 'admin/demo-data/local-assets/' . $path;
                
                if ( file_exists( $local_path ) ) {
                    // لاگ موفقیت (فقط در حالت debug)
                    if ( defined('WP_DEBUG') && WP_DEBUG ) {
                        error_log( sprintf( 
                            '[Fannava Demo] ✓ فایل لوکال یافت شد: %s', 
                            $path 
                        ) );
                    }
                    return $local_url;
                } else {
                    // هشدار: فایل لوکال یافت نشد
                    if ( defined('WP_DEBUG') && WP_DEBUG ) {
                        error_log( sprintf( 
                            '[Fannava Demo] ⚠ فایل لوکال یافت نشد: %s (URL اصلی استفاده می‌شود)', 
                            $path 
                        ) );
                    }
                    // بازگشت به URL اصلی به عنوان fallback
                    return $url;
                }
            }
        }
        
        return $url;
    }
    
    /**
     * Fix srcset for local assets
     */
    public function fix_srcset_for_local_assets( $sources, $size_array, $image_src, $image_meta, $attachment_id ) {
        if ( empty( $sources ) ) {
            return $sources;
        }
        
        foreach ( $sources as $width => $source ) {
            $sources[$width]['url'] = $this->convert_demo_urls_to_local( $source['url'], $attachment_id );
        }
        
        return $sources;
    }

    public function import_files_config() {

		$home_prevs = array(
			'fannava_demo_home_1' => array(
				'title' => __( 'Home 1', 'fannavacore' ),
				'page'  => __( 'home-1', 'fannavacore' ),
				'screenshot' => plugins_url( 'assets/img/demo/home-1.jpg', dirname(__FILE__) ),
				'preview_link' => 'https://fannava.themeearth.com/',
			),
			'fannava_demo_home_2' => array(
				'title' => __( 'Home 2', 'fannavacore' ),
				'page'  => __( 'home-2', 'fannavacore' ),
				'screenshot' => plugins_url( 'assets/img/demo/home-2.jpg', dirname(__FILE__) ),
				'preview_link' => 'https://fannava.themeearth.com/home-2/',
			),
		);

        $config = [];

        $import_path = trailingslashit( FANNAVA_ADDONS_PATH ) . 'admin/demo-data/';;
        
        foreach ( $home_prevs as $key => $prev ) {

            $contents_demo = $import_path . 'contents-demo.xml';
            $widget_settings = $import_path . 'widget-settings.wie';
            $customizer_data = $import_path . 'customizer-data.dat';

            $config[] = [
                'import_file_id'               => $key,
                'import_page_name'             => $prev['page'],
                'import_file_name'             => $prev['title'],
                'local_import_file'            => $contents_demo,
                'local_import_widget_file'     => $widget_settings,
                'local_import_customizer_file' => $customizer_data,
                'import_preview_image_url'     => $prev['screenshot'],
                'preview_url'                  => $prev['preview_link'],
                'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'fannavacore' ),
            ];
        }

        return $config;
    }

    public function ocdi_after_import_setup( $selected_file ) {

        $this->assign_menu_to_location();
        $this->assign_custom_post();
        $this->assign_frontpage_id( $selected_file );
        $this->update_permalinks();
        $this->check_missing_local_assets(); // چک کردن فایل‌های گم شده
        update_option( 'basa_ocdi_importer_flash', true );
    }
    
    /**
     * Check for missing local assets
     * بررسی فایل‌های لوکال گم شده
     */
    private function check_missing_local_assets() {
        $xml_file = FANNAVA_ADDONS_PATH . 'admin/demo-data/contents-demo.xml';
        
        if ( ! file_exists( $xml_file ) ) {
            return;
        }
        
        $xml_content = file_get_contents( $xml_file );
        
        // استخراج تمام URLهای wp-content/uploads
        preg_match_all( '/wp-content\/uploads\/([^<"]+)/', $xml_content, $matches );
        
        if ( empty( $matches[1] ) ) {
            return;
        }
        
        $missing_files = array();
        $found_files = array();
        
        foreach ( array_unique( $matches[1] ) as $file_path ) {
            $local_path = FANNAVA_ADDONS_PATH . 'admin/demo-data/local-assets/uploads/' . $file_path;
            
            if ( file_exists( $local_path ) ) {
                $found_files[] = $file_path;
            } else {
                $missing_files[] = $file_path;
            }
        }
        
        // ذخیره گزارش
        $report = array(
            'total_files' => count( array_unique( $matches[1] ) ),
            'found_files' => count( $found_files ),
            'missing_files' => count( $missing_files ),
            'missing_list' => $missing_files,
            'checked_at' => current_time( 'mysql' ),
        );
        
        update_option( 'fannava_demo_assets_report', $report );
        
        // نمایش پیام در admin
        if ( ! empty( $missing_files ) ) {
            add_action( 'admin_notices', function() use ( $report ) {
                printf(
                    '<div class="notice notice-warning is-dismissible"><p><strong>هشدار Fannava Demo:</strong> %d فایل از %d فایل در local-assets یافت نشد. این فایل‌ها از سرور اصلی دانلود خواهند شد.</p></div>',
                    $report['missing_files'],
                    $report['total_files']
                );
            } );
        }
    }

    private function assign_menu_to_location() {

        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

        set_theme_mod( 'nav_menu_locations', [
            'main-menu' => $main_menu->term_id,
        ] );
    }

    private function assign_custom_post() {
        // Set the new value for posts_per_page
        $new_posts_per_page = 5;

        // Update post types
        $custom_post_types = array(
            'post',
            'page',
            'e-landing-page',
            'portfolio',
        );
        // Update the posts_per_page option
        update_option('posts_per_page', $new_posts_per_page);

        update_option('elementor_cpt_support', $custom_post_types);
    }

    private function assign_frontpage_id( $selected_import ) {

        $front_page = get_page_by_title( $selected_import['import_page_name'] );
        $blog_page = get_page_by_title( 'Blog' );

        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page->ID );
        update_option( 'page_for_posts', $blog_page->ID );
    }


    private function update_permalinks() {
        update_option( 'permalink_structure', '/%postname%/' );
    }

    public function fannava_ocdi_rewrite_flush() {

        if ( get_option( 'basa_ocdi_importer_flash' ) == true ) {
            flush_rewrite_rules();
            delete_option( 'basa_ocdi_importer_flash' );
        }
    }
}

new Fannava_OCDI_Demo_Importer;
