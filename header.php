<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title>
<?php
				bloginfo(); 
				wp_title( '|' );
?>
	</title>
<?php
				wp_head();
?>
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
				<h1 class="site-title">
					<a href="<?php echo home_url(); ?>">
						<span><?php bloginfo(); ?></span>
					</a>
				</h1>
				<h2 class="site-description"><span><?php bloginfo( 'description' ); ?></span></h2>
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