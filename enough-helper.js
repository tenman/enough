( function () {
    jQuery( function () {
         var width = jQuery( window ).width();
/*
                if ( enough_script_vars.enough_is_front == 1 && enough_script_vars.enough_use_slider == 1 ) {

                    jQuery( 'header' ).before( '<h1 class="site-title" style="width:80%;"><a href="' + enough_home_url +'" style="color:#' + enough_header_textcolor +'">' + enough_site_title + '<\/a><\/h1>' );
		}
*/
		
		jQuery( '.enough-status-bar' ).hide();

		if ( enough_script_vars.enough_is_page == 0 ) {

                    jQuery( window ).mousemove( function ( e ) {

                            var window_height = jQuery( window ).innerHeight();
                            if ( window_height - 100 < e.pageY - jQuery( this ).scrollTop() ) {
                                    jQuery( 'body:not(.approach-blank) address' ).css( 'margin-bottom', '75px' );
                                    jQuery( '.enough-status-bar' ).show();


                            } else {
                                    jQuery( 'address' ).css( 'margin-bottom', '0' );
                                    jQuery( '.enough-status-bar' ).hide();
                            }
                    } );
		}

                jQuery( '.enough-toggle-title' ).remove();
                jQuery( ".menu-header" ).unwrap();

                if ( width < 481 ) {
                        if ( jQuery( 'ul' ).is( ".menu-header" ) ) {
                                jQuery( 'ul.menu-header' ).removeClass();
                        }
                        jQuery( ".menu-header" ).wrap( '<ul class="toggle-navigation"><li class="enough-toggle"><\/li><\/ul>' );
                        jQuery( ".enough-toggle" ).before( '<li class="enough-toggle enough-toggle-title"><span>Menu<\/span><\/li>' );
                        flag = true;
                }
		
                jQuery( '.enough-toggle' ).hide();
                jQuery( '.enough-toggle.enough-toggle-title' ).show().css( { "list-style": "none", "font-weight": "bold", "margin-top": "20px" } );

                jQuery( '.enough-toggle.enough-toggle-title' ).css( "cursor", "pointer" ).toggle(
                        function () {
                                jQuery( this ).siblings().show();
                                var v = jQuery( this ).html().substring( 0, 30 );
                                jQuery( this ).html( v );
                        },
                        function () {
                                jQuery( this ).siblings().hide();
                                var v = jQuery( this ).html().substring( 0, 30 );
                                jQuery( this ).html( v );
                        } );
		
                        if ( width < 481 ) {
                                jQuery( '.toggle-category,.toggle-tag' ).hide();
                                jQuery( '.toggle-category.toggle-title,.toggle-tag.toggle-title' ).show().css( { "list-style": "none", } );
                                jQuery( '.toggle-category.toggle-title,.toggle-tag.toggle-title' ).css( "cursor", "pointer" ).toggle(
                                        function () {

                                                jQuery( this ).siblings().show();
                                                var v = jQuery( this ).html().substring( 0, 30 );
                                                jQuery( this ).html( v );
                                        },
                                        function () {

                                                jQuery( this ).siblings().hide();
                                                var v = jQuery( this ).html().substring( 0, 30 );
                                                jQuery( this ).html( v );
                                        } );
                        }
		
		/**
		 * Toggle widget
		 *
		 */

                        if ( width < 481 ) {
                                jQuery( '.menu-header-container,.menu-wplook-main-menu-container' ).wrap( '<ul class="widget-container-wrapper"><li><\/li><\/ul>' );
                                jQuery( 'div.tagcloud' ).removeAttr( 'style' ).wrap( '<ul class="tagcloud-wrapper"><li><\/li><\/ul>' );
                                jQuery( '.widget ul, .widget form, .widget select, .widget .textwidget' ).hide();
                                jQuery( '.menu-header-container > ul,menu-wplook-main-menu-container > ul,.widget .menu-all-pages-container ul' ).show();
                                if ( jQuery( '.widgettitle' ).text() !== '' ) {
                                        jQuery( '.widgettitle' ).show().css( { "list-style": "none", "font-weight": "bold", 'max-width': '100%' } );
                                }
                                jQuery( '.widgettitle' ).css( "cursor", "pointer" ).toggle(
                                        function () {
                                                jQuery( this ).siblings().show();
                                                var v = jQuery( this ).html();
                                                jQuery( this ).html( v );
                                        },
                                        function () {
                                                jQuery( this ).siblings().hide();
                                                var v = jQuery( this ).html();

                                                jQuery( this ).html( v );
                                        } );
                        }

		/**
		 * Site title , description font size resize and header height ajust
		 *
		 */

                        function fontResize() {

                            var image_exists = enough_script_vars.enough_header_image_uri;
                            var width = jQuery( window ).width( );

                            if ( enough_script_vars.enough_upload_image == 0 ) {
                                var upload_image = false;
                            } else {
                                var upload_image = true;
                            }

                      /*      if ( enough_script_vars.enough_use_slider == 1 ) {
                                var use_slider = true;
                            } else {
                               
                            }*/
                             var use_slider = false;
                       //     $ratio = 0.11;

                            if ( enough_script_vars.enough_title_length !== 0 ) {

                                var px = width / enough_script_vars.enough_title_length;
                                if ( px < 10 ) {
                                        var tpx = 13;
                                }
                                if ( px > 30 ) {
                                        var tpx = 36;
                                }
                                if ( width < 480 ) {
                                        var tpx = 20;
                                }
                                jQuery( '.site-title' ).css( 'font-size', tpx + 'px' );			
                            }

                            if ( enough_script_vars.enough_description_length !== 0 ) {

                                var px = width / enough_script_vars.enough_description_length;
                                if ( px < 10 ) {
                                        var dpx = 13;
                                }
                                if ( px > 26 ) {
                                        var dpx = 20;
                                }
                                if ( width < 480 ) {
                                        var dpx = 14;
                                }

                                jQuery( '.site-description' ).css( 'font-size', dpx + 'px' );

                            }

            if ( upload_image && use_slider ) {
	
		

		//$enough_header_image = get_custom_header();
		//$uri				 = $enough_header_image->url;

		if ( ! enough_script_vars.enough_theme_mod_header_img  ) { //When child theme $url empty
			$url = enough_header_image_uri;
		}

		if ( enough_script_vars.enough_is_random_header_image == 1 ) {

			$url = enough_random_header_image;
		}


		var ratio = enough_script_vars.enough_header_image_height / enough_script_vars.enough_header_image_width;
                var header_width = jQuery( 'header' ).width();
                var height = ( header_width * ratio ).toFixed( 0 );
                jQuery( 'header' ).removeAttr( 'style' ).css( { 'height': height + 'px', } );
                
		if ( enough_script_vars.header_textcolor_is_blank == 1 ) {

                    jQuery( 'header' ).css( 'cursor', 'pointer' ).click( function () {

                            location.href = enough_home_url;

                    } );
		}

	} else {

                var header_width = jQuery( 'header' ).width();
                var ratio = enough_script_vars.enough_header_image_height / enough_script_vars.enough_header_image_width;
                var height = ( header_width * ratio ).toFixed( 0 );

		if ( enough_script_vars.enough_header_image_uri == 'random-uploaded-image' ) {
			$url = enough_script_vars.enough_random_header_image;
		}

		//image_exists = '<?php echo $url; ?>';
	
		if ( enough_script_vars.enough_url ) {
                        // jQuery('header').removeAttr('style').css({'background-image':'url('+ enough_url + ')', 'min-height': height + 'px','background-repeat':'no-repeat','background-size':'cover'});
                        jQuery( 'header' ).removeAttr( 'style' ).css( { 'min-height': height + 'px', 'background-repeat': 'no-repeat', 'background-size': 'cover' } );
		}


		if ( enough_script_vars.header_textcolor_is_blank == 1 ) {

                        jQuery( 'header' ).css( 'cursor', 'pointer' ).click( function () {

                                location.href = enough_script_vars.enough_home_url;

                        } );

		}

	}
                        if ( width < 1920 ) {
                                body_class = 'enough-w-wuxga';
                        }
                        if ( width < 1600 ) {
                                body_class = 'enough-w-uxga';
                        }
                        if ( width < 1401 ) {
                                body_class = 'enough-w-sxga-plus';
                        }
                        if ( width < 1281 ) {
                                body_class = 'enough-w-sxga';
                        }
                        if ( width < 1025 ) {
                                body_class = 'enough-w-xga';
                        }
                        if ( width < 801 ) {
                                body_class = 'enough-w-svga';
                        }
                        if ( width < 641 ) {
                                body_class = 'enough-w-vga';
                        }
                        if ( width < 481 ) {
                                body_class = 'enough-w-iphone';
                        }
                        if ( width < 321 ) {
                                body_class = 'enough-w-qvga';
                        }
                        if ( width < 241 ) {
                                body_class = 'enough-w-keitai';
                        }
                        /* remove old width[0-9]+ class*/
                        var element = jQuery( "body" );
                        var classes = element.attr( 'class' ).split( /\s+/ );

                        var pattern = /^enough-w/;

                        for ( var i = 0; i < classes.length; i++ ) {
                                var className = classes[i];

                                if ( className.match( pattern ) ) {
                                        element.removeClass( className );
                                }
                        }

			jQuery( 'body' ).addClass( body_class );

		/**
		 * Toggle for .menu-header
		 *
		 */


                        if ( width > 480 ) {
                                jQuery( '.enough-toggle' ).show();
                                jQuery( '.enough-toggle.enough-toggle-title' ).hide();
                                if ( jQuery( 'ul' ).is( '.toggle-navigation' ) ) {
                                        jQuery( ".menu-header" ).unwrap();
                                        jQuery( "enough-toggle enough-toggle-title" ).remove();
                                }
                                jQuery( '.widgettitle .marker' ).remove();
                                jQuery( '.toggle-title .marker' ).remove();
                                jQuery( '.widget ul' ).show();
                                jQuery( '.toggle-category,.toggle-tag' ).show();
                                if ( jQuery( 'ul' ).is( '.widget-container-wrapper' ) ) {
                                        jQuery( '.menu-header-container,.menu-wplook-main-menu-container' ).unwrap();
                                }
                                if ( jQuery( 'ul' ).is( '.tagcloud-wrapper' ) ) {
                                        jQuery( 'div.tagcloud' ).unwrap();
                                }

                        } else {

                            if ( enough_script_vars.enough_referer_customizer == 0 && enough_script_vars.enough_debug == 1 ) {

                                if ( !jQuery( 'ul' ).is( '.toggle-navigation' ) ) {
                                        /*location.reload();*/
                                }
                            }

							}

                        if ( enough_script_vars.enough_use_slider == 0 ) {

                            jQuery( 'script #enough-slider-js, style #enough-slider-css' ).remove();
                        }

		/**
		 * Check window size and mouse position
		 * Controll childlen menu show right or left side.
		 */

                        jQuery( ".menu-header" ).mousemove( function ( e ) {
                                var menu_item_position = e.pageX;
		 /* Position check
		  jQuery(".result:first").text(menu_item_position);
		  jQuery(".result-w").text(header_width); */
		
                                if ( header_width - 100 < menu_item_position ) {
                                        jQuery( '.menu-header .children .children' ).addClass( 'left' );
                                        jQuery( '.menu-header .sub-menu .sub-menu' ).addClass( 'left' );
                                } else if ( width / 10 > menu_item_position ) {
                                        jQuery( '.menu-header .children .children' ).removeClass( 'left' );
                                        jQuery( '.menu-header .sub-menu .sub-menu' ).removeClass( 'left' );
                                }
                        } );
}

		if ( enough_script_vars.is_ie ) {
			/**
			 * Fixed IE height issue
			 *
			 */

			jQuery( 'article img' ).removeAttr( "height" ).removeAttr( "width" );

		}

                fontResize();
                jQuery( window ).resize( function () {
                        fontResize();
                } );

    } );
} )( jQuery );