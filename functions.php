<?php
/**
 * Functions and class for WordPress theme Enough
 *
 *
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * @package Enough
 */
$enough_check_wp_version = explode('-',$wp_version);
$enough_wp_version      = $enough_check_wp_version[0];

if( !isset( $enough_current_theme_name ) ){
    if( $enough_wp_version >= '3.4' ){
        $enough_current_theme_name = wp_get_theme();
    }else{
        $enough_current_theme_name = get_current_theme();
    }
}

    load_textdomain( 'enough', get_template_directory().'/languages/'.get_locale().'.mo' );


/**
 *
 *
 *
 *
 *
 */
    if ( !isset( $content_width ) ){
         $content_width = 480;
    }
    if(!defined('ENOUGH_TABLE_TITLE')){
        define("ENOUGH_TABLE_TITLE",'options');
    }
    if(!defined('HEADER_TEXTCOLOR')){
        define('HEADER_TEXTCOLOR', 'ffffff');
    }
    if(!defined('HEADER_IMAGE')){
        define('HEADER_IMAGE', '%s/images/headers/wp3.jpg'); // %s is the template dir uri
    }
    if(!defined('HEADER_IMAGE_WIDTH')){
        define('HEADER_IMAGE_WIDTH', 950);
    }
    if(!defined('HEADER_IMAGE_HEIGHT')){
        define('HEADER_IMAGE_HEIGHT', 198);
    }
/**
 *
 *
 *
 *
 *
 */
    $enough_sidebar_args = array(
        'name'          => sprintf(__('Sidebar %d', 'enough'), 1 ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>'
        );
/**
 *
 *
 *
 *
 *
 */
    $enough_register_nav_menus_args = array(
        'primary' => __( 'Main navigation', 'enough' )
        );
    register_nav_menus( $enough_register_nav_menus_args );

/**
 *
 *
 *
 *
 *
 */
    $enough_admin_options_setting = array(
        array('option_id' => 2,
        'blog_id' => 0 ,
        'option_name' => "enough_format_detection_telephone",
        'option_value' => "no",
        'autoload'=>'yes',
        'title'=>__('iphone format telephone','enough'),
        'excerpt'=>__('Iphone format detection telephone','enough'),
        'validate'=>'enough_format_detection_telephone_validate','list' => 1,
        'type' => 'radio',
        'select_values' => array("yes" => 'yes')
        ),
        array('option_id' => 3,
        'blog_id' => 0 ,
        'option_name' => "enough_iphone_device_width",
        'option_value' => 'width=device-width',
        'autoload'=>'yes',
        'title'=>__('iphone device width settings','enough'),
        'excerpt'=> __('iphone meta name "viewport" content value','enough'),
        'validate'=>'enough_iphone_device_width_validate','list' => 2,
        'type' => 'text',
        'select_values' => '',
        ),
        array('option_id' => 4,
        'blog_id' => 0 ,
        'option_name' => "enough_iphone_status_bar_style",
        'option_value' => "default",
        'autoload'=>'yes',
        'title'=>__('iphone_status_bar_style','enough'),
        'excerpt'=>__('iphone the status bar style','enough'),
        'validate'=>'enough_iphone_status_bar_style_validate','list' => 3,
        'type' => 'radio',
        'select_values' => array('black' => 'black','black-translucent' => 'black-translucent')
        ),
        array('option_id' => 5,
        'blog_id' => 0 ,
        'option_name' => "enough_use_slider",
        'option_value' => "yes",
        'autoload'=>'yes',
        'title'=>__('Use Slider for Header Images','enough'),
        'excerpt'=>__('Dinamic Slide header','enough'),
        'validate'=>'enough_use_slider_validate','list' => 4,
        'type' => 'radio',
        'select_values' => array('no' => 'no')
        ),

        array('option_id' => 6,
        'blog_id' => 0 ,
        'option_name' => "enough_slider_sleep",
        'option_value' => 3,
        'autoload'=>'yes',
        'title'=>__('Slider sleep time','enough'),
        'excerpt'=>__('Show image duration','enough'),
        'validate'=>'enough_slider_sleep_validate','list' => 5,
        'type' => 'text',
         'select_values' => '',
        ),
        array('option_id' => 7,
        'blog_id' => 0 ,
        'option_name' => "enough_slider_fade",
        'option_value' => 1,
        'autoload'=>'yes',
        'title'=>__('Slider fade time','enough'),
        'excerpt'=>__('Image change duration','enough'),
        'validate'=>'enough_slider_fade_validate','list' => 6,
        'type' => 'text',
         'select_values' => '',
        ),

    );
/**
 *
 *
 *
 *
 *
 */
    $enough_deploy_check = get_option('enough_theme_settings');
    if ($enough_deploy_check == false or !array_key_exists('install', $enough_deploy_check) ) {
        add_action('admin_init', 'enough_deploy');
    }

    add_action( 'after_setup_theme', 'enough_theme_setup' );
/**
 *
 *
 *
 *
 *
 */
if( !function_exists( 'enough_theme_setup' ) ){
    function enough_theme_setup(){
        global $enough_sidebar_args;
        global $enough_register_nav_menus_args;
        global $enough_admin_options_setting;
        global $enough_wp_version;

        register_sidebar( $enough_sidebar_args );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-thumbnails' );
        add_editor_style(  );
        add_action('wp_enqueue_scripts', 'enough_enqueue_scripts_styles');
        add_filter('body_class','enough_add_body_class');
        add_action( 'wp_enqueue_scripts', 'enough_enqueue_comment_reply' );
        add_action('wp_footer','enough_small_device_helper');
        $enough_is_submenu = new enough_menu_create;
        add_action('admin_menu', array($enough_is_submenu, 'add_menus'));

        add_action('load-themes.php', 'enough_install_navigation');

        $enough_embed_format_detection_telephone = enough_theme_option("enough_format_detection_telephone");

        if($enough_embed_format_detection_telephone !== false){
            add_action("wp_head",'enough_embed_format_detection_telephone');
        }

        $enough_embed_iphone_device_width = enough_theme_option("enough_iphone_device_width");

        if($enough_embed_iphone_device_width !== false){
            add_action("wp_head",'enough_embed_iphone_device_width');
        }
        $enough_embed_iphone_status_bar_style = enough_theme_option("enough_iphone_status_bar_style");

        if($enough_embed_iphone_status_bar_style !== false){
            add_action("wp_head",'enough_embed_iphone_status_bar');
        }
        //if($is_IE){
            //add_filter("enough_post_thumbnail","ecnough_ie_height_issue");
        //}
        add_filter( 'post_class', 'enough_add_post_class' );
    $enough_site_image = get_template_directory_uri().'/images/headers/wp3.jpg';
    if( $enough_wp_version >= '3.4' ){

    add_action( 'wp_head', 'enough_embed_meta' );


    }
    if( $enough_wp_version < '3.4' ){
        add_custom_image_header('enough_header_style', 'enough_admin_header_style');
        add_custom_background();


    }
    $enough_options  = get_option("enough_theme_settings");
    add_action( 'wp_head', 'enough_slider' );

    /**
     * Add option helper
     *
     *
     *
     *
     *
     */
    if( version_compare(PHP_VERSION, '5.3.0', '<' ) ) {
        if(isset( $enough_admin_options_setting ) and is_array( $enough_admin_options_setting ) ){
            foreach($enough_admin_options_setting as $setting){
                $function_name = $setting['option_name'].'_validate';
                if(!function_exists($function_name)){
                    $message = sprintf(__('If you add  %s when you must create function %s for data validation','enough'),$setting['option_name'],$function_name);
                    printf('<script type="text/javascript">alert(\'%s\');</script>',$message);
                return;
                }
            }
        }
    }


    }
}
    if(file_exists(get_stylesheet_directory().'/images/headers/wp3.jpg')){
        $enough_site_image = get_stylesheet_directory_uri().'/images/headers/wp3.jpg';
        $enough_site_thumbnail_image = get_stylesheet_directory_uri().'/images/headers/wp3-thumbnail.jpg';
    }else{
        $enough_site_image = get_template_directory_uri().'/images/headers/wp3.jpg';
        $enough_site_thumbnail_image = get_template_directory_uri().'/images/headers/wp3-thumbnail.jpg';
    }

    $args = array(
                    'default-text-color' => 'ddd'
                    , 'width' => apply_filters( 'enough_header_image_width', '950' )
                    , 'flex-width' => true
                    , 'height' => apply_filters( 'enough_header_image_height', '198' )
                    , 'flex-height' => true
                    , 'header-text' => true
                    , 'default-image' => $enough_site_image
                    , 'wp-head-callback' => 'enough_small_device_helper'
                    , 'admin-head-callback' => 'enough_admin_header_style'
                );
        add_theme_support( 'custom-header', $args );

    $args = array('default-color' => ''
                , 'default-image' => ''
                , 'wp-head-callback' => 'enough_embed_meta'
                , 'admin-head-callback' => 'enough_admin_header_style'
                , 'admin-preview-callback' => 'enough_embed_meta'
            );
    add_theme_support( 'custom-background', $args );

/**
 *
 *
 *
 *
 *
 */

    function enough_embed_meta(){
        global $enough_site_image;
        $header_image_css               = '';
        $image_uri                      = get_theme_mod('header_image');
        $image_size                     = get_theme_mod('header_image_data');
//       $width                          = $image_size->width;
//       $height                         = $image_size->height;
        $body_background_color          = get_theme_mod( "background_color" );
        $body_background_image          = get_theme_mod( "background_image" );
        $body_background_repeat         = get_theme_mod( "background_repeat" );
        $body_background_position_x     = get_theme_mod( "background_position_x" );
        $body_background_attachment     = get_theme_mod( "background_attachment" );
        $header_textcolor               = get_theme_mod( "header_textcolor" );
        if($image_uri !== "remove-header" or !empty( $image_uri ) ){
            $header_image_css = 'header{ background: url('.$image_uri.'); }';
            if( $image_uri == "remove-header" ){ //need multisite child theme style rule
                $header_image_css .= 'header{ height:auto; }';
            }

        }else{
            $header_image_css = 'header{ background: url('.$enough_site_image.'); }';
            $header_image_css .= 'header{ height: 198px; }';
        }

        $header_style ='%1$s
        .site-title a,
        .site-title a span,
        .site-description{
            %2$s
        }';

        if( get_theme_mod( 'header_textcolor' ) !== 'blank' ){
            $header_style = sprintf(
                     $header_style
                     , $header_image_css
                     , 'color:#'. $header_textcolor. '!important;'
                      );
            $header_style .= 'header .site-title{margin-top:20px;}';
            $header_style .= 'header .site-description{margin-bottom:20px;}';
        }else{
            $header_style = sprintf(
                     $header_style
                     , $header_image_css
                     , 'display:none!important;'
                      );
        }

        $style= "<style type=\"text/css\">
        body{
            background-color:#{$body_background_color};
            background-image:url( {$body_background_image} );
            background-position:top {$body_background_position_x};
            background-attachment:{$body_background_attachment};
            background-size:100% auto;
        }
        $header_style
        </style>";
/**
 *
 *
 *
 *
 *
 */
    if ( 'blank' == get_theme_mod('header_textcolor') ){
        add_filter( 'wp_page_menu_args', 'enough_page_menu_args' );
    }

        echo $style;
    }
    if( $enough_wp_version >= '3.4' ){
        add_action( 'customize_register', 'enough_customize_register' );
    }

/**
 *
 *
 *
 *
 *
 */
if( !function_exists("enough_enqueue_scripts_styles" ) ){
    function enough_enqueue_scripts_styles( ) {
        global $is_IE;
        wp_enqueue_style( 'styles', get_stylesheet_uri() );
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'comment-reply' );
        if($is_IE){
            wp_register_script('html5shiv', 'http://html5shiv.googlecode.com/svn/trunk/html5.js', array(), '3', false);
            wp_enqueue_script('html5shiv');
        }
    }
}
/**
 * Article navigation
 *
 *
 *
 *
 */
if( ! function_exists( 'enough_prev_next_post' ) ){
    function enough_prev_next_post($position = "nav-above"){
        if(is_single() or (is_archive() and is_single())){
            $enough_max_length       = 40;
            $enough_prev_length      = $enough_max_length + 1;
            if(!is_attachment()){
                $enough_max_length   = 40;
                $enough_prev_post_id = get_adjacent_post(true,'',true) ;
                $enough_prev_length  = strlen(get_the_title($enough_prev_post_id));
                $enough_next_post_id = get_adjacent_post(false,'',false) ;
                $enough_next_length  = strlen(get_the_title($enough_next_post_id));
            }
            $html = '<div id="%1$s" class="%2$s"><span class="%3$s">';
            printf($html,$position,"clearfix","nav-previous");
            previous_post_link('%link','<span class="button"><span class="meta-nav">&laquo;</span> %title</span>');
            $html = '</span><div class="%1$s">';
            printf($html,"nav-next");
            next_post_link('%link','<span class="button"> %title <span class="meta-nav">&raquo;</span></span>');
            $html = '</div></div>';
            echo apply_filters("enough_prev_next_post",$html);
        }
    }
}
/**
 *
 *
 *
 *
 *
 */
if( ! function_exists( 'enough_attachment_navigation' ) ){
    function enough_attachment_navigation(){
        if( is_attachment() ){
        ?>
            <div class="attachment-navigation clear">
            <div class="nav-previous">
            <?php previous_image_link(0) ?>
            </div>
            <div class="nav-next">
            <?php next_image_link(0) ?>
            </div>
            <br class="clear" />
            </div>
        <?php
         }
    }
}
/**
 * Template function posted_on
 *
 *
 *
 * loop.php
 *
 */
if( ! function_exists( 'enough_posted_on' ) ){
    function enough_posted_on( $diaplay = true ){
        if( ! is_page( ) and $diaplay == true ){
        ?>
<div class="posted-on">
<?php
        $enough_date_format = get_option('date_format'). ' '. get_option( 'time_format' );
        $author = get_the_author();
        if (comments_open()){
            $enough_comment_html = '<a href="%1$s" class="enough-comment-link"><span class="enough-comment-string point"></span><em>%2$s %3$s</em></a>';
            if(get_comments_number() > 0 ){
                $enough_comment_string = _n('Comment','Comments',get_comments_number(),'enough');
                $enough_comment_number = get_comments_number();
            }else{
                $enough_comment_string = 'Comment';
                $enough_comment_number = '';
            }
        }else{
            $enough_comment_html   = '';
            $enough_comment_string = '';
            $enough_comment_number = '';
        }
        $result = sprintf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s %4$s'
, 'enough' ),
            'meta-prep meta-prep-author',
            sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
                get_permalink(),
                esc_attr( get_the_time($enough_date_format) ),
                get_the_date( $enough_date_format )
            ),
            sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="vcard:url">%3$s</a></span>',
                get_author_posts_url( get_the_author_meta( 'ID' ) ),
                sprintf( esc_attr__( 'View all posts by %s', 'enough' ), $author ),
                $author
            ),
            sprintf($enough_comment_html,get_comments_link(),$enough_comment_number,$enough_comment_string)
        );
        echo apply_filters( "enough_posted_on", $result );
        ?>
</div>
        <?php
         }
    }
}
/**
 *
 *
 *
 *
 *
 */
if( ! function_exists( 'enough_posted_in' ) ){
    function enough_posted_in( $diaplay = true ){
        if( ! is_page( ) and $diaplay == true ){
        ?>
<div class="posted-in">
        <ul>
        <?php
        $category_count = count(get_the_category());
        if( $category_count > 1 ){?>
        <li class="toggle-category toggle-title"><?php _e('Categories:','enough');?></li>
        <li class="toggle-category"><?php the_category(' '); ?></li>
        <?php }else{    ?>
        <li><?php _e('Categories:','enough');?></li>
        <li><?php the_category(' '); ?></li>
        <?php } ?>
        </ul>
        <?php
        $tags = get_the_tags();
        if( $tags){?>
        <ul>
        <li class="toggle-tag toggle-title"><?php _e('Tags:','enough');?></li>
        <li class="toggle-tag"><?php the_tags(' ',' '); ?></li>
        </ul>
        <?php } ?>
</div>
        <?php
         }
    }
}
/**
 *
 *
 *
 *
 *
 */
if( ! function_exists( 'enough_dinamic_sidebar' ) ){
    function enough_dinamic_sidebar($id,$display = true){
        if($display == true){ ?>
<nav><ul id="<?php echo $id;?>">
<?php
if( ! dynamic_sidebar( $id ) ){
    the_widget('WP_Widget_Archives');
    the_widget('WP_Widget_Recent_Posts');
}
?></ul></nav>
<?php
        }
    }
}
/**
 *
 *
 *
 *
 *
 */
if( ! function_exists( 'enough_enqueue_comment_reply' ) ){
    function enough_enqueue_comment_reply() {
        if ( is_singular()
             and comments_open()
             and get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }
}
/**
 *
 *
 *
 *
 *
 */
if( ! function_exists( 'enough_the_content') ){
    function enough_the_content( $more = '', $diaplay = true ){
        global $post;
        if( is_attachment( ) and $diaplay == true){
            $html = '<h3 class="h3 title">%1$s<a href="%2$s" rev="attachment">%3$s</a></h3>';
            printf($html
                ,__("Entry : ",'enough')
                ,get_permalink($post->post_parent)
                ,get_the_title($post->post_parent)
            );
            the_content($more);
        }elseif( is_search( ) and $diaplay == true){
            the_excerpt();
        }elseif($diaplay == true){
            the_content($more);
        }
    }
}
/**
 *
 *
 *
 *
 *
 */
if( ! function_exists( 'enough_the_footer' ) ){
    function enough_the_footer( $diaplay = true ){
    ?>
<footer>
    <address>
    <?php
    printf(
    '<small>&copy;%s %s <a href="%s" class="entry-rss">%s</a> and <a href="%s" class="comments-rss">%s</a></small>&nbsp;',
    date("Y"),
    get_bloginfo( 'name' ),
    get_bloginfo( 'rss2_url' ) ,
    __( "Entries <span>(RSS)</span>","enough" ),
    get_bloginfo('comments_rss2_url'),
    __( 'Comments <span>(RSS)</span>',"enough" )
    );
    if( is_child_theme() ){
        $enough_theme_name = 'Child theme '.ucwords(get_current_theme()).' of '.__("enough Theme","enough");
    }else{
        $enough_theme_name = __("enough Theme","enough");
    }
    printf(
    '&nbsp;<small><a href="%s">%s</a></small>&nbsp;&nbsp;',
    'http://www.tenman.info/wp3/enough',
    $enough_theme_name
    );
    ?>
    </address>
</footer>
    <?php
    }
}
/**
 * Extend body_class()
 *
 *
 * add browser class, languages class,
 *
 *
 */
if ( ! function_exists( 'enough_add_body_class' ) ) {
    function enough_add_body_class( $class ) {
    global $post, $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
        $lang               = get_locale();
        $enough_options  = get_option("enough_theme_settings");
        if(isset($enough_options["enough_style_type"]) and !empty($enough_options["enough_style_type"])){
            $color_type = "rd-type-".$enough_options["enough_style_type"];
        }else{
            $color_type = '';
        }
        if(is_single() or is_page()){
            $enough_content_check = get_post($post->ID);
            $enough_content_check = $enough_content_check->post_content;
            if(preg_match("!\[enough[^\]]+(color_type)=(\"|')*?([^\"' ]+)(\"|')*?[^\]]*\]!si",$enough_content_check,$regs)){
                $color_type = "rd-type-".trim($regs[3]);
            }
            if(preg_match("!\[enough[^\]]+(col)=(\"|')*?([^\"' ]+)(\"|')*?[^\]]*\]!si",$enough_content_check,$regs)){
                $color_type .= ' ';
                $color_type .= "rd-col-".$regs[3];
            }
        }
        if(isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])){
            $browser_lang = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
            $browser_lang = explode( ",", $browser_lang );
            $browser_lang = esc_html($browser_lang[0]);
            $browser_lang = 'accept-lang-'.$browser_lang;
            $classes= array($lang,$color_type,$browser_lang);
        }else{
            $classes= array($lang,$color_type);
        }
         $classes= array_merge($classes,$class);
         $iphone = false;
        switch(true){
            case($is_lynx):
                 $classes[] = 'lynx';
            break;
            case($is_gecko):
                $classes[]  = 'gecko';
            break;
            case($is_IE):
                preg_match(" |(MSIE )([0-9])(\.)|si",$_SERVER['HTTP_USER_AGENT'],$regs);
                $classes[]      = 'ie'.$regs[2];
            break;
            case($is_opera):
                 $classes[] = 'opera';
            break;
            case($is_NS4):
                $classes[]  = 'ns4';
            break;
            case($is_safari):
                $classes[]  = 'safari';
            if(preg_match("|(mobile)|si",$_SERVER['HTTP_USER_AGENT'],$regs)){
                $classes[]  = 'iphone';
                $iphone = true;
            }
            break;
            case($is_chrome):
                $classes[]  = 'chrome';
            break;
            case($is_iphone):
                if(!$iphone){
                    $classes[]  = 'iphone';
                }
            break;
            default:
                $classes[]  = 'unknown';
            break;
            }
            if(preg_match("|(mobile)|si",$_SERVER['HTTP_USER_AGENT'],$regs)){
              $classes[]  = 'mobile';
            }
        return apply_filters("enough_add_body_class",$classes);
    }
}
/**
 *
 *
 *
 *
 *
 */
if ( ! function_exists( 'enough_small_device_helper' ) ) {
    function enough_small_device_helper(){
        global $is_IE;
        $enough_title_length       = round(strlen(get_bloginfo('name')) );
        $enough_description_length = round(strlen(get_bloginfo('description')),0);
        $enough_header_image_uri   = get_header_image();
    ?>
        <script type="text/javascript">
        (function(){
        jQuery(function(){
            var width = jQuery(window).width();
    <?php
    /**
     * Menu header toggle controll
     *
     *
     *
     *
     */
     ?>

            jQuery('.enough-toggle-title').remove();
            jQuery(".menu-header").unwrap();

            if( width < 481){
                if (jQuery('ul').is(".menu-header")) {
                    jQuery('ul.menu-header').removeClass();
                }
                jQuery(".menu-header").wrap('<ul class="toggle-navigation"><li class="enough-toggle"></li></ul>');
                jQuery(".enough-toggle").before('<li class="enough-toggle enough-toggle-title">Menu</li>');

                flag = true;
            }
        <?php
        /**
        * Toggle for .menu-header
        */
        ?>
          jQuery('.enough-toggle').hide();
            jQuery('.enough-toggle.enough-toggle-title').show().css({"list-style":"none","font-weight":"bold","margin":"0 0 0 -1em"});
            jQuery('.enough-toggle.enough-toggle-title').css("cursor","pointer").toggle(
            function(){
                jQuery(this).siblings().show();
                    var v = jQuery(this).html().substring( 0, 30 );
                    jQuery(this).html( v );
            },
            function(){
                jQuery(this).siblings().hide();
                    var v = jQuery(this).html().substring( 0, 30 );
                    jQuery(this).html( v );
            });
        <?php
        /**
        * Toggle for category and tag
        */
        ?>
            if( width < 481){
            jQuery('.toggle-category,.toggle-tag').hide();
            jQuery('.toggle-category.toggle-title,.toggle-tag.toggle-title').show().css({"list-style":"none",});
            jQuery('.toggle-category.toggle-title,.toggle-tag.toggle-title').css("cursor","pointer").toggle(
            function(){

                jQuery(this).siblings().show();
                var v = jQuery(this).html().substring( 0, 30 );
                    jQuery(this).html( v );
            },
            function(){

                jQuery(this).siblings().hide();
                var v = jQuery(this).html().substring( 0, 30 );
                    jQuery(this).html( v );
            });
            }
        <?php
        /**
        * Toggle widget
        */
        ?>
            if( width < 481){
           jQuery('.menu-header-container,.menu-wplook-main-menu-container').wrap('<ul class="widget-container-wrapper"><li></li></ul>');
            jQuery('div.tagcloud').removeAttr('style').wrap('<ul class="tagcloud-wrapper"><li></li></ul>');
            jQuery('.widget ul').hide();
            jQuery('.menu-header-container > ul,menu-wplook-main-menu-container > ul').show();
            if(jQuery('.widgettitle').text() !== ''){
            jQuery('.widgettitle').show().css({"list-style":"none","font-weight":"bold","margin":"0",'max-width':'90%'});
            }
            jQuery('.widgettitle').css("cursor","pointer").toggle(
                function(){
                jQuery(this).siblings().show();
                var v = jQuery(this).html().substring(0, 30 );
                    jQuery(this).html(v);
                },
                function(){
                jQuery(this).siblings().hide();
                var v = jQuery(this).html().substring(0, 30 );

                    jQuery(this).html( v );
            });
            }

        <?php
        /**
        * Site title , description font size resize and header height ajust
        */
        ?>
            function fontResize(){
                <?php global $enough_site_image;?>
                var image_exists = '<?php echo $enough_header_image_uri;?>';
                var width = jQuery(window).width();
                <?php if($enough_title_length !== 0){?>
                var px = width /<?php echo $enough_title_length;?>;
                if( px < 10){ var px = 13;}
                if( px > 36){ var px = 36;}
                   jQuery('.site-title').css('font-size', px + 'px');
                <?php }?>
                <?php if($enough_description_length !== 0){?>
                var px = width /<?php echo $enough_description_length;?>;
                if( px < 10){ var px = 13;}
                if( px > 26){ var px = 26;}
                   jQuery('.site-description').css('font-size', px  + 'px');
                <?php }?>
                if( image_exists !== ''){
                <?php

                if ( ! is_multisite() ) {
                        $url        = get_theme_mod( 'header_image' );

                    if( empty( $url ) ){ //When child theme $url empty
                        $url        = get_header_image();
                    }

                    $uploads    = wp_upload_dir();
                    $path       = $uploads['path'].'/'. basename( $url );
                    list($img_width, $img_height, $img_type, $img_attr) = getimagesize($path);
                    $ratio = $img_height / $img_width;
                }else{

                    $url        = get_theme_mod( 'header_image' );

                    if( empty( $url ) ){ //When child theme $url empty
                        $url        = get_header_image();
                    }

                    $uploads    = wp_upload_dir();
                    $path       = $uploads['path'].'/'. basename( $url );

                    if( ! file_exists( $path ) ){
                    $path       = get_template_directory().'/images/headers/wp3.jpg';
                    }

                    list($img_width, $img_height, $img_type, $img_attr) = getimagesize($path);
                    $ratio = $img_height / $img_width;
                }
?>

                var header_width = jQuery( 'header' ).width();
                var ratio = <?php echo $ratio;?>;
                var height =  ( header_width * ratio ).toFixed(0);

                jQuery('header').removeAttr('style').css({'background-image':'url('+ image_exists + ')', 'height': height + 'px', 'background-size': 'cover'});


                <?php if( get_header_textcolor() == 'blank' ){?>


                jQuery('header').css('cursor','pointer').click(function(){

                location.href = "<?php echo home_url();?>";

                });
                <?php }?>
                }


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
                /* remove old width[0-9]+ class*/
                var element = jQuery("body");
                var classes = element.attr('class').split(/\s+/);

                var pattern = /^enough-w/;

                for(var i = 0; i < classes.length; i++){
                  var className = classes[i];

                  if(className.match(pattern)){
                    element.removeClass(className);
                  }
                }

                jQuery('body').addClass( body_class );


                <?php
                /**
                * Toggle for .menu-header
                */
                ?>

                if( width > 480){
                jQuery('.enough-toggle').show();
                jQuery('.enough-toggle.enough-toggle-title').hide();
                    if (jQuery('ul').is('.toggle-navigation')) {
                        jQuery(".menu-header").unwrap();
                        jQuery("enough-toggle enough-toggle-title").remove();
                    }
                    jQuery('.widgettitle .marker').remove();
                    jQuery('.toggle-title .marker').remove();
                    jQuery('.widget ul').show();
                    jQuery('.toggle-category,.toggle-tag').show();
                    if (jQuery('ul').is('.widget-container-wrapper')) {
                        jQuery('.menu-header-container,.menu-wplook-main-menu-container').unwrap();
                    }
                    if (jQuery('ul').is('.tagcloud-wrapper')) {
                        jQuery('div.tagcloud').unwrap();
                    }
                    <?php  if( $is_IE ){?>
                    if ( ! jQuery('body').is('[class^="enough-w"]')) {
                       // location.reload();
                    }
                    <?php } //end $is_IE ?>
                }else{
                <?php if( basename( wp_get_referer() ) !== 'customize.php' ){?>
                    if (!jQuery('ul').is('.toggle-navigation')) {
                        location.reload();
                    }
                <?php }?>
                }

    <?php $enough_options  = get_option("enough_theme_settings");

if( $enough_options['enough_use_slider'] !== 'yes' ){?>


jQuery('script #enough-slider-js, style #enough-slider-css').remove();

<?php }?>
    <?php
    /**
     * Check window size and mouse position
     * Controll childlen menu show right or left side.
     *
     *
     *
     */
     ?>
                jQuery(".menu-header").mousemove(function(e){
                    var menu_item_position = e.pageX ;
        <?php        // jQuery(".result:first").text(menu_item_position);
                  //jQuery(".result-w").text(width);?>
                    if( width - 200 < menu_item_position){
                        jQuery('.menu-header .children .children').addClass('left');
                    }else if( width / 2 >  menu_item_position){
                        jQuery('.menu-header .children .children').removeClass('left');
                    }
                });
            }
            fontResize();
            jQuery(window).resize( function () {fontResize()});

        });
        })(jQuery);
        </script>
        <?php
    }
}


/**
 *
 *
 *
 *
 *
 */
if ( ! function_exists( 'enough_not_found' ) ) {
    function enough_not_found(){
        if(is_search()){
    ?>
      <div class="fail-search message-box">
      <h2 class="center h2">
        <?php _e("Nothing was found though it was regrettable. Please change the key word if it is good, and retrieve it.","enough");?></h2>
        <?php get_search_form(); ?>
      </div>
    <?php
        }elseif( is_404()){
    ?>
      <div class="not-found message-box">
          <h2 class="center h2">
        <?php _e("File Not found","enough");?></h2>
        <?php get_search_form(); ?>
      </div>
    <?php
        }
    }
}
/**
 * index ,archive,loops page title
 *
 * echo Archives title
 *
 *
 */
if( ! function_exists( 'enough_loop_title' ) ){
    function enough_loop_title(){
        $enough_class_name = "";
        $page_title = "";
        if(is_search()){
            $enough_class_name = 'serch-result';
            $page_title = __("Search Results",'enough');
            $page_title_c = get_search_query();
        }elseif(is_tag()){
            $enough_class_name = 'tag-archives';
            $page_title = __("Tag Archives",'enough');
            $page_title_c = single_term_title("", false);
        }elseif(is_category()){
            $enough_class_name = 'category-archives';
            $page_title = __("Category Archives",'enough');
            $page_title_c = single_cat_title('', false);
        }elseif (is_archive()){
             $enough_date_format = get_option('date_format');
            if (is_day()){
                $enough_class_name = 'dayly-archives';
                $page_title = __('Daily Archives', 'enough');
                $page_title_c = get_the_date(get_option($enough_date_format));
            }elseif (is_month()){
                $enough_class_name = 'monthly-archives';
                $page_title = __('Monthly Archives', 'enough');
                if(get_locale() == 'ja'){
                    $page_title_c = get_the_date('Y / F');
                }else{
                    $page_title_c = get_the_date('F Y');
                }
            }elseif (is_year()){
                $enough_class_name = 'yearly-archives';
                $page_title = __('Yearly Archives', 'enough');
                $page_title_c = get_the_date('Y');
            }elseif (is_author()){
                $enough_class_name = 'author-archives';
                $page_title =   __("Author Archives",'enough');
                while (have_posts()){ the_post();
                    $page_title_c = get_avatar( get_the_author_meta( 'user_email' ),  32  ).' '.get_the_author();
                    break;
                }
                rewind_posts();
            }else{
                $enough_class_name = 'blog-archives';
                $page_title = __("Blog Archives",'enough');
            }
        }
        if(!empty($page_title)){
             printf('<h2 class="archives-title-text">%s <span>%s</span></h2>',
                    $page_title,
                    $page_title_c
            );
        }
    }
}
/**
 * Option value set when install.
 *
 *
 *
 *
 */
if( ! function_exists( 'enough_deploy' ) ){
    function enough_deploy(){
        global $wpdb,$enough_admin_options_setting;
        $enough_theme_settings = get_option('enough_theme_settings');
        foreach($enough_admin_options_setting as $add){
            $option_name = $add['option_name'];
            if(!isset($enough_theme_settings[$option_name])){
                $enough_theme_settings[$option_name] = $add['option_value'];
            }
        }
        update_option('enough_theme_settings',$enough_theme_settings,"",$add['autoload']);
    }
}
/**
 * return enough settings
 *
 *
 * @see enough_warehouse()
 *
 */
if( ! function_exists( 'enough_theme_option' ) ){
    function enough_theme_option( $name, $property = '' ){
        global $enough_admin_options_setting;
        $vertical = array();
        if(isset($enough_admin_options_setting)){
            foreach($enough_admin_options_setting as $key=>$val){
                if(!is_null($enough_admin_options_setting)){
                    $vertical[] = $val['option_name'];
                }
            }
            $row = array_search($name,$vertical);
            $result = get_option('enough_theme_settings');
            if( ! empty( $property ) ){
                if(isset($enough_admin_options_setting[$row][$property]) and !empty($enough_admin_options_setting[$row][$property])){
                return $enough_admin_options_setting[$row][$property];
                }else{
                return false;
                }
            }
            if(isset($result[$name]) and !empty($result[$name])){
                return apply_filters( 'enough_theme_settings_'.$name , $result[$name]);
            }elseif(isset($enough_admin_options_setting[$row]['option_value'])
                    and !empty($enough_admin_options_setting[$row]['option_value'])){
                return apply_filters('enough_theme_settings_'.$row, $enough_admin_options_setting[$row]['option_value']);
            }else{
                return false;
            }
        }
    }
}
/**
 * Validate admin panel form value.
 *
 *
 *
 *
 */
if( ! function_exists( 'enough_format_detection_telephone_validate' ) ){
    function enough_format_detection_telephone_validate($input){
        if($input == 'yes' or $input == 'no'){
            return $input;
        }else{
            return 'yes';
        }
    }
}
if( ! function_exists( 'enough_iphone_device_width_validate' ) ){
    function enough_iphone_device_width_validate($input){
        if (is_array($input)) {
                return array_map("htmlspecialchars", $input);
        } else {
                return htmlspecialchars($input, ENT_QUOTES);
        }
    }
}
if( ! function_exists( 'enough_iphone_status_bar_style_validate' ) ){
    function enough_iphone_status_bar_style_validate($input){
        return esc_html( $input );
    }
}
if( ! function_exists( 'enough_use_slider_validate' ) ){
    function enough_use_slider_validate($input){
        if($input == 'yes' or $input == 'no'){
            return $input;
        }else{
            return 'no';
        }
    }
}
if( ! function_exists( 'enough_slider_sleep_validate' ) ){
    function enough_slider_sleep_validate($input){
        if(is_numeric( $input ) ){
            return $input;
        }else{
            return 3;
        }
    }
}
if( ! function_exists( 'enough_slider_fade_validate' ) ){
    function enough_slider_fade_validate($input){
        if(is_numeric( $input ) ){
            return $input;
        }else{
            return 1;
        }
    }
}

/**
 * enough option panel
 *
 *
 * @package WordPress
 * @subpackage enough
 */
if( ! class_exists( 'enough_menu_create' ) ){
    class enough_menu_create {
        var $accesskey  = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");

/**
 *
 *
 *
 *
 *
 */
        function enough_theme_option_panel() {
            global $wpdb,$count, $enough_admin_options_setting, $enough_wp_version;
            $ok     = false;
            $result = "";
            $count = '';

            $enough_navigation_list  = '<ul class="enough-wp-native-style"><li><h3>'.__( 'WordPress settings links for human user interface', 'enough' ).'</h3></li>';
    if( $enough_wp_version >= '3.4' ){
            $enough_navigation_list  .= '<li class="enough-customizer enough-wp-native-style-settings-link"><a href="'.admin_url( 'customize.php' ).'">'.__( 'Customizer','enough').'</a><div class="enough_customizer_description">'.__('Preview with settings','enough').'<br />'.__('The enough Setting change of a theme can also be performed. ','enough').'</div></li>';
    }
            $enough_navigation_list  .= '<li class="enough-wp-native-style-settings-link"><a href="'.admin_url( 'widgets.php' ).'">'.__( 'Widget','enough').'</a><div class="enough_customizer_description">'.__('Add Widgets Sidebar and Footer','enough').'<br />'.__('The enough theme supports 6 positions of widgets area','enough').'</div></li>';
            $enough_navigation_list  .= '<li class="enough-wp-native-style-settings-link"><a href="'.admin_url( 'theme-editor.php' ).'">'.__( 'Theme Editor','enough').'</a><div class="enough_customizer_description">'.__('Edit All Theme Files Manualy','enough').'</div></li></ul>';

            /**
             * POSTGET
             *
             *
             */
            if(isset($_POST['enough_option_values']) and !empty($_POST['enough_option_values'])){
                    $enough_updates         = "";

                foreach($_POST["enough_option_values"] as $key=>$val){

                    $valid_function         = $key.'_validate';
                    $new_settings           = get_option('enough_theme_settings');
                    $new_settings[$key]     = $valid_function( $val );

                    if(update_option('enough_theme_settings',$new_settings)){
                        $ok                 = true;
                        $enough_updates .= ','.$key;
                    }
                }
            }
            $result .= '<div class="wrap"><div id="title-enough-header" >';

            $result .= screen_icon();
            $result .= "<h2>" .  ucfirst(get_current_theme()) . __(' Theme Settings', 'enough') . "</h2>";

            $result .= $enough_navigation_list;
            $result .= '<br style="clear:both;" />';
/**
 * Reset
 *
 *
 *
 *
 */
            if(isset($_POST['reset'])){
               foreach($enough_admin_options_setting as $add){
                    $option_name = $add['option_name'];
                        $enough_theme_settings[$option_name] = $add['option_value'];
                }
                update_option('enough_theme_settings',$enough_theme_settings,"",$add['autoload']);
                remove_theme_mods();

                $enough_updates = __( 'Reset Theme options and Theme Customizer options', 'enough' );
            }
/**
 *
 *
 *
 *
 *
 */
            if(isset($_POST['enough_option_values']) and !empty($_POST['enough_option_values'])){
                if($ok == true){
                $result .= '<div id="message" class="updated fade" title="'.esc_attr($enough_updates).'"><p>'.sprintf(__('updated %1$s  successfully.', 'enough'), $enough_updates);
                $result .= '</p></div>';
                }
            }
                $result .= $this->create_form();
                $result .= '</div>';
            echo $result;
        }
/**
 *
 *
 *
 *
 *
 */
        function add_menus() {
                $option_name   = ucwords(get_current_theme()).' Options';
                $hook_suffix = add_theme_page(
                        ENOUGH_TABLE_TITLE,
                        $option_name,
                        'edit_theme_options',
                        'enough_settings',
                        array($this, 'enough_theme_option_panel')
                );
                if ( $hook_suffix ){
                    add_action( 'admin_print_styles-' . $hook_suffix, array($this,'enough_admin_print_styles') );
                    add_action( 'load-' . $hook_suffix, array($this,'enough_settings_page_contextual_help') );
                }
        }
/**
 *
 *
 *
 *
 *
 */

        function enough_settings_page_contextual_help() {
        $screen = get_current_screen();

        $theme_data = get_theme_data( get_theme_root() . '/enough/style.css' );

        $html = '<dt>%1$s</dt><dd>%2$s</dd>';
        $link = '<a href="%1$s" %3$s>%2$s</a>';


        $content = '';

        /* theme description*/
        $content .= sprintf($html
                , __('Description','enough')
                , __( $theme_data['Description'] ,'enough')
                );
        /* theme URI*/
        $content .= sprintf($html
                , __('Theme URI','enough')
                , sprintf($link,$theme_data['URI'], $theme_data['URI'], 'target="_self"' )
                );
        /*AuthorURI*/
        $content .= sprintf($html
                , __('Author','enough')
                , sprintf( $link,$theme_data['AuthorURI'], $theme_data['Author'], 'target="_self"' )
                );
        /*Version*/
        $content .= sprintf($html
                , __('Version','enough')
                , $theme_data['Version']
                );
        /*Changelog.txt*/

        $content .= sprintf($html
                , __('Change log text','enough')
                , sprintf( $link, get_template_directory_uri().'/changelog.txt', __('Changelog , display new window', 'enough'), 'target="_blank"' )
                ,'target="_blank"'
                );
        /*readme.txt*/
        $content .= sprintf($html
                , __('Readme text','enough')
                , sprintf( $link, get_template_directory_uri().'/readme.txt', __('Readme , display new window', 'enough'), 'target="_blank"' )
                );


        $content = '<dl id="enough-help">'.$content.'</dl>';

            $screen->add_help_tab( array(
                'id'      => 'enough-settings-help',
                'title'   => __( 'Enough infomation', 'enough' ),
                'content' => $content
            ) );
        }
/**
 *
 *
 *
 *
 *
 */
        function enough_admin_print_styles(){
            if(file_exists(get_stylesheet_directory().'/admin-options.css')){
                echo '<style type="text/css">@import url("'.get_stylesheet_directory_uri().'/css/admin-options.css");</style>';
            }else{
                echo '<style type="text/css">@import url("'.get_template_directory_uri().'/css/admin-options.css");</style>';
            }
        }
/**
 *
 *
 *
 *
 *
 */
        function create_form(){
            global $enough_admin_options_setting;
            global $wpdb;
            $option_value   = "-";
            $lines          = "";
            $i              = 0;
            $deliv          = htmlspecialchars($_SERVER['REQUEST_URI']);
            $results        = get_option('enough_theme_settings');
            $lines .= '<div class="enough-options-panel">';
            $lines .= $this->navigation_list($enough_admin_options_setting);
            foreach($enough_admin_options_setting as $key => $row){
                $enough_option_name = $enough_admin_options_setting[$key]['option_name'];
                $enough_sort[$enough_option_name] = $results[$enough_option_name];
            }
            $results        = $enough_sort;
            $lines .= "<form action=\"$deliv\" method=\"post\">".wp_nonce_field('update-options');
            $i = 0;
            foreach( $results as $key => $val ){
                if(enough_theme_option($key,'type') == 'text' ){
/**
 *
 *
 *
 *
 *
 */
            $lines .= '<div id="'.$key.'" class="form-section '.enough_theme_option($key,'type').'">';
$lines .= '<a href="#wpwrap">Top</a>';
                    $lines .= '<h3 class="setting-title">'. enough_theme_option($key,'title').'</h3>';
                    $lines .=  '<strong class="setting-excerpt">'.enough_theme_option($key,'excerpt').'</strong>';
                    $lines .= '<p><input  accesskey="'.esc_attr($this->accesskey[$i]).'" type="text" name="enough_option_values['.$key.']" value="'.esc_attr__($val,'enough').'"';
                   $lines .= ' /></p>';
            $lines .= '</div>';
                }elseif(enough_theme_option($key,'type') == 'textarea' ){
/**
 *
 *
 *
 *
 *
 */
            $lines .= '<div id="'.$key.'" class="form-section '.enough_theme_option($key,'type').'">';
$lines .= '<a href="#wpwrap">Top</a>';
                    $lines .= '<h3 class="setting-title">'. enough_theme_option($key,'title').'</h3>';
                    $lines .=  '<strong class="setting-excerpt">'.enough_theme_option($key,'excerpt').'</strong>';
                    $lines .= '<p><textarea accesskey="'.esc_attr($this->accesskey[$i]).'" name="enough_option_values['.$key.']" >'.esc_attr__($val,'enough').'</textarea></p>';
            $lines .= '</div>';
                    $i++;
                }elseif(enough_theme_option($key,'type') == 'checkbox' ){
/**
 *
 *
 *
 *
 *
 */
            $lines .= '<div id="'.$key.'" class="form-section '.enough_theme_option($key,'type').'">';
$lines .= '<a href="#wpwrap">Top</a>';
                    $lines .= '<h3 class="setting-title">'. enough_theme_option($key,'title').'</h3>';
                    $lines .=  '<strong class="setting-excerpt">'.enough_theme_option($key,'excerpt').'</strong>';
                    $lines .= '<p><input  accesskey="'.esc_attr($this->accesskey[$i]).'" type="checkbox" name="enough_option_values['.$key.'][]" value="'.esc_attr__(enough_theme_option($key,'option_value'),'enough').'"';
                    $i++;
                    $check = enough_theme_option($key);
                   if( is_array( $check ) and (enough_theme_option($key,'option_value') == $val or array_search(enough_theme_option($key,'option_value'),$check) !== false  ) ){
                        $lines .= 'checked = "checked" />'.enough_theme_option($key,'option_value');
                   }elseif(array_search(enough_theme_option($key,'option_value'),$check) == false){
                        $lines .= ' />'.enough_theme_option($key,'option_value');
                   }
                    $select_values = enough_theme_option($key,'select_values');
                    foreach($select_values as $label => $val_check_box){
                        $lines .= '<input  accesskey="'.esc_attr($this->accesskey[$i]).
                                    '" type="checkbox" name="enough_option_values['.$key.'][]" value="'.
                                    esc_attr__($val_check_box,'enough').'"';
                        $i++;
                        if(is_array( $check ) and (enough_theme_option($key) == $val_check_box or array_search($val_check_box,$check) !== false ) ){
                            $lines .= 'checked = "checked" />'.$val_check_box;
                        }elseif(array_search($val_check_box,$check) == false){
                            $lines .= ' />'.$val_check_box;
                        }
                    }
                    $lines .= '</p>';
            $lines .= '</div>';
                }elseif(enough_theme_option($key,'type') == 'radio' ){
/**
 *
 *
 *
 *
 *
 */
            $lines .= '<div id="'.$key.'" class="form-section '.enough_theme_option($key,'type').'">';
$lines .= '<a href="#wpwrap">Top</a>';
                    $lines .= '<h3 class="setting-title">'. enough_theme_option($key,'title').'</h3>';
                    $lines .=  '<strong class="setting-excerpt">'.enough_theme_option($key,'excerpt').'</strong>';
                    $lines .= '<p><label><input  accesskey="'.esc_attr($this->accesskey[$i]).'" type="radio" name="enough_option_values['.$key.']" value="'.esc_attr__(enough_theme_option($key,'option_value'),'enough').'"';
                    $i++;
                    $check = enough_theme_option($key);

                   if( enough_theme_option($key,'option_value') == $val or (is_array( enough_theme_option($key,'option_value') ) and array_search(enough_theme_option($key,'option_value'),$check) !== false ) ){
                        $lines .= 'checked = "checked" />'.enough_theme_option($key,'option_value'). '</label>';
                   }elseif( ! is_array( $check ) or array_search(enough_theme_option($key,'option_value'),$check) == false ){
                        $lines .= ' />'.enough_theme_option($key,'option_value'). '</label>';
                   }
                    $select_values = enough_theme_option($key,'select_values');

                    if(is_array( $select_values ) and !empty( $select_values ) ){

                        foreach($select_values as $label => $val_check_box){
                            $lines .= '<label><input  accesskey="'.esc_attr($this->accesskey[$i]).
                                        '" type="radio" name="enough_option_values['.$key.']" value="'.
                                        esc_attr__($val_check_box,'enough').'"';
                            $i++;

                            if( enough_theme_option($key) == $val_check_box or (is_array( $check ) and array_search($val_check_box,$check) !== false ) ){
                                $lines .= 'checked = "checked" />'.$val_check_box.'</label>';
                            }elseif( ! is_array( $check ) or array_search($val_check_box,$check) == false ){
                                $lines .= ' />'. $val_check_box.'</label>';
                            }
                        }
                    }
                    $lines .= '</p>';
            $lines .= '</div>';
                }
            }
/**
 *
 *
 *
 *
 *
 */
            $lines .= "<div class=\"submit-box\"><input type=\"submit\" class=\"button-primary\" value=\"".esc_attr('Save Changes').'" />&nbsp;&nbsp;&nbsp;';
            $lines .= "<input type=\"submit\" name=\"reset\" class=\"button-primary\" value=\"".esc_attr('Reset All Settings').'" /></form><br style="clear:both;</div>"';
            $lines .= "lines";
            $add_infomation = '';
            return $add_infomation.'</div></div>'. $lines;
        }
        function navigation_list($enough_admin_options_setting){
        $lines = '<h3>Menu</h3><ul class="theme-option-menu">';
        foreach($enough_admin_options_setting as $val){
            $lines .='<li><a href="#'.$val['option_name'].'">'.$val['option_name'].'</a></li>';
        }
        $lines .= '</ul>';
        return $lines;
        }
    }
}
/**
 * enough once message when install.
 *
 *
 *
 *
 *
 */
if( ! function_exists( "enough_first_only_msg" ) ){
    function enough_first_only_msg($type=0) {
        if ( $type == 1 ) {
            $query  = 'enough_settings';
            $link   = get_site_url('', 'wp-admin/themes.php', 'admin') . '?page='.$query;
            if (version_compare(PHP_VERSION, '5.0.0', '<')) {
            $msg    = sprintf(__('Sorry Your PHP version is %s Please use PHP version 5 or later.','enough'),PHP_VERSION);
            }else{
            $msg    = sprintf(__('Thank you for adopting the %s theme. It is necessary to set it to this theme. Please move to a set screen clicking this <a href="%s">settings page</a>.','enough'),get_current_theme() ,$link);
            }
        }
        return '<div id="testmsg" class="error"><p>' . $msg . '</p></div>' . "\n";
    }
}
/**
 * Management of uninstall and install.
 *
 *
 *
 *
 */
if( ! function_exists( "enough_install_navigation" ) ){
    function enough_install_navigation() {
        $install = get_option('enough_theme_settings');
        if ($install == false or !array_key_exists('install', $install)) {
            add_action('admin_notices', create_function(null, 'echo enough_first_only_msg(1);'));
            $install['install'] = true;
            update_option('enough_theme_settings',$install);
        } else {
            add_action('switch_theme', create_function(null, 'delete_option("enough_theme_settings");'));
        }
    }
}
/**
 *
 *
 *
 *
 *
 */
if( ! function_exists( 'enough_embed_format_detection_telephone' ) ){
    function enough_embed_format_detection_telephone(){
        global $enough_embed_format_detection_telephone;
        if( empty( $enough_embed_format_detection_telephone ) or ! isset( $enough_embed_format_detection_telephone ) ){
            $enough_embed_format_detection_telephone = enough_theme_option("enough_embed_format_detection_telephone");
        }

    ?>
    <meta name="format-detection" content="telephone=<?php echo $enough_embed_format_detection_telephone; ?>" />
    <?php
    }
}
/**
 *
 *
 *
 *
 *
 */
if( ! function_exists( 'enough_embed_iphone_device_width' ) ){
    function enough_embed_iphone_device_width(){
        global $enough_embed_iphone_device_width;
        if( empty( $enough_embed_iphone_device_width ) or ! isset( $enough_embed_iphone_device_width ) ){
            $enough_embed_iphone_device_width = enough_theme_option("enough_iphone_device_width");
        }
    ?>
    <meta name="viewport" content="<?php echo $enough_embed_iphone_device_width; ?>" />
    <?php
    }
}
/**
 *
 *
 *
 *
 *
 */
if( ! function_exists( 'enough_embed_iphone_status_bar' ) ){
    function enough_embed_iphone_status_bar(){
        global $enough_embed_iphone_status_bar_style;
        if( empty( $enough_embed_iphone_status_bar_style ) or ! isset( $enough_embed_iphone_status_bar_style ) ){
            $enough_embed_iphone_status_bar_style = enough_theme_option("enough_iphone_status_bar_style");
        }

    ?>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style"      content="<?php echo $enough_embed_iphone_status_bar_style; ?>">
    <?php
    }
}
/**
 *
 *
 *
 *
 *
 */
if( ! function_exists( 'ecnough_ie_height_issue' ) ){
    function ecnough_ie_height_issue($content){
        return str_replace('<img ', '<img style="width:150px;height:auto;" ',$content);
    }
}
/**
 *
 *
 *
 *
 *
 */
if( ! function_exists( 'enough_header_style' ) /*and $enough_wp_version < '3.4'*/ ){
    function enough_header_style() {
        $header_image = get_header_image();
        if(!empty($header_image)){
        ?><style type="text/css"><!--
            header {
                background: url(<?php echo $header_image ?>);
                height:<?php echo HEADER_IMAGE_HEIGHT;?>px;
            }
            <?php if ( 'blank' == get_header_textcolor() ) {?>
            header a span{visibility:hidden;}
            header .site-description span{ display: none; }
            <?php }else{ ?>
            header h2,
            header h1 a{
                color:#<?php echo get_header_textcolor(); ?>;
            }
            <?php } ?>  -->
        </style><?php
        }

    }
}
/**
 *
 *
 *
 *
 *
 */
if( ! function_exists( 'enough_admin_header_style' ) ){
    function enough_admin_header_style(){

            $url            = get_theme_mod( 'header_image' );
            $uploads        = wp_upload_dir();
            $path           = $uploads['path'].'/'. basename( $url );

        list($img_width, $img_height, $img_type, $img_attr) = getimagesize($path);
?>
<style type="text/css"><!--
#headimg{
width:<?php echo $img_width; ?>px!important;
height:<?php echo $img_height; ?>px!important;
}
            <?php if ( 'blank' == get_header_textcolor() ) {?>
            #headimg a span{visibility:hidden;}
            #headimg .site-description span{ display: none; }
            <?php }else{ ?>
            #headimg h2,
            #headimg h1 a{
                color:#<?php echo get_header_textcolor(); ?>;
            }
            <?php } ?>  -->
        </style>
<?php

    }
}


if( ! function_exists( 'enough_add_post_class' ) ){
    function enough_add_post_class( $classes ){

        if ( comments_open() ) {
            $newclass = 'comments-open';
        }else{
            $newclass = 'comments-closed';
        }
        array_push( $classes, $newclass );

        return $classes;
    }
}

/**
 *
 *
 *
 *
 *
 */
if( ! function_exists( "enough_page_menu_args" ) ){
    function enough_page_menu_args( $args ) {
        $args['show_home'] = true;
        return $args;
    }
}
/**
 *
 *
 *
 *
 *
 */
if( ! function_exists( "enough_slider" ) ){
    function enough_slider(){

        wp_register_script('jquery.cross-slide.js', get_template_directory_uri(). '/jquery.cross-slide.js',array('jquery'));
        wp_enqueue_script('jquery.cross-slide.js');

        $enough_options  = get_option("enough_theme_settings");

        if(!empty( $enough_options['enough_slider_sleep']) ){
            $sleep = $enough_options['enough_slider_sleep'];
        }else{
            $sleep = $enough_admin_options_setting[4]['option_value'];
        }
        if(!empty( $enough_options['enough_slider_fade']) ){
            $fade = $enough_options['enough_slider_fade'];
        }else{
            $fade = $enough_admin_options_setting[5]['option_value'];
        }

    if( $enough_options['enough_use_slider'] == 'yes' ){
     if(!is_single()){
        if(get_header_image()){
         $headers = get_uploaded_header_images();
    ?>
<style type="text/css" id="enough-slider-css">
    header .site-title, header .site-description{display:none;}
    header{box-shadow:1px 0 0 #000;overflow:hidden;}
    header img{
        margin:0 0 0!important;
        padding:0!important;
        width:100%;
        max-width:100%!important;
        left:2px!important;
        z-index:1;
    }
    .site-title{display:inline;position:absolute;z-index:999;color:#fff;left:10%;}
</style>
<script type="text/javascript" id="enough-slider-js">
    jQuery(function() {
    jQuery('header').before('<h1 class="site-title"><a href="<?php home_url();?>" style="color:#<?php echo get_theme_mod("header_textcolor");?>"><?php bloginfo('site-title');?></a></h1>');
    <?php $last = end($headers);?>
        jQuery('header').crossSlide({
        sleep: <?php echo $sleep; ?>,
        fade: <?php echo $fade; ?>
        },[<?php foreach ($headers as $key => $value){
        if($value == $last){$separator = '';}else{$separator = ',';}?>
    {src: '<?php echo $value['url']; ?>' }<?php echo $separator;?><?php } ?>])
    });
</script>
    <?php
    }

         }
        }
    }
}
/**
 *
 *
 *
 *
 *
 */

if( ! function_exists( 'enough_customize_register' ) and $enough_wp_version >= '3.4'){
    function enough_customize_register( $wp_customize ) {

        $wp_customize->add_section( 'enough_theme_setting'
            , array( 'title' => __( 'enough theme setting', 'enough' )
                    , 'priority' => 33,
                )
        );

        $wp_customize->add_setting( 'enough_theme_settings[enough_use_slider]', array(
            'default'        => 'no',
            'type'           => 'option',
            'capability'    => 'edit_theme_options'
        ) );

        $wp_customize->add_setting( 'enough_theme_settings[enough_slider_sleep]', array(
            'default'        => 3,
            'type'           => 'option',
            'capability'        => 'edit_theme_options'
        ) );
        $wp_customize->add_setting( 'enough_theme_settings[enough_slider_fade]', array(
            'default'        => 1,
            'type'           => 'option',
            'capability'        => 'edit_theme_options'
        ) );

        $wp_customize->add_control( 'enough_use_slider', array(
                'label'      => __( 'Slider Header Image', 'enough' ),
                'section'    => 'enough_theme_setting',
                'settings'   => 'enough_theme_settings[enough_use_slider]',
                'type'       => 'radio',
                'choices'    => array( 'yes'=> __( 'Yes' , 'enough' )
                                        , 'no' => __( 'No', 'enough' )
                                    )
                )
        );
        $wp_customize->add_control( 'enough_slider_sleep'
            , array(
                'label'      => __( 'Sleep (sec)', 'enough' ),
                'section'    => 'enough_theme_setting',
                'settings'   => 'enough_theme_settings[enough_slider_sleep]',
                'type'       => 'text',
                )
        );
        $wp_customize->add_control( 'enough_slider_fade'
            , array(
                'label'      => __( 'Fade (sec)', 'enough' ),
                'section'    => 'enough_theme_setting',
                'settings'   => 'enough_theme_settings[enough_slider_fade]',
                'type'       => 'text',
                )
        );

    }
}


?>