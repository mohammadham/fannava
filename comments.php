<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 */
?>
<?php
// If the current post is protected by a password and the visitor has not yet 
// entered the password we will return early without loading the comments.
// ----------------------------------------------------------------------------------------
if ( post_password_required() ) {
    return;
}
?>

<?php if ( have_comments() || comments_open()) : ?>

    <?php if ( get_comments_number() >= 1 ): ?>
        <!-- Comment List Start -->
        <div class="te-post-comments">
            <div class="te-comment-title">

                <?php
                    $comment_no = number_format_i18n( get_comments_number() );
                    $comment_text = ( !empty( $comment_no ) AND ( $comment_no > 1 ) ) ? esc_html__( ' Comments Found', 'ekobyte' ) : esc_html__( ' Comment Found', 'ekobyte' );
                    $comment_no = ( !empty( $comment_no ) AND ( $comment_no > 0 ) ) ? '<h2>' . esc_html( $comment_no . $comment_text ) . '</h2>' : ' ';
                    print sprintf( "%s", $comment_no );
                ?>

            </div>
            <div class="te-latest-comments">
                <ul>
                    <?php
                        wp_list_comments( [
                            'style'       => 'ul',
                            'callback'    => 'ekobyte_comment',
                            'avatar_size' => 90,
                            'short_ping'  => true,
                        ] );
                    ?>
                </ul>
            </div>
        </div>
        <!-- Comment List End -->
    <?php endif;?>



    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ): ?>
        <div class="comment-pagination mb-50 d-none">
            <nav id="comment-nav-below" class="comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'ekobyte' );?></h1>
                <div class="row">
                    <div class="col-md-6">
                        <div class="nav-previous "><?php previous_comments_link( esc_html__( '&larr; Older ', 'ekobyte' ) );?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="nav-next "><?php next_comments_link( esc_html__( 'Newer &rarr;', 'ekobyte' ) );?></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </nav><!-- #comment-nav-below -->
        </div>
    <?php endif; // check for comment navigation ?>


    <!-- Comment Form Start -->
    <div class="te-post-comments-form">
        <div class="te-comment-respond">
            <?php
            $post_id = '';
            if ( null === $post_id )
                $post_id = get_the_ID();
            else
                $id      = $post_id;

            $commenter       = wp_get_current_commenter();
            $user            = wp_get_current_user();
            $user_identity   = $user->exists() ? $user->display_name : '';


            $req         = get_option( 'require_name_email' );
            $aria_req    = ( $req ? " aria-required='true'" : '' );

            $fields = array(
                'author' => '<div class="row gx-4"><div class="col-xl-4"><div class="te-contacts-name"><input placeholder="'.  esc_attr__('Enter Name', 'ekobyte').'" id="author" name="author" type="text" value="' . esc_attr( $commenter[ 'comment_author' ] ) . '" ' . $aria_req . ' /></div></div>',
                'email'  => '<div class="col-xl-4"><div class="te-contacts-email"><input placeholder="'.  esc_attr__('Enter Email', 'ekobyte').'" id="email" name="email" type="email" value="' . esc_attr( $commenter[ 'comment_author_email' ] ) . '"' . $aria_req . ' /></div></div>',
                'url'    => '<div class="col-xl-4"><div class="te-contacts-name"><input placeholder="'.  esc_attr__('Enter Website', 'ekobyte').'" id="url" name="url" type="url" value="' . esc_attr( $commenter[ 'comment_author_url' ] ) . '" /></div></div></div>'
            );

            if ( is_user_logged_in() ) {
                $cl = 'loginformuser';
            } else {
                $cl = '';
            }
            $defaults = [
                'fields'             => $fields,
                'comment_field'      => '
                    <div class="row gx-4">
                        <div class="col-xl-12 ' . $cl . '">
                        <div class="te-contacts-message"><textarea placeholder="'.  esc_attr__('Enter Your Comments', 'ekobyte').'" id="comment" name="comment" cols="20" rows="3" aria-required="true"></textarea></div>
                        </div>
                    </div>
                ',
                'submit_button'    => '<div class="col-12"><button class="te-theme-btn" type="submit">' . esc_html__( 'Post Comment', 'ekobyte' ) . ' <i class="fa-solid fa-arrow-right"></i></button></div>',
                /** This filter is documented in wp-includes/link-template.php */
                'must_log_in'        => '
                    <p class="must-log-in">
                    '.esc_html__('You must be','ekobyte').' <a href="'.esc_url(wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )).'">'.esc_html__('logged in','ekobyte').'</a> '.esc_html__('to post a comment.','ekobyte').'
                    </p>',
                /** This filter is documented in wp-includes/link-template.php */
                'logged_in_as'       => '
                    <p class="logged-in-as">
                    '.esc_html__('Logged in as','ekobyte').' <a href="'.esc_url(get_edit_user_link()).'">'.esc_html($user_identity).'</a>. <a href="'.esc_url(wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )).'" title="'.esc_attr__('Log out of this account','ekobyte').'">'.esc_html__('Log out?','ekobyte').'</a>
                    </p>',
                'id_form'            => 'commentform',
                'id_submit'          => 'submit',
                'class_submit'       => 'te-theme-btn',
                'title_reply'        => esc_html__( 'Add a Comment', 'ekobyte' ),
                'title_reply_to'     => esc_html__( 'Leave a Reply to %s', 'ekobyte' ),
                'cancel_reply_link'  => esc_html__( '   Cancel reply', 'ekobyte' ),
                'label_submit'       => esc_html__( 'Post Comment', 'ekobyte' ),
                'format'             => 'xhtml',
            ];

            comment_form( $defaults );
            ?>
        </div>
    </div>
    <!-- Comment Form End -->

<?php endif; ?>