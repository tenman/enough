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
<?php if ( locate_template( array( 'header.php' ) , true , true ) == '') {//template existance check
do_action( 'get_header' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php bloginfo(); ?><?php wp_title( '|' ); ?></title>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="enough-page">
<?php
/**
 * Site title and description
 *
 *
 *
 *
 */
?>
<div>
<header role="banner">
    <h1 class="site-title"><a href="<?php echo home_url(); ?>">
      <span><?php bloginfo(); ?></span>
      </a></h1>
    <h2 class="site-description"><span>
      <?php bloginfo( 'description' ); ?></span>
    </h2>
    <noscript>
        <p class="no-script-and-small-view"><?php _e('This content shows Simple View','enough');?></p>
    </noscript>
    <p class="unknown-ua"><?php _e('This content shows Simple View','enough');?></p>
</header>
<?php
/**
 * Horizontal menu bar
 *
 *
 *
 *
 */
?>
<?php
if( ! has_nav_menu( 'primary' ) ){
    $args = array( 'menu_class' => 'menu-header'
                , 'theme_location' => 'primary'
                , 'container_class'=>'menu-header'
                , 'echo'=> true );
    wp_nav_menu($args);
}else{
    $args = array( 'theme_location' => 'primary'
                , 'container_class'=>'menu-header'
                , 'echo'=> true );
    wp_nav_menu($args);
}
?>




<?php }//End locate_template( array( 'header.php' ) ?>
<br class="clear" />
<?php
/**
 * index , archive and another list of contents page title.
 *
 *
 *
 *
 */
 
    enough_loop_title();
/**
 * Monthly archive prev next links
 *
 *
 *
 *
 */
	enough_monthly_archive_prev_next_navigation();

    if ( locate_template( array( 'loop.php' ) , true , true ) == '') {//template existance check
/**
 * post and page content start
 *
 *
 *
 *
 */
    if ( have_posts() ){
        while ( have_posts() ) {
            the_post(); 
			
?>


    <article <?php post_class(); ?> <?php if( is_single() ){ printf( 'role="%1$s"', 'main' ); } ?> >
<?php
/**
 * article title
 *
 *
 *
 *
 */

	enough_article_title();
        

/**
 * posted date, author ,comment(s)
 *
 *
 *
 *
 */
	if ( has_post_format( 'aside' ) or
		 has_post_format( 'image' ) or
		 has_post_format( 'quote' ) or
		 has_post_format( 'video' ) or
		 has_post_format( 'audio' ) or
		 has_post_format( 'gallery' ) or
		 has_post_format( 'status' ) or
		 has_post_format( 'chat' ) or
		 has_post_format( 'link' )
	){
		enough_post_format_posted_on();	
	}else{
    	enough_posted_on($diaplay = true);
	}?>
<?php
/**
 *
 *
 *
 *
 *
 */
    echo apply_filters( 'enough_post_thumbnail', get_the_post_thumbnail(  ) );
/**
 * article content
 *
 *
 *
 *
 */
?>
    <div class="entry-content">
<?php enough_the_content(__( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'enough')); ?>
    </div>
<br class="clear vspacer-1" />
<?php
/**
 * navigation for attachment when display attachment
 *
 *
 *
 *
 */
    enough_attachment_navigation();?>
<?php
/**
 * article metadata category, tag shows
 *
 *
 *
 *
 */
 		if ( has_post_format( 'aside' ) or
			 has_post_format( 'image' ) or
			 has_post_format( 'quote' ) or
			 has_post_format( 'video' ) or
			 has_post_format( 'audio' ) or
			 has_post_format( 'gallery' ) or
			 has_post_format( 'status' ) or
			 has_post_format( 'chat' ) or
			 has_post_format( 'link' )
		){
		 	enough_post_format_posted_in();
	 	}else{

    		enough_posted_in();
		}
?>
<?php
/**
 * <!--nextpage--> Navigation
 *
 *
 *
 *
 */
    wp_link_pages( array(
                    'before'=>'<div class="wp-link-pages">',
                    'after'=>'</div>',
                    'link_before'=>'<span>',
                    'link_after'=>'</span>'
                    ) );
?>
<br class="clear"  />
<?php
/**
 * navigation for next previus post
 *
 *
 *
 *
 */
    enough_prev_next_post('nav-below');?>
<?php if( is_singular() ){ ?>
<br class="clear"  />
<?php }//is_singular()
/**
 * comment
 *
 *
 *
 *
 */
if( is_singular() ){
    comments_template();
}else{
?>
<br class="clear"  />
<?php
}
?>
    </article>
          <?php }//endwhile

    }else{
        if ( locate_template( array( '404.php' ) , true , true ) == '') {//template existance check ?>
<?php
/**
 * Not found
 *
 *
 *
 *
 */
?>
      <article <?php post_class(); ?> role="main">
      <?php enough_not_found();?>
      </article>
    <?php }//locate_template( array( 'loop.php' )
     } //end else
	 
} // locate_template( array( 'loop.php' )

/**
 * Sidebar
 *
 *
 *
 *
 */
    if ( locate_template( array( 'sidebar-1.php' , 'sidebar.php' ) , true , true ) == '') {//template existance check
        enough_dinamic_sidebar( 'sidebar-1', ! is_page() );
    }//locate_template( array( 'sidebar-1.php' )
/**
 * list of posts Navigation
 *
 *
 *
 *
 */
?>
    <div class="clear posts-nav-link">
    <?php posts_nav_link(' '); ?>
    </div>
<br class="clear vspacer-3" />
<?php
/**
 * Sidebar show bottom when post 1column
 *
 *
 *
 *
 */
    if ( locate_template( array( 'sidebar-1.php' , 'sidebar.php' ) , true , true ) == '') {//template existance check
		if( $enough_onecolumn_post == true ){
        	enough_dinamic_sidebar( 'sidebar-1', false );
		}
    }//locate_template( array( 'sidebar-1.php' )

?>
<?php
wp_reset_query();
 if(!is_page_template('page-blog.php')): ?>
<?php get_template_part('login'); ?>
<?php endif; ?>
<?php
    if ( locate_template( array( 'footer.php' ) , true , true ) == '') {//template existance check
        enough_the_footer();
    }//locate_template( array( 'footer.php' )?>
</div></div>
<?php wp_footer(); ?>
</body>
</html>
