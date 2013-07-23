<?php
/**
 * conditional index template author for WordPress theme Enough
 *
 *
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * @package Enough
 */
			global $enough_onecolumn_post , $home_template ; 
			
			get_header();
?>
			<br class="clear" />
			<article <?php post_class("approach-author-content"); ?> <?php if( is_single() ){ printf( 'role="%1$s"', 'main' ); } ?>>
<?php			
		 	printf('<a class="post-format-link" href="%1$s"><span>%2$s</span></a>',
						esc_url( get_post_format_link( 'status' ) ), 
						__( 'Archives Status', 'enough' ) 
				);

		// The Query
			$user_query = new WP_User_Query( array( 'number' => 10, 'orderby' => 'post_count', 'order' => 'DESC') );

		// User Loop
			if ( ! empty( $user_query->results ) ) {
			
				foreach ( $user_query->results as $user ) {
?>
				<ul style="list-style:none;" class="user">
<?php
					$html = '<li class="user-description"><a class="author avatar" href="%1$s">%2$s</a>%3$s</li>';
					
					printf( $html, 
							esc_url( get_author_posts_url( $user->ID, $user->user_nicename ) ),
							get_avatar( $user->user_email , 60,'',  $user->display_name ),
							wpautop( get_the_author_meta( 'user_description', $user->ID ) )
						);
						
					$html = '<li class="user-nicename"><a href="%1$s">%2$s</a></li>';
					
					printf( $html,
							esc_url( get_author_posts_url( $user->ID, $user->user_nicename ) ),
							esc_html( $user->user_nicename )
						);
?>
				</ul>
<?php
				}//end foreach
			} else {
			
				esc_html_e( 'No users found.', 'enough' );
			}
?>
			</article>
<?php 
			$enough_post_formats = get_theme_support( 'post-formats');
?>
			<aside class="custom-format-link-list-wrapper">
				<ul id="custom-post-format-widget-link">
<?php
			
			$html = '	<li class="%3$s"><a href="%1$s"><span>%2$s</span></a></li>';
			
			foreach( $enough_post_formats[0] as $format ){
			
				printf( $html, 
						esc_url( get_post_format_link( $format ) ), 
						esc_html( enough_get_post_format_string( $format ) ),
						esc_attr( $format )
					);
			}
?>
				</ul>
				<br class="clear" />
				<ul class="approach-widget">
<?php
			dynamic_sidebar('sidebar-approach' );
?>
				</ul>
			</aside>
<?php
/**
 * Sidebar
 */
			enough_dinamic_sidebar( 'sidebar-1', ! is_page() );
?>
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
<?php 
			wp_footer();
?>
</body>
</html>
