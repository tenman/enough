<?php
/**
 * conditional index template blank for WordPress theme Enough
 *
 *
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * @package Enough
 */
global $enough_onecolumn_post;

add_filter( 'wp_head', 'enough_approach_blank_style' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <title>
<?php
bloginfo();
wp_title( '|' );
?>
        </title>
            <?php
            wp_head();
            ?>
    </head>
    <body <?php body_class( 'approach-blank' ); ?>>
        <div id="enough-page">
            <h1 class="site-title">
                <a href="<?php echo home_url(); ?>">
                    <span><?php bloginfo(); ?></span>
                </a>
            </h1>
            <h2 class="site-description"><span><?php bloginfo( 'description' ); ?></span></h2>
<?php
/**
 * Horizontal menu bar
 *
 *
 *
 *
 */
if ( !has_nav_menu( 'primary' ) ) {
    $args = array( 'menu_class'      => 'menu-header'
        , 'theme_location'  => 'primary'
        , 'container_class' => 'menu-header'
        , 'echo'            => true );
    wp_nav_menu( $args );
} else {
    $args = array( 'theme_location'  => 'primary'
        , 'container_class' => 'menu-header'
        , 'echo'            => true );
    wp_nav_menu( $args );
}
?>
            <br class="clear" />
            <div>
                <div id="push"></div>
            </div>
<?php
get_footer();

wp_footer();
?>
        </div>
    </body>
</html>