<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
      	<?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
		<?php enough_prepend_body(); ?>
        <div id="enough-page">
			<?php
			/**
			 * Site title and description
			 */
			do_action( 'enough_page_top', '' );
			?>
            <div>

                <header role="banner">
					<?php enough_prepend_header(); ?>
                    <h1 class="site-title">
						<?php
						if ( function_exists( 'the_custom_logo' ) ) {
							
							if( get_theme_mod( 'header_textcolor' ) !== 'blank' ) {			
								echo '<span class="custom-logo-wrap no-linked">'. strip_tags( get_custom_logo(),'<img>').'</span>';
							} else {
								echo '<span class="custom-logo-wrap linked">'. get_custom_logo() .'</span>';						
							}
						}
						?>
						<a href="<?php echo home_url(); ?>">																	
                            <span><?php bloginfo(); ?></span>
                        </a>
                    </h1>
                    <h2 class="site-description"><span><?php bloginfo( 'description' ); ?></span></h2>
                    <noscript>
                    <p class="no-script-and-small-view"><?php _e( 'This content shows Simple View', 'enough' ); ?></p>
                    </noscript>
                    <p class="unknown-ua"><?php _e( 'This content shows Simple View', 'enough' ); ?></p>
					<?php enough_append_header(); ?>
                </header>
				<?php
				/**
				 * Horizontal menu bar
				 */
		
					$args = array( 
							'theme_location'	 => 'primary', 
							'container_class'	 => 'menu-header',
						'fallback_cb'     => '',
							'echo'				 => true );
					wp_nav_menu( $args );

				enough_nav_menu_after();
				?>
