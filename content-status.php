<?php
	if ( is_tax( ) or is_front_page() ) {
?>
	<article <?php post_class(); ?> <?php if( is_single() ){ printf( 'role="%1$s"', 'main' ); } ?> >
<?php
		$enough_content 			= '';
		
		$enough_status_date 		= get_the_date( get_option( 'date_format' ) );
		
		$enough_status_time 		= get_the_date( get_option( 'time_format' ) );
		
		$enough_status_title 		= the_title('<p tabindex="-1" class="post-status-title">','</p>',false);
		
		if( empty( $enough_status_title ) ){
		
			$enough_status_title = get_the_content();
			
		}else{
		
			$enough_content = get_the_content();
		}
		
		$enough_status_title = '<p tabindex="1" class="post-status-title">'.$enough_status_title.'</p>';
		
		$enough_html = '<table class="statuses"><tr><td class="avatar">%1$s</td><td class="content">%2$s %3$s</td></tr></table>';
   
		$enough_content_html = '<div class="entry-content" tabindex="1"><p>%1$s</p>%2$s %3$s<div>%4$s</div></div>';
		
		$enough_content_date_html 	= '<a href="%1$s">%2$s</a>';
		
		$enough_content_permalink 	= get_permalink();
		
		$enough_comments =  get_comments(array( 'post_id' => $post->ID ));
				
		$enough_avatar 				= get_avatar( get_the_author_meta( 'user_email' ), 48 );
		
		$enough_avatar 				= sprintf( $enough_content_date_html,
												$enough_content_permalink,
												get_avatar( get_the_author_meta( 'user_email' ), 48 )
										);

		
		$enough_content_html 		= sprintf( $enough_content_html,
												sprintf( $enough_content_date_html,
															$enough_content_permalink, 
															$enough_status_date. $enough_status_time 
													),
												apply_filters( 'enough_post_thumbnail', 
															get_the_post_thumbnail( null, 'post-thumbnail' ) 
													),
												
												$enough_content,
												enough_post_format_posted_in( false )
												
										);

		if( is_front_page( ) ){
			$enough_post_format = get_post_format();
		
		 	printf('<a class="post-format-link" href="%1$s"><span>%2$s</span></a>',
						esc_url( get_post_format_link( $enough_post_format ) ), 
						get_post_format_string( $enough_post_format ) 
				);
		}

							
		printf( $enough_html,
				$enough_avatar,
				$enough_status_title,
				$enough_content_html	
			);
			
							
		wp_link_pages( array( 'before' => '<div class="wp-link-pages">',
								'after' => '</div>',
								'link_before' => '<span>',
								'link_after' => '</span>'
						) 
				);
?>
		<br class="clear"  />
<?php
			enough_prev_next_post( 'nav-below' );

    		comments_template( );
?>
		<br class="clear"  />
	</article>
<?php		
	} else {
?>
    <article <?php post_class(); ?> <?php if( is_single() ){ printf( 'role="%1$s"', 'main' ); } ?> >
<?php
		$enough_post_format = get_post_format();
		
		
		if( is_single( ) ){
		
		 	printf('<a class="post-format-link" href="%1$s"><span>%2$s</span></a>',
						esc_url( get_post_format_link( $enough_post_format ) ), 
						get_post_format_string( $enough_post_format ) 
				);
		}

		enough_article_title();
			
		if ( $enough_post_format === false or is_single( ) ) {
		
			enough_posted_on($diaplay = true);
		}else{
		
			enough_post_format_posted_on();	
		}
	
    	echo apply_filters( 'enough_post_thumbnail', get_the_post_thumbnail(  ) );
?>
    <div class="entry-content">
<?php 
		enough_the_content(__( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'enough')); 
?>
    </div>
	<br class="clear vspacer-1" />
<?php

		enough_attachment_navigation();
		
		if ( $enough_post_format === false or is_single( ) ) {
		
			enough_posted_in();
		}else{
		
			enough_post_format_posted_in();
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
    
