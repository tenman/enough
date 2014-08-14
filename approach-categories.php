<?php
/**
 * conditional index template categories for WordPress theme Enough
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
<article <?php post_class( "approach-categories-content" ); ?> <?php if ( is_single() ) {
    printf( 'role="%1$s"', 'main' );
} ?>>
    <?php
    $args = array( 'orderby' => 'name',
        'order'   => 'ASC',
        'exclude' => '',
        'include' => '',
    );

    $categories = get_categories( $args );

    $html = '<div style=""><a style="" href="%1$s" title="%2$s" >%3$s</a></div>';

    foreach ( $categories as $category ) {

        printf( $html, get_category_link( $category->term_id ), sprintf( __( "View all posts in %s", 'enough' ), $category->name ), $category->name
        );
    }
    ?>
</article>
<?php
$enough_post_formats = get_theme_support( 'post-formats' );
?>
<aside class="custom-format-link-list-wrapper">
    <ul id="custom-post-format-widget-link">
        <?php
        $html = '	<li class="%3$s"><a href="%1$s"><span>%2$s</span></a></li>';

        foreach ( $enough_post_formats[ 0 ] as $format ) {

            printf( $html, esc_url( get_post_format_link( $format ) ), esc_html( enough_get_post_format_string( $format ) ), esc_attr( $format )
            );
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
<?php
get_footer();
?>
</div>
</div>
<?php
wp_footer();
?>
</body>
</html>

