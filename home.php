<?php

$enough_page_for_posts			 = get_option( 'page_for_posts' );
$enough_page_for_posts_object	 = get_page( $enough_page_for_posts );
$enough_page_for_posts_name		 = str_replace( ' ', '-', wp_kses( $enough_page_for_posts_object->post_title, array() ) );
$current_page					 = get_query_var( 'pagename' );
$enough_home_template			 = enough_theme_option( 'enough_approach_type' );
$enough_core_post_format_setting = get_option( 'default_post_format' );

if( $enough_home_template == 'default' && $enough_core_post_format_setting !== 0 ) {
	
	$enough_home_template = $enough_core_post_format_setting;
}
$enough_options					 = enough_theme_option( 'defaults' );

if( empty( $current_page ) ) {
	$enough_page_for_posts_name = $enough_page_for_posts;
	$current_page				= get_query_var( 'page_id' );
}


/**
 * Enough Post Full width One Clolumn
 *
 *
 *
 */
if ( isset( $enough_options[ 'enough_post_one_column_bottom_sidebar' ] ) && $enough_options[ 'enough_post_one_column_bottom_sidebar' ] == 'yes' ) {

	$enough_onecolumn_post = 'yes';
	add_filter( 'post_class', 'enough_onecolumn_post' );
	add_filter( 'body_class', 'enough_onecolumn_post' );
} else {

	add_filter( 'post_class', 'enough_twocolumn_post' );
	add_filter( 'body_class', 'enough_twocolumn_post' );
	$enough_onecolumn_post = 'no';
}
	if ( ( !empty($current_page) && !empty($enough_page_for_posts_name) && $current_page == $enough_page_for_posts_name ) or $enough_home_template == 'default') {


		get_template_part( 'index' );
		
	} elseif (	$enough_home_template == 'image' or
				$enough_home_template == 'gallery' or
				$enough_home_template == 'link' or
				$enough_home_template == 'chat' or
				$enough_home_template == 'quote' or
				$enough_home_template == 'status' or
				$enough_home_template == 'video' ) {
		
		get_template_part( 'approach', 'format' );

	} else {

		get_template_part( 'approach', $enough_home_template );
	}


?>