*Enough WordPress Theme
**Themes infomation
    http://www.tenman.info/wp3/enough/
**Contact
    a.tenman@gmail.com
**License
    wp3.jpg wp3-thumbnail.jpg

    Above images License

    copyright   Copyright (c) 2010-2012, Tenman
    License: GNU General Public License v2.0
    License URI: http://www.gnu.org/licenses/gpl-2.0.html

    This themes contents is especially the thing without clear statement of a license
    supply under below license.

    copyright   Copyright (c) 2010-2012, Tenman
    License: GNU General Public License v2.0
    License URI: http://www.gnu.org/licenses/gpl-2.0.html
**About this theme
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
				 $classes[] 	= 'lynx';
			break;
			case($is_gecko):
				$classes[]  	= 'gecko';
			break;
			case($is_IE):
				preg_match(" |(MSIE )([0-9])(\.)|si",$_SERVER['HTTP_USER_AGENT'],$regs);
				$classes[]      = 'ie'.$regs[2];
			break;
			case($is_opera):
				 $classes[] 	= 'opera';
			break;
			case($is_NS4):
				$classes[]  	= 'ns4';
			break;
			case($is_safari):
				$classes[]  	= 'safari';
			if(preg_match("|(mobile)|si",$_SERVER['HTTP_USER_AGENT'],$regs)){
				$classes[]  	= 'iphone';
				$iphone 		= true;
			}
			break;
			case($is_chrome):
				$classes[]  	= 'chrome';
			break;
			case($is_iphone):
				if(!$iphone){
					$classes[]  = 'iphone';
				}
			break;
			default:
				$classes[]  	= 'unknown';
			break;
			}
			if(preg_match("|(mobile)|si",$_SERVER['HTTP_USER_AGENT'],$regs)){
			
			  $classes[]  		= 'mobile';
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
			
	
	
	
	
	
		