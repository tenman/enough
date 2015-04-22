<?php
/**
 * Template Name: blog
 *
 */
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
$posts_per_page             = 10; //ページあたりのリンク件数
$paged                      = '';
$content                    = '';
$html_structure             = '<li><a href="%1$s">%2$s</a></li>';
$html_list_wrapper          = '<ul>%1$s</ul>';
$html_pagenate_links_wrapper= '<div class="enough-pagenate-links">%1$s</div>';
 
$paged= get_query_var('paged');
 
if ( !isset( $posts_per_page ) ) {
 
    $posts_per_page         = get_option('posts_per_page');
}
 
$args= array('paged'=> $paged , 'posts_per_page'=> $posts_per_page );
 
if ( ! is_paged() ) {
 
    $args['numberposts']    = $posts_per_page;
    $paged                  = 1;
} elseif($paged== 2) {
 
    $args['offset']         = $posts_per_page;
} else {
 
    $args['offset']         = $posts_per_page * ( $paged-1 );
}
 
$paging_contents= get_posts( $args );
 
if ( $paging_contents ) {
    foreach ( $paging_contents as $post ){
		setup_postdata($post);
 ?>    
      <article <?php post_class(); ?> <?php if ( is_single() ) {
    printf( 'role="%1$s"', 'main' );
} ?>>
    <?php
    if ( !post_password_required() && is_singular() ) {
        echo apply_filters( 'enough_post_thumbnail', get_the_post_thumbnail() );
    }
    
    enough_article_title();

    $enough_post_format = get_post_format();

    if ( $enough_post_format === false ) {
        enough_posted_on( $diaplay = true );
    } else {
        enough_post_format_posted_on();
    }
    ?>
    <div class="entry-content">
        <?php
        enough_the_content( __( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'enough' ) );
        ?>
    </div>
    <br class="clear vspacer-1" />
    <?php
    enough_attachment_navigation();

    wp_link_pages( array(
        'before'      => '<div class="wp-link-pages">',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>'
    ) );
    if ( $enough_post_format === false ) {
        enough_posted_in();
    } else {
        enough_post_format_posted_in();
    }
    ?>
    <br class="clear"  />
    <?php
    enough_prev_next_post( 'nav-below' );

    if ( is_singular() ) {
        comments_template();
    } else {
        ?>
        <?php
    }
    ?>
</article>

<?php
    }
    wp_reset_postdata(); 
    printf( $html_list_wrapper, $content );
}
 
/* Make pagenate links */
 
$total_content= get_posts('numberposts=-1');
$page_total = ceil( count( $total_content ) / $posts_per_page );
$pagination = array(
                        'base'=> esc_url( add_query_arg( 'paged', '%#%' ) ),
                        'format'=> '',
                        'total'=> $page_total,
                        'current'=> $paged,
                        'show_all'=> false,
                        'type'=> 'plain'
                    );
 
if( $wp_rewrite->using_permalinks( ) ){
        $pagination['base'] = user_trailingslashit( trailingslashit( esc_url( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) ). 'page/%#%/', 'paged' );
}
 
if( $page_total - $paged >= 0 ){
 
    printf($html_pagenate_links_wrapper, paginate_links( $pagination ) );
}

/**
 * list of posts Navigation
 */
enough_next_prev_links( 'nav-below' );
/**
 * Sidebar
 */
$raindrops_page_for_posts		 = get_option( 'page_for_posts' );
if(  $enough_onecolumn_post == 'yes' ) {
	$enough_sidebar = false;
} else {
	$enough_sidebar = true;

}

enough_dinamic_sidebar( 'sidebar-1', true );
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