<?php
/**
 * index template for WordPress theme Enough
 *
 *
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * @package Enough
 */
?>
<?php
			global $enough_onecolumn_post; 
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
		if ( have_posts() ){
		
				while ( have_posts() ) {
				
					the_post();
						
					$enough_post_format = get_post_format();
					
					if( $enough_post_format === false ) {
					
						get_template_part( 'content' );
					} else {
				
						get_template_part( 'content', $enough_post_format );
					}
	
				}//endwhile
	
		} else {

			enough_not_found();
		} 
/**
 * Sidebar
 */
			enough_dinamic_sidebar( 'sidebar-1', ! is_page() );
/**
 * list of posts Navigation
 */
?>
			<div class="clear posts-nav-link">
<?php
			posts_nav_link(' ');
?>
    		</div>
			<br class="clear vspacer-3" />
<?php
/**
 * Sidebar show bottom when post 1column
 */
			enough_dinamic_sidebar( 'sidebar-1', $enough_onecolumn_post );
		
			get_footer();
?>
		</div>
	</div>
<?php wp_footer(); ?>
</body>
</html>
