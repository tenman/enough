*Enough WordPress Theme
**Themes infomation
    http://www.tenman.info/wp3/enough/
**Contact
    a.tenman@gmail.com
**License
	images/screenshot-images1.jpg
	images/screenshot-images2.jpg
	images/screenshot-images3.jpg
    images/headers/wp3.jpg
    images/headers/wp3-thumbnail.jpg
    screenshot.png
    images/please-upload.jpg

    Above images License

    copyright   Copyright (c) 2010-2014, Tenman
    License: GNU General Public License v2.0
    License URI: http://www.gnu.org/licenses/gpl-2.0.html

    This themes contents is especially the thing without clear statement of a license
    supply under below license.

    copyright   Copyright (c) 2010-2014, Tenman
    License: GNU General Public License v2.0
    License URI: http://www.gnu.org/licenses/gpl-2.0.html

    genericons
        genericons/font/genericons-regular-webfont.eot
        genericons/font/genericons-regular-webfont.svg
        genericons/font/genericons-regular-webfont.ttf
        genericons/font/genericons-regular-webfont.woff
        genericons/genericons.css
            genericons.css is customized (line 206-753) by enough theme

    License genericons  and customized style rules by enough theme

    copyright   Copyright (c) 2010-2014, Tenman
    License: GNU General Public License v2.0
    License URI: http://www.gnu.org/licenses/gpl-2.0.html

    License CrossSlide jQuery plugin v0.6.2
        jquery.cross-slide.js
        jquery.cross-slide.min.js

    License: GNU General Public License v2.0
    License URI: http://www.gnu.org/licenses/gpl-2.0.html

    License html5 shiv 3.7.2

    License: GNU General Public License v2.0
    License URI: http://www.gnu.org/licenses/gpl-2.0.html
**About this theme
ver 0.85
	Add genericons
		http://genericons.com/

Enough consept change
ver 0.6 <
	Satisfied enough necessary minimum structure Responsive Theme.
[del version=0.6]
last version 0.56
    This theme has only two template files.
        index.php
        comments.php
    This theme has not template part file.

    But this theme is designed to operate even if it adds a template file.

    The list of templates which can be added.

        Template part files.
            header.php
            footer.php
            sidebar-1.php
            sidebar.php
            loop.php
        Template file.
            404.php

    These files saved to the theme directory are included automatically.
[/del]
**Other notes
    Although this theme is Responsive design, jQuery is used for that operation.

        horizontal menu bar
            mouse position check and right end children list popup left.
        DOM class
            Adding a DOM class when window resize where body.

            class name list

                if( width < 1281 ){
                    body_class = 'enough-w-sxga';
                }
                if( width < 1025 ){
                    body_class = 'enough-w-xga';
                }
                if( width < 801 ){
                    body_class = 'enough-w-svga';
                }
                if( width < 641 ){
                    body_class = 'enough-w-vga';
                }
                if( width < 481 ){
                    body_class = 'enough-w-iphone';
                }
                if( width < 321 ){
                    body_class = 'enough-w-qvga';
                }
                if( width < 241 ){
                    body_class = 'enough-w-keitai';
                }

            You can controll human interface what not support media query browser.

        Horizontal menu, category, tag and sidebar menus are toggled when indow width less than 481px

    Browser detect body_class()
    ( this action is PHP )

        switch(true){
            case($is_lynx):
                 $classes[]     = 'lynx';
            break;
            case($is_gecko):
                $classes[]      = 'gecko';
            break;
            case($is_IE):
                preg_match(" |(MSIE )([0-9])(\.)|si",$_SERVER['HTTP_USER_AGENT'],$regs);
                $classes[]      = 'ie'.$regs[2];
            break;
            case($is_opera):
                 $classes[]     = 'opera';
            break;
            case($is_NS4):
                $classes[]      = 'ns4';
            break;
            case($is_safari):
                $classes[]      = 'safari';
            if(preg_match("|(mobile)|si",$_SERVER['HTTP_USER_AGENT'],$regs)){
                $classes[]      = 'iphone';
                $iphone         = true;
            }
            break;
            case($is_chrome):
                $classes[]      = 'chrome';
            break;
            case($is_iphone):
                if(!$iphone){
                    $classes[]  = 'iphone';
                }
            break;
            default:
                $classes[]      = 'unknown';
            break;
            }
            if(preg_match("|(mobile)|si",$_SERVER['HTTP_USER_AGENT'],$regs)){

              $classes[]        = 'mobile';
            }


    It is possible to describe a CSS rule as follows using jQuery DOM class and Browser detect class.
        example

        .ie8.enough-w-keitai .menu-header,
        .ie8.enough-w-qvga .menu-header,
        .ie8.enough-w-iphone .menu-header{
            display:block;
            width:100%;
            font-size:0.9em;
        }

*ver 0.30 Add

    CrossSlide jQuery plugin for WordPress theme Enough
        License: GNU General Public License v2.0
        License URI: http://www.gnu.org/licenses/gpl-2.0.html

        filename jquery.cross-slide.min.js

*ver 0.54 Add
        do_action( 'enough_setup_before' );
        do_action( 'enough_setup_after' );
            in function enough_theme_setup().
    Code Example
        You can override parent theme settiongs when child theme.

        child-theme/functions.php
        <?php
        add_action( 'enough_setup_after','my_setup' );

        function my_setup(){
            add_filter( 'post_class','enough_onecolumn_post' );
        }
        ?>
*ver 0.64

	Add template content-link.php

	This template is used when the post format link.

	Enough post format link has Predefined custom field keys.

	key names:	rel = a element attribute rel
					ex. field value 'bookmark'
				target = a element attribute target
					ex. field value '_blank'
				class = a element attribute class
					ex. field value 'my-class'

	above custom fields automaticaly add to the post format link.


*ver0.78
		Add WEB Fonts
			http://fonts.googleapis.com/css?family=Ubuntu:400,700

			You can change using enough_web_font filter hook
