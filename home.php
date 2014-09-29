<?php

$enough_page_for_posts			 = get_option( 'page_for_posts' );
$enough_page_for_posts_object	 = get_page( $enough_page_for_posts );
$enough_page_for_posts_name		 = wp_kses( $enough_page_for_posts_object->post_title, array() );
$current_page					 = get_query_var( 'pagename' );
$enough_home_template			 = enough_theme_option( 'enough_approach_type' );
$enough_options					 = enough_theme_option( 'defaults' );
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

if ( $enough_home_template == 'image' or
$enough_home_template == 'gallery' or
$enough_home_template == 'link' or
$enough_home_template == 'chat' or
$enough_home_template == 'quote' or
$enough_home_template == 'status' or
$enough_home_template == 'video' ) {

	get_template_part( 'approach', 'format' );
} elseif ( $current_page == $enough_page_for_posts_name ) {

	get_template_part( 'index' );
} else {

	get_template_part( 'approach', $enough_home_template );
}
?>