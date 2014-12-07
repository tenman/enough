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

    $html = '<div class="%4$s"><a href="%1$s" title="%2$s" >%3$s</a></div>';
	$initial_compare = '';
	$dummy_div_count = 0;
	$i = 1;
    foreach ( $categories as $category ) {
		

		$initial = mb_substr( $category->name  ,0 ,1 );
			
		if( mb_strtolower( $initial_compare ) == mb_strtolower( $initial ) ) {
			$initial_class = 'initial-category initial-'. $initial;
		}else{
			$initial_class = 'initial-category first initial-'. $initial;
			
		}
		
		$category_name = '<span>'.$initial.'</span>';	
		$category_name .= mb_substr( $category->name,1 );
		
		
        printf( $html, get_category_link( $category->term_id ), sprintf( __( "View all posts in %s", 'enough' ), $category->name ),  $category_name 
        , 'category-'.$category->term_id. ' '. $initial_class );
		$initial_compare = $initial;
		$i++;
    }
    ?>
</article>
<aside class="custom-format-link-list-wrapper">
	<?php  enough_custom_post_format_links_button( ); ?>
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

