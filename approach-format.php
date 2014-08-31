<?php
/**
 * conditional index template format for WordPress theme Enough
 *
 *
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * @package Enough
 */
global $enough_onecolumn_post, $enough_home_template;
get_header();
?>
<br class="clear" />
<?php
/**
 * index , archive and another list of contents page title.
 */
enough_loop_title();
/**
 * Monthly archive prev next links
 */
enough_monthly_archive_prev_next_navigation();
/**
 * post and page content start
 */
if ( have_posts() ) {

    while ( have_posts() ) {


        the_post();
        if ( has_post_format( $enough_home_template ) ) {

            get_template_part( 'content', $enough_home_template );

            break;
        }
    }//endwhile
} else {

    enough_not_found();
}

$enough_post_formats = get_theme_support( 'post-formats' );
?>
<div class="posts-nav-link">
    <div class="alignleft"><?php previous_posts_link( esc_html__( '&laquo; Previous Page', 'enough' ) ); ?></div>
    <div class="alignright"><?php next_posts_link( esc_html__( 'Next Page &raquo;', 'enough' ), '' ); ?></div>
</div>
<aside class="custom-format-link-list-wrapper">
    <ul id="custom-post-format-widget-link">
        <?php
        $html                = '	<li class="%3$s"><a href="%1$s"><span>%2$s</span></a></li>';

        foreach ( $enough_post_formats[0] as $format ) {

            if ( $format !== $enough_home_template ) {

                printf( $html, esc_url( get_post_format_link( $format ) ), esc_html( enough_get_post_format_string( $format ) ), esc_attr( $format )
                );
            }
        }
        ?>
    </ul>
    <br class="clear" />
    <ul class="approach-widget">
        <?php
        dynamic_sidebar( 'sidebar-approach' );
        ?>
    </ul>
</aside>


<?php
/**
 * Sidebar
 */
enough_dinamic_sidebar( 'sidebar-1', !is_page() );
?>

<br class="clear vspacer-3" />
<?php get_footer(); ?>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
