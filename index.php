<?php
/**
 * conditional index template fallback for WordPress theme Enough
 *
 *
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * @package Enough
 */
$enough_options = enough_theme_option( 'defaults' );

if ( isset( $enough_options['enough_post_one_column_bottom_sidebar'] ) and
        $enough_options['enough_post_one_column_bottom_sidebar'] == 'yes' ) {

    $enough_onecolumn_post = 'yes';

    add_filter( 'post_class', 'enough_onecolumn_post' );
    add_filter( 'body_class', 'enough_onecolumn_post' );
	
} else {

    $enough_onecolumn_post = 'no';
}

get_header();

enough_loop_title();

enough_monthly_archive_prev_next_navigation();

if ( have_posts() ) {

    while ( have_posts() ) {

        the_post();

        $enough_post_format = get_post_format();

        if ( $enough_post_format === false ) {

            get_template_part( 'content' );
        } else {

            get_template_part( 'content', $enough_post_format );
        }
    }

} else {
    enough_not_found();
}

?><div class="posts_pagination_wrapper"><?php the_posts_pagination();?></div>
<?php
/**
 * Sidebar
 */
if( 'no' == enough_theme_option( 'enough_post_one_column_bottom_sidebar' ) ) {

	get_sidebar('1');
}
?>
<br class="clear vspacer-3" />
<?php
get_footer();
?>
</div>
</div>
<?php enough_append_body(); ?>
<?php wp_footer(); ?>
</body>
</html>