<?php
/**
 * index template for WordPress theme Enough
 *
 *
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * @package Enough
 */
global $enough_onecolumn_post;

enough_get_header();

print '<br class="clear" />';

enough_loop_title();

enough_monthly_archive_prev_next_navigation();

if ( have_posts() ) {

    if ( has_post_format( 'image' ) ) {
        print '<div class="tiled-post-format-image">';
    }

    while ( have_posts() ) {

        the_post();

        $enough_post_format = get_post_format();

        if ( $enough_post_format === false ) {

            get_template_part( 'content' );
        } else {

            get_template_part( 'content', $enough_post_format );
        }
    }//endwhile

    if ( has_post_format( 'image' ) ) {
        print '</div>';
    }
} else {

    enough_not_found();
}
if ( !has_post_format( 'image' ) ) {

    enough_dinamic_sidebar( 'sidebar-1', !is_page() );
}

printf( '<div class="posts-nav-link">%1$s</div><br class="clear vspacer-3" />', get_posts_nav_link( array( 'sep' => ' ', 'prelabel' => esc_html__( 'Previous Page', 'enough' ), 'nxtlabel' => esc_html__( 'Next Page', 'enough' ) ) ) );

//enough_dinamic_sidebar( 'sidebar-1', $enough_onecolumn_post );

enough_the_footer();
?>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
