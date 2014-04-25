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

		/* 1column setting */
		add_filter( 'post_class','enough_onecolumn_post' );

		get_header();
?>
				<br class="clear" />
<?php
/**
 * post and page content start
 */
		if ( have_posts() ){
		
				while ( have_posts() ) {
				
					the_post();
						
					$enough_post_format = get_post_format();
?>					
    <article <?php post_class(); ?> <?php if( is_single() ){ printf( 'role="%1$s"', 'main' ); } ?> >
<?php
					$att_image = wp_get_attachment_image_src( get_the_ID(), "full-size");
?>
		<img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>" class="attachment-full-size" alt="<?php $post->post_excerpt; ?>" />
		<br class="clear vspacer-3" />
<?php
		$enough_post_format = get_post_format();
			
		if ( $enough_post_format === false ){
			enough_posted_on($diaplay = true);
		}else{
			enough_post_format_posted_on();	

		}
?>
    <div class="entry-content">
<?php 
		enough_the_content(__( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'enough')); 
?>
    </div>
	<br class="clear vspacer-1" />
<?php
		enough_attachment_navigation();
?>
<p class="attachment-history-back"><a href="javascript:history.back();"><span>back to page<span></a></p>
<?php
		wp_link_pages( array(
						'before'=>'<div class="wp-link-pages">',
						'after'=>'</div>',
						'link_before'=>'<span>',
						'link_after'=>'</span>'
						) );

					if( is_singular() ){
					
    					comments_template();
					} else {
?>
		<br class="clear"  />
<?php
					}
?>
    </article>
<?php
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
			posts_nav_link( ' ', ' '. esc_html__( 'Previous Page', 'enough'), esc_html__( 'Next Page', 'enough'). ' ' );
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