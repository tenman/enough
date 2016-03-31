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

if ( ! is_home() ) {
	printf( '<div class="posts-nav-link">%1$s</div>', 
		get_posts_nav_link( array( 
									'sep' => ' ', 
									'prelabel' => esc_html__( '&laquo;Previous Page', 'enough' ),
									'nxtlabel' => esc_html__( 'Next Page &raquo;', 'enough' )
							) 
				) 
	);
} ?>
<aside class="custom-format-link-list-wrapper">
	<?php  enough_custom_post_format_links_button( );?>
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
	if( ! is_page() ){
		get_sidebar('1');
	}
?>

<br class="clear vspacer-3" />
<?php get_footer(); ?>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
