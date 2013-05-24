<?php

		global $enough_wp_version;
		
		$link_url			= '';
		$permalink			= get_permalink( );
		$content 			= get_the_content( );
		$uri_detect_regex	= "/(https?:\/\/)([-_.!˜*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/siu";
		$title				= the_title('','', false );
		$rel				= '';
		$target				= '_self';
		$class				= '';
		$html = '<a href="%1$s" class="term-post-format-link-item" title="link to %1$s" rel="%3$s" target="%4$s" class="%5$s"><span>%2$s</span></a>';

		$rel 				= get_post_meta($post->ID, 'rel', true );
		$rel				= addslashes( $rel );
		
		$target 			= get_post_meta($post->ID, 'target', true );
		$target				= addslashes( $target );
		 
		$class	 			= get_post_meta($post->ID, 'class', true );
		$class	 			= addslashes( $class );

if ( is_tax( ) ) {
?>
    <article <?php post_class(); ?> <?php if( is_single() ){ printf( 'role="%1$s"', 'main' ); } ?> >
<?php	
		
/**
 *	if custom field 'rel' or 'target' exists then over write fielc value.
 *
 *
 *
 */		

		if( empty( $title ) ){
		
			$title = '<span>LINK</span>';
		}
				
		if( $enough_wp_version >= '3.6' ){
		
			$enough_post_format = get_post_format_meta( $post->ID );
						
			$link_url = $enough_post_format['link_url'];
	
		}

		if( empty( $link_url ) ){
			
			if(preg_match($uri_detect_regex, $content, $matches) ) {
		
				$link_url = $matches[0];
			}
		}
		
		
		if( ! empty( $link_url ) ){
				
			printf ( $html , esc_url( $link_url ), $title, esc_attr( $rel ), esc_attr( $target ), esc_attr( $class ) );
			
			enough_post_format_posted_in();

		} else {
?>
			<div class="post-format-link-content">
<?php
			enough_the_content(__( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'enough'));
?> 
			</div>
<?php
		
		}	
			
		wp_link_pages( array(
						'before'=>'<div class="wp-link-pages">',
						'after'=>'</div>',
						'link_before'=>'<span>',
						'link_after'=>'</span>'
						) );

		print '<br class="clear"  />';

		enough_prev_next_post('nav-below');

?>
	</article>
<?php
} else {
?>
    <article <?php post_class(); ?> <?php if( is_single() ){ printf( 'role="%1$s"', 'main' ); } ?> >
<?php

	//	enough_article_title();
		
		$enough_post_format = get_post_format();
			
		if ( $enough_post_format === false ){
			enough_posted_on($diaplay = true);
		}else{
			enough_post_format_posted_on();	

		}
	
    	echo apply_filters( 'enough_post_thumbnail', get_the_post_thumbnail(  ) );
		
				
		if( $enough_wp_version >= '3.6' ){
		
			$enough_post_format = get_post_format_meta( $post->ID );
						
			$link_url = $enough_post_format['link_url'];
	
		}

		if( empty( $link_url ) ){
			
			if(preg_match($uri_detect_regex, $content, $matches) ) {
		
				$link_url = $matches[0];
			}
		}
		if( empty( $title ) ){
		
			$title = $link_url;
		}
		
		if( ! empty( $link_url ) ){
				
			printf ( $html , esc_url( $link_url ), $title, esc_attr( $rel ), esc_attr( $target ), esc_attr( $class ) );
			
			if (is_single() and !empty( $content ) ){
			
				if( $enough_wp_version >= '3.6' ){

					remove_filter( 'the_content', 'post_formats_compat', 7 );

?>
			<div class="post-format-link-content">
<?php
			enough_the_content(__( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'enough'));
?> 
			</div>
<?php
				} else {
				
					$content = do_shortcode( $content );
				
?>
			<div class="post-format-link-content">
<?php
					echo $content;
?> 
			</div>
<?php
				}
			}
			
			enough_post_format_posted_in();

		} else {
?>
			<div class="post-format-link-content">
<?php
			enough_the_content(__( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'enough'));
?> 
			</div>
<?php
		
		}?>
<?php

		enough_attachment_navigation();
		
		if ( $enough_post_format === false ){
			enough_posted_in();
		}else{
			//enough_post_format_posted_in();
		}
			
		wp_link_pages( array(
						'before'=>'<div class="wp-link-pages">',
						'after'=>'</div>',
						'link_before'=>'<span>',
						'link_after'=>'</span>'
						) );
?>
		<br class="clear"  />
<?php
		enough_prev_next_post('nav-below');
		
			if( is_singular() ){
?>
		<br class="clear"  />
<?php
    comments_template();
			} else {
?>
		<br class="clear"  />
<?php
			}
?>
    </article>
<?php
}
?>