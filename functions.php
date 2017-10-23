<?php
/* Functions and class for WordPress theme Enough
 *
 *
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * @package Enough
 */
/**
 *
 * @since 0.48
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

include_once( get_template_directory() . '/inc/widgets.php');
/**
 * When WEBSITE Change from http: to https
 * Old post content filtered to https://your domain/...
 */
if( ! isset( $raindrops_ssl_link_helper ) ) {

	$enough_ssl_link_helper = true;
}
/**
 * enough Gallery Presentation
 * value false shows WordPress Standard Gallery Style.
 *
 */
if( ! isset( $enough_extend_galleries ) ) {

	$enough_extend_galleries = true;
}
/**
 * USE genericons or not
 * SET enough-icon or enouth-text
 */
$enough_navigation_type			 = 'enough-icon';
/**
 * Show insert point guid WP_DEBUG true and $enough_show_insert_point value true
 * @since 0.80
 */
$enough_show_insert_point		 = false;

if ( function_exists( 'the_custom_logo' ) ) {
/* for WordPress 4.5 */
	add_image_size( 'raindrops-logo', 1200, 120 );
	add_theme_support( 'custom-logo', array( 'size' => 'raindrops-logo' ) );
}

/**
 *
 *
 */
$enough_admin_options_setting	 = array(
	array( 'option_id'		 => 2,
		'blog_id'		 => 0,
		'option_name'	 => "enough_format_detection_telephone",
		'option_value'	 => "no",
		'autoload'		 => 'yes',
		'title'			 => __( 'iphone format telephone', 'enough' ),
		'excerpt'		 => __( 'Iphone format detection telephone', 'enough' ),
		'validate'		 => 'enough_format_detection_telephone_validate', 'list'			 => 1,
		'type'			 => 'radio',
		'select_values'	 => array( "yes" => 'yes' )
	),
	array( 'option_id'		 => 3,
		'blog_id'		 => 0,
		'option_name'	 => "enough_iphone_device_width",
		'option_value'	 => 'width=device-width',
		'autoload'		 => 'yes',
		'title'			 => __( 'iphone device width settings', 'enough' ),
		'excerpt'		 => __( 'iphone meta name "viewport" content value', 'enough' ),
		'validate'		 => 'enough_iphone_device_width_validate', 'list'			 => 2,
		'type'			 => 'text',
		'select_values'	 => '',
	),
	array( 'option_id'		 => 4,
		'blog_id'		 => 0,
		'option_name'	 => "enough_iphone_status_bar_style",
		'option_value'	 => "default",
		'autoload'		 => 'yes',
		'title'			 => __( 'iphone_status_bar_style', 'enough' ),
		'excerpt'		 => __( 'iphone the status bar style', 'enough' ),
		'validate'		 => 'enough_iphone_status_bar_style_validate', 'list'			 => 3,
		'type'			 => 'radio',
		'select_values'	 => array( 'black' => 'black', 'black-translucent' => 'black-translucent' )
	),
	array( 'option_id'		 => 8,
		'blog_id'		 => 0,
		'option_name'	 => "enough_post_one_column_bottom_sidebar",
		'option_value'	 => 'no',
		'autoload'		 => 'yes',
		'title'			 => __( 'Post One Column Bottom Sidebar', 'enough' ),
		'excerpt'		 => __( 'Post Full Width One Column', 'enough' ),
		'validate'		 => 'enough_post_one_column_bottom_sidebar_validate',
		'list'			 => 1,
		'type'			 => 'radio',
		'select_values'	 => array( 'yes' => 'yes' )
	),
	array( 'option_id'		 => 9,
		'blog_id'		 => 0,
		'option_name'	 => "enough_approach_type",
		'option_value'	 => 'default',
		'autoload'		 => 'yes',
		'title'			 => __( 'Home Page Type', 'enough' ),
		'excerpt'		 => __( 'Please select the layout of the homepage', 'enough' ),
		'validate'		 => 'enough_approach_type_validate',
		'list'			 => 1,
		'type'			 => 'radio',
		'select_values'	 => array( 
			__( 'Author', 'enough' )				 => 'author',
			__( 'Blank', 'enough' )					 => 'blank',
			__( 'Categories','enough' )				 => 'categories',
			__( 'Post Format Chat', 'enough' )		 => 'chat',
			__( 'Post Format Gallery', 'enough' )	 => 'gallery',
			__( 'Post Format Image', 'enough' )		 => 'image',
			__( 'Post Format Link', 'enough' )		 => 'link',
			__( 'Post Format Quote', 'enough' )		 => 'quote',
			__( 'Post Format Status', 'enough' )	 => 'status',
			__( 'Post Format Video', 'enough' )		 => 'video',
		)
	),
	array( 'option_id'		 => 10,
		'blog_id'		 => 0,
		'option_name'	 => "enough_enable_post_formats",
		'option_value'	 => 'default',
		'autoload'		 => 'yes',
		'title'			 => __( 'Enabled Post Formats', 'enough' ),
		'excerpt'		 => __( 'Please select whether to enable any Post Format', 'enough' ),
		'validate'		 => 'enough_enable_post_formats_validate',
		'list'			 => 1,
		'type'			 => 'checkbox',
		'select_values'	 => array(
			'Default'				 => 'default',
			__( 'Post Format Chat', 'enough' )		 => 'chat',
			__( 'Post Format Gallery', 'enough' )	 => 'gallery',
			__( 'Post Format Image', 'enough' )		 => 'image',
			__( 'Post Format Link', 'enough' )		 => 'link',
			__( 'Post Format Quote', 'enough' )		 => 'quote',
			__( 'Post Format Status', 'enough' )	 => 'status',
			__( 'Post Format Video', 'enough' )		 => 'video',
		)
	),
	array( 'option_id'		 => 11,
		'blog_id'		 => 0,
		'option_name'	 => "enough_post_content_width",
		'option_value'	 => 100,
		'autoload'		 => 'yes',
		'title'			 => __( 'Content Width of One Column Post', 'enough' ),
		'excerpt'		 => __( 'Set your content width for One Column post', 'enough' ),
		'validate'		 => 'enough_post_content_width_validate',
		'list'			 => 1,
		'type'			 => 'text',
		'select_values'	 => '',
	),
);
function enough_post_content_width_validate( $input ) {

	if( is_numeric( $input ) && $input > 49 && $input < 101 ) {
		return $input;
	}
	return 100;
}

function enough_enable_post_formats_validate( $input ) {

	$formats = array( 'aside','chat','gallery','link','image','quote','status','video','audio');
	foreach( $formats as $format ){

		if( in_array( $format , $input ) ) {
			return $input;
		}
	}
	return array('default');
}

/**
 * return enough settings
 *
 *
 */
if ( !function_exists( 'enough_theme_option' ) ) {

	function enough_theme_option( $name, $property = '' ) {

		global $enough_admin_options_setting;

		$vertical = array();

		$result = get_option( 'enough_theme_settings' );

		$defaults = array();
		foreach ( $enough_admin_options_setting as $key => $val ) {

			if ( $val[ 'autoload' ] == 'yes' ) {

				$defaults = array_merge( $defaults, array( $val[ 'option_name' ] => $val[ 'option_value' ] ) );
			}
		}
		if ( $result == false && $name == 'defaults' ) {

			return $defaults;
		} elseif ( $result !== false && $name == 'defaults' ) {

			return array_merge( $defaults, $result );
		}

		if ( isset( $enough_admin_options_setting ) ) {

			foreach ( $enough_admin_options_setting as $key => $val ) {

				if ( !is_null( $enough_admin_options_setting ) ) {

					$vertical[] = $val[ 'option_name' ];
				}
			}


			$row = array_search( $name, $vertical );

			if ( !empty( $property ) ) {

				if ( isset( $enough_admin_options_setting[ $row ][ $property ] ) and ! empty( $enough_admin_options_setting[ $row ][ $property ] ) ) {

					return $enough_admin_options_setting[ $row ][ $property ];
				} else {

					return false;
				}
			}
			if ( isset( $result[ $name ] ) and ! empty( $result[ $name ] ) ) {

				return apply_filters( 'enough_theme_settings_' . $name, $result[ $name ] );
			} elseif ( isset( $enough_admin_options_setting[ $row ][ 'option_value' ] ) and ! empty( $enough_admin_options_setting[ $row ][ 'option_value' ] ) ) {

				return apply_filters( 'enough_theme_settings_' . $row, $enough_admin_options_setting[ $row ][ 'option_value' ] );
			} else {

				return false;
			}
		}
	}
}
/**
 *
 *
 */
$enough_options			 = get_option( "enough_theme_settings" );
$enough_home_template	 = enough_theme_option( 'enough_approach_type' );

add_action( 'pre_get_posts', 'enough_modify_query_exclude_category' );

function enough_modify_query_exclude_category( $query ) {

	global $enough_home_template;

	if ( empty( $enough_home_template ) ) {
		return $query;
	}

	if ( !is_admin() and
	$query->is_main_query() and
	$query->is_home() and
	$enough_home_template !== 'default' and
	$enough_home_template !== 'author' and
	$enough_home_template !== 'standard' and
	$enough_home_template !== 'categories' ) {

		$query->set( 'posts_per_page', 100 );
	}
}

/**
 *
 * Version
 */
$enough_check_wp_version	 = explode( '-', $wp_version );
$enough_wp_version			 = $enough_check_wp_version[ 0 ];
$enough_theme_data			 = wp_get_theme();
$enough_theme_uri			 = $enough_theme_data->get( 'ThemeURI' );
$enough_author_uri			 = $enough_theme_data->get( 'AuthorURI' );
$enough_version				 = $enough_theme_data->get( 'Version' );
$enough_current_theme_name	 = $enough_theme_data->get( 'Name' );
$enough_description			 = $enough_theme_data->get( 'Description' );
$enough_author				 = $enough_theme_data->get( 'Author' );
$enough_template			 = $enough_theme_data->get( 'Template' );
$enough_tags				 = implode( ',', $enough_theme_data->get( 'Tags' ) );

load_textdomain( 'enough', get_template_directory() . '/languages/' . get_locale() . '.mo' );
/**
 * Content Width
 *
 */
if ( !isset( $content_width ) ) {
	$content_width = 610;
}
if ( !defined( 'ENOUGH_TABLE_TITLE' ) ) {
	define( "ENOUGH_TABLE_TITLE", 'options' );
}
/**
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
 */
if ( !isset( $enough_post_format_functionality ) ) {

	$enough_post_format_functionality = false;
}
$enough_enable_post_formats = enough_theme_option( 'enough_enable_post_formats' );

if ( is_array( $enough_enable_post_formats ) && ($key = array_search( 'default', $enough_enable_post_formats )) !== false ) {

	if ( isset( $enough_enable_post_formats[ $key ] ) ) {

		unset( $enough_enable_post_formats[ $key ] );
	}
}
if ( is_array( $enough_enable_post_formats ) && !empty( $enough_enable_post_formats ) ) {

	add_theme_support( 'post-formats', $enough_enable_post_formats );
}

/**
 *
 *
 */
$enough_deploy_check = get_option( 'enough_theme_settings' );

if ( $enough_deploy_check == false or ! array_key_exists( 'install', $enough_deploy_check ) ) {

	//add_action('admin_init', 'enough_deploy');
}

/**
 *
 *
 */
add_action( 'after_setup_theme', 'enough_theme_setup' );

if ( !function_exists( 'enough_theme_setup' ) ) {

	function enough_theme_setup() {

		global $enough_sidebar_args;
		global $enough_register_nav_menus_args;
		global $enough_admin_options_setting;
		global $enough_wp_version;

		do_action( 'enough_setup_before' );

		register_sidebar( array(
			'name'			 => sprintf( __( 'Sidebar %d', 'enough' ), 1 ),
			'id'			 => 'sidebar-1',
			'description'	 => '',
			'before_widget'	 => '<li id="%1$s" class="widget %2$s">',
			'after_widget'	 => '</li>',
			'before_title'	 => '<h2 class="widgettitle">',
			'after_title'	 => '</h2>'
		) );

		register_sidebar( array(
			'name'			 => __( 'Approach Page Post Format After', 'enough' ),
			'id'			 => 'sidebar-approach',
			'description'	 => __( 'Blog Home Widget After Content', 'enough' ),
			'before_widget'	 => '<li id="%1$s" class="widget %2$s">',
			'after_widget'	 => '</li>',
			'before_title'	 => '<h2 class="widgettitle">',
			'after_title'	 => '</h2>'
		) );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );

		add_editor_style();

		add_action( 'wp_enqueue_scripts', 'enough_enqueue_scripts_styles' );

		add_filter( 'body_class', 'enough_add_body_class' );

		add_action( 'wp_enqueue_scripts', 'enough_enqueue_comment_reply' );

		$enough_embed_format_detection_telephone = enough_theme_option( "enough_format_detection_telephone" );

		if ( $enough_embed_format_detection_telephone !== false ) {

			add_action( "wp_head", 'enough_embed_format_detection_telephone' );
		}

		$enough_embed_iphone_device_width = enough_theme_option( "enough_iphone_device_width" );

		if ( $enough_embed_iphone_device_width !== false ) {

			add_action( "wp_head", 'enough_embed_iphone_device_width' );
		}

		$enough_embed_iphone_status_bar_style = enough_theme_option( "enough_iphone_status_bar_style" );

		if ( $enough_embed_iphone_status_bar_style !== false ) {

			add_action( "wp_head", 'enough_embed_iphone_status_bar' );
		}

		add_filter( 'post_class', 'enough_add_post_class' );

		add_action( 'wp_head', 'enough_embed_meta' );

		/**
		 * Enough Post Full width One Clolumn
		 *
		 *
		 *
		 */
		if ( enough_theme_option( 'enough_post_one_column_bottom_sidebar' ) == 'yes' ) {

			$enough_onecolumn_post = 'yes';

			add_filter( 'post_class', 'enough_onecolumn_post' );
			add_filter( 'body_class', 'enough_onecolumn_post' );
		} else {

			$enough_onecolumn_post = 'no';
		}
		add_action( 'wp_head', 'enough_slider' );

		add_action( 'widgets_init', 'enough_register_recent_post_group_by_category' );
		add_action( 'widgets_init', 'enough_register_pinup_entry_Widget' );

		add_filter( 'embed_oembed_html', 'enough_oembed_filter', 99, 4 );
		add_action( 'wp_enqueue_scripts', 'enough_load_small_device_helper' );

		add_theme_support( 'title-tag' );

		if ( ! function_exists( '_wp_render_title_tag' ) ) {
		/**
		 * WordPress4.1 Backwards compatibility
		 * @since 1.265
		 */
			function enough_render_title() {
				?><title><?php wp_title( '|', true, 'right' ); ?></title><?php
			}
			add_action( 'wp_head', 'enough_render_title' );
		}
		add_theme_support( 'html5', array( 'gallery', 'caption' ) );
		do_action( 'enough_setup_after' );
	}

}
/**
 *
 *
 */
if ( file_exists( get_stylesheet_directory() . '/images/headers/wp3.jpg' ) ) {

	$enough_site_image			 = get_stylesheet_directory_uri() . '/images/headers/wp3.jpg';
	$enough_site_thumbnail_image = get_stylesheet_directory_uri() . '/images/headers/wp3-thumbnail.jpg';
} else {

	$enough_site_image			 = get_template_directory_uri() . '/images/headers/wp3.jpg';
	$enough_site_thumbnail_image = get_template_directory_uri() . '/images/headers/wp3-thumbnail.jpg';
}

$args_custom_header = array( 'default-text-color'	 => '333333'
	, 'width'					 => apply_filters( 'enough_header_image_width', '950' )
	, 'flex-width'			 => true
	, 'height'				 => apply_filters( 'enough_header_image_height', '100' )
	, 'flex-height'			 => true
	, 'header-text'			 => true
	, 'default-image'			 => $enough_site_image
	//, 'wp-head-callback'		 => 'enough_small_device_helper'
	, 'admin-head-callback'	 => 'enough_admin_header_style'
);

add_theme_support( 'custom-header', $args_custom_header );
/**
 * Add for WordPress 4.1
 *
 * @since 1.260
 */
register_default_headers( array(
	'willow' => array(
		'url'			 => $enough_site_image,
		'thumbnail_url'	 => $enough_site_thumbnail_image,
	),
) );
$args_custom_background = array( 'default-color'			 => 'ffffff'
	, 'default-image'			 => ''
	, 'wp-head-callback'		 => 'enough_embed_meta'
	, 'admin-head-callback'	 => 'enough_admin_header_style'
	, 'admin-preview-callback' => ''
);
/* ver 0.57 remove admin-preview-callback => enough_embed_meta admin custom background page override background color */

add_theme_support( 'custom-background', $args_custom_background );

add_action( 'admin_init', 'enough_register_settings' );

if ( !function_exists( 'enough_register_settings' ) ) {

	function enough_register_settings() {
		register_setting( 'enough_theme_settings', 'enough_post_one_column_bottom_sidebar', 'enough_post_one_column_bottom_sidebar_validate' );
		register_setting( 'enough_theme_settings', 'enough_approach_type', 'enough_approach_type_validate' );
	}

}
/**
 *
 *
 */
if ( !function_exists( 'enough_embed_meta' ) ) {

	function enough_embed_meta() {

		global $enough_site_image;

		$header_image_css	 = '';
		$image_uri			 = get_theme_mod( 'header_image' );

		if ( $image_uri == 'random-uploaded-image' ) {

			$image_uri = get_random_header_image();
		}

		$body_background_color		 = get_theme_mod( "background_color", 'ffffff' );
		$body_background_image		 = get_theme_mod( "background_image", 'none' );
		$body_background_repeat		 = get_theme_mod( "background_repeat", 'no-repeat' );
		$body_background_position_x	 = get_theme_mod( "background_position_x", 'left' );
		$body_background_attachment	 = get_theme_mod( "background_attachment", 'scroll' );
		$header_textcolor			 = get_theme_mod( "header_textcolor", '333333' );

		if ( $image_uri !== "remove-header" ) {

			if ( !empty( $image_uri ) ) {

				$header_image_css = 'header{ background: url(' . $image_uri . '); }';

				if ( $image_uri == "remove-header" ) { //need multisite child theme style rule
					$header_image_css .= 'header{ height:auto; }';
				}
			} else {

				$header_image_css = 'header{ background: url(' . $enough_site_image . '); }';
				$header_image_css .= 'header{ height: 100px; }';
			}
		}

		$header_style = '%1$s
			.site-title span:not(.custom-logo-wrap) a,
			.site-title a span,
			.site-description{
				%2$s
			}';

		if ( get_theme_mod( 'header_textcolor' ) !== 'blank' ) {

			$header_style = sprintf(
			$header_style
			, $header_image_css
			, 'color:#' . $header_textcolor . '!important;'
			);

			$header_style .= 'header .site-title{margin-top:20px;}';
			$header_style .= 'header .site-description{margin-bottom:20px;}';
		} else {

			$header_style = sprintf(
			$header_style
			, $header_image_css
			, 'display:none!important;'
			);
		}

		$style = "<style type=\"text/css\">
			body{
			background-color:#{$body_background_color};
			background-image:url( {$body_background_image} );
			background-repeat:{$body_background_repeat};
			background-position:top {$body_background_position_x};
			background-attachment:{$body_background_attachment};
			}
			body:not(.blog) header{
			background-size:cover;
			}
			$header_style \n";

			$enough_content_width = enough_theme_option( 'enough_post_content_width' );

			if( isset( $enough_content_width ) ) {
				$style .= "\n".'.enough-1col-post article, .enough-1col-post .posts-nav-link, .enough-1col-post .posts_pagination_wrapper{width:'. $enough_content_width. '%;margin:auto;float:none;}'."\n";
			}
			$style .= '</style>';

		if ( 'blank' == get_theme_mod( 'header_textcolor' ) ) {

			add_filter( 'wp_page_menu_args', 'enough_page_menu_args' );
		}

		echo $style;
	}

}

add_action( 'customize_register', 'enough_customize_register' );

/**
 *
 *
 */
if ( !function_exists( "enough_enqueue_scripts_styles" ) ) {

	function enough_enqueue_scripts_styles() {

		global $is_IE, $enough_version;
		
		if( ! is_user_logged_in() ) {
			/* @since 1.24 */
			$enough_version = null;
		}

		$enough_csses = array( "css/normalize.css", "genericons/genericons.css", "css/fonts.css", "css/box-modules.css", "css/comment.css", "css/ua.css", "css/colors.css", "css/base.css", "css/layout-fluid.css", "css/post-format.css", "css/approach.css" );

		foreach ( $enough_csses as $ecnough_css_path ) {

			if ( file_exists( trailingslashit( get_stylesheet_directory() ) . $ecnough_css_path ) ) {

				wp_enqueue_style( 'enough_' . basename( $ecnough_css_path, '.css' ), trailingslashit( get_stylesheet_directory_uri() ) . $ecnough_css_path, array(), $enough_version );
			} else {

				wp_enqueue_style( 'enough_' . basename( $ecnough_css_path, '.css' ), trailingslashit( get_template_directory_uri() ) . $ecnough_css_path, array(), $enough_version );
			}
		}

		wp_enqueue_style( 'styles', get_stylesheet_uri(), array( 'enough_approach' ), $enough_version );
		$gallery_style = enough_gallerys_css();
		wp_add_inline_style( 'styles', $gallery_style );

		wp_enqueue_style( 'enough-web-font', apply_filters( 'enough_web_font', '//fonts.googleapis.com/css?family=Ubuntu:400,700' ) );

		wp_enqueue_script( 'jquery' );

		wp_enqueue_script( 'comment-reply' );

		if ( $is_IE ) {

			wp_register_script( 'html5shiv', get_template_directory_uri() . '/inc/html5shiv.js', array(), '3', false );

			wp_enqueue_script( 'html5shiv' );
		}
	}

}
/**
 * Article navigation
 *
 */
if ( !function_exists( 'enough_prev_next_post' ) ) {

	function enough_prev_next_post( $position = "nav-above" ) {

		if ( is_single() or ( is_archive() and is_single()) ) {

			$enough_max_length	 = 40;
			$enough_prev_length	 = $enough_max_length + 1;

			if ( !is_attachment() ) {

				$enough_max_length	 = 40;
				$enough_prev_post_id = get_adjacent_post( true, '', true );
				$enough_prev_length	 = strlen( get_the_title( $enough_prev_post_id ) );
			}

			$html_1 = '<div id="%1$s" class="%2$s"><span class="%3$s">';

			printf( $html_1, $position, "clearfix", "nav-previous" );

			previous_post_link( '%link', '<span class="button"><span class="meta-nav">&laquo;</span> %title</span>' );

			$html_2 = '</span><div class="%1$s">';

			printf( $html_2, "nav-next" );

			next_post_link( '%link', '<span class="button"> %title <span class="meta-nav">&raquo;</span></span>' );

			$html_3 = '</div></div>';

			echo apply_filters( "enough_prev_next_post", $html_3 );
		}
	}

}
/**
 *
 *
 */
if ( !function_exists( 'enough_attachment_navigation' ) ) {

	function enough_attachment_navigation() {

		if ( is_attachment() ) {
			?>
			<div class="attachment-navigation clear">
				<div class="nav-previous">
					<?php
					previous_image_link();
					?>
				</div>
				<div class="nav-next">
					<?php
					next_image_link();
					?>
				</div>
				<br class="clear" />
			</div>
			<?php
		}
	}

}
/**
 *
 *
 */
if ( !function_exists( 'enough_post_format_posted_on' ) ) {

	function enough_post_format_posted_on() {

		$enough_comment_number_class = '';
		if ( comments_open() ) {

			$enough_comment_html = '<a href="%1$s" class="enough-comment-link"><span class="enough-comment-string point"></span><em>%2$s %3$s</em></a>';
			$enough_comment_html = '<a href="%1$s" class="enough-comment-link"><em %4$s title="%2$s"><i class="count">%2$s</i> <span>%3$s</span></em></a>';
			if ( get_comments_number() > 0 ) {

				$enough_comment_string		 = _n( 'Comment', 'Comments', get_comments_number(), 'enough' );
				$enough_comment_number		 = get_comments_number();
				$enough_comment_number_class = 'class="enough-length-' . strlen( $enough_comment_number ) . '"';
			} else {

				$enough_comment_string	 = 'Comment';
				$enough_comment_number	 = '';
			}
		} else {

			$enough_comment_html	 = '';
			$enough_comment_string	 = '';
			$enough_comment_number	 = '';
		}

		if ( !is_single() ) {

			$comments = sprintf( $enough_comment_html, get_comments_link(), $enough_comment_number, $enough_comment_string, $enough_comment_number_class );
		} else {
			$comments = '';
		}

		$format = get_post_format();

		$format = '<a class="post-format-link ' . $format . '" href="' . esc_url( get_post_format_link( $format ) ) . '"><span class="nav-text">' . enough_get_post_format_string( $format ) . '</span></a>';
		?>
		<div class="post-format-name"><?php echo $format; ?>&nbsp;<?php echo $comments; ?></div>
		<?php
		return;
	}

}
/**
 * Template function posted_on
 * loop.php
 */
if ( !function_exists( 'enough_posted_on' ) ) {

	function enough_posted_on( $diaplay = true ) {

		if ( !is_page() and $diaplay == true ) {
			?>
			<div class="posted-on">
			<?php
			$enough_date_format = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );

			$author = get_the_author();

			if ( comments_open() ) {

				$enough_comment_html = '<a href="%1$s" class="enough-comment-link"><em %4$s title="%2$s"><i class="count">%2$s</i> <span>%3$s</span></em></a>';

				if ( get_comments_number() > 0 ) {

					$enough_comment_string		 = _n( 'Comment', 'Comments', get_comments_number(), 'enough' );
					$enough_comment_number		 = get_comments_number();
					$enough_comment_number_class = 'class="enough-length-' . strlen( $enough_comment_number ) . '"';
				} else {

					$enough_comment_string		 = 'Comment';
					$enough_comment_number		 = '';
					$enough_comment_number_class = '';
				}
			} else {

				$enough_comment_html		 = '';
				$enough_comment_string		 = '';
				$enough_comment_number		 = '';
				$enough_comment_number_class = '';
			}

			if ( !is_single() ) {

				$enough_comment = sprintf( $enough_comment_html, get_comments_link(), $enough_comment_number, $enough_comment_string, $enough_comment_number_class );
			} else {
				$enough_comment = '';
			}
			$result = sprintf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s %4$s'
			, 'enough' ), 'meta-prep meta-prep-author nav-text', sprintf( '<a href="%1$s" title="%2$s"><span class="entry-date updated nav-text">%3$s</span></a>', get_permalink(), esc_attr( get_the_time( $enough_date_format ) ), get_the_date( $enough_date_format )
			), sprintf( '<span class="author vcard"><a class="url fn nickname" href="%1$s" title="%2$s" ><span class="nav-text">%3$s</span></a></span>', get_author_posts_url( get_the_author_meta( 'ID' ) ), sprintf( esc_attr__( 'View all posts by %s', 'enough' ), $author ), $author
			), $enough_comment
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
	 * @since 0.48
	 */
	if ( !function_exists( 'enough_post_format_posted_in' ) ) {

		function enough_post_format_posted_in( $echo = true ) {

			$author = get_the_author();

			$author = sprintf( '<span class="meta-sep">by</span><span class="author vcard"><a class="url fn nickname" href="%1$s" title="%2$s" >%3$s</a></span>', get_author_posts_url( get_the_author_meta( 'ID' ) ), sprintf( esc_attr__( 'View all posts by %s', 'enough' ), $author ), $author
			);

			$permalink = get_permalink();

			$format = get_post_format();

			$html = '<a href="%1$s" class="permalink-post-format-%2$s" rel="bookmark"><span>%4$s %3$s</span></a>';

			$link_to_title = strip_tags( get_the_title() );

			if ( empty( $link_to_title ) ) {

				$link_to_title = enough_get_post_format_string( $format );
			}

			$permalink = sprintf( $html, esc_url( $permalink ), esc_attr( $format ), $link_to_title, __( 'link to', 'enough' )
			);

			$result = '<div class="post-format-entry-meta" style="position:relative;">' . $author . $permalink . '</div>';

			if ( $echo == true ) {
				echo $result;
			} elseif ( $echo == false ) {
				return $result;
			}
		}

	}
	/**
	 *
	 *
	 */
	if ( !function_exists( 'enough_posted_in' ) ) {

		function enough_posted_in( $diaplay = true ) {
			global $post;
			if ( !is_page() and $diaplay == true ) {
				?>
			<div class="posted-in">
				<ul>
			<?php
			$category_count = count( get_the_category() );

			if ( $category_count > 1 ) {
				?>
						<li class="toggle-category toggle-title"><span class="nav-text"><?php _e( 'Categories:', 'enough' ); ?></span></li>
						<li class="toggle-category"> <?php


    $categories = get_the_category( $post->ID );

    $html = '<div class="%4$s"><a href="%1$s" title="%2$s" >%3$s</a></div>';
	$initial_compare = '';
	$dummy_div_count = 0;
	$i = 1;
    foreach ( $categories as $category ) {


		$initial = mb_substr( $category->name  ,0 ,1 );

		if( mb_strtolower( $initial_compare ) == mb_strtolower( $initial ) ) {
			$initial_class = 'initial-category initial-'. $initial;
		}else{
			$initial_class = 'initial-category first initial-'. $initial;

		}

		$category_name = '<span>'.$initial.'</span>';
		$category_name .= mb_substr( $category->name,1 );


        printf( $html, get_category_link( $category->term_id ), sprintf( __( "View all posts in %s", 'enough' ), $category->name ),  $category_name
        , 'category-'.$category->term_id. ' '. $initial_class );
		$initial_compare = $initial;
		$i++;
    }
    ?></li>
				<?php
			} else {
				?>
						<li class="category-title"><span class="nav-text"><?php _e( 'Categories:', 'enough' ); ?></span></li>
						<li><?php the_category( ' ' ); ?></li>
				<?php
			}
			?>
				</ul>
					<?php
					$tags = get_the_tags();

					if ( $tags ) {
						?>
					<ul>
						<li class="toggle-tag toggle-title"><span class="nav-text"><?php _e( 'Tags:', 'enough' ); ?></span></li>
						<li class="toggle-tag"><?php


    $categories = get_the_terms( $post->ID, 'post_tag' ); ;

    $html = '<div class="%4$s"><a href="%1$s" title="%2$s" >%3$s</a></div>';
	$initial_compare = '';
	$dummy_div_count = 0;
	$i = 1;
    foreach ( $categories as $category ) {


		$initial = mb_substr( $category->name  ,0 ,1 );

		if( mb_strtolower( $initial_compare ) == mb_strtolower( $initial ) ) {
			$initial_class = 'initial-category initial-'. $initial;
		}else{
			$initial_class = 'initial-category first initial-'. $initial;

		}

		$category_name = '<span>'.$initial.'</span>';
		$category_name .= mb_substr( $category->name,1 );


        printf( $html, get_category_link( $category->term_id ), sprintf( __( "View all posts in %s", 'enough' ), $category->name ),  $category_name
        , 'category-'.$category->term_id. ' '. $initial_class );
		$initial_compare = $initial;
		$i++;
    }
    ?></li>
					</ul>
				<?php
			}
			?>
			</div>
				<?php
			}
		}

	}
/**
 *
 *
 */
if ( !function_exists( 'enough_onecolumn_post' ) ) {

	function enough_onecolumn_post( $classes ) {

		$classes[] = 'enough-1col-post';
		return $classes;
	}

}
if ( !function_exists( 'enough_twocolumn_post' ) ) {

	function enough_twocolumn_post( $classes ) {

		$classes[] = 'enough-2col-post';
		return $classes;
	}

}
/**
 *
 *
 */
if ( !function_exists( 'enough_enqueue_comment_reply' ) ) {

	function enough_enqueue_comment_reply() {

		if ( is_singular() and comments_open() and get_option( 'thread_comments' ) ) {

			wp_enqueue_script( 'comment-reply' );
		}
	}

}
/**
 *
 *
 */
if ( !function_exists( 'enough_the_content' ) ) {

	function enough_the_content( $more = '', $diaplay = true ) {

		global $post;

		if ( is_attachment() and $diaplay == true ) {

			$html = '<h3 class="h3 title">%1$s<a href="%2$s" rev="attachment">%3$s</a></h3>';
			printf( $html
			, __( "Entry : ", 'enough' )
			, get_permalink( $post->post_parent )
			, get_the_title( $post->post_parent )
			);

			the_content( $more );
		} elseif ( is_search() && $diaplay == true ) {

			the_excerpt();
		} elseif ( $diaplay == true ) {

			the_content( $more );
		}
	}

}
/**
 *
 * @since 0.48
 */
add_filter( 'the_content', 'enough_chat_filter' );

if ( !function_exists( 'enough_chat_filter' ) ) {

	function enough_chat_filter( $contents ) {

		if ( !has_post_format( 'chat' ) ) {

			return $contents;
		} else {

			/* chat notation use : remove protocol from url */
			$contents = str_replace( array( 'http:', 'https:' ), '', $contents );
		}

		$new_contents = explode( '<p>', $contents );

		if ( 2 == count( $new_contents ) ) {

			return $contents;
		}
		$result			 = '';
		$prev_author_id	 = '';
		$html			 = '<dt class="enough-chat enough-chat-author-%1$s">%2$s</dt><dd class="enough-chat-text enough-chat-author-text-%1$s">%3$s</dd>';
		$before			 = '';
		$after			 = '';
		$flag			 = false;
		$last			 = count( $new_contents ) - 1;
		foreach ( $new_contents as $key => $new ) {

			if ( !preg_match( '|([^\:]+)(\:)(.+)|si', $new, $regs ) && $flag == false ) {
				$before .= '<p>' . $new;
				continue;
			}

			if ( intval($key) == intval($last) ) {

				if( false !==  $after_result = strstr( $new, '<' ) ) {
					
					$after .= $after_result;
				}
				if( false !==  $after_result = strstr( $new, "<", true ) ) {

					$reg[3] = $after_result;
				}
				if( false !==  $after_result = strstr( $reg[3], ":" ) ) {
					
					$regs[3] = str_replace( ':', '', $after_result );
				}
			}
			$flag	 = true;
			$new	 = str_replace( '</p>', '', $new );
			if ( isset( $regs[ 3 ] ) && !empty( $regs[ 3 ] ) ) {
				
				$regs[3] = str_replace( '</p>', '', $regs[3] );
			}
			if ( isset( $regs[ 1 ] ) && !empty( $regs[ 1 ] ) ) {

				$regs[ 1 ] = strip_tags( $regs[ 1 ] );
			}

			if ( isset( $regs[ 1 ] ) && !preg_match( '!(http|https|ftp)!', $regs[ 1 ] ) && !empty( $regs[ 1 ] ) ) {

				$result .= sprintf( $html, esc_attr( enough_chat_author_id( $regs[ 1 ] ) ), esc_html( $regs[ 1 ] ), $regs[ 3 ] );
			} else {

				if ( !empty( $new ) ) {
					$result .= '<dd class="additional-block">' . $new . '</dd>';
				}
			}

		}

		return apply_filters( 'enough_chat_filter', sprintf( '%2$s<dl class="enough-post-format-chat">%1$s</dl>%3$s', $result, $before, $after ) );
	}

}
/**
 *
 * @since 0.48
 */
if ( !function_exists( 'enough_chat_author_id' ) ) {

	function enough_chat_author_id( $author ) {

		static $enough_chat_author_id	 = array();
		$enough_chat_author_id[]		 = $author;
		$enough_chat_author_id			 = array_unique( $enough_chat_author_id );

		return array_search( $author, $enough_chat_author_id );
	}

}
/**
 * Extend body_class()
 * add browser class, languages class,
 */
if ( !function_exists( 'enough_add_body_class' ) ) {

	function enough_add_body_class( $class ) {

		global $post, $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone, $enough_navigation_type;
		$regs	 = array();
		$lang	 = get_locale();

		$enough_options = enough_theme_option( 'defaults' );

		if ( isset( $enough_options[ "enough_style_type" ] ) and ! empty( $enough_options[ "enough_style_type" ] ) ) {

			$color_type = "rd-type-" . $enough_options[ "enough_style_type" ];
		} else {

			$color_type = '';
		}

		if ( is_single() or is_page() ) {

			$enough_content_check	 = get_post( $post->ID );
			$enough_content_check	 = $enough_content_check->post_content;

			if ( preg_match( "!\[enough[^\]]+(color_type)=(\"|')*?([^\"' ]+)(\"|')*?[^\]]*\]!si", $enough_content_check, $regs ) ) {

				$color_type = "rd-type-" . trim( $regs[ 3 ] );
			}

			if ( preg_match( "!\[enough[^\]]+(col)=(\"|')*?([^\"' ]+)(\"|')*?[^\]]*\]!si", $enough_content_check, $regs ) ) {

				$color_type .= ' ';
				$color_type .= "rd-col-" . $regs[ 3 ];
			}
		}

		if ( isset( $_SERVER[ "HTTP_ACCEPT_LANGUAGE" ] ) ) {

			$browser_lang	 = $_SERVER[ "HTTP_ACCEPT_LANGUAGE" ];
			$browser_lang	 = explode( ",", $browser_lang );
			$browser_lang	 = esc_html( $browser_lang[ 0 ] );
			$browser_lang	 = 'accept-lang-' . $browser_lang;
			$classes		 = array( $lang, $color_type, $browser_lang );
		} else {

			$classes = array( $lang, $color_type );
		}

		$classes	 = array_merge( $classes, $class );
		$classes[]	 = $enough_navigation_type;

		$iphone = false;

		switch ( true ) {
			case( $is_lynx ):

				$classes[] = 'lynx';
				break;

			case( $is_gecko ):

				$classes[] = 'gecko';
				break;

			case( $is_IE ):

				preg_match( " |(MSIE )([0-9]{1,2})(\.)|si", $_SERVER[ 'HTTP_USER_AGENT' ], $regs );
				if ( isset( $regs[ 2 ] ) ) {
					$classes[] = 'ie' . $regs[ 2 ];
				}
				break;

			case( $is_opera ):

				$classes[] = 'opera';
				break;

			case( $is_NS4 ):

				$classes[] = 'ns4';
				break;

			case( $is_safari ):

				$classes[] = 'safari';

				if ( preg_match( "|(mobile)|si", $_SERVER[ 'HTTP_USER_AGENT' ], $regs ) ) {

					$classes[]	 = 'iphone';
					$iphone		 = true;
				}
				break;

			case($is_chrome):

				$classes[] = 'chrome';
				break;

			case($is_iphone):

				if ( !$iphone ) {

					$classes[] = 'iphone';
				}
				break;

			default:
				$classes[] = 'unknown';
				break;
		}

		if ( preg_match( "|(mobile)|si", $_SERVER[ 'HTTP_USER_AGENT' ], $regs ) ) {

			$classes[] = 'mobile';
		}

		return apply_filters( "enough_add_body_class", $classes );
	}

}

if ( !function_exists( 'enough_load_small_device_helper' ) ) {

	function enough_load_small_device_helper() {

		global $is_IE, $enough_site_image, $enough_version;
		$enough_is_IE			 = $is_IE;
		/* 	$enough_title_length		 = round( strlen( get_bloginfo( 'name' ) ) );
		  $enough_description_length	 = round( strlen( get_bloginfo( 'description' ) ), 0 ); */
		$enough_header_image_uri = get_header_image();
		$enough_options			 = enough_theme_option( 'defaults' );
		$uploads				 = wp_upload_dir();

		if (  is_front_page() ) {
			$enough_is_front = 1;
		} else {
			$enough_is_front = 0;
		}

		if ( !is_page() ) {
			$enough_is_page = 0;
		} else {
			$enough_is_page = 1;
		}
		//$enough_image_exists = $enough_header_image_uri;

		$upload_image = get_uploaded_header_images();
		if ( empty( $upload_image ) ) {
			$enough_upload_image = 0;
		} else {
			$enough_upload_image = 1;
		}

		$enough_use_slider = 0;

		$url				 = get_theme_mod( 'header_image' );
		$enough_header_image = get_custom_header();
		$uri				 = $enough_header_image->url;

		if ( empty( $url ) ) { //When child theme $url empty
			$url = get_header_image();
		}

		if ( $url == 'random-uploaded-image' ) {

			$url = get_random_header_image();
		}

		if ( $url !== 'remove-header' ) {

			$enough_header_image_width	 = enough_detect_header_image_size( 'width' );
			$enough_header_image_height	 = enough_detect_header_image_size( 'height' );
			$ratio						 = $enough_header_image_height / $enough_header_image_width;
		} else {
			$enough_header_image_width	 = 0;
			$enough_header_image_height	 = 0;
			$ratio						 = 0;
		}

		if ( $url == 'random-uploaded-image' ) {
			$enough_is_random_header_image = 1;
		} else {
			$enough_is_random_header_image = 0;
		}

		$uploads	 = wp_upload_dir();
		$file_name	 = basename( $url );

		if ( preg_match( '|/[0-9]{4}/[0-9]{2}/' . $file_name . '$|', $url, $regs ) ) {

			$child_path = $regs[ 0 ];
		} else {

			$child_path = '/' . $file_name;
		}

		$path = $uploads[ 'path' ] . $child_path;

		if ( get_header_textcolor() == 'blank' ) {
			$header_textcolor_is_blank = 1;
		} else {
			$header_textcolor_is_blank = 0;
		}

		if ( basename( wp_get_referer() ) !== 'customize.php' ) {
			$enough_referer_customizer = 0;
		} else {
			$enough_referer_customizer = 1;
		}

		if ( WP_DEBUG == true ) {
			$enough_debug = 1;
		} else {
			$enough_debug = 0;
		}
		wp_enqueue_script( 'enough_helper_script', get_template_directory_uri() . '/enough-helper.js', array( 'jquery' ) ,$enough_version, true);

		wp_localize_script( 'enough_helper_script', 'enough_script_vars', array(
			'enough_is_front'		 => $enough_is_front,
			'is_ie'							 => $is_IE,
			'enough_home_url'				 => home_url(),
			'enough_site_title'				 => get_bloginfo( 'site-title' ),
			'enough_site_image'				 => $enough_site_image,
			'enough_theme_mod_header_img'	 => get_theme_mod( 'header_image' ),
			'enough_title_length'			 => round( strlen( get_bloginfo( 'name' ) ) ),
			'enough_description_length'		 => round( strlen( get_bloginfo( 'description' ) ), 0 ),
			'enough_header_image_uri'		 => get_header_image(),
			'enough_image_exists'			 => get_header_image(),
			'enough_options'				 => enough_theme_option( 'defaults' ),
			'uploads'						 => wp_upload_dir(),

			'enough_is_page'				 => $enough_is_page,
			'enough_upload_image'			 => $enough_upload_image,
			'enough_use_slider'				 => $enough_use_slider,
			'enough_url'					 => $url,
			'uri'							 => $uri,
			'enough_header_image_width'		 => $enough_header_image_width,
			'enough_header_image_height'	 => $enough_header_image_height,
			'ratio'							 => $ratio,
			'enough_header_textcolor'		 => get_theme_mod( "header_textcolor" ),
			'enough_random_header_image'	 => get_random_header_image(),
			'enough_is_random_header_image'	 => $enough_is_random_header_image,
			'path'							 => $path,
			'header_textcolor_is_blank'		 => $header_textcolor_is_blank,
			'enough_referer_customizer'		 => $enough_referer_customizer,
			'enough_debug'					 => $enough_debug,
		)
		);
	}

}
/**
 *
 *
 */
if ( !function_exists( 'enough_small_device_helper' ) ) {

	function enough_small_device_helper() {


		global $is_IE;

		$enough_title_length		 = round( strlen( get_bloginfo( 'name' ) ) );
		$enough_description_length	 = round( strlen( get_bloginfo( 'description' ) ), 0 );
		$enough_header_image_uri	 = get_header_image();
		$enough_options				 = enough_theme_option( 'defaults' );
		$uploads					 = wp_upload_dir();
		?>
		<script type="text/javascript">

		    ( function () {
		        jQuery( function () {
		            var width = jQuery( window ).width();
		<?php
		if ( $enough_options[ 'enough_use_slider' ] !== 'no' and is_front_page() ) {
			?>
			            jQuery( 'header' ).before( '<h1 class="site-title" style="width:80%;"><a href="<?php echo home_url(); ?>" style="color:#<?php echo get_theme_mod( "header_textcolor" ); ?>"><?php bloginfo( 'site-title' ); ?><\/a><\/h1>' );



			<?php
		}
		/**
		 * Enough Status Bar
		 *
		 */
		?>
		            jQuery( '.enough-status-bar' ).hide();
		<?php
		if ( !is_page() ) {
			?>
			            jQuery( window ).mousemove( function ( e ) {

			                var window_height = jQuery( window ).innerHeight();
			                if ( window_height - 100 < e.pageY - jQuery( this ).scrollTop() ) {
			                    jQuery( 'address' ).css( 'margin-bottom', '75px' );
			                    jQuery( '.enough-status-bar' ).show();


			                } else {
			                    jQuery( 'address' ).css( 'margin-bottom', '0' );
			                    jQuery( '.enough-status-bar' ).hide();
			                }
			            } );
			<?php
		}
		/**
		 * Menu header toggle controll
		 *
		 */
		?>
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
		<?php
		/**
		 * Toggle for .menu-header
		 *
		 */
		?>
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
		<?php
		/**
		 * Toggle for category and tag
		 *
		 */
		?>
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
		<?php
		/**
		 * Toggle widget
		 *
		 */
		?>
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
		<?php
		/**
		 * Site title , description font size resize and header height ajust
		 *
		 */
		?>
		            function fontResize() {
		<?php global $enough_site_image; ?>
		                var image_exists = '<?php echo $enough_header_image_uri; ?>';
		                var width = jQuery( window ).width( );
		<?php
		$upload_image = get_uploaded_header_images();
		if ( empty( $upload_image ) ) {
			?>var
			                upload_image = false;<?php
		} else {
			?>var
			                upload_image = true;<?php
		}

		if ( $enough_options[ 'enough_use_slider' ] == 'yes' ) {
			?>var
			                use_slider = true;<?php
		} else {
			?>var
			                use_slider = false;<?php
		}
		$ratio = 0.11;

		if ( $enough_title_length !== 0 ) {
			?>
			                var px = width /<?php echo $enough_title_length; ?>;
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
			<?php
		}

		if ( $enough_description_length !== 0 ) {
			?>
			                var px = width /<?php echo $enough_description_length; ?>;
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
			<?php
		}
		?>
		                if ( upload_image && use_slider ) {
		<?php
		$url = get_theme_mod( 'header_image' );

		$enough_header_image = get_custom_header();
		$uri				 = $enough_header_image->url;

		if ( empty( $url ) ) { //When child theme $url empty
			$url = get_header_image();
		}

		if ( $url == 'random-uploaded-image' ) {

			$url = get_random_header_image();
		}

		if ( $url !== 'remove-header' ) {

			$enough_header_image_width	 = enough_detect_header_image_size( 'width' );
			$enough_header_image_height	 = enough_detect_header_image_size( 'height' );
			$ratio						 = $enough_header_image_height / $enough_header_image_width;
		}
		?>
		                    var header_width = jQuery( 'header' ).width();
		                    var ratio = <?php echo $ratio; ?>;
		                    var height = ( header_width * ratio ).toFixed( 0 );
		                    jQuery( 'header' ).removeAttr( 'style' ).css( { 'height': height + 'px', } );
		<?php
		if ( get_header_textcolor() == 'blank' ) {
			?>
			                    jQuery( 'header' ).css( 'cursor', 'pointer' ).click( function () {

			                        location.href = "<?php echo home_url(); ?>";

			                    } );
			<?php
		}
		?>
		                } else {

		                    var header_width = jQuery( 'header' ).width();
		                    var ratio = <?php echo $ratio; ?>;
		                    var height = ( header_width * ratio ).toFixed( 0 );
		<?php
		$url = get_header_image();

		if ( $url == 'random-uploaded-image' ) {
			$url = get_random_header_image();
		}
		?>
		                    image_exists = '<?php echo $url; ?>';
		<?php
		$uploads	 = wp_upload_dir();
		$file_name	 = basename( $url );

		if ( preg_match( '|/[0-9]{4}/[0-9]{2}/' . $file_name . '$|', $url, $regs ) ) {

			$child_path = $regs[ 0 ];
		} else {

			$child_path = '/' . $file_name;
		}

		$path = $uploads[ 'path' ] . $child_path;
		?>
		                    if ( image_exists ) {
		                        // jQuery('header').removeAttr('style').css({'background-image':'url('+ image_exists + ')', 'min-height': height + 'px','background-repeat':'no-repeat','background-size':'cover'});
		                        jQuery( 'header' ).removeAttr( 'style' ).css( { 'min-height': height + 'px', 'background-repeat': 'no-repeat', 'background-size': 'cover' } );
		                    }

		<?php
		if ( get_header_textcolor() == 'blank' ) {
			?>
			                    jQuery( 'header' ).css( 'cursor', 'pointer' ).click( function () {

			                        location.href = "<?php echo home_url(); ?>";

			                    } );
			<?php
		}
		?>
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
		<?php
		/**
		 * Toggle for .menu-header
		 *
		 */
		?>

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
		<?php
		if ( basename( wp_get_referer() ) !== 'customize.php' and WP_DEBUG == true ) {
			?>
			                    if ( !jQuery( 'ul' ).is( '.toggle-navigation' ) ) {
			                        location.reload();
			                    }
			<?php
		}
		?>
		                }
		<?php
		if ( $enough_options[ 'enough_use_slider' ] !== 'yes' ) {
			?>
			                jQuery( 'script #enough-slider-js, style #enough-slider-css' ).remove();
			<?php
		}

		/**
		 * Check window size and mouse position
		 * Controll childlen menu show right or left side.
		 */
		?>
		                jQuery( ".menu-header" ).mousemove( function ( e ) {
		                    var menu_item_position = e.pageX;
		<?php /* Position check
		  jQuery(".result:first").text(menu_item_position);
		  jQuery(".result-w").text(header_width); */
		?>
		                    if ( header_width - 100 < menu_item_position ) {
		                        jQuery( '.menu-header .children .children' ).addClass( 'left' );
		                        jQuery( '.menu-header .sub-menu .sub-menu' ).addClass( 'left' );
		                    } else if ( width / 10 > menu_item_position ) {
		                        jQuery( '.menu-header .children .children' ).removeClass( 'left' );
		                        jQuery( '.menu-header .sub-menu .sub-menu' ).removeClass( 'left' );
		                    }
		                } );
		            }
		<?php
		if ( $is_IE ) {
			/**
			 * Fixed IE height issue
			 *
			 */
			?>
			            jQuery( 'article img' ).removeAttr( "height" ).removeAttr( "width" );
			<?php
		}
		?>
		            fontResize();
		            jQuery( window ).resize( function () {
		                fontResize();
		            } );

		        } );
		    } )( jQuery );
		</script>
		<?php
	}

}

if ( !function_exists( 'enough_detect_header_image_size' ) ) {

	function enough_detect_header_image_size( $xy = 'width' ) {

		global $args_custom_header;
		$all_header_images		 = array();
		$header_image			 = get_custom_header();
		$header_image_uri		 = $header_image->url;
		$header_image_basename	 = basename( $header_image_uri );

		if ( $args_custom_header[ "default-image" ] == $header_image_uri ) {

			if ( 'width' == $xy ) {

				return $args_custom_header[ "width" ];
			} elseif ( 'height' == $xy ) {
				return $args_custom_header[ "height" ];
			}
		}
		$all_header_images = get_uploaded_header_images();

		if ( 'width' == $xy ) {

			if ( isset( $all_header_images[ $header_image_basename ][ 'width' ] ) ) {

				return $all_header_images[ $header_image_basename ][ 'width' ];
			} else {

				return $header_image->width;
			}
		} elseif ( 'height' == $xy ) {

			if ( isset( $all_header_images[ $header_image_basename ][ 'height' ] ) ) {

				return $all_header_images[ $header_image_basename ][ 'height' ];
			} else {

				return $header_image->height;
			}
		}
		return false;
	}

}
/**
 *
 *
 */
if ( !function_exists( 'enough_not_found' ) ) {

	function enough_not_found() {

		if ( locate_template( array( '404.php' ), true, true ) == '' ) {

			?><article <?php post_class(); ?> role="main"><?php

			if ( is_search() ) {

				$fail_search_html = '<div class="fail-search message-box"><h2 class="center h2">%1$s</h2>%2$s</div>';

				$fail_search_html = sprintf( $fail_search_html ,
										__( "Nothing was found though it was regrettable. Please change the key word if it is good, and retrieve it.", "enough" ),
										get_search_form(false)
									);
				echo apply_filters( 'enough_fail_search_html', $fail_search_html, $fail_search_html);

			} elseif ( is_404() ) {

				$html_404 = '<div class="not-found message-box"><h2 class="center h2">%1$s</h2>%2$s</div>';
				$fail_search_html = sprintf( $html_404 ,
										__( "Nothing was found though it was regrettable. Please change the key word if it is good, and retrieve it.", "enough" ),
										get_search_form(false)
									);
				echo apply_filters( 'enough_fail_search_html', $fail_search_html, $html_404 );
			}
			?></article><?php
			}
		}
	}
	/**
	 * index ,archive,loops page title
	 * echo Archives title
	 */
	if ( !function_exists( 'enough_loop_title' ) ) {

		function enough_loop_title() {

			$enough_class_name	 = "";
			$page_title			 = "";
			$page_title_c		 = '';

			if ( is_search() ) {

				$enough_class_name	 = 'serch-result';
				$page_title			 = __( "Search Results", 'enough' );
				$page_title_c		 = get_search_query();
			} elseif ( is_tag() ) {

				$enough_class_name	 = 'tag-archives';
				$page_title			 = __( "Tag Archives", 'enough' );
				$page_title_c		 = single_term_title( "", false );
			} elseif ( is_category() ) {

				$enough_class_name	 = 'category-archives';
				$page_title			 = __( "Category Archives", 'enough' );
				$page_title_c		 = single_cat_title( '', false );
			} elseif ( is_archive() ) {

				$enough_date_format = get_option( 'date_format' );

				if ( is_day() ) {

					$enough_class_name	 = 'dayly-archives';
					$page_title			 = __( 'Daily Archives', 'enough' );
					$page_title_c		 = get_the_date( get_option( $enough_date_format ) );
				} elseif ( is_month() ) {

					$enough_class_name	 = 'monthly-archives';
					$page_title			 = __( 'Monthly Archives', 'enough' );

					if ( get_locale() == 'ja' ) {

						$page_title_c = get_the_date( 'Y / F' );
					} else {

						$page_title_c = get_the_date( 'F Y' );
					}
				} elseif ( is_year() ) {

					$enough_class_name	 = 'yearly-archives';
					$page_title			 = __( 'Yearly Archives', 'enough' );
					$page_title_c		 = get_the_date( 'Y' );
				} elseif ( is_author() ) {

					$enough_class_name	 = 'author-archives';
					$page_title			 = __( "Author Archives", 'enough' );

					while ( have_posts() ) {

						the_post();

						$page_title_c = get_avatar( get_the_author_meta( 'user_email' ), 32 ) . ' ' . get_the_author();

						break;
					}
				} elseif ( has_post_format( 'aside' ) or
				has_post_format( 'image' ) or
				has_post_format( 'quote' ) or
				has_post_format( 'video' ) or
				has_post_format( 'audio' ) or
				has_post_format( 'gallery' ) or
				has_post_format( 'status' ) or
				has_post_format( 'chat' ) or
				has_post_format( 'link' ) ) {

					$enough_class_name	 = 'post-format-archives';
					$page_title			 = __( "Post Format", 'enough' );
					$page_title_c		 = enough_get_post_format_string( get_post_format() );
				} else {
					$enough_class_name	 = 'blog-archives';
					$page_title			 = __( "Blog Archives", 'enough' );
				}

				rewind_posts();
			}



			if ( !empty( $page_title ) ) {

				$page_title = apply_filters( 'enough_archive_name' ,'', $page_title );

				printf( '<h2 class="archives-title-text">%s <span>%s</span></h2>', $page_title, $page_title_c
				);
			}
		}

	}
	/**
	 * Option value set when install.
	 *
	 */
	if ( !function_exists( 'enough_deploy' ) ) {

		function enough_deploy() {

			global $wpdb, $enough_admin_options_setting;

			$enough_theme_settings = get_option( 'enough_theme_settings' );

			foreach ( $enough_admin_options_setting as $add ) {

				$option_name = $add[ 'option_name' ];

				if ( !isset( $enough_theme_settings[ $option_name ] ) ) {

					$enough_theme_settings[ $option_name ] = $add[ 'option_value' ];
				}
			}
		}

	}

	/**
	 * Validate admin panel form value.
	 *
	 */
	if ( !function_exists( 'enough_approach_type_validate' ) ) {

		function enough_approach_type_validate( $input ) {

			$formats = get_theme_support( 'post-formats' );

			if ( isset( $formats[ 0 ] ) && is_array( $formats[ 0 ] ) && array_search( $input, $formats[ 0 ] ) !== false ) {

				return $input;
			}

			if ( $input == 'default' or
			$input == 'author' or
			$input == 'categories' or
			$input == 'blank' ) {

				return $input;
			}

			return 'default';
		}

	}
	if ( !function_exists( 'enough_post_one_column_bottom_sidebar_validate' ) ) {

		function enough_post_one_column_bottom_sidebar_validate( $input ) {

			if ( $input == 'yes' or $input == 'no' ) {

				return $input;
			} else {

				return 'no';
			}
		}

	}

	if ( !function_exists( 'enough_format_detection_telephone_validate' ) ) {

		function enough_format_detection_telephone_validate( $input ) {

			if ( $input == 'yes' or $input == 'no' ) {

				return $input;
			} else {

				return 'yes';
			}
		}

	}

	if ( !function_exists( 'enough_iphone_device_width_validate' ) ) {

		function enough_iphone_device_width_validate( $input ) {

			if ( is_array( $input ) ) {

				return array_map( "htmlspecialchars", $input );
			} else {
				return htmlspecialchars( $input, ENT_QUOTES );
			}
		}

	}

	if ( !function_exists( 'enough_iphone_status_bar_style_validate' ) ) {

		function enough_iphone_status_bar_style_validate( $input ) {

			return esc_html( $input );
		}

	}

	if ( !function_exists( 'enough_use_slider_validate' ) ) {

		function enough_use_slider_validate( $input ) {

			if ( $input == 'yes' or $input == 'no' ) {
				return $input;
			} else {
				return 'no';
			}
		}

	}

	if ( !function_exists( 'enough_slider_sleep_validate' ) ) {

		function enough_slider_sleep_validate( $input ) {

			if ( is_numeric( $input ) ) {

				return $input;
			} else {

				return 3;
			}
		}

	}

	if ( !function_exists( 'enough_slider_fade_validate' ) ) {

		function enough_slider_fade_validate( $input ) {

			if ( is_numeric( $input ) ) {

				return $input;
			} else {

				return 1;
			}
		}

	}

	/**
	 *
	 *
	 */
	if ( !function_exists( 'enough_embed_format_detection_telephone' ) ) {

		function enough_embed_format_detection_telephone() {

			global $enough_embed_format_detection_telephone;

			if ( empty( $enough_embed_format_detection_telephone ) or ! isset( $enough_embed_format_detection_telephone ) ) {

				$enough_embed_format_detection_telephone = enough_theme_option( "enough_embed_format_detection_telephone" );
			}
			?>
		<meta name="format-detection" content="telephone=<?php echo $enough_embed_format_detection_telephone; ?>" />
		<?php
	}

}
/**
 *
 *
 */
if ( !function_exists( 'enough_embed_iphone_device_width' ) ) {

	function enough_embed_iphone_device_width() {

		global $enough_embed_iphone_device_width;

		if ( empty( $enough_embed_iphone_device_width ) or ! isset( $enough_embed_iphone_device_width ) ) {

			$enough_embed_iphone_device_width = enough_theme_option( "enough_iphone_device_width" );
		}
		?>
		<meta name="viewport" content="<?php echo $enough_embed_iphone_device_width; ?>" />
		<?php
	}

}
/**
 *
 *
 */
if ( !function_exists( 'enough_embed_iphone_status_bar' ) ) {

	function enough_embed_iphone_status_bar() {

		global $enough_embed_iphone_status_bar_style;

		if ( empty( $enough_embed_iphone_status_bar_style ) or ! isset( $enough_embed_iphone_status_bar_style ) ) {

			$enough_embed_iphone_status_bar_style = enough_theme_option( "enough_iphone_status_bar_style" );
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
 */
if ( !function_exists( 'ecnough_ie_height_issue' ) ) {

	function ecnough_ie_height_issue( $content ) {

		return str_replace( '<img ', '<img style="width:150px;height:auto;" ', $content );
	}

}
/**
 *
 *
 */
if ( !function_exists( 'enough_admin_header_style' ) ) {

	function enough_admin_header_style() {

		$url = get_theme_mod( 'header_image' );

		if ( empty( $url ) ) { //When child theme $url empty
			$url = get_header_image();
		}

		if ( $url == 'random-uploaded-image' ) {

			$url = get_random_header_image();
		}

		$uploads	 = wp_upload_dir();
		$file_name	 = basename( $url );
		$child_path	 = '/' . $file_name;
		$path		 = $uploads[ 'path' ] . $child_path;

		if ( file_exists( $path ) ) {

			list($img_width, $img_height, $img_type, $img_attr) = getimagesize( $path );
			?>
			<style type="text/css"><!--
				#headimg{
					width:<?php echo $img_width; ?>px!important;
					height:<?php echo $img_height; ?>px!important;
				}
				#headimg #desc,
				#headimg h1 {margin:13px 50px 10px;}
			<?php
		} else {
			?>
				<style type="text/css"><!--
				<?php
			} //end if ( file_exists( $path ) )

			if ( 'blank' == get_header_textcolor() ) {
				?>
				#headimg a span{visibility:hidden;}
				#headimg .site-description span{ display: none; }
			<?php } else { ?>
				#headimg h2,
				#headimg h1 a{
					color:#<?php echo get_header_textcolor(); ?>;
				}
				<?php
			}
			?>
			-->
		</style>
			<?php
		}

	}
	/**
	 *
	 *
	 */
	if ( !function_exists( 'enough_add_post_class' ) ) {

		function enough_add_post_class( $classes ) {
			global $post;

			if ( comments_open() ) {

				$newclass = 'comments-open';
			} else {

				$newclass = 'comments-closed';
			}


			$enough_now				 = current_time( 'timestamp' );
			$enough_publish_time	 = get_the_time( 'U' );
			$enough_modified_time	 = get_the_modified_time( 'U' );
			$enough_period			 = apply_filters( 'enough_new_period', 3 );
			$enough_Period			 = 60 * 60 * 24 * $enough_period;

			if ( $enough_now < $enough_Period + $enough_publish_time ) {

				$classes[] = 'enough-pub-new ';
			}

			if ( $enough_now < $enough_Period + $enough_modified_time ) {

				$classes[] = 'enough-mod-new';
			}

			if ( isset( $post ) && get_comments_number( $post->ID ) ) {

				$classes[] = 'has-comments';
			} else {
				$classes[] = 'comments-none';
			}

			array_push( $classes, $newclass );

			$i = enough_display_count();

			$classes[] = 'enough-display-count-' . $i;

			return $classes;
		}

	}

	/**
	 *
	 *
	 */
	if ( !function_exists( "enough_page_menu_args" ) ) {

		function enough_page_menu_args( $args ) {

			$args[ 'show_home' ] = true;

			return $args;
		}

	}
	/**
	 *
	 *
	 */
	if ( !function_exists( "enough_slider" ) ) {

		function enough_slider() {
			global $enough_admin_options_setting;

			$remove_header_check = get_theme_mod( 'header_image' );

			if ( $remove_header_check == 'remove-header' ) {

				return;
			}

			if ( !is_home() ) {

				return;
			}
			wp_register_script( 'jquery.cross-slide.js', get_template_directory_uri() . '/jquery.cross-slide.js', array( 'jquery' ), '', true );
			wp_enqueue_script( 'jquery.cross-slide.js' );

			$enough_options = enough_theme_option( 'defaults' );

			if ( !empty( $enough_options[ 'enough_slider_sleep' ] ) ) {

				$sleep = $enough_options[ 'enough_slider_sleep' ];
			} else {
				$sleep = $enough_admin_options_setting[ 4 ][ 'option_value' ];
			}

			if ( !empty( $enough_options[ 'enough_slider_fade' ] ) ) {
				$fade = $enough_options[ 'enough_slider_fade' ];
			} else {
				$fade = $enough_admin_options_setting[ 5 ][ 'option_value' ];
			}
	}

}
/**
 *
 *
 */
if ( class_exists( 'WP_Customize_Control' ) && !class_exists( 'enough_Customize_Control_Multiple_Select' ) ) {

	class enough_Customize_Control_Multiple_Select extends WP_Customize_Control {

		public $type = 'multiple-select';

		public function render_content() {

			if ( empty( $this->choices ) || ! is_array( $this->choices ) ) {
				return;
			}
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?> multiple="multiple" style="height: 11em;width:100%">
			<?php
			foreach ( $this->choices as $value => $label ) {
				if( is_array( $this->value() ) ) {
					$selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
				}else{
					$selected = '';
				}
				echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
			}
			?>
				</select>
			</label>
					<?php
				}

			}

		}
		if ( !function_exists( 'enough_customize_register' ) ) {

			function enough_customize_register( $wp_customize ) {

				$wp_customize->add_section( 'enough_theme_setting'
				, array( 'title'		 => __( 'Layout and Style of Home Page', 'enough' )
					, 'priority'	 => 33,
				)
				);

				$wp_customize->add_section( 'enough_post_formats_setting'
				, array( 'title'		 => __( 'Enable Post Formats', 'enough' )
					, 'priority'	 => 32,
				)
				);

				$wp_customize->add_setting( 'enough_theme_settings[enough_enable_post_formats]', array(
					'default'			 => 'default',
					'type'				 => 'option',
					'capability'		 => 'edit_theme_options',
					'sanitize_callback'	 => 'enough_enable_post_formats_validate'
				) );

 

				$wp_customize->add_setting( 'enough_theme_settings[enough_post_one_column_bottom_sidebar]', array(
					'default'			 => 'no',
					'type'				 => 'option',
					'capability'		 => 'edit_theme_options',
					'sanitize_callback'	 => 'enough_post_one_column_bottom_sidebar_validate'
				) );
				$wp_customize->add_setting( 'enough_theme_settings[enough_approach_type]', array(
					'default'			 => 'default',
					'type'				 => 'option',
					'capability'		 => 'edit_theme_options',
					'sanitize_callback'	 => 'enough_approach_type_validate'
				) );
				///////////////
				$wp_customize->add_setting( 'enough_theme_settings[enough_post_content_width]', array(
					'default'			 => 100,
					'type'				 => 'option',
					'capability'		 => 'edit_theme_options',
					'sanitize_callback'	 => 'enough_post_content_width_validate'
				) );


				$wp_customize->add_control(
				new enough_Customize_Control_Multiple_Select(
				$wp_customize, 'enough_enable_post_formats', array(
					'label'		 => __( 'Please choose your favorite Post Formats( Multiple selection possible )', 'enough' ),
					'section'	 => 'enough_post_formats_setting',
					'settings'	 => 'enough_theme_settings[enough_enable_post_formats]',
					'type'		 => 'select',
					'choices'	 => array(
						'default'	 => 'No need Post Format',
						'chat'		 => 'Post Format chat',
						'gallery'	 => 'Post Format Gallery',
						'image'		 => 'Post Format Image',
						'link'		 => 'Post Format Link',
						'quote'		 => 'Post Format Quote',
						'status'	 => 'Post Format Status',
						'video'		 => 'Post Format Video',
					),
				)
				)
				);

				$enough_choices_array	 = array(
					'default'	 => __( 'Default', 'enough' ),
					'author'	 => __( 'Author', 'enough' ),
					'blank'		 => __( 'Blank', 'enough' ),
					'categories' => __( 'Categories', 'enough' ),
				);
				$enough_post_formats	 = get_theme_support( 'post-formats' );

				if ( isset( $enough_post_formats[ 0 ] ) && is_array( $enough_post_formats[ 0 ] ) ) {

					foreach ( $enough_post_formats[ 0 ] as $key => $val ) {

						$enough_choices_array[ $val ] = enough_get_post_format_string( $val );
					}
				}

				$wp_customize->add_control( 'enough_approach_type', array(
					'label'		 => __( 'Home Page Type', 'enough' ),
					'section'	 => 'enough_theme_setting',
					'settings'	 => 'enough_theme_settings[enough_approach_type]',
					'type'		 => 'radio',
					'choices'	 => $enough_choices_array,
				)
				);
				$wp_customize->add_control( 'enough_post_one_column_bottom_sidebar', array(
					'label'		 => __( 'Post Full Width One Column ', 'enough' ),
					'section'	 => 'enough_theme_setting',
					'settings'	 => 'enough_theme_settings[enough_post_one_column_bottom_sidebar]',
					'type'		 => 'radio',
					'choices'	 => array( 'yes'	 => __( 'yes', 'enough' )
						, 'no'	 => __( 'no', 'enough' )
					)
				)
				);

				$wp_customize->add_control( 'enough_post_content_width', array(
					'label'		 => __( 'Content Width of One Column Post', 'enough' ),
					'section'	 => 'enough_theme_setting',
					'settings'	 => 'enough_theme_settings[enough_post_content_width]',
					'type'			 => 'range',
					'input_attrs'	 => array(
						'min'	 => 50,
						'max'	 => 100,
						'step'	 => 1,
					),
				)
				);

			}

		}


		/**
		 *
		 *
		 *
		 *
		 * @since 0.44
		 */
		if ( !function_exists( 'enough_monthly_archive_prev_next_navigation' ) ) {

			function enough_monthly_archive_prev_next_navigation() {

				global $wpdb, $wp_query;
				$calendar_output = '';
				if ( is_month() ) {

					$thisyear	 = mysql2date( 'Y', $wp_query->posts[ 0 ]->post_date );
					$thismonth	 = mysql2date( 'm', $wp_query->posts[ 0 ]->post_date );

					$unixmonth	 = mktime( 0, 0, 0, $thismonth, 1, $thisyear );
					$last_day	 = date( 't', $unixmonth );

					$previous	 = $wpdb->get_row( "SELECT MONTH(post_date) AS month, YEAR(post_date) AS year FROM $wpdb->posts
					WHERE post_date < '$thisyear-$thismonth-01'
					AND post_type = 'post' AND post_status = 'publish'
						ORDER BY post_date DESC
						LIMIT 1" );
					$next		 = $wpdb->get_row( "SELECT MONTH(post_date) AS month, YEAR(post_date) AS year FROM $wpdb->posts
					WHERE post_date > '$thisyear-$thismonth-{$last_day} 23:59:59'
					AND post_type = 'post' AND post_status = 'publish'
						ORDER BY post_date ASC
						LIMIT 1" );

					$html = '<a href="%1$s" class="%3$s" title="%4$sth"><span class="nav-text">%2$s</span></a>';

					if ( $previous ) {
						$calendar_output = sprintf( $html, get_month_link( $previous->year, $previous->month ), sprintf( __( 'Prev Month( %sth )', 'enough' ), $previous->month ), 'alignleft', esc_attr( $previous->month )
						);
					}
					$calendar_output .= "\t";
					if ( $next ) {
						$calendar_output .= sprintf( $html, get_month_link( $next->year, $next->month ), sprintf( __( 'Next Month( %sth )', 'enough' ), $next->month ), 'alignright', esc_attr( $next->month )
						);
					}

					$html = '<div class="%1$s">%2$s</div>';

					$calendar_output = sprintf( $html, 'enough-monthly-archive-prev-next-navigation', $calendar_output
					);

					echo apply_filters( 'enough_monthly_archive_prev_next_navigation', $calendar_output );
				}
			}

		}
		/**
		 *
		 *
		 */
		if ( !function_exists( 'enough_article_title' ) ) {

			function enough_article_title() {

				$content_exists		 = get_the_content();
				$enough_post_format	 = get_post_format();

				if ( !empty( $enough_post_format ) and empty( $content_exists ) ) {
					return;
				}
				?>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php
	}

}
/**
 *
 *
 */
if ( !function_exists( 'enough_display_count' ) ) {

	function enough_display_count() {

		static $count = 1;

		return $count++;
	}

}

/**
 *
 *
 */
if ( !function_exists( 'enough_counter' ) ) {

	function enough_counter() {

		static $count = 1;

		return $count++;
	}

}
/**
 *
 *
 */
if ( !function_exists( 'enough_approach_blank_style' ) ) {

	function enough_approach_blank_style() {
		?>
						<style type="text/css">
							html{
								height: 100%;
								min-height:100%;

							}
							body {
								height: 100%;
								min-height:100%;

							}

							#enough-page {
								width: 100%;
								display: -webkit-box;
								display: -moz-box;
								padding:0;
								min-height: 100%;
								height: auto !important;
								height: 100%;
							}
							footer {
								position: fixed!important;
								bottom: 0;
								right:0;
								left: 0;
								z-index: 1030;
								margin-bottom: 0;
							}
							.menu-header{
								position: fixed!important;
								top: 40%;
								right:0;
								left: 0;
								z-index: 1030;
								margin-bottom: 0;

							}
							.enough-w-vga .menu-header,
							.enough-w-iphone .menu-header{
								position: static!important;
								height:auto;
								margin-bottom: 20px;

							}
							.menu-header {
								background: none repeat scroll 0 0 rgba(255, 255, 255, 0.7)!important;
								border-bottom: 1px solid #fff!important;
								border-top: 1px solid #fff!important;
							}
						</style>
		<?php
	}

}
/**
 * Entry title none breaking text breakable
 * test filter.
 * @since 1.119
 */
add_filter( 'the_title', 'enough_non_breaking_title' );

if ( !function_exists( 'enough_non_breaking_title' ) ) {

	function enough_non_breaking_title( $title ) {


		//Floccinaucinihilipilification

		if ( !is_admin() && get_locale() == 'en_US' ) {

			if ( preg_match( "/[\x20-\x7E]{30,}/", strip_tags( $title ) ) and preg_match( '!([A-Z])!', $title ) ) {

				return preg_replace( '!([A-Z])!', '<wbr>$1', $title );
			} elseif ( preg_match( "/[\x20-\x7E]{30,}/", strip_tags( $title ) ) ) {

				return preg_replace( '!([^a-z])!', '$1<wbr>', $title );
			}
		}

		return $title;
	}

}
/**
 * Entry content none breaking text ( url ) breakable
 * test filter.
 */
add_filter( 'the_content', 'enough_non_breaking_content', 11 );

if ( !function_exists( 'enough_non_breaking_content' ) ) {

	function enough_non_breaking_content( $content ) {


		//long url link text breakable

		if ( !is_admin() ) {

			return preg_replace_callback( "|>([-_.!*()a-zA-Z0-9;\/?:@&=+$,%#]{30,})<|", 'enough_add_wbr_content_long_text', $content );
		}

		return $content;
	}

}
/**
 *
 *
 */
if ( !function_exists( 'enough_add_wbr_content_long_text' ) ) {

	function enough_add_wbr_content_long_text( $matches ) {

		foreach ( $matches as $match ) {
			return preg_replace( '!([/])!', '$1<wbr>', $match );
		}
	}

}

/**
 * WordPress is correct but Currnt W3C validate is noisy
 * @since 0.74
 */
if ( !function_exists( 'enough_remove_rel_category' ) ) {

	function enough_remove_rel_category( $text ) {
		$text	 = str_replace( 'rel="category tag"', 'rel="tag"', $text );
		$text	 = str_replace( 'rel="category"', '', $text );
		return $text;
	}

}
add_filter( 'the_category', 'enough_remove_rel_category', 99 );


/**
 *
 *
 */
if ( !function_exists( 'enough_get_post_format_string' ) ) {

	function enough_get_post_format_string( $slug ) {

		$strings = array(
			'standard'	 => esc_html__( 'Standard', 'enough' ),
			'aside'		 => esc_html__( 'Aside', 'enough' ),
			'chat'		 => esc_html__( 'Chat', 'enough' ),
			'gallery'	 => esc_html__( 'Gallery', 'enough' ),
			'link'		 => esc_html__( 'Link', 'enough' ),
			'image'		 => esc_html__( 'Image', 'enough' ),
			'quote'		 => esc_html__( 'Quote', 'enough' ),
			'status'	 => esc_html__( 'Status', 'enough' ),
			'video'		 => esc_html__( 'Video', 'enough' ),
			'audio'		 => esc_html__( 'Audio', 'enough' ),
		);
		if ( !$slug ) {

			return $strings[ 'standard' ];
		} else {

			if ( isset( $strings[ $slug ] ) ) {

				return $strings[ $slug ];
			} else {
				return;
			}
		}
	}

}
/**
 *
 * @since 0.980
 */
if ( !function_exists( 'enough_prepend_body' ) ) {

	function enough_prepend_body() {

		get_template_part( 'enough', 'prepend-body' );
		$args = array( 'hook_name' => 'enough_prepend_body', 'template_part_name' => 'enough-prepend-body.php' );
		enough_insert_position_guid( $args );
		do_action( 'enough_prepend_body', $args );
	}

}
/**
 *
 *
 */
if ( !function_exists( 'enough_append_body' ) ) {

	function enough_append_body() {

		get_template_part( 'enough', 'append-body' );
		$args = array( 'hook_name' => 'enough_append_body', 'template_part_name' => 'enough-append-body.php' );
		enough_insert_position_guid( $args );
		do_action( 'enough_append_body', $args );
	}

}
/**
 *
 *
 */
if ( !function_exists( 'enough_prepend_header' ) ) {

	function enough_prepend_header() {

		get_template_part( 'enough', 'prepend-header' );
		$args = array( 'hook_name' => 'enough_prepend_header', 'template_part_name' => 'enough-prepend-header.php' );
		enough_insert_position_guid( $args );
		do_action( 'enough_prepend_header', $args );
	}

}
/**
 *
 *
 */
if ( !function_exists( 'enough_append_header' ) ) {

	function enough_append_header() {

		get_template_part( 'enough', 'append-header' );
		$args = array( 'hook_name' => 'enough_append_header', 'template_part_name' => 'enough-append-header.php' );
		enough_insert_position_guid( $args );

		do_action( 'enough_append_header', $args );
	}

}
/**
 *
 *
 */
if ( !function_exists( 'enough_prepend_footer' ) ) {

	function enough_prepend_footer() {


		get_template_part( 'enough', 'prepend-footer' );
		$args = array( 'hook_name' => 'enough_prepend_footer', 'template_part_name' => 'enough-prepend-footer.php' );

		enough_insert_position_guid( $args );

		do_action( 'enough_prepend_footer', $args );
	}

}
/**
 *
 *
 */
if ( !function_exists( 'enough_append_footer' ) ) {

	function enough_append_footer() {

		get_template_part( 'enough', 'append-footer' );
		$args = array( 'hook_name' => 'enough_append_footer', 'template_part_name' => 'enough-append-footer.php' );
		enough_insert_position_guid( $args );
		do_action( 'enough_append_footer', $args );
	}

}
/**
 *
 *
 */
if ( !function_exists( 'enough_nav_menu_after' ) ) {

	function enough_nav_menu_after() {

		get_template_part( 'enough', 'nav-menu-after' );
		$args = array( 'hook_name' => 'enough_nav_menu_after', 'template_part_name' => 'enough-nav-menu-after.php' );
		enough_insert_position_guid( $args );
		do_action( 'enough_nav_menu_after', $args );
	}

}
/**
 *
 *
 */
if ( !function_exists( 'enough_insert_position_guid' ) ) {

	function enough_insert_position_guid( $args ) {

		global $enough_show_insert_point;

		$text = sprintf( esc_html__( 'Insert this position with Action hook %1$s  or  Template %2$s', 'enough' ), $args[ 'template_part_name' ], $args[ 'template_part_name' ] );

		$enough_insert_position_html = '<p class="enough-insert-position">%1$s</p>';

		if ( WP_DEBUG == true && $enough_show_insert_point == true ) {

			printf( $enough_insert_position_html, $text );
		}
	}

}

/**
 *
 *
 */
if ( !function_exists( 'enough_next_prev_links' ) ) {

	function enough_next_prev_links( $position = 'nav-above' ) {

		global $wp_query, $paged, $post;

		$enough_page_on_front = get_option( 'page_on_front' );

		if ( is_front_page() && isset( $enough_page_on_front ) ) {

			return;
		}
		$enough_old	 = $paged + 1;
		$enough_new	 = $paged - 1;

		if ( $wp_query->max_num_pages > 1 ) {

			$html	 = '<div id="%3$s" class="posts-nav-link"><span class="nav-previous">%1$s</span><span class="nav-next">%2$s</span></div>';
			$html	 = sprintf( $html, get_next_posts_link( '<span class="meta-nav">&larr; $enough_old </span>' . esc_html__( ' Older posts', 'enough' ) ), get_previous_posts_link( '<span>' . esc_html__( 'Newer posts', 'enough' ) . '<span class="meta-nav">' . $enough_new . ' &rarr;</span></span>' ), $position
			);
			echo apply_filters( 'enough_next_prev_links', $html, $position );
		}
	}

}

if ( !function_exists( 'enough_oembed_filter' ) ) {

	/**
	 *
	 * @param type $html
	 * @param type $url
	 * @param type $attr
	 * @param type $post_ID
	 * @return type string html
	 * @since 1.246
	 */
	function enough_oembed_filter( $html, $url, $attr, $post_ID ) {


		if ( !preg_match( '!twitter.com!', $url ) ) {
			return sprintf( '<%2$s class="oembed-container clearfix">%1$s</%2$s>', $html, 'figure' );
		}
		return $html;
	}

}

function enough_custom_post_format_links_button( $echo = true ) {

	$enough_post_formats	 = get_theme_support( 'post-formats' );
	$enough_home_template	 = enough_theme_option( 'enough_approach_type' );

	if ( !$enough_post_formats ) {

		return;
	}
	$html_wrapper	 = '<ul id="custom-post-format-links-button">%1$s</ul>';
	$html			 = '	<li class="%3$s"><a href="%1$s"><span>%2$s</span></a></li>';
	$result			 = '';

	foreach ( $enough_post_formats[ 0 ] as $format ) {

		if ( $enough_home_template !== $format ) {
			$result .= sprintf( $html, esc_url( get_post_format_link( $format ) ), esc_html( enough_get_post_format_string( $format ) ), esc_attr( $format ) );
		}
	}

	if ( $echo !== true ) {
		return sprintf( $html_wrapper, $result );
	} else {
		printf( $html_wrapper, $result );
	}
}

if( ! function_exists( 'enough_gallery_atts' ) ) {
/**
 *
 * @global type $enough_extend_galleries
 * @param type $out
 * @param type $pairs
 * @param type $atts
 * @return gallery default attribute value
 * @since 1.269
 */
	function enough_gallery_atts( $out, $pairs, $atts ) {
		global $enough_extend_galleries;

		if ( $enough_extend_galleries !== true ){
			return  $out;
		}

		if (  empty( $atts["columns"] ) || $atts["columns"] < 4 ) {

			$atts = shortcode_atts( array(
			'size' => 'medium',
			), $atts );

			$out['size'] = $atts['size'];
		}
		return $out;
	}
}

function enough_gallerys_css() {

	global $enough_extend_galleries;

		$clear_float = ".gallery,
			.gallery-columns-1 .gallery-item:nth-child(2),\n
			.gallery-columns-2 .gallery-item:nth-child(3),\n
			.gallery-columns-3 .gallery-item:nth-child(4),\n
			.gallery-columns-4 .gallery-item:nth-child(5),\n
			.gallery-columns-5 .gallery-item:nth-child(6),\n
			.gallery-columns-6 .gallery-item:nth-child(7),\n
			.gallery-columns-7 .gallery-item:nth-child(8),\n
			.gallery-columns-8 .gallery-item:nth-child(9),\n
			.gallery-columns-9 .gallery-item:nth-child(10),\n
			.gallery-columns-10 .gallery-item:nth-child(11){clear:both;}";

		if ( $enough_extend_galleries !== true ){

			return apply_filters( "enough_gallerys_css", $clear_float, $enough_extend_galleries );
		}

	$doc_type = 'html5';



	if( $doc_type == 'xhtml' ){
		$display_property = 'float:left;';
	} else {
		$display_property = 'display:inline-block;';
	}

    $enough_gallerys = ".gallery { margin: auto; width: 100%; }\n
            .gallery .gallery-item { margin: 0px; }\n
            .gallery .gallery-item {". $display_property. " margin-top: 10px; text-align: center; }\n
            .gallery img { max-width:100%; }\n
            .gallery .gallery-caption { margin-left: 0; }\n
            .gallery br { clear: both }\n
            .gallery-columns-1 .gallery-item{ width: 100% }\n
            .gallery-columns-2 .gallery-item{ width: 50% }\n
            .gallery-columns-3 .gallery-item{ width: 33.3% }\n
            .gallery-columns-4 .gallery-item{ width: 25% }\n
            .gallery-columns-5 .gallery-item{ width: 20% }\n
            .gallery-columns-6 .gallery-item{ width: 16.6% }\n
            .gallery-columns-7 .gallery-item{ width: 14.28% }\n
            .gallery-columns-8 .gallery-item{ width: 12.5% }\n
            .gallery-columns-9 .gallery-item{ width: 11.1% }\n
            .gallery-columns-10 .gallery-item{ width: 9.9% }\n";

	$enough_gallerys .= $clear_float;

	/* caption text presentation */
    $enough_gallerys .= ".gallery:after{content:'';clear:both;display:block;}.gallery-item{position:relative;}
			.gallery figcaption{
            box-sizing:border-box;
            position:absolute;
            top:0;
            left:0;
            width:100%;
			height:auto;
            bottom:30%;
            padding:1em;
            text-align:left;
            margin:auto;
            background:#000;
            color:#fff;
			opacity:0;
			transition:opacity .7s;
            border: 1px solid #fff;
            visibility:hidden;
            transition:visibility .7s, opacity .7s;
			-webkit-transition:visibility .7s,opacity .7s;
            z-index:99999;
			font-size:100%;
        }
		.gallery figure:focus figcaption{
			visibility:visible;
            opacity:.7;
			transition:visibility 1s, opacity 1s;
			-webkit-transition:visibility .7s,opacity .7s;
            overflow:hidden;
            margin:4px;
			outline:0;
		}
        .gallery .gallery-item:hover figcaption{
            visibility:visible;
            opacity:.7;
			transition:visibility 1s, opacity 1s;
			-webkit-transition:visibility .7s,opacity .7s;
            overflow:hidden;
            margin:4px;

        }";
    return apply_filters( "enough_gallerys_css", $enough_gallerys );
}
add_filter( 'shortcode_atts_gallery', 'enough_gallery_atts', 10, 3 );

if ( !function_exists( 'enough_approach_blank_fallback_cb' ) ) {

	function enough_approach_blank_fallback_cb() {

		if ( is_customize_preview() ) {
			$message = __( 'Menu is not set yet. Please create a menu and set the main navigation', 'enough' );
			echo '<div class="menu-header fallback-navigation"><p class="alert">' . $message . '</p></div>';
		}
	}
}

add_filter( 'enough_embed_meta_echo', 'enough_ssl_link_helper' );
add_filter( 'enough_custom_fields_style_for_loop', 'enough_ssl_link_helper',99 );//not work
add_filter( 'enough_embed_meta_css', 'enough_ssl_link_helper' );
add_filter( 'enough_footer_text', 'enough_ssl_link_helper' );
add_filter( 'post_link', 'enough_ssl_link_helper' );
add_filter( 'wp_nav_menu', 'enough_ssl_link_helper' );
add_filter( 'wp_get_custom_css', 'enough_ssl_link_helper' );
add_filter('widget_text_content', 'enough_ssl_link_helper' );
add_filter( 'widget_custom_html_content','enough_ssl_link_helper' );
add_filter( 'post_type_archive_link','enough_ssl_link_helper' );
add_filter( 'tag_link','enough_ssl_link_helper' );
add_filter( 'category_link','enough_ssl_link_helper' );
add_filter( 'the_content','enough_ssl_link_helper' );
add_filter('the_content_rss','enough_ssl_link_helper' );
		
if( ! function_exists( 'enough_ssl_link_helper' ) ) {
	/**
	 * @since 1.488
	 */
	function enough_ssl_link_helper( $content ) {

		global $enough_ssl_link_helper;

		if( is_ssl( ) && true == $enough_ssl_link_helper ) {

			$parsed_url = parse_url (  home_url() );
			$host = $parsed_url['host'];

			$replace_pairs = apply_filters( 'enough_ssl_link_helper_hosts', array( 'http://'.$host =>'https://'.$host ) );

			return strtr( $content, $replace_pairs );
		}
		return $content;
	}
}
?>