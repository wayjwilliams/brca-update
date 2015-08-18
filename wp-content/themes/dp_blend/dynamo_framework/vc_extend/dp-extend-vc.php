<?php
vc_set_as_theme($disable_updater = true);
// Removing shortcodes
vc_remove_element("vc_wp_search");
vc_remove_element("vc_wp_meta");
vc_remove_element("vc_wp_recentcomments");
vc_remove_element("vc_wp_calendar");
vc_remove_element("vc_wp_pages");
vc_remove_element("vc_wp_tagcloud");
vc_remove_element("vc_wp_text");
vc_remove_element("vc_wp_posts");
vc_remove_element("vc_wp_links");
vc_remove_element("vc_wp_categories");
vc_remove_element("vc_wp_archives");
vc_remove_element("vc_wp_rss");
vc_remove_element("vc_teaser_grid");
vc_remove_element("vc_button");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_message");
vc_remove_element("vc_pie");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_toggle");
vc_remove_element("vc_progress_bar");
vc_remove_element("vc_gallery");
vc_remove_element("vc_tta_accordion");
vc_remove_element("vc_tta_tour");
vc_remove_element("vc_tta_tab");
vc_remove_element("vc_tabs");
vc_remove_element("vc_accordion");
vc_remove_element("vc_tta_tabs");
$remove_depreciate = array (
  'deprecated' => ''
);
vc_map_update( 'vc_tab', $remove_depreciate );
vc_map_update( 'vc_tour', $remove_depreciate );
vc_map_update( 'vc_accordion_tab', $remove_depreciate );
// Add VC admin CSS styles
function load_custom_vc_admin_style() {
        wp_register_style( 'custom_vc_admin_css', get_template_directory_uri() . '/dynamo_framework/vc_extend/dp_vc_admin.css', false, '' );
        wp_enqueue_style( 'custom_vc_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_vc_admin_style' );
//Add VC frontend styles
function load_custom_vc_frontend_style() {
		 wp_register_style( 'custom_vc_frontend_css', get_template_directory_uri().'/dynamo_framework/vc_extend/dp_vc_frontend.css', array('js_composer_front'), '', 'screen' );
		 wp_enqueue_style( 'custom_vc_frontend_css' );
    }
add_action('wp_head', 'load_custom_vc_frontend_style', 6);

// Add custom functions and arrays

if (class_exists('DP_Post_Types')) {
if (!function_exists('getSliderArray')){
	function getSliderArray() {
    $terms = get_terms('slideshows');	
	$output = array("" => "");	
    $count = count($terms);
	    if ( $count > 0 ):
        foreach ( $terms as $term ):
            $output[$term->name] = $term->slug;
        endforeach;
    endif;
	
    return $output;
	}
}
add_action('init', 'getSliderArray',3);

if (!function_exists('getPortfoliosArray')){
	function getPortfoliosArray() {
    $terms = get_terms('portfolios');	
	$output = array("All" => "all");	
    $count = count($terms);
	    if ( $count > 0 ):
        foreach ( $terms as $term ):
            $output[$term->name] = $term->slug;
        endforeach;
    endif;
	
    return $output;
	}
}
add_action('init', 'getPortfoliosArray',3);
}
if (!function_exists('getPatternsArray')){
	function getPatternsArray() {
    $dirPath = dir( get_template_directory().'/images/overlay_patterns');	
	$output = array("No pattern" => "none.png");	
	while (($file = $dirPath->read()) !== false)
					{if (trim($file)!='.' && trim($file)!='..')	{
					$value = current(explode(".", $file));
					if ($value != "none" && $value != "Thumbs") {
					$output[$value] = $file;
					}}
					}
	$dirPath->close();
    return $output;
	}
}
add_action('init', 'getPatternsArray',3);

if (!function_exists('getCategoriesArray')){
	function getCategoriesArray() {
    $terms = get_terms('category');	
	$output = array("All" => "all");	
    $count = count($terms);
	    if ( $count > 0 ):
        foreach ( $terms as $term ):
            $output[$term->name] = $term->slug;
        endforeach;
    endif;
	
    return $output;
	}
}
add_action('init', 'getCategoriesArray',3);

if (!function_exists('getMenusArray')){
	function getMenusArray() {
	$menus = wp_get_nav_menus();
	$output = array("-- Select --" => "");	
    $count = count($menus);
	    if ( $count > 0 ):
        foreach ( $menus as $menu ):
            $output[$menu->name] = $menu->slug;
        endforeach;
    endif;
	
    return $output;
	}
}
add_action('init', 'getMenusArray',3);

$slideshows = $portfolios = '';
if (class_exists('DP_Post_Types')) {
$slideshows = getSliderArray();
$portfolios = getPortfoliosArray();
}
$patterns = getPatternsArray();
$categories = getCategoriesArray();
$menus = getMenusArray();

$add_dp_animation = array(
  "type" => "dropdown",
  "heading" => __("CSS Animation", DPTPLNAME),
  "param_name" => "dp_animation",
  "admin_label" => true,
  "value" => array ("No" => "",
  		"fadeIn " => "fadeIn",
		"fadeInUp" => "fadeInUp",
		"fadeInDown" => "fadeInDown",
		"fadeInLeft" => "fadeInLeft",
		"fadeInRight" => "fadeInRight",
		"fadeInUpBig" => "fadeInUpBig",
		"fadeInDownBig" => "fadeInDownBig",
		"fadeInLeftBig" => "fadeInLeftBig",
		"fadeInRightBig" => "fadeInRightBig",
		"lightSpeedRight" => "lightSpeedRight",
		"lightSpeedLeft" => "lightSpeedLeft",
		"bounceIn" => "bounceIn",
		"bounceInUp" => "bounceInUp",
		"bounceInDown" => "bounceInDown",
		"bounceInLeft" => "bounceInLeft",
		"bounceInRight" => "bounceInRight",
		"rotateInUpLeft" => "rotateInUpLeft",
		"rotateInDownLeft" => "rotateInDownLeft",
		"rotateInUpRight" => "rotateInUpRight",
		"rotateInDownRight" => "rotateInDownRight",
		"rollIn" => "rollIn",
		"pulse" => "pulse",
		"flipInX" => "flipInX",
)
);

$target_arr = array(
	__( 'Same window', DPTPLNAME ) => '_self',
	__( 'New window', DPTPLNAME ) => "_blank"
);
$add_dp_slideshow = array(
  "type" => "dropdown",
  "heading" => __("Slideshow", DPTPLNAME),
  "param_name" => "slideshow",
  "admin_label" => true,
  "value" => $slideshows,
  "description" => "Select slideshow from available slideshows list"
);

$add_dp_category = array(
  "type" => "dropdown",
  "heading" => __("Category", DPTPLNAME),
  "param_name" => "category",
  "admin_label" => true,
  "value" => $categories,
  "description" => "Select category from available categories list"

);
$add_dp_portfolios = array(
  "type" => "dropdown",
  "heading" => __("Portfolio category", DPTPLNAME),
  "param_name" => "portfolios",
  "admin_label" => true,
  "value" => $portfolios,
  "description" => "Select portfolio category from available portfolio categories list"
);

$add_dp_menu = array(
  "type" => "dropdown",
  "heading" => __("Menu", DPTPLNAME),
  "param_name" => "menu",
  "admin_label" => true,
  "value" => $menus,
  "description" => "Select menu from available menus list"
);

function dp_getImageBySize( $params = array( 'post_id' => NULL, 'attach_id' => NULL, 'thumb_size' => 'thumbnail', 'class' => '' ) ) {
	if ( ( ! isset( $params['attach_id'] ) || $params['attach_id'] == NULL ) && ( ! isset( $params['post_id'] ) || $params['post_id'] == NULL ) ) return;
	$post_id = isset( $params['post_id'] ) ? $params['post_id'] : 0;

	if ( $post_id ) $attach_id = get_post_thumbnail_id( $post_id );
	else $attach_id = $params['attach_id'];

	$thumb_size = $params['thumb_size'];
	$thumb_class = ( isset( $params['class'] ) && $params['class'] != '' ) ? $params['class'] . ' ' : '';

	global $_wp_additional_image_sizes;
	$thumbnail = '';

	if ( is_string( $thumb_size ) && ( ( ! empty( $_wp_additional_image_sizes[$thumb_size] ) && is_array( $_wp_additional_image_sizes[$thumb_size] ) ) || in_array( $thumb_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) ) {
		$thumb = wp_get_attachment_image_src( $attach_id, 'thumbnail' );
		$url = $thumb['0'];
		$thumbnail = wp_get_attachment_image( $attach_id, $thumb_size, false, array( 'class' => $thumb_class . 'attachment-' . $thumb_size, 'data-thumb' => $url ) );
	} elseif ( $attach_id ) {
		if ( is_string( $thumb_size ) ) {
			preg_match_all( '/\d+/', $thumb_size, $thumb_matches );
			if ( isset( $thumb_matches[0] ) ) {
				$thumb_size = array();
				if ( count( $thumb_matches[0] ) > 1 ) {
					$thumb_size[] = $thumb_matches[0][0]; // width
					$thumb_size[] = $thumb_matches[0][1]; // height
				} elseif ( count( $thumb_matches[0] ) > 0 && count( $thumb_matches[0] ) < 2 ) {
					$thumb_size[] = $thumb_matches[0][0]; // width
					$thumb_size[] = $thumb_matches[0][0]; // height
				} else {
					$thumb_size = false;
				}
			}
		}
		if ( is_array( $thumb_size ) ) {
			// Resize image to custom size
			$p_img = wpb_resize( $attach_id, null, $thumb_size[0], $thumb_size[1], true );
			$alt = trim( strip_tags( get_post_meta( $attach_id, '_wp_attachment_image_alt', true ) ) );

			if ( empty( $alt ) ) {
				$attachment = get_post( $attach_id );
				$alt = trim( strip_tags( $attachment->post_excerpt ) ); // If not, Use the Caption
			}
			if ( empty( $alt ) )
				$alt = trim( strip_tags( $attachment->post_title ) ); // Finally, use the title
			if ( $p_img ) {
				$img_class = '';
				$thumbnail = '<img class="' . $thumb_class . '" src="' . $p_img['url'] . '" width="' . $p_img['width'] . '" height="' . $p_img['height'] . '" alt="' . $alt . '"/>';
			}
		}
	}

	$p_img_large = wp_get_attachment_image_src( $attach_id, 'large' );
	return array( 'thumbnail' => $thumbnail, 'p_img_large' => $p_img_large );
}

if (!function_exists('getDPAnimation')){
	function getDPAnimation($animation) {
	$output = '';
	if ($animation != '') $output .= ' data-animated ="'.$animation.'"';
    return $output;
	}
}

function dp_datetimepicker($settings, $value)
		{
			$dependency = vc_generate_dependencies_attributes($settings);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$uni = uniqid();
			$output = '<div id="dp-date-time'.$uni.'" class="dp-datetime"><input data-format="yyyy/MM/dd hh:mm:ss" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" style="width:258px;" value="'.$value.'" '.$dependency.'/><div class="add-on" >  <i data-time-icon="Defaults-time" data-date-icon="Default-calendar3"></i></div></div>';
			$output .= '<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery("#dp-date-time'.$uni.'").datetimepicker({
						language: "en-US"
					});
				})
				</script>';
			return $output;
		}

if ( function_exists('add_shortcode_param'))
			{
				add_shortcode_param('dp-datetimepicker' , 'dp_datetimepicker' ) ;
			}
			
function vc_include_post_search( $search_string ) {
	$query = $search_string;
	$data = array();
	$args = array( 's' => $query, 'post_type' => 'post' );
	$args['vc_search_by_title_only'] = true;
	$args['numberposts'] = - 1;
	if ( strlen( $args['s'] ) == 0 ) {
		unset( $args['s'] );
	}
	add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
	$posts = get_posts( $args );
	if ( is_array( $posts ) && ! empty( $posts ) ) {
		foreach ( $posts as $post ) {
			$data[] = array(
				'value' => $post->ID,
				'label' => $post->post_title,
				'group' => $post->post_type,
			);
		}
	}

	return $data;
}

function vc_include_portfolio_search( $search_string ) {
	$query = $search_string;
	$data = array();
	$args = array( 's' => $query, 'post_type' => 'portfolio' );
	$args['vc_search_by_title_only'] = true;
	$args['numberposts'] = - 1;
	if ( strlen( $args['s'] ) == 0 ) {
		unset( $args['s'] );
	}
	add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
	$posts = get_posts( $args );
	if ( is_array( $posts ) && ! empty( $posts ) ) {
		foreach ( $posts as $post ) {
			$data[] = array(
				'value' => $post->ID,
				'label' => $post->post_title,
				'group' => $post->post_type,
			);
		}
	}

	return $data;
}
function vc_include_postorportfolio_search( $search_string ) {
	$query = $search_string;
	$data = array();
	$args = array( 's' => $query, 'post_type' => array('portfolio','post') );
	$args['vc_search_by_title_only'] = true;
	$args['numberposts'] = - 1;
	if ( strlen( $args['s'] ) == 0 ) {
		unset( $args['s'] );
	}
	add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
	$posts = get_posts( $args );
	if ( is_array( $posts ) && ! empty( $posts ) ) {
		foreach ( $posts as $post ) {
			$data[] = array(
				'value' => $post->ID,
				'label' => $post->post_title,
				'group' => $post->post_type,
			);
		}
	}

	return $data;
}

//Add custom parameters to existing VC elements

//Animations
vc_remove_param("vc_single_image", "css_animation"); 				
vc_add_param("vc_single_image", $add_dp_animation);

vc_remove_param("vc_column_text", "css_animation"); 				
vc_add_param("vc_column_text", $add_dp_animation);

vc_remove_param("vc_cta_button2", "css_animation"); 				
vc_add_param("vc_cta_button2", $add_dp_animation);

vc_add_param("vc_column", $add_dp_animation);

//VC Row
vc_remove_param("vc_row", "el_class"); 				
vc_remove_param("vc_row", "full_width"); 				
vc_remove_param("vc_row", "video_bg"); 				
vc_remove_param("vc_row", "video_bg_url"); 				
vc_remove_param("vc_row", "video_bg_parallax"); 				
vc_remove_param("vc_row", "parallax"); 				
vc_remove_param("vc_row", "parallax_image"); 				
//vc_remove_param("vc_row", "el_id");

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Content Type", DPTPLNAME),
	"param_name" => "type",
	"value" => array(
		"In Grid" => "grid",	
		"Full Width" => "full_width"
		
	),
    "description" => __('This settings affected only when "Full width" page template is used. Here you can decide if row content should be boxed in page grid or 100% screen width.  ', DPTPLNAME)
));
vc_add_param("vc_row", array(
			'type' => 'checkbox',
			'heading' => __( 'No columns padding?', 'js_composer' ),
			'param_name' => 'no_paddings',
			'description' => __( 'If checked columns in row will be displayed with no paddings.', 'js_composer' ),
			'value' => array( __( 'Yes', 'js_composer' ) => 'true' )
		));


vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "Parallax Background",
	"value" => array("Enable Parallax Background?" => "true" ),
	"param_name" => "parallax_bg",
    "description" => __("Enable / Disable paralax effect for background image", DPTPLNAME)
	));
	
vc_add_param("vc_row",array(
						"type" => "textfield",
						"class" => "",
						"heading" => __( "Parallax Speed", DPTPLNAME ),
						"param_name" => "parallax_speed",
						"value" => "0.3",
						"description" => __( "The movement speed, value should be between 0.1 and 1.0. A lower number means slower scrolling speed. Be mindful of the <strong>background size</strong> and the <strong>dimensions</strong> of your background image when setting this value. Faster scrolling means that the image will move faster, make sure that your background image has enough width or height for the offset.", DPTPLNAME ),
	"group" => 'DP Background&Overlay Options',
	));
	
vc_add_param("vc_row", array(
    "type" => "dropdown",
	"group" => 'DP Background&Overlay Options',
    "heading" => __('Video background', DPTPLNAME),
    "param_name" => "video_bg",
    "value" => array(
                        __("None", DPTPLNAME) => '',
                        __("HTML5 video background", DPTPLNAME) => 'html5videobg',
                        __('Youtube video background', DPTPLNAME) => 'ytvideobg'
                      ),
      "description" => __("Select a background video type for your row", DPTPLNAME),
    ));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "WebM File URL",
	"value" => "",
	"param_name" => "video_webm",
	"description" => "You must include this format & the mp4 format to render your video with cross browser compatibility. OGV is optional.
Video must be in a 16:9 aspect ratio.",
	"dependency" => array('element' => "video_bg", 'value' =>  array('html5videobg'))
	));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "MP4 File URL",
	"value" => "",
	"param_name" => "video_mp4",
	"description" => "Enter the URL for your mp4 video file here",
	"dependency" => array('element' => "video_bg", 'value' =>  array('html5videobg'))
	));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "OGV File URL",
	"value" => "",
	"param_name" => "video_ogv",
	"description" => "Enter the URL for your ogv video file here",
	"dependency" => Array('element' => "video_bg", 'value' =>  array('html5videobg'))
	));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "YouTube video URL",
	"value" => "",
	"param_name" => "video_yt",
	"description" => "Enter the URL for your YouTube video file here",
	"dependency" => Array('element' => "video_bg", 'value' =>  array('ytvideobg'))
	));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "Start at",
	"value" => "",
	"param_name" => "start_at",
	"description" => "Enter a Youtube video start time in seconds. If you leave blank video will be start from begining.",
	"dependency" => Array('element' => "video_bg", 'value' =>  array('ytvideobg'))
	));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "Video raster",
	"value" => array("Use raster?" => "use_raster" ),
	"param_name" => "use_raster",
	"description" => "",
	"dependency" => Array('element' => "video_bg", 'value' =>  array('ytvideobg'))
	));
vc_add_param("vc_row", array(
    "type" => "dropdown",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "Audio",
	"param_name" => "mute",
    "value" => array(
                        __("Muted", DPTPLNAME) => 'muted',
                        __("Unmuted", DPTPLNAME) => 'unmuted'
                      ),
    "description" => __("Select a video audio default stand", DPTPLNAME),
	"dependency" => Array('element' => "video_bg", 'value' =>  array('ytvideobg','html5videobg'))
	));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "Mute Button",
	"value" => array("Enable Mute / Unmute Button?" => "true" ),
	"param_name" => "mute_btn",
	"dependency" => Array('element' => "video_bg", 'value' =>  array('ytvideobg','html5videobg'))
	));
vc_add_param("vc_row", array(
    "type" => "dropdown",
	"group" => 'DP Background&Overlay Options',
    "heading" => __('FSS background', DPTPLNAME),
    "param_name" => "is_fss_bg",
    "value" => array(
                        __("Disabled", DPTPLNAME) => 'no',
                        __("Enabled", DPTPLNAME) => 'fss'
                      ),
      "description" => __("Enable a FFS background (animated polygonal background) for this row. Please note that you can use only one row with FSS background per page.", DPTPLNAME),
    ));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "FSS Row height",
	"value" => "",
	"param_name" => "fss_height",
	"description" => "Enter row height in px.",
	"dependency" => Array('element' => "fss_bg",'value' =>  array('fss'))
	));
vc_add_param("vc_row", array(
    "type" => "dropdown",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "FSS background style",
	"param_name" => "fss_style",
    "value" => array(
                        __("Purple", DPTPLNAME) => 'purple',
                        __("Blue", DPTPLNAME) => 'blue',
                        __("Green", DPTPLNAME) => 'green',
                        __("Brown", DPTPLNAME) => 'brown',
                        __("Red", DPTPLNAME) => 'red',
                        __("Orange", DPTPLNAME) => 'orange',
                        __("Gray", DPTPLNAME) => 'gray',
                        __("Custom", DPTPLNAME) => 'custom',
                      ),
    "description" => __("Select a predefined color settings or define custom colors", DPTPLNAME),
	"dependency" => Array('element' => "fss_bg",'value' =>  array('fss'))
	));
vc_add_param("vc_row",array(
			'type' => 'colorpicker',
			"group" => 'DP Background&Overlay Options',
			'heading' => __( 'Meshambient color', DPTPLNAME ),
			'param_name' => 'fss_meshambient',
			'value' => '#555555',
			'description' => __( 'Select color for meshambient.', DPTPLNAME ),
			"dependency" => Array('element' => "fss_style",'value' =>  array('custom')),
    		"description" => __("Select a meshambient color. You can use this <a href='http://matthew.wagerfield.com/flat-surface-shader/' target ='_blank'>generator</a> for color setting", DPTPLNAME)
		));
vc_add_param("vc_row",array(
			'type' => 'colorpicker',
			"group" => 'DP Background&Overlay Options',
			'heading' => __( 'Meshdiffuse color', DPTPLNAME ),
			'param_name' => 'fss_meshdiffuse',
			'value' => '#ffffff',
			'description' => __( 'Select color for meshdiffuse.', DPTPLNAME ),
			"dependency" => Array('element' => "fss_style",'value' =>  array('custom')),
    		"description" => __("Select a meshdiffuse color. You can use this <a href='http://matthew.wagerfield.com/flat-surface-shader/' target ='_blank'>generator</a> for color setting", DPTPLNAME)
		));
vc_add_param("vc_row",array(
			'type' => 'colorpicker',
			"group" => 'DP Background&Overlay Options',
			'heading' => __( 'Lightambient color', DPTPLNAME ),
			'param_name' => 'fss_lightambient',
			'value' => '#880066',
			'description' => __( 'Select color for lightambient.', DPTPLNAME ),
			"dependency" => Array('element' => "fss_style",'value' =>  array('custom')),
    		"description" => __("Select a lightambient color. You can use this <a href='http://matthew.wagerfield.com/flat-surface-shader/' target ='_blank'>generator</a> for color setting", DPTPLNAME)
		));
vc_add_param("vc_row",array(
			'type' => 'colorpicker',
			"group" => 'DP Background&Overlay Options',
			'heading' => __( 'Lightdiffuse color', DPTPLNAME ),
			'param_name' => 'fss_lightdiffuse',
			'value' => '#ff8800',
			'description' => __( 'Select color for lightdiffuse.', DPTPLNAME ),
			"dependency" => Array('element' => "fss_style",'value' =>  array('custom')),
    		"description" => __("Select a lightdiffuse color. You can use this <a href='http://matthew.wagerfield.com/flat-surface-shader/' target ='_blank'>generator</a> for color setting", DPTPLNAME)
		));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "Overlay Setting",
	"value" => array("Enable row overlay?" => "true" ),
	"param_name" => "useoverlay",
    "description" => __("Enable color and pattern overlay for this row", DPTPLNAME)
	));
vc_add_param("vc_row",array(
			'type' => 'colorpicker',
			"group" => 'DP Background&Overlay Options',
			'heading' => __( 'Overlay color', DPTPLNAME ),
			'param_name' => 'overlaycolor',
			'description' => __( 'Select color for overlay.', DPTPLNAME ),
			"dependency" => Array('element' => "useoverlay", 'value' =>  'true')
		));
		
vc_add_param("vc_row",array(
	  "type" => "dropdown",
      "group" => 'DP Background&Overlay Options',
	  "heading" => __("Overlay pattern", DPTPLNAME),
	  "param_name" => "overlaypattern",
	  "value" => $patterns,
	  "description" => "Select pattern from available patterns list",
	  "dependency" => Array('element' => "useoverlay", 'value' =>  'true')
	));

vc_add_param("vc_row", array(
        "type" => "textfield",
        "heading" => __("Extra class name", DPTPLNAME),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", DPTPLNAME),
      ));

//VC Tab

$tab_id_1 = ''; // 'def' . time() . '-1-' . rand( 0, 100 );
$tab_id_2 = ''; // 'def' . time() . '-2-' . rand( 0, 100 );
vc_map( array(
	"name" => __( 'DP Tabs', 'js_composer' ),
	'base' => 'vc_tabs',
	'show_settings_on_create' => false,
	'is_container' => true,
	'icon' => 'icon-wpb-ui-tab-content',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Tabbed content', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text used as widget title (Note: located above content element).', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Auto rotate', 'js_composer' ),
			'param_name' => 'interval',
			'value' => array( __( 'Disable', 'js_composer' ) => 0, 3, 5, 10, 15 ),
			'std' => 0,
			'description' => __( 'Auto rotate tabs each X seconds.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
		)
	),
	'custom_markup' => '
<div class="wpb_tabs_holder wpb_holder vc_container_for_children">
<ul class="tabs_controls">
</ul>
%content%
</div>'
,
	'default_content' => '
[vc_tab title="' . __( 'Tab 1', 'js_composer' ) . '" tab_id="' . $tab_id_1 . '"][/vc_tab]
[vc_tab title="' . __( 'Tab 2', 'js_composer' ) . '" tab_id="' . $tab_id_2 . '"][/vc_tab]
',
	'js_view' =>'VcTabsView'
) );


vc_add_param("vc_tab", 
			array(
				"type" => "icon_selector",
				"admin_label" => true,
				"class" => "",
				"heading" => __("Icon", DPTPLNAME),
				"param_name" => "icon"
				));
vc_add_param("vc_tab", array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Subtitle", DPTPLNAME),
				"value" => " ",
				"param_name" => "subtitle",
			    "description" => __("This field will be used only by custom diamond skin", DPTPLNAME)
				));
vc_add_param("vc_tabs", array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Fullwidth", DPTPLNAME),
				"param_name" => "fullwidth"
				));
vc_add_param("vc_tabs", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => "Force fullwidth tabs in navigation?",
	"value" => array("Yes, please" => "true" ),
	"param_name" => "fullwidth",
    "description" => __("This setting will work only by tabs count lower then 9 tabs", DPTPLNAME)
	));
vc_add_param("vc_tabs", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => "Use diamond navigation?",
	"value" => array("Yes, please" => "true" ),
	"param_name" => "diamond_style"
	));
vc_add_param("vc_tabs", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Diamond navigation position",
			'value' => array(
				__( 'Top', DPTPLNAME ) => 'top',
				__( 'Bottom', DPTPLNAME ) => 'bottom'
			),
	"param_name" => "diamond_navigation_position",
	"dependency" => Array('element' => "diamond_style", 'value' => array('true'))
	));
	  

// Accordion
vc_map( array(
	'name' => __( 'DP Accordion', 'js_composer' ),
	'base' => 'vc_accordion',
	'show_settings_on_create' => false,
	'is_container' => true,
	'icon' => 'icon-wpb-ui-accordion',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Collapsible content panels', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text used as widget title (Note: located above content element).', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Active section', 'js_composer' ),
			'param_name' => 'active_tab',
			'value' => 1,
			'description' => __( 'Enter section number to be active on load or enter "false" to collapse all sections.', 'js_composer' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Allow collapse all sections?', 'js_composer' ),
			'param_name' => 'collapsible',
			'description' => __( 'If checked, it is allowed to collapse all sections.', 'js_composer' ),
			'value' => array( __( 'Yes', 'js_composer' ) => 'yes' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Disable keyboard interactions?', 'js_composer' ),
			'param_name' => 'disable_keyboard',
			'description' => __( 'If checked, disables keyboard arrow interactions (Keys: Left, Up, Right, Down, Space).', 'js_composer' ),
			'value' => array( __( 'Yes', 'js_composer' ) => 'yes' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
		)
	),
	'custom_markup' => '
<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
%content%
</div>
<div class="tab_controls">
    <a class="add_tab" title="' . __( 'Add section', 'js_composer' ) . '"><span class="vc_icon"></span> <span class="tab-label">' . __( 'Add section', 'js_composer' ) . '</span></a>
</div>
',
	'default_content' => '
    [vc_accordion_tab title="' . __( 'Section 1', 'js_composer' ) . '"][/vc_accordion_tab]
    [vc_accordion_tab title="' . __( 'Section 2', 'js_composer' ) . '"][/vc_accordion_tab]
',
	'js_view' => 'VcAccordionView'
) );

vc_add_param("vc_accordion_tab", array(
	"type" => "icon_selector",
	"admin_label" => true,
	"class" => "",
	"heading" => __("Icon", DPTPLNAME),
	"param_name" => "icon",
	"description" => ""
));



// Vertical tabs

$tab_id_1 = time().'-1-'.rand(0, 100);
$tab_id_2 = time().'-2-'.rand(0, 100);
WPBMap::map( 'vc_tour', array(
  "name" => __("Vertical Tabs", DPTPLNAME),
  "base" => "vc_tour",
  "show_settings_on_create" => false,
  "is_container" => true,
  "container_not_allowed" => true,
  "icon" => "icon-wpb-ui-tab-content-vertical",
  "category" => __('Content', DPTPLNAME),
  "wrapper_class" => "clearfix",
  "description" => __('Vertical tabbed content', DPTPLNAME),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", DPTPLNAME),
      "param_name" => "title",
      "description" => __("Enter text which will be used as widget title. Leave blank if no title is needed.", DPTPLNAME)
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Auto rotate slides", DPTPLNAME),
      "param_name" => "interval",
      "value" => array(__("Disable", DPTPLNAME) => 0, 3, 5, 10, 15),
      "std" => 0,
      "description" => __("Auto rotate slides each X seconds.", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", DPTPLNAME),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", DPTPLNAME)
    )
  ),
  "custom_markup" => '  
  <div class="wpb_tabs_holder wpb_holder clearfix vc_container_for_children">
  <ul class="tabs_controls">
  </ul>
  %content%
  </div>'
  ,
  'default_content' => '
  [vc_tab title="'.__('Slide 1','js_composer').'" tab_id="'.$tab_id_1.'"][/vc_tab]
  [vc_tab title="'.__('Slide 2','js_composer').'" tab_id="'.$tab_id_2.'"][/vc_tab]
  ',
  "js_view" => ('VcTabsView' )
) );

/* VC Gallery */
vc_map( array(
	'name' => __( 'Image Gallery', 'js_composer' ),
	'base' => 'vc_gallery',
	'icon' => 'icon-wpb-images-stack',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Responsive image gallery', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Gallery type', 'js_composer' ),
			'param_name' => 'type',
			'value' => array(
				__( 'Flex slider fade', 'js_composer' ) => 'flexslider_fade',
				__( 'Flex slider slide', 'js_composer' ) => 'flexslider_slide',
				__( 'Nivo slider', 'js_composer' ) => 'nivo',
				__( 'Nivo slider with thumb nav', 'js_composer' ) => 'nivo_thumb',
				__( 'Image grid', 'js_composer' ) => 'image_grid',
			),
			'description' => __( 'Select gallery type.', 'js_composer' )
		),
		array(
					"type" => "dropdown",
					"heading" => __("Slideshow navigation type", DPTPLNAME),
					"param_name" => "navigation",
					"value" => array(
						"Both" => "",
						"Only direction nav" => "nav-dir",	
						"Only pagination" => "nav-pag",
						"No navigation" => "nav-none"
					),
			'description' => __( 'Select navigation type for slideshow.', DPTPLNAME ),
			'dependency' => array(
				'element' => 'type',
				'value' => array( 'flexslider_fade', 'flexslider_slide', 'nivo', 'nivo_thumb' )
			)
				),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Auto rotate slides', 'js_composer' ),
			'param_name' => 'interval',
			'value' => array( 3, 5, 10, 15, __( 'Disable', 'js_composer' ) => 0 ),
			'description' => __( 'Auto rotate slides each X seconds.', 'js_composer' ),
			'dependency' => array(
				'element' => 'type',
				'value' => array( 'flexslider_fade', 'flexslider_slide', 'nivo' )
			)
		),
		array(
			'type' => 'attach_images',
			'heading' => __( 'Images', 'js_composer' ),
			'param_name' => 'images',
			'value' => '',
			'description' => __( 'Select images from media library.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Image size', 'js_composer' ),
			'param_name' => 'img_size',
			'description' => __( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'On click', 'js_composer' ),
			'param_name' => 'onclick',
			'value' => array(
				__( 'Open prettyPhoto', 'js_composer' ) => 'link_image',
				__( 'Do nothing', 'js_composer' ) => 'link_no',
				__( 'Open custom link', 'js_composer' ) => 'custom_link'
			),
			'description' => __( 'Define action for onclick event if needed.', 'js_composer' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => __( 'Custom links', 'js_composer' ),
			'param_name' => 'custom_links',
			'description' => __( 'Enter links for each slide here. Divide links with linebreaks (Enter) . ', 'js_composer' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Custom link target', 'js_composer' ),
			'param_name' => 'custom_links_target',
			'description' => __( 'Select where to open  custom links.', 'js_composer' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			),
			'value' => $target_arr
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

/* Dynamicpress elements
---------------------------------------------------------- */
// DP Space
		vc_map( array(
			'name' => __('Spacer', DPTPLNAME),
			'base' => 'space',
			'class' => '',
		  	'icon' => 'icon-wpb-spacer',
		    'category' =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
		    'description' => __('Blank space at a certain height ', DPTPLNAME),
			'params' => array(
				array(
				  "type" => "number",
				  "class" => "",
				  "heading" => __("Size in px", DPTPLNAME),
				  "param_name" => "size",
				  "value" => "5",
				  "admin_label" => true,
				  "min"=>"1",
				  "suffix"=>"px"
				)

			)
		) );

// DP Headline
		vc_map( array(
			'name' => __('DP Headline', DPTPLNAME),
			'base' => 'headline',
			'class' => '',
		  	'icon' => 'icon-wpb-heading',
		    'category' =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
      		'description' => __("Headline block", DPTPLNAME),
			'params' => array(
				array(
					"type" => "dropdown",
					"heading" => __("Style", DPTPLNAME),
					"param_name" => "style",
					"value" => array(
						"Default" => "",
						"Small underlined" => "heading-line",	
						"Big with subtitle" => "big",
						"Medium underlined" => "medium"
					),
					"description" => "",
				),
			array(
				"type" => "textfield",
				"heading" => __("Headline title", DPTPLNAME),
				"param_name" => "content",
				"holder" => "div",
				"value" => "Heading",
				"value" => __("This is header", DPTPLNAME)
			),
			array(
				"type" => "textfield",
				"heading" => __("Headline subtitle", DPTPLNAME),
				"param_name" => "subtitle",
				"admin_label" => true,
				"value" => "",
				"dependency" => Array('element' => "style", 'value' => array('big'))
			),
			array(
				"type" => "dropdown",
				"heading" => __("Headline alignment", DPTPLNAME),
				"param_name" => "hedaline_alignment",
				"admin_label" => true,
				"value" => array(
						"Left" => "headline-align-left",
						"Center" => "headline-align-center",	
						"Right" => "headline-align-right"
					),
				"dependency" => Array('element' => "style", 'value' => array('big'))
			),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Force custom text color', DPTPLNAME ),
			'param_name' => 'customcolor',
			'description' => __( 'Select custom color for header.', DPTPLNAME )
		),
			array(
			  "type" => "textfield",
			  "holder" => "div",
			  "heading" => __("Custom CSS class", DPTPLNAME),
			  "param_name" => "cssclass",
			  "description" => ""
    )
			)
		) );

// DP Toggle (FAQ)
vc_map( array(
  "name" => __("FAQ", DPTPLNAME),
  "base" => "faq",
  "icon" => "icon-wpb-faq",
  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  "description" => __('Toggle element with icon', DPTPLNAME),
  "params" => array(
    array(
      "type" => "textfield",
      "class" => "toggle_title",
      "heading" => __("Title", DPTPLNAME),
      "param_name" => "title",
	  "admin_label" => true,
      "value" => __("FAQ title", DPTPLNAME),
      "description" => __("FAQ block title.", DPTPLNAME)
    ),
	array(
	"type" => "icon_selector",
	"admin_label" => true,
	"class" => "",
	"heading" => __("Icon", DPTPLNAME),
	"param_name" => "icon",
	"value" => "icon-help-circled-1",
	"description" => ""
	),
    array(
      "type" => "textarea_html",
      "class" => "toggle_content",
      "heading" => __("FAQ content", DPTPLNAME),
      "param_name" => "content",
      "value" => __("<p>FAQ content goes here, click edit button to change this text.</p>", DPTPLNAME),
      "description" => __("FAQ block content.", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", DPTPLNAME),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", DPTPLNAME)
    )
  )
) );
// Progress bar shortcode

vc_map( array(
	'name' => __( 'Progress Bar', DPTPLNAME ),
	'base' => 'vc_progress_bar',
	'icon' => 'icon-wpb-graph',
	'category' => __( 'Content', DPTPLNAME ),
	'description' => __( 'Animated progress bar', DPTPLNAME ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', DPTPLNAME ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', DPTPLNAME )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => __( 'Graphic values', DPTPLNAME ),
			'param_name' => 'values',
			'description' => __( 'Input graph values here. Divide values with linebreaks (Enter). Example: 90|Development', DPTPLNAME ),
			'value' => "90|Development,80|Design,70|Marketing"
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Units', DPTPLNAME ),
			'param_name' => 'units',
			'description' => __( 'Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.', DPTPLNAME )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Bar color', DPTPLNAME ),
			'param_name' => 'bgcolor',
			'value' => array(
				__( 'Grey', DPTPLNAME ) => 'bar_grey',
				__( 'Blue', DPTPLNAME ) => 'bar_blue',
				__( 'Turquoise', DPTPLNAME ) => 'bar_turquoise',
				__( 'Green', DPTPLNAME ) => 'bar_green',
				__( 'Orange', DPTPLNAME ) => 'bar_orange',
				__( 'Red', DPTPLNAME ) => 'bar_red',
				__( 'Black', DPTPLNAME ) => 'bar_black',
				__( 'Custom Color', DPTPLNAME ) => 'custom'
			),
			'description' => __( 'Select bar background color.', DPTPLNAME ),
			'admin_label' => true
		),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Bar custom color', DPTPLNAME ),
			'param_name' => 'custombgcolor',
			'description' => __( 'Select custom background color for bars.', DPTPLNAME ),
			'dependency' => array( 'element' => 'bgcolor', 'value' => array( 'custom' ) )
		),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Text custom color', DPTPLNAME ),
			'param_name' => 'customtxtcolor',
			'description' => __( 'Select custom text color for bars.', DPTPLNAME )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Options', DPTPLNAME ),
			'param_name' => 'options',
			'value' => array(
				__( 'Add Stripes?', DPTPLNAME ) => 'striped'
			)
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', DPTPLNAME ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', DPTPLNAME )
		)
	)
) );

// DP Progress bar shortcode
vc_map( array(
		"name" => __("DP Progress Bar", DPTPLNAME),
		"base" => "progress_bar",
   		'admin_enqueue_css' => array(get_template_directory_uri().'/dynamo_framework/vc_extend/dp_vc_admin.css'),
		"icon" => "icon-wpb-progress_bar",
		"category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  		"description" => __('Animated progress bar', DPTPLNAME),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Title", DPTPLNAME),
				"admin_label" => true,
				"param_name" => "title",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Title Color", DPTPLNAME),
				"param_name" => "titlecolor",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Percentage", DPTPLNAME),
				"admin_label" => true,
				"param_name" => "percent",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Bar color", DPTPLNAME),
				"param_name" => "barcolor",
				"description" => ""
			)
		)
) );
// Piechart shortcode
vc_map( array(
		"name" => __("DP Pie Chart", DPTPLNAME),
		"base" => "piechart",
   		'admin_enqueue_css' => array(get_template_directory_uri().'/dynamo_framework/vc_extend/dp_vc_admin.css'),
		"icon" => "icon-wpb-pie-chart",
		"category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				 "type" => "number",
				 "class" => "",
				 "heading" => __("Size", DPTPLNAME),
				 "description" => "Size of chart in px",
				 "param_name" => "size",
				 "value" => "200",
				 "min"=>"50",
				 "suffix"=>"px"
			),
			array(
				"type" => "number",
				"class" => "",
				"heading" => __("Bar line width", DPTPLNAME),
				"param_name" => "linewidth",
				 "value" => "5",
				 "min"=>"1",
				 "suffix"=>"px"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Percentage", DPTPLNAME),
				"admin_label" => true,
				"param_name" => "percent",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Percent color", DPTPLNAME),
				"param_name" => "percentcolor",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Bar color", DPTPLNAME),
				"param_name" => "barcolor",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Track color", DPTPLNAME),
				"param_name" => "trackcolor",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Text color", DPTPLNAME),
				"param_name" => "textcolor",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Title", DPTPLNAME),
				"param_name" => "title",
				"admin_label" => true,
			  	"value" => __("Pie Chart title", DPTPLNAME),
				"description" => ""
			),
			array(
			  "type" => "textarea_html",
			  "heading" => __("Description", DPTPLNAME),
			  "param_name" => "content",
			  "value" => __("<p>I am Pie Chart description.</p>", DPTPLNAME)
			  
    ),
			$add_dp_animation,
	)
) );

// Piechart 2 shortcode
vc_map( array(
		"name" => __("DP Pie Chart 2", DPTPLNAME),
		"base" => "piechart2",
   		'admin_enqueue_css' => array(get_template_directory_uri().'/dynamo_framework/vc_extend/dp_vc_admin.css'),
		"icon" => "icon-wpb-pie-chart",
		"category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
		"allowed_container_element" => 'vc_row',
      	"description" => __("Chart with background", DPTPLNAME),
		"params" => array(
			array(
				 "type" => "number",
				 "class" => "",
				 "heading" => __("Size", DPTPLNAME),
				 "description" => "Size of chart in px",
				 "param_name" => "size",
				 "value" => "200",
				 "min"=>"50",
				 "suffix"=>"px"
			),
			array(
				"type" => "number",
				"class" => "",
				"heading" => __("Bar line width", DPTPLNAME),
				"param_name" => "linewidth",
				 "value" => "5",
				 "min"=>"1",
				 "suffix"=>"px"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Percentage", DPTPLNAME),
				"admin_label" => true,
				"param_name" => "percent",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Percent color", DPTPLNAME),
				"param_name" => "percentcolor",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Bar color", DPTPLNAME),
				"param_name" => "barcolor",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Track color", DPTPLNAME),
				"param_name" => "trackcolor",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Background color", DPTPLNAME),
				"param_name" => "bgcolor",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Text color", DPTPLNAME),
				"param_name" => "textcolor",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Title", DPTPLNAME),
				"admin_label" => true,
				"param_name" => "title",
			  	"value" => __("Pie Chart title", DPTPLNAME),
				"description" => ""
			),
			array(
			  "type" => "textarea_html",
			  "heading" => __("Description", DPTPLNAME),
			  "param_name" => "content",
			  "value" => __("<p>I am Pie Chart description.</p>", DPTPLNAME),
    ),
			$add_dp_animation,
	)
) );
/* Dp Pricing column
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Pricing Column", DPTPLNAME),
  "base" => "pricing_column",
  "icon" => "icon-wpb-price-table",
  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  "description" => __('Pricing column for Pricing Table ', DPTPLNAME),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Title", DPTPLNAME),
	  "admin_label" => true,
      "param_name" => "title"
    ),
    array(
      "type" => "textfield",
      "heading" => __("Subitle", DPTPLNAME),
	  "admin_label" => true,
      "param_name" => "subtitle"
    ),
	array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => __("Column style", DPTPLNAME),
	  "param_name" => "column_style",
	  "value" => array(
		  "Default" => "",	
		  "Highlighted" => "premium",
		  "Highlighted on hover" => "highlighted",
		  "Custom" => "custom"
		  ),
	 "description" => ""
			),
	array(
			'type' => 'checkbox',
			'heading' => __( 'Highlight initialy?', DPTPLNAME ),
			'param_name' => 'inistate',
			'value' => array( __( 'Yes', DPTPLNAME ) => 'true' ),
			"description" => __('Check this box if you will highlight this column on page load.',DPTPLNAME),
		    "dependency" => Array('element' => "column_style", 'value' => array('highlighted'))
	),
	array(
	  "type" => "colorpicker",
	  "class" => "",
	  "heading" => __("Price background color", DPTPLNAME),
	  "param_name" => "price_bgcolor",
	  "value" => "",
	  "description" => __("Select price area background color", DPTPLNAME),
	  "dependency" => Array('element' => "column_style", 'value' => array('custom'))
	),
	array(
	  "type" => "colorpicker",
	  "class" => "",
	  "heading" => __("Price text color", DPTPLNAME),
	  "param_name" => "price_txtcolor",
	  "value" => "#fff",
	  "description" => __("Select price area text color", DPTPLNAME),
	  "dependency" => Array('element' => "column_style", 'value' => array('custom'))
	),
	array(
			'type' => 'checkbox',
			'heading' => __( 'Use image or icon?', DPTPLNAME ),
			'param_name' => 'useimage',
			'group' => 'Additional Icon/Image Settings',
			'value' => array( __( 'Yes', DPTPLNAME ) => 'true' ),
			"description" => __('Check this box if you will use additional icon or image in this column',DPTPLNAME)
	),
	array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => __("Image type", DPTPLNAME),
	  "param_name" => "image_type",
	  'group' => 'Additional Icon/Image Settings',
	  "value" => array(
		  "Icon" => "selector",	
		  "Full width image" => "image"
		  ),
	  "description" => __("Use an existing font icon or upload a custom image.", DPTPLNAME),
	  "dependency" => Array("element" => "useimage","value" => array("true")),
			),
	array(
	"type" => "icon_selector",
	"admin_label" => true,
	"class" => "",
	"heading" => __("Icon", DPTPLNAME),
	"param_name" => "icon",
	'group' => 'Additional Icon/Image Settings',
	"description" => "",
	"dependency" => Array("element" => "image_type","value" => array("selector")),
	),
	array(
								"type" => "number",
								"class" => "",
								"heading" => __("Icon size", DPTPLNAME),
								"param_name" => "icon_size",
								'group' => 'Additional Icon/Image Settings',
								"value" => 48,
								"min" => 12,
								"max" => 72,
								"suffix" => "px",
								"dependency" => Array("element" => "image_type","value" => array("selector")),
		),
	array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Icon Color", DPTPLNAME),
								"param_name" => "icon_color",
	  							'group' => 'Additional Icon/Image Settings',
								"value" => "#2e2a27",
								"description" => __("Select background color for icon.", DPTPLNAME),	
								"dependency" => Array("element" => "image_type","value" => array("selector")),
			),
	array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Icon Badge Style", DPTPLNAME),
								"param_name" => "icon_style",
								'group' => 'Additional Icon/Image Settings',
								"value" => array(
									"No badge" => "",
									"Circle" => "circle",
									"Square" => "square"
								),
								"dependency" => Array("element" => "image_type","value" => array("selector")),
	  ),
	array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Badge Background Color", DPTPLNAME),
								"param_name" => "icon_badge_color",
								'group' => 'Additional Icon/Image Settings',
								"value" => "#ffffff",
								"description" => __("Select background color for icon.", DPTPLNAME),	
								"dependency" => Array("element" => "icon_style", "value" => array("circle","square")),
			),
	array(
								"type" => "attach_image",
								"class" => "",
								"heading" => __("Upload Image:", DPTPLNAME),
								"param_name" => "image",
	  							'group' => 'Additional Icon/Image Settings',
								"value" => "",
								"description" => __("Upload the custom image icon.", DPTPLNAME),
								"dependency" => Array("element" => "image_type","value" => array("image")),
		),
    array(
      "type" => "textfield",
      "heading" => __("Price", DPTPLNAME),
      "param_name" => "price",
	  "admin_label" => true,
    ),
    array(
      "type" => "textfield",
      "heading" => __("Currency", DPTPLNAME),
      "param_name" => "currency"
    ),
	array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Currency position", DPTPLNAME),
				"param_name" => "currencypos",
				"value" => array(
					"After price" => "after",
					"Before price" => "before",	
				),
				"description" => ""
	),
	
    array(
      "type" => "textfield",
      "heading" => __("Price subtitle", DPTPLNAME),
      "param_name" => "price_sub"
    ),
	array(
				"type" => "textarea_html",
				"class" => "",
				"holder" => "div",
				"heading" => __("Column contentt", DPTPLNAME),
				"param_name" => "content",
				"description" => "",
				"value" => __("Enter column content here", DPTPLNAME)
	),
	array(
			'type' => 'checkbox',
			'heading' => __( 'Use arrowed style?', DPTPLNAME ),
			'param_name' => 'arrowed',
			'value' => array( __( 'Yes', DPTPLNAME ) => 'true' ),
			"description" => "Check this box if you will use down arrow bellow price block",
	),
	array(
			'type' => 'checkbox',
			'heading' => __( 'Use ribbon?', DPTPLNAME ),
			'param_name' => 'ribbon',
			'value' => array( __( 'Yes', DPTPLNAME ) => 'true' ),
			"description" => "Check this box if you will use additional ribbon in right top corner",
	),
    array(
      "type" => "textfield",
      "heading" => __("Ribbon text", DPTPLNAME),
      "param_name" => "ribbon_text",
	  "dependency" => Array('element' => "ribbon", 'value' => array('true'))
    ),
	array(
	  "type" => "colorpicker",
	  "class" => "",
	  "heading" => __("Ribbon background color", DPTPLNAME),
	  "param_name" => "ribbon_bgcolor",
	  "value" => "#88B700",
	  "description" => __("Select ribbon background color", DPTPLNAME),
	  "dependency" => Array('element' => "ribbon", 'value' => array('true'))
	),
	array(
	  "type" => "colorpicker",
	  "class" => "",
	  "heading" => __("Ribbon text color", DPTPLNAME),
	  "param_name" => "ribbon_txtcolor",
	  "value" => "#fff",
	  "description" => __("Select ribbon text color", DPTPLNAME),
	  "dependency" => Array('element' => "ribbon", 'value' => array('true'))
	),
    array(
      "type" => "textfield",
      "heading" => __("Link", DPTPLNAME),
      "param_name" => "link",
	  "description" => "Link for button. If you leave this field blank button will be not displayed.",
    ),
    array(
      "type" => "textfield",
      "heading" => __("Button text", DPTPLNAME),
      "param_name" => "button_txt",
	  "value" => __("Buy Now", DPTPLNAME)
    ),
	array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Button style ",DPTPLNAME),
				"param_name" => "button_style",
				"value" => array(
					"Default" => "",	
					"Dark" => "dark",	
					"Light" => "light",
					"White" => "white",
					"Blue" => "blue",
					"Green" => "green",
					"Orange" => "orange",
					"Yellow" => "yellow",
					"Red" => "red",
					"Purple" => "purple",				
					"Pink" => "pink",
					"Gray" => "gray",
					"Default Bordered" => "line",
					"White Bordered" => "line-white",
					"Dark Bordered" => "line-dark",
					"Blue Bordered" => "line-blue",
					"Green Bordered" => "line-green",
					"Orange Bordered" => "line-orange",
					"Yellow Bordered" => "line-yellow",
					"Red Bordered" => "line-red",
					"Purple Bordered" => "line-purple",				
					"Pink Bordered" => "line-pink",
					"Gray Bordered" => "line-gray",
					"Readmore only" => "readmore"
				),
							"description" => __("Select button style.",DPTPLNAME)
			),

	
  )
) );

/* DP Button */
vc_map( array(
		"name" => __("DP Button", DPTPLNAME),
		"base" => "button",
		"category" => __('by Dynamicpress', DPTPLNAME),
		"icon" => "icon-wpb-dp-button",
		"description" => __('Custom button with icon ', DPTPLNAME),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Size", DPTPLNAME),
				"param_name" => "size",
				"value" => array(
					"Small" => "small",	
					"Large" => "large",	
					"Extra Large" => "extralarge",
					"Extra Large Bold with Subtitle" => "extralargebold",
					
				),
				"description" => ""
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Button Title", DPTPLNAME),
				"param_name" => "content",
				"description" => "",
	  			"admin_label" => true,
				"value" => __("Button title", DPTPLNAME)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Button Subtitle", DPTPLNAME),
				"param_name" => "subtitle",
				"description" => "",
	  			"admin_label" => true,
				"value" => __("Button subtitle", DPTPLNAME),
				"dependency" => Array('element' => "size", 'value' => array('extralargebold'))
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Style", DPTPLNAME),
				"param_name" => "style",
				"value" => array(
					"Default" => "",	
					"Dark" => "dark",	
					"Light" => "light",
					"White" => "white",
					"Blue" => "blue",
					"Green" => "green",
					"Orange" => "orange",
					"Yellow" => "yellow",
					"Red" => "red",
					"Purple" => "purple",				
					"Pink" => "pink",
					"Gray" => "gray",
					"Default Bordered" => "line",
					"White Bordered" => "line-white",
					"Dark Bordered" => "line-dark",
					"Blue Bordered" => "line-blue",
					"Green Bordered" => "line-green",
					"Orange Bordered" => "line-orange",
					"Yellow Bordered" => "line-yellow",
					"Red Bordered" => "line-red",
					"Purple Bordered" => "line-purple",				
					"Pink Bordered" => "line-pink",
					"Gray Bordered" => "line-gray",
					"-------------------------------------" => "",
					"Custom" => "custom"
				),
				"description" => ""
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button background color", DPTPLNAME),
				"param_name" => "bgcolor",
				"value" => "",
				"description" => __("Select button background color", DPTPLNAME),
				"dependency" => Array('element' => "style", 'value' => array('custom'))
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button text color", DPTPLNAME),
				"param_name" => "textcolor",
				"value" => "",
				"description" => __("Select button text color", DPTPLNAME),
				"dependency" => Array('element' => "style", 'value' => array('custom'))
			),			
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button hover state background color", DPTPLNAME),
				"param_name" => "hbgcolor",
				"value" => "",
				"description" => __("Select hover state background color", DPTPLNAME),
				"dependency" => Array('element' => "style", 'value' => array('custom'))
			),			
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Hover state text color", DPTPLNAME),
				"param_name" => "htextcolor",
				"value" => "",
				"description" => __("Select hover state text color", DPTPLNAME),
				"dependency" => Array('element' => "style", 'value' => array('custom'))
			),			
			array(
				"type" => "icon_selector",
				"class" => "",
				"heading" => __("Icon", DPTPLNAME),
				"param_name" => "icon",
	  			"admin_label" => true
				),
			array(
				"type" => "dropdown",
				"heading" => __("Button alignment", DPTPLNAME),
				"param_name" => "align",
				"value" => array(
					"None" => "",
					"Center" => "center",	
					"Right" => "right"
				),
				"description" => "",
			),
			$add_dp_animation,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Link", DPTPLNAME),
				"param_name" => "link",
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Open in", DPTPLNAME),
				"param_name" => "linktarget",
				"value" => array(
					"The same window" => "_self",
					"New window" => "_blank",	
					"Parent" => "_parent"
				),
				"description" => "",
			)
		)
) );

/* Button Group */

vc_map( array(
    "name" => __("DP Button Group", DPTPLNAME),
    "base" => "buttongroup",
	"icon" => "icon-wpb-buttongroup",
    "as_parent" => array('only' => 'buttongroup_item,buttongroup_sep,buttongroup_dropdown'),
  	"category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
    "content_element" => true,
    "show_settings_on_create" => false,
	"description" =>  __('Bootsrap style button group container', DPTPLNAME),
    "params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Size", DPTPLNAME),
				"param_name" => "size",
				"value" => array(
					"Small" => "",	
					"Large" => "large",	
					"Extra Large" => "extralarge"
				),
				"description" => ""
			),
			array(
				 "type" => "number",
				 "class" => "",
				 "heading" => __("Border radius", DPTPLNAME),
				"description" => __("Border radius in px ", DPTPLNAME),
				"param_name" => "radius",
				 "value" => "4",
				 "min"=>"0",
				 "suffix"=>"px"
			),
			array(
				"type" => "dropdown",
				"heading" => __("Group Alignment", DPTPLNAME),
				"param_name" => "align",
				"value" => array(
					"Center" => "center",
					"Left" => "left",
					"Right" => "right"
				),
				"description" => "",
			),
		array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Force equal width of the buttons in group?",
				"value" => array("Yes, please" => "true" ),
				"param_name" => "equal_width"
		),
    ),
    "js_view" => 'VcColumnView'
) );

/* DP Group Button */
vc_map( array(
		"name" => __("Button", DPTPLNAME),
		"base" => "buttongroup_item",
		"category" => __('by Dynamicpress', DPTPLNAME),
		"icon" => "icon-wpb-buttongroup-item",
		"description" => __('Button in button group', DPTPLNAME),
    	"as_child" => array('only' => 'buttongroup'), 
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Button Text", DPTPLNAME),
				"param_name" => "text",
				"description" => "",
	  			"admin_label" => true,
				"value" => __("Button Text", DPTPLNAME)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Button Subtext", DPTPLNAME),
				"param_name" => "subtext",
				"description" => "",
				"value" => ""
			),
			array(
				"type" => "icon_selector",
				"class" => "",
				"heading" => __("Icon", DPTPLNAME),
				"param_name" => "icon",
	  			"admin_label" => true
				),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Icon position", DPTPLNAME),
				"param_name" => "icon_position",
				"value" => array(
					"Left" => "left",	
					"Right" => "right"
				),
				"description" => ""
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button background color", DPTPLNAME),
				"param_name" => "bgcolor",
				"value" => "#3296dc",
				"description" => __("Select button background color", DPTPLNAME)
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button Text Color", DPTPLNAME),
				"param_name" => "textcolor",
				"value" => "#fff",
				"description" => __("Select button text color", DPTPLNAME)
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button Border Color", DPTPLNAME),
				"param_name" => "bordercolor",
				"value" => "#3296dc",
				"description" => __("Select button border color", DPTPLNAME)
			),
			 array(
				"type" => "colorpicker",
				"class" => "#2e2a27",
				"heading" => __("Button hover background color", DPTPLNAME),
				"param_name" => "hbgcolor",
				"value" => "",
				"description" => __("Select button hover background color", DPTPLNAME)
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button hover text Color", DPTPLNAME),
				"param_name" => "htextcolor",
				"value" => "#fff",
				"description" => __("Select button hover text color", DPTPLNAME)
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button Hover Border Color", DPTPLNAME),
				"param_name" => "hbordercolor",
				"value" => "#2e2a27",
				"description" => __("Select button hover border color", DPTPLNAME)
			),			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Button Link", DPTPLNAME),
				"param_name" => "link",
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Open in", DPTPLNAME),
				"param_name" => "linktarget",
				"value" => array(
					"The same window" => "_self",
					"New window" => "_blank",	
					"Parent" => "_parent"
				),
				"description" => "",
			),
		)
) );

/* DP Group Dropdown Button */
vc_map( array(
		"name" => __("Dropdown Button", DPTPLNAME),
		"base" => "buttongroup_dropdown",
		"category" => __('by Dynamicpress', DPTPLNAME),
		"icon" => "icon-wpb-buttongroup-item",
		"description" => __('Dropdown Button in button group', DPTPLNAME),
    	"as_child" => array('only' => 'buttongroup'), 
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Button Text", DPTPLNAME),
				"param_name" => "text",
				"description" => "",
	  			"admin_label" => true,
				"value" => __("Button Text", DPTPLNAME)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Button Subtext", DPTPLNAME),
				"param_name" => "subtext",
				"description" => "",
				"value" => ""
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button background color", DPTPLNAME),
				"param_name" => "bgcolor",
				"value" => "#3296dc",
				"description" => __("Select button background color", DPTPLNAME)
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button Text Color", DPTPLNAME),
				"param_name" => "textcolor",
				"value" => "#fff",
				"description" => __("Select button text color", DPTPLNAME)
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button Border Color", DPTPLNAME),
				"param_name" => "bordercolor",
				"value" => "#3296dc",
				"description" => __("Select button border color", DPTPLNAME)
			),
			 array(
				"type" => "colorpicker",
				"class" => "#2e2a27",
				"heading" => __("Button hover background color", DPTPLNAME),
				"param_name" => "hbgcolor",
				"value" => "",
				"description" => __("Select button hover background color", DPTPLNAME)
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button hover text Color", DPTPLNAME),
				"param_name" => "htextcolor",
				"value" => "#fff",
				"description" => __("Select button hover text color", DPTPLNAME)
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button Hover Border Color", DPTPLNAME),
				"param_name" => "hbordercolor",
				"value" => "#2e2a27",
				"description" => __("Select button hover border color", DPTPLNAME)
			),
			array(
			  "type" => "dropdown",
			  "heading" => __("Dropdown Mode", DPTPLNAME),
			  "param_name" => "mode",
			  "group" => "Dropdown Content",
			  "value" => array(
					"On click" => "onclick",	
					"On hover" => "onhover"
				),			  
				"description" => "Select dropdown expand event"
			),
			array(
			  "type" => "dropdown",
			  "heading" => __("Dropdown Source", DPTPLNAME),
			  "param_name" => "source_type",
			  "group" => "Dropdown Content",
			  "value" => array(
					"Menu" => "menu",	
					"HTML content" => "html"
				),			  
				"description" => "Select dropdown content type"
			),
			array(
			  "type" => "dropdown",
			  "heading" => __("Menu", DPTPLNAME),
			  "param_name" => "menu",
			  "group" => "Dropdown Content",
			  "value" => $menus,
			  "description" => "Select menu from available menus list",
			  'dependency' => array( 'element' => 'source_type', 'value' => array('menu'))	  
			),
			array(
			  "type" => "textarea_html",
			  "heading" => __("HTML content", DPTPLNAME),
			  "param_name" => "content",
			  "group" => "Dropdown Content",
			  "value" => __("This is sample dropdown HTML", DPTPLNAME),
			  'dependency' => array( 'element' => 'source_type', 'value' => array('html'))	  
			),
		
		)
) );

/* DP Group Button Separator */
vc_map( array(
		"name" => __("Button Separator", DPTPLNAME),
		"base" => "buttongroup_sep",
		"category" => __('by Dynamicpress', DPTPLNAME),
		"icon" => "icon-wpb-buttongroup-sep",
		"description" => __('Button separator', DPTPLNAME),
    	"as_child" => array('only' => 'buttongroup'), 
		"params" => array(
			array(
				 "type" => "number",
				 "class" => "",
				 "heading" => __("Separator width", DPTPLNAME),
				"description" => __("Widt of separator in px ", DPTPLNAME),
				"param_name" => "s_width",
				 "value" => "2",
				 "min"=>"0",
				 "suffix"=>"px"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Separator background color", DPTPLNAME),
				"param_name" => "s_bgcolor1",
				"value" => "#fff",
				"description" => __("Select separator background color", DPTPLNAME)
			),
		array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Use round badge in separator?",
				"value" => array("Yes, please" => "true" ),
				"param_name" => "use_badge"
		),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Separator badge text Text", DPTPLNAME),
				"param_name" => "s_text",
				"description" => "",
	  			"admin_label" => true,
				"value" => __("or", DPTPLNAME),
				'dependency' => array( 'element' => 'use_badge', 'not_empty' => true)
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Separator background color", DPTPLNAME),
				"param_name" => "s_bgcolor",
				"value" => "#fff",
				"description" => __("Select separator background color", DPTPLNAME),
				'dependency' => array( 'element' => 'use_badge', 'not_empty' => true)
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Separator Text Color", DPTPLNAME),
				"param_name" => "s_textcolor",
				"value" => "#2e2a27",
				"description" => __("Select separator text color", DPTPLNAME),
				'dependency' => array( 'element' => 'use_badge', 'not_empty' => true)
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Separator Border Color", DPTPLNAME),
				"param_name" => "s_bordercolor",
				"value" => "#fff",
				"description" => __("Select separator border color", DPTPLNAME),
				'dependency' => array( 'element' => 'use_badge', 'not_empty' => true)
			),
		)
) );

class WPBakeryShortCode_buttongroup extends WPBakeryShortCodesContainer {
}
class WPBakeryShortCode_buttongroup_item extends WPBakeryShortCode {
}
class WPBakeryShortCode_buttongroup_sep extends WPBakeryShortCode {
}
class WPBakeryShortCode_buttongroup_dropdown extends WPBakeryShortCode {
}


/* Team box
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Team box", DPTPLNAME),
  "base" => "teambox",
  "icon" => "icon-wpb-teambox",
  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  "description" => __('Team member presentation box', DPTPLNAME),
  "params" => array(
   array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => __("Style", DPTPLNAME),
	  "param_name" => "type",
			"value" => array(
				"Default" => "",
				"VCard" => "vcard",
				"Animated Flipbox" => "animated"
			),
	  "description" => ""
	),
		array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Highlited teambox?",
				"value" => array("Yes, please" => "true" ),
				"param_name" => "highligth",
				"dependency" => Array('element' => "type", 'value' => array('vcard'))		),
	array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Back side background color", DPTPLNAME),
				"param_name" => "back_bgcolor",
				"value" => "#2e2a27",
				"description" => __("Select back side background color", DPTPLNAME),
				"dependency" => Array('element' => "type", 'value' => array('animated'))
		),			
    array(
      "type" => "textfield",
      "heading" => __("Name", DPTPLNAME),
      "param_name" => "name",
	  "admin_label" => true,
      "value" => __("John Smith", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Position", DPTPLNAME),
	  "admin_label" => true,
      "param_name" => "position",
      "value" => __("Chief Executive Officer / CEO", DPTPLNAME)
    ),
	 array(
      "type" => "attach_image",
      "heading" => __("Image", DPTPLNAME),
      "param_name" => "imgurl",
      "value" => "",
      "description" => __("Select image from media library.", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Twitter link", DPTPLNAME),
      "param_name" => "twitter",
	  "description" => __("If you leave this field blank link will be not displayed", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Facebook link", DPTPLNAME),
      "param_name" => "facebook",
	  "description" => __("If you leave this field blank link will be not displayed", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Google+ link", DPTPLNAME),
      "param_name" => "gplus",
	  "description" => __("If you leave this field blank link will be not displayed", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Linkedin link", DPTPLNAME),
      "param_name" => "linkedin",
	  "description" => __("If you leave this field blank link will be not displayed", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("RSS link", DPTPLNAME),
      "param_name" => "rss",
	  "description" => __("If you leave this field blank link will be not displayed", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Flickr", DPTPLNAME),
      "param_name" => "flickr",
	  "description" => __("If you leave this field blank link will be not displayed", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Dribble link", DPTPLNAME),
      "param_name" => "dribble",
	  "description" => __("If you leave this field blank link will be not displayed", DPTPLNAME)
    ),
    array(
      "type" => "textarea_html",
      "heading" => __("Description", DPTPLNAME),
      "param_name" => "content",
      "value" => __("<p>Team member activity description</p>", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", DPTPLNAME),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", DPTPLNAME)
    )
  )
) );

// Counter shortcode
vc_map( array(
		"name" => __("DP Counter", DPTPLNAME),
		"base" => "counter",
		"icon" => "icon-wpb-counter",
		"category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
		"allowed_container_element" => 'vc_row',
      	"description" => __("Animated counter", DPTPLNAME),
		"params" => array(
			 array(
			  "type" => "dropdown",
			  "class" => "",
			  "heading" => __("General style", DPTPLNAME),
			  "param_name" => "counter_style",
					"value" => array(
						"Vertical (default)" => "",
						"Horizontal" => "horizontal"
					),
			  "description" => "",
			  'dependency' => array( 'element' => 'icon', 'not_empty' => true)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Counter title", DPTPLNAME),
				"param_name" => "content",
	  			"admin_label" => true,
				"value" => __("Counter title", DPTPLNAME)
			),
			array(
				"type" => "icon_selector",
				"class" => "",
				"heading" => __("Icon", DPTPLNAME),
				"param_name" => "icon",
	  			"admin_label" => true
				),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Icon color", DPTPLNAME),
				"param_name" => "iconcolor",
				"description" => "",
				'dependency' => array( 'element' => 'icon', 'not_empty' => true)
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Icon badge color", DPTPLNAME),
				"param_name" => "badgecolor",
				"description" => "",
				'dependency' => array( 'element' => 'icon', 'not_empty' => true)
			),
			 array(
			  "type" => "dropdown",
			  "class" => "",
			  "heading" => __("Icon badge style", DPTPLNAME),
			  "param_name" => "badge_style",
					"value" => array(
						"No badge" => "",
						"Rounded" => "rounded",	
						"Rounded bordered" => "rounded bordered",	
						"Diamond" => "diamond",
						"Diamond bordered" => "diamond bordered"
					),
			  "description" => "",
			  'dependency' => array( 'element' => 'icon', 'not_empty' => true)
			),
			array(
				 "type" => "number",
				 "class" => "",
				 "heading" => __("Icon fontsize", DPTPLNAME),
				"description" => __("Icon fontsize in px ", DPTPLNAME),
				"param_name" => "iconfontsize",
				 "value" => "60",
				 "min"=>"10",
				 "suffix"=>"px",
				'dependency' => array( 'element' => 'icon', 'not_empty' => true)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Counter number value", DPTPLNAME),
				"param_name" => "number"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Number value by witch animation will be stopped", DPTPLNAME),
				"param_name" => "animate_stop",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Number sufix", DPTPLNAME),
				"param_name" => "number_sufix",
				"description" => "Text after animated number (eg K)"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Number color", DPTPLNAME),
				"param_name" => "numbercolor",
				"description" => ""
			),
			array(
				"type" => "number",
				"class" => "",
				"heading" => __("Number fontsize", DPTPLNAME),
				"param_name" => "fontsize",
				 "value" => "70",
				 "min"=>"10",
				 "suffix"=>"px",
				"description" => __("Number fontsize in px", DPTPLNAME)
			),

			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Title color color", DPTPLNAME),
				"param_name" => "titlecolor",
				"description" => ""
			),
			array(
			  "type" => "textfield",
			  "holder" => "div",
			  "heading" => __("Custom CSS class", DPTPLNAME),
			  "param_name" => "cssclass",
			  "description" => ""
    )
	)
) );

/* Testimonial
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Testimonial", DPTPLNAME),
  "base" => "testimonial",
  "icon" => "icon-wpb-testimonial",
  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  "description" => __('Testimonial with client image', DPTPLNAME),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Name", DPTPLNAME),
      "param_name" => "name",
	  "admin_label" => true,
      "value" => __("John Smith", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Position", DPTPLNAME),
      "param_name" => "position",
      "value" => __("CEO", DPTPLNAME)
    ),
	 array(
      "type" => "attach_image",
      "heading" => __("Image", DPTPLNAME),
      "param_name" => "img",
      "value" => "",
      "description" => __("Select image from media library.", DPTPLNAME)
    ),
    array(
      "type" => "textarea_html",
      "heading" => __("Testimonial content", DPTPLNAME),
      "param_name" => "content",
      "value" => __("Client testimonial content.", DPTPLNAME)
    ),
	$add_dp_animation,	
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", DPTPLNAME),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", DPTPLNAME)
    )
  )
) );

/* Alert box
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Notification Box", DPTPLNAME),
  "base" => "box",
  "icon" => "icon-wpb-alertbox",
  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  "description" => __('Box with notifications', DPTPLNAME),
  "params" => array(
     array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => __("Type", DPTPLNAME),
	  "param_name" => "type",
			"value" => array(
				"Success" => "success",	
				"Warning" => "warning",
				"Error" => "error",
				"Notice" => "notice"
			),
	  "description" =>  __('Select box style', DPTPLNAME)
	),

    array(
      "type" => "textfield",
      "heading" => __("Title", DPTPLNAME),
      "param_name" => "title",
      "value" => __("Success!", DPTPLNAME)
    ),
	array(
	"type" => "icon_selector",
	"class" => "",
	"heading" => __("Icon", DPTPLNAME),
	"param_name" => "icon",
	"admin_label" => true,
	"description" =>  __('Select icon to display before message', DPTPLNAME)
	),	 
    array(
      "type" => "textarea_html",
      "holder" => "div",
      "heading" => __("Content", DPTPLNAME),
      "param_name" => "content",
      "value" => __("Your message comes here.", DPTPLNAME)
    ),
     array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => __("Sticky?", DPTPLNAME),
	  "param_name" => "sticky",
			"value" => array(
				"No" => "no",	
				"Yes" => "yes"
			),
	  "description" =>  __('If selected yes box will be closeable', DPTPLNAME)
	),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", DPTPLNAME),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", DPTPLNAME)
    )
  )
) );

/* DP Gallery */
vc_map( array(
    "name" => __("DP Gallery", DPTPLNAME),
    "base" => "dp_gallery",
	"icon" => "icon-wpb-dp-gallery",
	"description" =>  __('Simple image grid gallery with lightbox', DPTPLNAME),
    "params" => array(
		array(
			'type' => 'attach_images',
			'heading' => __( 'Images', 'js_composer' ),
			'param_name' => 'images',
			'value' => '',
			'description' => __( 'Select images from media library.', 'js_composer' )
		),
	   array(
			"type" => "dropdown",
			"heading" => __("Columns count", DPTPLNAME),
			"param_name" => "columns",
			"admin_label" => true,
				"value" => array(
						"2" => "2",
						"3" => "3",
						"4" => "4",
						"5" => "5",
						"6" => "6",
						"8" => "8"		
				),
		  ),
		array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Use nomargin style?",
				"value" => array("Yes, please" => "true" ),
				"param_name" => "nomargin"
		),
		array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Use Grayscale images?",
				"value" => array("Yes, please" => "true" ),
				"param_name" => "grayscale"
		),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", DPTPLNAME),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", DPTPLNAME)
        )
    )
) );

class WPBakeryShortCode_dp_gallery extends WPBakeryShortCode {

	public function singleParamHtmlHolder( $param, $value ) {
		$output = '';
		// Compatibility fixes
		$old_names = array( 'yellow_message', 'blue_message', 'green_message', 'button_green', 'button_grey', 'button_yellow', 'button_blue', 'button_red', 'button_orange' );
		$new_names = array( 'alert-block', 'alert-info', 'alert-success', 'btn-success', 'btn', 'btn-info', 'btn-primary', 'btn-danger', 'btn-warning' );
		$value = str_ireplace( $old_names, $new_names, $value );
		$param_name = isset( $param['param_name'] ) ? $param['param_name'] : '';
		$type = isset( $param['type'] ) ? $param['type'] : '';
		$class = isset( $param['class'] ) ? $param['class'] : '';

		if ( isset( $param['holder'] ) == true && $param['holder'] !== 'hidden' ) {
			$output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">' . $value . '</' . $param['holder'] . '>';
		}
		if ( $param_name == 'images' ) {
			$images_ids = empty( $value ) ? array() : explode( ',', trim( $value ) );
			$output .= '<ul class="attachment-thumbnails' . ( empty( $images_ids ) ? ' image-exists' : '' ) . '" data-name="' . $param_name . '">';
			foreach ( $images_ids as $image ) {
				$img = wpb_getImageBySize( array( 'attach_id' => (int)$image, 'thumb_size' => 'thumbnail' ) );
				$output .= ( $img ? '<li>' . $img['thumbnail'] . '</li>' : '<li><img width="150" height="150" test="' . $image . '" src="' . vc_asset_url( 'vc/blank.gif' ) . '" class="attachment-thumbnail" alt="" title="" /></li>' );
			}
			$output .= '</ul>';
			$output .= '<a href="#" class="column_edit_trigger' . ( ! empty( $images_ids ) ? ' image-exists' : '' ) . '">' . __( 'Add images', 'js_composer' ) . '</a>';

		}
		return $output;
	}
}

/* DP Social Links */
vc_map( array(
    "name" => __("DP Social Links", DPTPLNAME),
    "base" => "social_links",
	"icon" => "icon-wpb-social-icons",
    "as_parent" => array('only' => 'social_link'),
  	"category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
    "content_element" => true,
    "show_settings_on_create" => false,
	"description" =>  __('Social icons block', DPTPLNAME),
    "params" => array(
		array(
			"type" => "dropdown",
			"heading" => __("Badge type", DPTPLNAME),
			"param_name" => "type",
			"value" => array(
					"Square" => "",
					"Rounded" => "rounded",
					"Diamond" => "diamond"	
				)
		),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => __("Custom icon color", DPTPLNAME),
			"param_name" => "icon_color",
			"value" => "",
			"description" => __("If you leave it blank icons will be by default #333", DPTPLNAME),
		),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", DPTPLNAME),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", DPTPLNAME)
        )
    ),
    "js_view" => 'VcColumnView'
) );
vc_map( array(
    "name" => __("DP Social Icon", DPTPLNAME),
    "base" => "social_link",
	"icon" => "icon-wpb-icon",
    "content_element" => true,
	"description" =>  __('Single social icon', DPTPLNAME),
    "as_child" => array('only' => 'social_links'), 
    "params" => array(		
		array(
			"type" => "dropdown",
			"heading" => __("Icon type", DPTPLNAME),
			"param_name" => "type",
			"admin_label" => true,
			"value" => array(
					"Facebook" => "facebook",
					"Twitter" => "twitter",
					"Linkedin" => "linkedin",		
					"Google Plus" => "gplus",		
					"Spotify" => "spotify",		
					"Yahoo" => "yahoo",		
					"Amazon" => "amazon",		
					"Appstore" => "appstore",		
					"Paypal" => "paypal",		
					"Blogger" => "blogger",		
					"Evernote" => "evernote",		
					"Instagram" => "instagram",		
					"Pinterest" => "pinterest",		
					"Dribbble" => "dribbble",		
					"Flickr" => "flickr",		
					"Youtube" => "youtube",		
					"Vimeo" => "vimeo",		
					"RSS" => "rss",		
					"Steam" => "steam",		
					"Tumblr" => "tumblr",		
					"Github" => "github",		
					"Delicious" => "delicious",		
					"Reddit" => "reddit",		
					"Lastfm" => "lastfm",		
					"Digg" => "digg",		
					"Forrst" => "forrst",		
					"Stumbleupon" => "stumbleupon",		
					"Wordpress" => "wordpress",		
					"Xing" => "xing",		
					"Dropbox" => "dropbox",		
					"Fivehundredpx" => "fivehundredpx"		
				)
		),
        array(
		  "type" => "textfield",
		  "heading" => __("Title", DPTPLNAME),
		  "param_name" => "title",
		  "description" =>  __("If you wish add title of link displayed in tooltip type it here", DPTPLNAME)
		),
        array(
		  "type" => "textfield",
		  "heading" => __("Icon link", DPTPLNAME),
		  "param_name" => "link"
		)
    )
) );

class WPBakeryShortCode_social_links extends WPBakeryShortCodesContainer {
}
class WPBakeryShortCode_social_link extends WPBakeryShortCode {
}

/* DP Google map */
vc_map( array(
    "name" => __("DP Google Map", DPTPLNAME),
    "base" => "dp_googlemap",
	"icon" => "icon-wpb-gmap",
    "as_parent" => array('only' => 'dp_googlemap_marker'),
  	"category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
    "content_element" => true,
    "show_settings_on_create" => false,
	"description" =>  __('Google map with multiple markers', DPTPLNAME),
    "params" => array(
		array(
			"type" => "dropdown",
			"heading" => __("Map center determined by", DPTPLNAME),
			"param_name" => "centertype",
			"value" => array(
					"Address" => "address",
					"Latitude and Longtitude" => "coordinates"	
				)
		),
        array(
            "type" => "textfield",
            "heading" => __("Map center address", DPTPLNAME),
            "param_name" => "address",
            "description" => __("Enter address of map center point.", DPTPLNAME),
			"dependency" => Array("element" => "centertype","value" => array("address")),			
        ),
        array(
            "type" => "textfield",
            "heading" => __("Map center latitude", DPTPLNAME),
            "param_name" => "lat",
            "description" => __("Enter latitude of map center point. You can use this <a href='http://www.latlong.net/' target='_blank'>link</a>", DPTPLNAME),
			"dependency" => Array("element" => "centertype","value" => array("coordinates"))			
        ),
        array(
            "type" => "textfield",
            "heading" => __("Map center longtitude", DPTPLNAME),
            "param_name" => "long",
            "description" => __("Enter longtitude of map center point. You can use this <a href='http://www.latlong.net/' target='_blank'>link</a>", DPTPLNAME),
			"dependency" => Array("element" => "centertype","value" => array("coordinates"))
        ),
		array(
				"type" => "number",
				"class" => "",
				"heading" => __("Map height", DPTPLNAME),
				"param_name" => "height",
				"value" => 300,
				"suffix" => "px",
				"min" => 0,
				"description" => __("Map width is allways 100% of parent container but width must be determined.", DPTPLNAME),
		),
		array(
				"type" => "number",
				"class" => "",
				"heading" => __("Zoom Level", DPTPLNAME),
				"param_name" => "zoom",
				"value" => 14,
				"min" => 0,
				"max" => 19,
		),
		array(
			"type" => "dropdown",
			"heading" => __("Use Map Control?", DPTPLNAME),
			"param_name" => "mapcontrol",
			"value" => array(
					"Yes" => "Y",
					"No" => "N"	
				)
		),
		array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Disable map type control?",
				"value" => array("Yes, please" => "true" ),
				"param_name" => "maptypecontrol",
				'dependency' => array( 'element' => 'mapcontrol', 'value' => 'Y')
		),
		array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Disable Pan Control?",
				"value" => array("Yes, please" => "true" ),
				"param_name" => "pancontrol",
				'dependency' => array( 'element' => 'mapcontrol', 'value' => 'Y')
		),
		array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Disable zoom control?",
				"value" => array("Yes, please" => "true" ),
				"param_name" => "zoomcontrol",
				'dependency' => array( 'element' => 'mapcontrol', 'value' => 'Y')
		),
		array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Disable streetview button?",
				"value" => array("Yes, please" => "true" ),
				"param_name" => "streetviewcontrol",
				'dependency' => array( 'element' => 'mapcontrol', 'value' => 'Y')
		),
		array(
			"type" => "dropdown",
			"heading" => __("Custom map style", DPTPLNAME),
			"param_name" => "mapstyle",
			"value" => array(
					"Default Google style" => "no",
					"Light Gray" => "lightgray",
					"Dark Gray" => "darkgray",
					"Night Blue" => "nightblue",
					"Fresh" => "fresh",
					"Pastel" => "pastel",
					"Vintage" => "vintage",	
					"Apple Maps style" => "aple",
					"Custom" => "custom"
				)
		),
		array(
                    "heading"            => "Custom Map Theme",
                    "type"               => "textarea_raw_html",
                    "param_name"         => "customtheme",
                    "value"              => "",
                    "description"        => "Custom map theme in jason format. For more themes see <a href=\"http://snazzymaps.com/\" target=\"_blank\">http://snazzymaps.com</a>",
					'dependency' => array( 'element' => 'mapstyle', 'value' => 'custom')
                ),

    ),
    "js_view" => 'VcColumnView'
) );
vc_map( array(
    "name" => __("DP Google Map Location", DPTPLNAME),
    "base" => "dp_googlemap_marker",
	"icon" => "icon-wpb-marker",
    "content_element" => true,
	"description" =>  __('Google map location', DPTPLNAME),
    "as_child" => array('only' => 'dp_googlemap'), 
    "params" => array(
		array(
			"type" => "dropdown",
			"heading" => __("Location determined by", DPTPLNAME),
			"param_name" => "locationtype",
			"value" => array(
					"Address" => "address",
					"Latitude and Longtitude" => "coordinates"	
				)
		),
        array(
            "type" => "textfield",
            "heading" => __("Location address", DPTPLNAME),
            "param_name" => "address",
            "description" => __("Enter address of location.", DPTPLNAME),
			"dependency" => Array("element" => "locationtype","value" => array("address")),			
        ),
        array(
            "type" => "textfield",
            "heading" => __("Location latitude", DPTPLNAME),
            "param_name" => "lat",
            "description" => __("Enter latitude of location. You can use this <a href='http://www.latlong.net/' target='_blank'>link</a>", DPTPLNAME),
			"dependency" => Array("element" => "locationtype","value" => array("coordinates"))			
        ),
        array(
            "type" => "textfield",
            "heading" => __("Location longtitude", DPTPLNAME),
            "param_name" => "long",
            "description" => __("Enter longtitude of location. You can use this <a href='http://www.latlong.net/' target='_blank'>link</a>", DPTPLNAME),
			"dependency" => Array("element" => "locationtype","value" => array("coordinates"))
        ),
		array(
			"type" => "dropdown",
			"heading" => __("Marker type", DPTPLNAME),
			"param_name" => "markertype",
			"value" => array(
					"Simple marker" => "simple",
					"Marker with icon" => "icon",
					"Custom image" => "custom"	
				)
		),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => __("Marker color", DPTPLNAME),
			"param_name" => "markercolor",
			"value" => "",
			"description" => __("Select color for marker", DPTPLNAME),
			"dependency" => Array("element" => "markertype","value" => array("simple","icon"))
		),
		array(
			"type" => "icon_selector",
			"class" => "",
			"heading" => __("Marker Icon", DPTPLNAME),
			"admin_label" => true,
			"param_name" => "icon",
			"description" => "Select icon for marker",
			"dependency" => Array("element" => "markertype","value" => array("icon"))
		),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => __("Icon color", DPTPLNAME),
			"param_name" => "iconcolor",
			"value" => "",
			"description" => __("Select color for icon", DPTPLNAME),
			"dependency" => Array("element" => "markertype","value" => array("icon"))
		),
		array(
		  "type" => "attach_image",
		  "heading" => __("Custom marker image", DPTPLNAME),
		  "param_name" => "markerimage",
		  "value" => "",
		  "description" => __("Select image from media library.", DPTPLNAME),
		  "dependency" => Array("element" => "markertype","value" => array("custom"))
		),
		array(
			"type" => "dropdown",
			"heading" => __("Use infobox for marker", DPTPLNAME),
			"group" => "Infobox Setting",
			"param_name" => "infobox",
			"value" => array(
					"No" => "N",
					"Yes" => "Y"	
				)
		),
        array(
		  "type" => "textfield",
		  "heading" => __("Info Box Title", DPTPLNAME),
		  "group" => "Infobox Setting",
		  "param_name" => "title",
		  "dependency" => Array("element" => "infobox","value" => array("Y"))
		),
        array(
		  "type" => "textarea_html",
		  "heading" => __("Info Box Content", DPTPLNAME),
		  "group" => "Infobox Setting",
		  "param_name" => "content",
		  "dependency" => Array("element" => "infobox","value" => array("Y"))
		),
		array(
		  "type" => "attach_image",
		  "heading" => __("Infobox image", DPTPLNAME),
		  "param_name" => "infoboximage",
		  "value" => "",
		  "group" => "Infobox Setting",
		  "description" => __("Select image from media library.", DPTPLNAME),
		  "dependency" => Array("element" => "infobox","value" => array("Y"))
		)
	)
) );

class WPBakeryShortCode_dp_googlemap extends WPBakeryShortCodesContainer {
}
class WPBakeryShortCode_dp_googlemap_marker extends WPBakeryShortCode {
}




/* Lightbox image link */
vc_map( array(
  "name" => __("Lightbox thumb", DPTPLNAME),
  "base" => "lightbox",
  "icon" => "icon-wpb-single-image",
  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  "description" => __('Simple image as lightbox link', DPTPLNAME),
  "params" => array(
    array(
      "type" => "attach_image",
      "heading" => __("Thumb image", DPTPLNAME),
      "param_name" => "thumb",
      "value" => "",
      "description" => __("Select image from media library.", DPTPLNAME)
    ),
      array(
        "type" => "dropdown",
        "heading" => __("Overlay icon type", DPTPLNAME),
        "param_name" => "hover_icon",
        "admin_label" => true,
			"value" => array(
					"Zoom" => "zoom",
					"Play" => "play",
					"File" => "file"		
	),
        "description" => __("Select icon to display in thumb fancy overlay.", DPTPLNAME)
      ),
	array(
	  'type' => 'attach_images',
	  'heading' => __( 'Images', DPTPLNAME ),
	  'param_name' => 'images',
	  'value' => '',
	  'description' => __( 'Select images from media library.', 'js_composer' )
	),
    array(
      "type" => "textfield",
      "heading" => __("Video URL (Link to video lightbox video content)", DPTPLNAME),
      "param_name" => "videolink",
      "description" => __("Link to video content to display in lightbox.", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Title", DPTPLNAME),
      "param_name" => "title",
      "description" => __("Title of image to display in lightbox window", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Description", DPTPLNAME),
      "param_name" => "desc",
      "description" => __("Description of image to display in lightbox window", DPTPLNAME)
    ),
	$add_dp_animation
  )
));
/* Featured box
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Featured Box", DPTPLNAME),
  "base" => "featuredbox",
  "icon" => "icon-wpb-servicebox",
  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  "description" => __('Box with animated icons', DPTPLNAME),
  "params" => array(
     array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => __("Type", DPTPLNAME),
	  "param_name" => "type",
			"value" => array(
				"Icon centered" => "centered",	
				"Icon left" => "left-big",				
				"Icon small left" => "left-small",
				"Icon right" => "right-big",
				"Icon small right" => "right-small"
			),
	  "description" => ""
	),
     array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => __("Icon badge style", DPTPLNAME),
	  "param_name" => "style",
			"value" => array(
				"Rounded" => "rounded",	
				"Rounded bordered" => "rounded-border",	
				"No badge" => "no-border"
			),
	  "description" => ""
	),
	array(
	"type" => "icon_selector",
	"class" => "",
	"heading" => __("Icon", DPTPLNAME),
	"admin_label" => true,
	"param_name" => "icon",
	"description" => ""
	),
	array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => __("Custom icon color", DPTPLNAME),
	"param_name" => "icon_color",
	"value" => "",
	"description" => __("Select custom color color for this box", DPTPLNAME)
	),
	array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => __("Custom hover state icon color", DPTPLNAME),
	"param_name" => "icon_hcolor",
	"value" => "",
	"description" => __("Select custom hover state icon color for this box", DPTPLNAME)
	),
	array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => __("Custom text color", DPTPLNAME),
	"param_name" => "textcolor",
	"value" => "",
	"description" => __("Select custom text color for this box", DPTPLNAME)
	),
	array(
      "type" => "textfield",
      "heading" => __("Title", DPTPLNAME),
      "param_name" => "title",
	  "admin_label" => true,
      "value" => __("Faetured Box", DPTPLNAME)
    ),
	 
    array(
      "type" => "textarea_html",
      "heading" => __("Content", DPTPLNAME),
	  "holder"      => "div",
      "param_name" => "content",
      "value" => __("", DPTPLNAME)
    ),
	array(
      "type" => "textfield",
      "heading" => __("Button link", DPTPLNAME),
      "param_name" => "button_link",
      "description" => __("If you leave this foeld blank 'Read more' button will be not dispaled", DPTPLNAME)
    ),
	array(
      "type" => "textfield",
      "heading" => __("Button text", DPTPLNAME),
      "param_name" => "button_text"
    ),
	array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button Style", DPTPLNAME),
				"param_name" => "button_style",
				"value" => array(
					"Default" => "",	
					"Dark" => "dark",	
					"Light" => "light",
					"White" => "white",
					"Blue" => "blue",
					"Green" => "green",
					"Orange" => "orange",
					"Yellow" => "yellow",
					"Red" => "red",
					"Purple" => "purple",				
					"Pink" => "pink",
					"Gray" => "gray",
					"Default Bordered" => "line",
					"White Bordered" => "line-white",
					"Dark Bordered" => "line-dark",
					"Blue Bordered" => "line-blue",
					"Green Bordered" => "line-green",
					"Orange Bordered" => "line-orange",
					"Yellow Bordered" => "line-yellow",
					"Red Bordered" => "line-red",
					"Purple Bordered" => "line-purple",				
					"Pink Bordered" => "line-pink",
					"Gray Bordered" => "line-gray",
					"Readmore only" => "readmore"
				),
				"description" => ""
			),
	$add_dp_animation,
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", DPTPLNAME),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", DPTPLNAME)
    )
  )
) );

/* Number boxes */

vc_map( array(
  "name" => __("Number Box", DPTPLNAME),
  "base" => "numberbox",
  "icon" => "icon-wpb-numberbox",
  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  "description" => __('Box with animated number', DPTPLNAME),
  "params" => array(
     array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => __("Type", DPTPLNAME),
	  "param_name" => "type",
			"value" => array(
				"Centerd box" => "centered",	
				"Number left" => "left",
				"Number right" => "right"
			),
	  "description" => ""
	),
     array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => __("Border style", DPTPLNAME),
	  "param_name" => "style",
			"value" => array(
				"Round" => "round",	
				"Diamond" => "diamond"
			),
	  "description" => ""
	),
    array(
      "type" => "textfield",
      "heading" => __("Title", DPTPLNAME),
      "param_name" => "title",
	  "admin_label" => true,
      "value" => __("Faeture Box", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Number", DPTPLNAME),
      "param_name" => "number",
      "value" => "01"
    ),
	array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => __("Custom number color", DPTPLNAME),
	"param_name" => "number_color",
	"value" => "",
	"description" => __("Select custom number color for this box", DPTPLNAME)
	),
    array(
      "type" => "textarea_html",
      "heading" => __("Content", DPTPLNAME),
	  "holder" => 'div',
      "param_name" => "content",
      "value" => __("Number box content.", DPTPLNAME)
    ),
	array(
      "type" => "textfield",
      "heading" => __("Button link", DPTPLNAME),
      "param_name" => "button_link",
      "description" => __("If you leave this foeld blank 'Read more' button will be not dispaled", DPTPLNAME)
    ),
	array(
      "type" => "textfield",
      "heading" => __("Button text", DPTPLNAME),
      "param_name" => "button_text"
    ),
	array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button Style", DPTPLNAME),
				"param_name" => "button_style",
				"value" => array(
					"Default" => "",	
					"Dark" => "dark",	
					"Light" => "light",
					"White" => "white",
					"Blue" => "blue",
					"Green" => "green",
					"Orange" => "orange",
					"Yellow" => "yellow",
					"Red" => "red",
					"Purple" => "purple",				
					"Pink" => "pink",
					"Gray" => "gray",
					"Default Bordered" => "line",
					"White Bordered" => "line-white",
					"Dark Bordered" => "line-dark",
					"Blue Bordered" => "line-blue",
					"Green Bordered" => "line-green",
					"Orange Bordered" => "line-orange",
					"Yellow Bordered" => "line-yellow",
					"Red Bordered" => "line-red",
					"Purple Bordered" => "line-purple",				
					"Pink Bordered" => "line-pink",
					"Gray Bordered" => "line-gray",
					"Readmore only" => "readmore"
				),
				"description" => ""
			),
	$add_dp_animation,
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", DPTPLNAME),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", DPTPLNAME)
    )
  )
) );

/* Flip Box */

vc_map( array(
  "name" => __("Flip Box", DPTPLNAME),
  "base" => "dp-flipbox",
  "icon" => "icon-wpb-flipbox",
  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  "description" => __('Flipping box', DPTPLNAME),
  "params" => array(
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Icon type:", DPTPLNAME),
		"param_name" => "icon_type",
		"group" => "Front Side Settings",
		"value" => array(
		"Font Icon Manager" => "selector",
		"Custom Image" => "custom",
		),
		"description" => __("Use an existing font icon or upload a custom image.", DPTPLNAME)
		),
	array(
	"type" => "icon_selector",
	"group" => "Front Side Settings",
	"class" => "",
	"admin_label" => true,
	"heading" => __("Icon", DPTPLNAME),
	"param_name" => "icon",
	"description" => "",
	"dependency" => Array("element" => "icon_type","value" => array("selector")),
	),
	array(
								"type" => "number",
								"class" => "",
								"heading" => __("Icon size", DPTPLNAME),
								"param_name" => "icon_size",
								"group" => "Front Side Settings",
								"value" => 48,
								"min" => 12,
								"max" => 72,
								"suffix" => "px",
								"dependency" => Array("element" => "icon_type","value" => array("selector")),
		),
	array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Icon Color", DPTPLNAME),
								"param_name" => "icon_color",
								"group" => "Front Side Settings",
								"value" => "#2e2a27",
								"description" => __("Select background color for icon.", DPTPLNAME),	
								"dependency" => Array("element" => "icon_type","value" => array("selector")),
			),
	array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Icon Badge Style", DPTPLNAME),
								"param_name" => "icon_style",
								"group" => "Front Side Settings",						
								"value" => array(
									"No badge" => "none",
									"Circle" => "circle",
									"Square" => "square"
								),
								"dependency" => Array("element" => "icon_type","value" => array("selector")),
	  ),
	array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Badge Background Color", DPTPLNAME),
								"param_name" => "icon_badge_color",
								"group" => "Front Side Settings",
								"value" => "#ffffff",
								"description" => __("Select background color for icon.", DPTPLNAME),	
								"dependency" => Array("element" => "icon_style", "value" => array("circle","square")),
			),
	array(
								"type" => "attach_image",
								"class" => "",
								"heading" => __("Upload Image Icon:", DPTPLNAME),
								"param_name" => "icon_img",
								"group" => "Front Side Settings",
								"value" => "",
								"description" => __("Upload the custom image icon.", DPTPLNAME),
								"dependency" => Array("element" => "icon_type","value" => array("custom")),
		),
		
	array(
								"type" => "number",
								"class" => "",
								"heading" => __("Image Width", DPTPLNAME),
								"param_name" => "img_width",
								"group" => "Front Side Settings",
								"value" => 48,
								"min" => 16,
								"max" => 512,
								"suffix" => "px",
								"description" => __("Set image width", DPTPLNAME),
								"dependency" => Array("element" => "icon_type","value" => array("custom")),
			),
	array(
      							"type" => "textfield",
      							"heading" => __("Front title", DPTPLNAME),
      							"param_name" => "front_title",
								"admin_label" => true,
								"value" => "Front Side Title",
								"group" => "Front Side Settings",
    ),
    array(
							  "type" => "textarea",
							  "heading" => __("Content", DPTPLNAME),
							  "param_name" => "front_content",
							  "group" => "Front Side Settings",
							  "value" => __("Front side content of this FlipBox.", DPTPLNAME)
    ),
	array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Front text color", DPTPLNAME),
								"param_name" => "front_txt_color",
								"group" => "Front Side Settings",
								"value" => "#2e2a27",
								"description" => __("Select text color for front side.", DPTPLNAME)
			),
	array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Front background color", DPTPLNAME),
								"param_name" => "front_bg_color",
								"group" => "Front Side Settings",
								"value" => "#e6e6e6",
								"description" => __("Select background color for front side.", DPTPLNAME)
			),
	array(
      							"type" => "textfield",
      							"heading" => __("Front title", DPTPLNAME),
      							"param_name" => "back_title",
								"value" => "Back Side Title",
								"group" => "Back Side Settings",
    ),
    array(
							  "type" => "textarea_html",
							  "heading" => __("Back Side Content", DPTPLNAME),
							  "holder" => "div",
							  "param_name" => "content",
							  "group" => "Back Side Settings",
							  "value" => __("Back side content of this FlipBox.", DPTPLNAME)
    ),
	array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Back text color", DPTPLNAME),
								"param_name" => "back_txt_color",
								"group" => "Back Side Settings",
								"value" => "#2e2a27",
								"description" => __("Select text color for back side.", DPTPLNAME)
			),
	array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Back background color", DPTPLNAME),
								"param_name" => "back_bg_color",
								"group" => "Back Side Settings",
								"value" => "#e6e6e6",
								"description" => __("Select background color for back side.", DPTPLNAME)
			),
	array(
							    "type" => "textfield",
							    "heading" => __("Button link", DPTPLNAME),
							    "param_name" => "link",
								"group" => "Back Side Settings",
							    "description" => __("If you leave this field blank 'Read more' button will be not dispaled", DPTPLNAME)
			),
	array(
							    "type" => "textfield",
							    "heading" => __("Button text", DPTPLNAME),
							    "param_name" => "button_text",
								"group" => "Back Side Settings",
								"value" => "Read more",
								'dependency' => array( 'element' => 'link', 'not_empty' => true)

    		),
	array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Button style ",DPTPLNAME),
				"param_name" => "button_style",
				"value" => array(
					"Default" => "",	
					"Dark" => "dark",	
					"Light" => "light",
					"White" => "white",
					"Blue" => "blue",
					"Green" => "green",
					"Orange" => "orange",
					"Yellow" => "yellow",
					"Red" => "red",
					"Purple" => "purple",				
					"Pink" => "pink",
					"Gray" => "gray",
					"Default Bordered" => "line",
					"White Bordered" => "line-white",
					"Dark Bordered" => "line-dark",
					"Blue Bordered" => "line-blue",
					"Green Bordered" => "line-green",
					"Orange Bordered" => "line-orange",
					"Yellow Bordered" => "line-yellow",
					"Red Bordered" => "line-red",
					"Purple Bordered" => "line-purple",				
					"Pink Bordered" => "line-pink",
					"Gray Bordered" => "line-gray",
					"Readmore only" => "readmore"
				),
							"description" => __("Select button style.",DPTPLNAME),
							'dependency' => array( 'element' => 'link', 'not_empty' => true)
			),
	array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button Size", DPTPLNAME),
				"param_name" => "button_size",
				"value" => array(
					"Small" => "small",	
					"Large" => "large",	
					"Extra Large" => "extralarge",
				),
				"description" => "",
				'dependency' => array( 'element' => 'link', 'not_empty' => true)
			),
	array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Open in", DPTPLNAME),
				"param_name" => "link_target",
				"value" => array(
					"The same window" => "_self",
					"New window" => "_blank",	
					"Parent" => "_parent"
					
				),
				"description" => "",
				'dependency' => array( 'element' => 'link', 'not_empty' => true)
			),
	array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Flip Animation Type ",DPTPLNAME),
							"param_name" => "flip_type",
							"group" => "Additional Settings",
							"value" => array(
								"Flip Horizontally" => "",
								"Flip Vertically" => "vertical",
							),
							"description" => __("Select Flip type for this flip box.",DPTPLNAME)
			),
	array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Set Box Height",DPTPLNAME),
							"param_name" => "height_type",
							"group" => "Additional Settings",
							"value" => array(
								"Display full the content and adjust height of the box accordingly"=>"auto",
								"Give a custom height of your choice to the box" => "custom",								
							),
							"description" => __("Select height option for this box.",DPTPLNAME)
			),
	array(
							"type" => "number",
							"class" => "",
							"heading" => __("Box Height", DPTPLNAME),
							"param_name" => "box_height",
							"group" => "Additional Settings",
							"value" => 300,
							"min" => 200,
							"max" => 1200,
							"suffix" => "px",
							"description" => __("Provide box height", DPTPLNAME),
							"dependency" => Array("element" => "height_type","value" => array("custom")),
			),
    array(
						  "type" => "textfield",
						  "heading" => __("Extra class name", DPTPLNAME),
						  "param_name" => "el_class",
						  "group" => "Additional Settings",
						  "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", DPTPLNAME)
    )
  )
) );



/* Text box
---------------------------------------------------------- */
vc_map( array(
  "name" => __("DP Text Box", DPTPLNAME),
  "base" => "textbox",
  "holder"      => "div",
  "icon" => "icon-wpb-textbox",
  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  "description" => __('Text box with background, border etc', DPTPLNAME),
  "params" => array(
	array(
      "type" => "textfield",
      "heading" => __("Title", DPTPLNAME),
	  "admin_label" => true,
      "param_name" => "title",
      "value" => __("Text Box", DPTPLNAME)
    ),
	array(
	"type" => "icon_selector",
	"admin_label" => true,
	"class" => "",
	"heading" => __("Icon", DPTPLNAME),
	"param_name" => "icon",
	"description" => ""
	),	 
    array(
      "type" => "textarea_html",
	  "holder" => "div",
      "heading" => __("Content", DPTPLNAME),
      "param_name" => "content",
      "value" => __("Text box content.", DPTPLNAME)
    ),
	
	array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => __("Background color", DPTPLNAME),
	"group" => "Style Options",
	"param_name" => "bgcolor",
	"value" => "",
	"description" => __("Select custom background color for text box", DPTPLNAME)
	),
	array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => __("Text color", DPTPLNAME),
	"group" => "Style Options",
	"param_name" => "txtcolor",
	"value" => "",
	"description" => __("Select custom background color for text box", DPTPLNAME)
	),
	array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => __("Border color", DPTPLNAME),
	"group" => "Style Options",
	"param_name" => "border_color",
	"value" => "",
	"description" => __("Select custom border color for text box", DPTPLNAME)
	),
	array(
      "type" => "number",
      "heading" => __("Border width", DPTPLNAME),
	  "group" => "Style Options",
      "param_name" => "border_width",
	  "suffix"=>"px",
      "value" => "1",
	  "description" => __("Border width in px", DPTPLNAME)
    ),
	array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => __("Border style", DPTPLNAME),
	  "group" => "Style Options",
	  "param_name" => "border_style",
			"value" => array(
				"Solid" => "solid",
				"No border" => "none",	
				"Dotted" => "dotted",
				"Dashed" => "dashed",
				"Double" => "double",
				"Groove" => "groove",
				"Ridge" => "ridge",
				"Inset" => "inset",
				"Outset" => "outset"
			)
	),
	array(
      "type" => "number",
      "heading" => __("Border radius", DPTPLNAME),
	  "group" => "Style Options",
      "param_name" => "border_radius",
	  "suffix"=>"px",
      "value" => "2",
	  "description" => __("Border radius in px", DPTPLNAME)
    ),
	array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => __("Header background color", DPTPLNAME),
	"group" => "Style Options",
	"param_name" => "header_bgcolor",
	"value" => "",
	"description" => __("Select custom background color for front of service box", DPTPLNAME)
	),
	array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => __("Header text color", DPTPLNAME),
	"group" => "Style Options",
	"param_name" => "header_txtcolor",
	"value" => "",
	"description" => __("Select custom color for header text", DPTPLNAME)
	),
	array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => __("Icon custom color", DPTPLNAME),
	"group" => "Style Options",
	"param_name" => "icon_color",
	"value" => "",
	"description" => __("Select custom color for header text", DPTPLNAME)
	),

    array(
      "type" => "textfield",
      "heading" => __("Extra class name", DPTPLNAME),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", DPTPLNAME)
    )
  )
) );

/* Teaser
---------------------------------------------------------- */
vc_map( array(
  "name" => __("DP Teaser", DPTPLNAME),
  "base" => "teaser",
  "icon" => "icon-wpb-teaser",
  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  "description" => __('Text box with image and link', DPTPLNAME),
  "params" => array(
     array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => __("Source", DPTPLNAME),
	  "param_name" => "source",
			"value" => array(
				"Post or portfolio item" => "post",	
				"Custom content" => "custom",
			),
	  "description" => "Select source type for teaser"
	),
     array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => __("Icons in overlay", DPTPLNAME),
	  "param_name" => "overlay_icons",
			"value" => array(
				"Only zoom icon" => "zoom",	
				"Only link icon" => "link",
				"Both" => "both",
				"No icons" => "no",
			),
	  "description" => ""
	),
				array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Use Read More button?",
				"value" => array("Yes, please" => "true" ),
				"param_name" => "usebutton",
		),
			array(
			'type' => 'textfield',
			'heading' => __( 'Button text', DPTPLNAME ),
			'param_name' => 'button_text',
			'value' => __("read more", DPTPLNAME),
			'dependency' => array( 'element' => 'usebutton', 'not_empty' => true)
		),
			array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Button style ",DPTPLNAME),
				"param_name" => "button_style",
				"value" => array(
					"Default" => "",	
					"Dark" => "dark",	
					"Light" => "light",
					"White" => "white",
					"Blue" => "blue",
					"Green" => "green",
					"Orange" => "orange",
					"Yellow" => "yellow",
					"Red" => "red",
					"Purple" => "purple",				
					"Pink" => "pink",
					"Gray" => "gray",
					"Default Bordered" => "line",
					"White Bordered" => "line-white",
					"Dark Bordered" => "line-dark",
					"Blue Bordered" => "line-blue",
					"Green Bordered" => "line-green",
					"Orange Bordered" => "line-orange",
					"Yellow Bordered" => "line-yellow",
					"Red Bordered" => "line-red",
					"Purple Bordered" => "line-purple",				
					"Pink Bordered" => "line-pink",
					"Gray Bordered" => "line-gray",
					"Readmore only" => "readmore"
				),
							"description" => __("Select button style.",DPTPLNAME),
							'dependency' => array( 'element' => 'usebutton', 'not_empty' => true)
		),
	$add_dp_animation,	
	array(
      "type" => "textfield",
      "heading" => __("Extra class name", DPTPLNAME),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Title", DPTPLNAME),
      "param_name" => "title",
	  "admin_label" => true,
      "value" => __("Teaser title", DPTPLNAME),
	  'dependency' => array(
	  'element' => 'source',
	  'value' => array( 'custom' ),
		),
	  'group' => __("Custom content setting", DPTPLNAME),

    ),
	array(
      "type" => "attach_image",
      "heading" => __("Image", DPTPLNAME),
      "param_name" => "img",
      "value" => "",
      "description" => __("Select image from media library.", DPTPLNAME),
	  'dependency' => array(
	  'element' => 'source',
	  'value' => array( 'custom' ),
		),
	  'group' => __("Custom content setting", DPTPLNAME),
    ),
	array(
      "type" => "attach_image",
      "heading" => __("Big Image", DPTPLNAME),
      "param_name" => "bigimg",
      "value" => "",
      "description" => __("Select image from media library.This image will be displayed in lightbox. If you leave it blank lightbox link will be not displayed.", DPTPLNAME),
	  'dependency' => array(
	  'element' => 'source',
	  'value' => array( 'custom' ),
		),
	  'group' => __("Custom content setting", DPTPLNAME),
    ),
	array(
      "type" => "textarea_html",
      "heading" => __("Content", DPTPLNAME),
      "param_name" => "content",
      "value" => __("Teaser content.", DPTPLNAME),
	  'dependency' => array(
	  'element' => 'source',
	  'value' => array( 'custom' ),
		),
	  'group' => __("Custom content setting", DPTPLNAME),
    	),
			array(
			'type' => 'textfield',
			'heading' => __( 'Teaser link', DPTPLNAME ),
			'param_name' => 'link',
			'description' => __( 'Enter URL if you want display read more button on bottom.', DPTPLNAME ),
	  'dependency' => array(
	  'element' => 'source',
	  'value' => array( 'custom' ),
		),
			'group' => __("Custom content setting", DPTPLNAME),
		),
	array(
		'type' => 'autocomplete',
		'heading' => __( 'Post or portfolio item', 'js_composer' ),
		'param_name' => 'post_id',
		'description' => __( 'Add post by title. Start typing post title to find right post', 'js_composer' ),
		'settings' => array(
			'multiple' => false,
			'sortable' => true,
			'groups' => true,
		),
	   'dependency' => array(
	   'element' => 'source',
	   'value' => array( 'post' ),
		),
		'group' => __("Post content setting", DPTPLNAME),
	),
    array(
      "type" => "textfield",
      "heading" => __("Excerpt characters limit", DPTPLNAME),
      "param_name" => "charlimit",
      "description" => __("How many characters should be displayed in post excerpt (default is 100)", DPTPLNAME),
	  "value" => "100",
	   'dependency' => array(
	   'element' => 'source',
	   'value' => array( 'post' ),
		),
		'group' => __("Post content setting", DPTPLNAME),
    ),

	)
) );

add_filter( 'vc_autocomplete_teaser_post_id_callback',
	'vc_include_postorportfolio_search', 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_teaser_post_id_render',
	'vc_include_field_render', 10, 1 ); // Render exact product. Must return an array (label,value)


/* Horizontal Teaser
---------------------------------------------------------- */
vc_map( array(
  "name" => __("DP Teaser Horizontal", DPTPLNAME),
  "base" => "post_teaser",
  "icon" => "icon-wpb-teaser2",
  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  "description" => __('Display fancy post based teaser block', DPTPLNAME),
  "params" => array(
     array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => __("Type", DPTPLNAME),
	  "param_name" => "type",
			"value" => array(
				"Featured image left" => "left",	
				"Featured image right" => "right"
			),
	  "description" => ""
	),
	array(
		'type' => 'autocomplete',
		'heading' => __( 'Post', 'js_composer' ),
		'param_name' => 'post_id',
		'description' => __( 'Add post by title. Start typing post title to find right post', 'js_composer' ),
		'settings' => array(
			'multiple' => false,
			'sortable' => true,
			'groups' => true,
		)
	),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", DPTPLNAME),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", DPTPLNAME)
    )
  )
) );

add_filter( 'vc_autocomplete_post_teaser_post_id_callback',
	'vc_include_postorportfolio_search', 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_post_teaser_post_id_render',
	'vc_include_field_render', 10, 1 ); // Render exact product. Must return an array (label,value)

/* Countdown timer
---------------------------------------------------------- */
vc_map( array(
  "name" => __("DP Countdown", DPTPLNAME),
  "base" => "dp-countdown",
  "icon" => "icon-wpb-countdown",
  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  'admin_enqueue_js' => array(get_template_directory_uri().'/dynamo_framework/vc_extend/bootstrap-datetimepicker.min.js'),
  'admin_enqueue_css' => array(get_template_directory_uri().'/dynamo_framework/vc_extend/bootstrap-datetimepicker.min.css'),
  "description" => __('Countdown timer', DPTPLNAME),
  "params" => array(
					   		array(
						   		"type" => "dropdown",
								"class" => "",
								"heading" => __("Countdown Timer Style", DPTPLNAME),
								"param_name" => "style",
								"value" => array(
										__("Digit and Unit Up and Down",DPTPLNAME) => "updown",
										__("Digit and Unit Side by Side",DPTPLNAME) => "byside",
									),
								"description" => __("Select style for countdown timer.", DPTPLNAME),
							),
  
							array(
							"type" => "dp-datetimepicker",
							"class" => "",
							"heading" => __("Target Time For Countdown", DPTPLNAME),
							"param_name" => "datetime",
							"admin_label" => true,
							"value" => "", 
							"description" => __("Date and time format (yyyy/mm/dd hh:mm:ss).", DPTPLNAME),
							),
							array(
						   		"type" => "colorpicker",
								"class" => "",
								"heading" => __("Timer Digit Text Color", DPTPLNAME),
								"param_name" => "digit_col",
								"value" => ""
							),
							array(
						   		"type" => "number",
								"class" => "",
								"heading" => __("Timer Digit Text Size", DPTPLNAME),
								"param_name" => "digit_size",
								"suffix"=>"px",
								"min"=>"0",
								"value" => "60"
							),
							array(
						   		"type" => "dropdown",
								"class" => "",
								"heading" => __("Timer Digit Text Style", DPTPLNAME),
								"param_name" => "digit_style",								
								"value" => array(
												"Normal"=>"",
												"Bold"=>"bold",
												"Italic"=>"italic",
												"Bold & Italic"=>"bolditalic",
											)
							),
							array(
						   		"type" => "colorpicker",
								"class" => "",
								"heading" => __("Timer Unit Text Color", DPTPLNAME),
								"param_name" => "unit_col",
								"value" => "",
							),
							array(
						   		"type" => "number",
								"class" => "",
								"heading" => __("Timer Unit Text Size", DPTPLNAME),
								"param_name" => "unit_size",
								"value" => "15",
								"suffix"=>"px",
								"min"=>"0"
							),
							array(
						   		"type" => "dropdown",
								"class" => "",
								"heading" => __("Timer Unit Text Style", DPTPLNAME),
								"param_name" => "unit_style",
								"value" => array(
												"Normal"=>"",
												"Bold"=>"bold",
												"Italic"=>"italic",
												"Bold & Italic"=>"bolditalic",
											)
							),
							array(
							  "type" => "textfield",
							  "heading" => __("Extra class name", DPTPLNAME),
							  "param_name" => "el_class",
							  "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", DPTPLNAME)
							),
  )
) );

/* Process boxes */

vc_map( array(
  "name" => __("Process Box", DPTPLNAME),
  "base" => "processbox",
  "icon" => "icon-wpb-processbox",
  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  "description" => __('Box in process diagram', DPTPLNAME),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Title", DPTPLNAME),
      "param_name" => "title",
	  "admin_label" => true,
      "value" => __("Process Box", DPTPLNAME)
    ),
     array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => __("Border style", DPTPLNAME),
	  "param_name" => "style",
			"value" => array(
				"Round" => "round",	
				"Diamond" => "diamond"
			),
	  "description" => ""
	),
	array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => __("Symbol size", DPTPLNAME),
	  "param_name" => "symbol_size",
			"value" => array(
				"Small" => "small",	
				"Medium" => "medium",	
				"Large" => "large"
			),
	  "description" => "Select size of displayed symbol"
	),
	array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => __("Type", DPTPLNAME),
	  "param_name" => "symbol_type",
			"value" => array(
				"Icon" => "icon",	
				"Number" => "number",
			),
	  "description" => "Select type of displayed symbol"
	),
	array(
	"type" => "icon_selector",
	"class" => "",
	"admin_label" => true,
	"heading" => __("Icon", DPTPLNAME),
	"param_name" => "icon",
	"description" => "",
	"value" => "icon-wordpress",
	"dependency" => Array('element' => "symbol_type", 'value' => array('icon'))
	),	 
    array(
      "type" => "textfield",
      "heading" => __("Number", DPTPLNAME),
      "param_name" => "number",
      "value" => "01",
	  "dependency" => Array('element' => "symbol_type", 'value' => array('number'))
    ),
	array(
	  "type" => "colorpicker",
	  "class" => "",
	  "heading" => __("Symbol color", DPTPLNAME),
	 "param_name" => "symbol_color",
	  "description" => ""
	),
	array(
	  "type" => "colorpicker",
	  "class" => "",
	  "heading" => __("Process line color", DPTPLNAME),
	 "param_name" => "line_color",
	  "description" => ""
	),
    array(
      "type" => "textarea_html",
	  "holder" => "div",
      "heading" => __("Content", DPTPLNAME),
      "param_name" => "content",
      "value" => __("Featured box content.", DPTPLNAME)
    ),
	array(
      "type" => "textfield",
      "heading" => __("Button link", DPTPLNAME),
      "param_name" => "button_link",
      "description" => __("If you leave this foeld blank 'Read more' button will be not dispaled", DPTPLNAME)
    ),
	array(
      "type" => "textfield",
      "heading" => __("Button text", DPTPLNAME),
      "param_name" => "button_text",
	  "value" => "Read more"
    ),
	array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button Style", DPTPLNAME),
				"param_name" => "button_style",
				"value" => array(
					"Default" => "",	
					"Dark" => "dark",	
					"Light" => "light",
					"White" => "white",
					"Blue" => "blue",
					"Green" => "green",
					"Orange" => "orange",
					"Yellow" => "yellow",
					"Red" => "red",
					"Purple" => "purple",				
					"Pink" => "pink",
					"Gray" => "gray",
					"Default Bordered" => "line",
					"White Bordered" => "line-white",
					"Dark Bordered" => "line-dark",
					"Blue Bordered" => "line-blue",
					"Green Bordered" => "line-green",
					"Orange Bordered" => "line-orange",
					"Yellow Bordered" => "line-yellow",
					"Red Bordered" => "line-red",
					"Purple Bordered" => "line-purple",				
					"Pink Bordered" => "line-pink",
					"Gray Bordered" => "line-gray",
					"Readmore only" => "readmore"
				),
				"description" => ""
			),
	array(
			'type' => 'checkbox',
			'heading' => __( 'Finish process diagram?', DPTPLNAME ),
			'param_name' => 'finish',
			'description' => __( 'If it is last process position pocess line will be not displayed after this position.', DPTPLNAME ),
			'value' => array( __( 'Yes, please', DPTPLNAME ) => 'yes' )
	),
	$add_dp_animation,
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", DPTPLNAME),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", DPTPLNAME)
    )
  )
) );

/* DP Time line */
vc_map( array(
    "name" => __("DP Timeline", DPTPLNAME),
    "base" => "timeline",
	"icon" => "icon-wpb-timeline",
    "as_parent" => array('only' => 'timeline_item, timeline_sep'),
  	"category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
    "content_element" => true,
    "show_settings_on_create" => false,
	"description" =>  __('Timeline container', DPTPLNAME),
    "params" => array(
	array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => __("Line type", DPTPLNAME),
	  "param_name" => "type",
			"value" => array(
				"Solid" => "solid",	
				"Dotted" => "dotted",	
				"Dashed" => "dashed"
			),
	  "description" => "Select type of timeline axe"
	),
	array(
	  "type" => "colorpicker",
	  "class" => "",
	  "heading" => __("Line color", DPTPLNAME),
	  "param_name" => "line_color",
	  "description" => "Select color of timeline axe"
	),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", DPTPLNAME),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", DPTPLNAME)
        )
    ),
    "js_view" => 'VcColumnView'
) );
vc_map( array(
    "name" => __("DP Timeline Item", DPTPLNAME),
    "base" => "timeline_item",
	"icon" => "icon-wpb-timeline_item",
    "content_element" => true,
	"description" =>  __('Single timeline item', DPTPLNAME),
    "as_child" => array('only' => 'timeline'), 
    "params" => array(
	array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => __("Item position", DPTPLNAME),
	  "param_name" => "position",
			"value" => array(
				"Right" => "right",	
				"Left" => "left",	
			),
	  "description" => "Select type of timeline axe"
	),
	array(
		  "type" => "colorpicker",
		  "class" => "",
		  "heading" => __("Node color", DPTPLNAME),
		  "param_name" => "node_color",
		  "description" => "Select color of timeline node"
		),
	array(
		  "type" => "textfield",
		  "heading" => __("Date", DPTPLNAME),
		  "param_name" => "date"
		),
	array(
		  "type" => "colorpicker",
		  "class" => "",
		  "heading" => __("Date background color", DPTPLNAME),
		  "param_name" => "date_color",
		  "description" => "Select background color for date"
		),
	array(
		  "type" => "colorpicker",
		  "class" => "",
		  "heading" => __("Date text color", DPTPLNAME),
		  "param_name" => "date_text_color",
		  "description" => "Select text color for date"
		),
	array(
		  "type" => "textfield",
		  "heading" => __("Title", DPTPLNAME),
		  "param_name" => "title",
		  "admin_label" => true,
		),
    array(
      "type" => "textarea_html",
	  "holder" => "div",
      "heading" => __("Content", DPTPLNAME),
      "param_name" => "content",
      "value" => __("Item content.", DPTPLNAME)
    ),
	$add_dp_animation,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", DPTPLNAME),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", DPTPLNAME)
        )
    )
) );
vc_map( array(
    "name" => __("DP Timeline Seprator", DPTPLNAME),
    "base" => "timeline_sep",
	"icon" => "icon-wpb-timeline_separator",
    "content_element" => true,
"description" =>  __('Timeline item separator', DPTPLNAME),
    "as_child" => array('only' => 'timeline'), 
    "params" => array(
	array(
		  "type" => "textfield",
		  "heading" => __("Separator text", DPTPLNAME),
		  "param_name" => "sep_text",
		  "admin_label" => true,
		),
	array(
		  "type" => "colorpicker",
		  "class" => "",
		  "heading" => __("Separator background color", DPTPLNAME),
		  "param_name" => "sep_color",
		  "description" => "Select background color for separator"
		),
	array(
		  "type" => "colorpicker",
		  "class" => "",
		  "heading" => __("Separator text color", DPTPLNAME),
		  "param_name" => "sep_text_color",
		  "description" => "Select text color for separator"
		),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", DPTPLNAME),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", DPTPLNAME)
        )
    )
) );

class WPBakeryShortCode_timeline extends WPBakeryShortCodesContainer {
}
class WPBakeryShortCode_timeline_item extends WPBakeryShortCode {
}
class WPBakeryShortCode_timeline_sep extends WPBakeryShortCode {
}

/* OWL Carousel */
vc_map( array(
  "name" => __("OWL Carousel", DPTPLNAME),
  "base" => "owl_carousel",
  "icon" => "icon-wpb-owl",
  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  "description" => __('OWL Carousel using slide custom post type', DPTPLNAME),
  "params" => array(
  $add_dp_slideshow,
    array(
      "type" => "textfield",
      "heading" => __("Items", DPTPLNAME),
      "param_name" => "items",
      "description" => __("Items to display on normal screen width > 1200px", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Items on desktop", DPTPLNAME),
      "param_name" => "itemsdesktop",
      "description" => __("Items to display on desktop screen width < 1200px", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Items on small desktop", DPTPLNAME),
      "param_name" => "itemsdesktopsmall",
      "description" => __("Items to display on desktop screen width < 980px. If you leave this field blank will be used setting from first not empty field above.", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Items on tablet", DPTPLNAME),
      "param_name" => "itemstablet",
      "description" => __("Items to display on tablet screen width < 768px. If you leave this field blank will be used setting from first not empty field above.", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Items on mobile devices", DPTPLNAME),
      "param_name" => "itemsmobile",
      "description" => __("Items to display on mobile devices width < 479px. If you leave this field blank will be used setting from first not empty field above.", DPTPLNAME)
    ),
	array(
				  "type" => "number",
				  "class" => "",
				  "heading" => __("Item margin", DPTPLNAME),
				  "param_name" => "item_margin",
				  "value" => "",
				  "min"=>"0",
				  "suffix"=>"px"
		),
    array(
      "type" => "textfield",
      "heading" => __("Autoplay", DPTPLNAME),
      "param_name" => "autoplay",
      "description" => __("Set autoplay speed in ms. If you leave blank autoplay will be disabled.", DPTPLNAME)
    ),
      array(
        "type" => "dropdown",
        "heading" => __("Show navigation arrows", DPTPLNAME),
        "param_name" => "navigation",
			"value" => array(
					"No" => "no",
					"Yes" => "yes"		
	)
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Show pagination bullets", DPTPLNAME),
        "param_name" => "pagination",
			"value" => array(
					"No" => "no",
					"Yes" => "yes"		
	)
      ),

  )
));

/* Portfolio carousel */
vc_map( array(
  "name" => __("Portfolio carousel", DPTPLNAME),
  "base" => "portfolio_carousel",
  "icon" => "icon-wpb-portfolio-carousel",
  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  "description" => __('Portfolio items carousel', DPTPLNAME),
  "params" => array(
   array(
      "type" => "textfield",
      "heading" => __("Items in carousel total", DPTPLNAME),
      "param_name" => "show_items",
      "description" => __("How many items should be included in carousel", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Categories", DPTPLNAME),
      "param_name" => "categories",
      "description" => __("Coma separated list of categories to display. If you leave this field blank all items will be displayed.", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Excerpt characters limit", DPTPLNAME),
      "param_name" => "charlimit",
      "description" => __("How many characters should be displayed in post excerpt (default is 100)", DPTPLNAME),
	  "value" => "100"
    ),
    array(
      "type" => "textfield",
      "heading" => __("Items", DPTPLNAME),
      "param_name" => "items",
      "description" => __("Items to display on normal screen width > 1200px", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Items on desktop", DPTPLNAME),
      "param_name" => "itemsdesktop",
      "description" => __("Items to display on desktop screen width < 1200px", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Items on small desktop", DPTPLNAME),
      "param_name" => "itemsdesktopsmall",
      "description" => __("Items to display on desktop screen width < 980px. If you leave this field blank will be used setting from first not empty field above.", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Items on tablet", DPTPLNAME),
      "param_name" => "itemstablet",
      "description" => __("Items to display on tablet screen width < 768px. If you leave this field blank will be used setting from first not empty field above.", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Items on mobile devices", DPTPLNAME),
      "param_name" => "itemsmobile",
      "description" => __("Items to display on mobile devices width < 479px. If you leave this field blank will be used setting from first not empty field above.", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Autoplay", DPTPLNAME),
      "param_name" => "autoplay",
      "description" => __("Set autoplay speed in ms. If you leave blank autoplay will be disabled.", DPTPLNAME)
    ),

  )
));


/* Portfolio grid */
vc_map( array(
  "name" => __("Portfolio Grid", DPTPLNAME),
  "base" => "portfolio_grid",
  "icon" => "icon-wpb-portfolio-grid",
  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  "description" => __('Portfolio items grid', DPTPLNAME),
  "params" => array(
   array(
      "type" => "textfield",
      "heading" => __("Items", DPTPLNAME),
      "param_name" => "items",
      "description" => __("How many items should be displayed", DPTPLNAME)
    ),
   array(
        "type" => "dropdown",
        "heading" => __("Columns count", DPTPLNAME),
        "param_name" => "columns",
        "admin_label" => true,
			"value" => array(
					"2" => "2",
					"3" => "3",
					"4" => "4",
					"5" => "5",
					"6" => "6",
					"8" => "8"		
			),
      ),
    array(
      "type" => "textfield",
      "heading" => __("Categories", DPTPLNAME),
      "param_name" => "categories",
      "description" => __("Coma separated list of categories to display. If you leave this field blank all items will be displayed.", DPTPLNAME)
    ),
	array(
        "type" => "dropdown",
        "heading" => __("Thumb dimension", DPTPLNAME),
        "param_name" => "thumbsize",
        "admin_label" => true,
			"value" => array(
					"Horizontal 4:3" => "horizontal",
					"Vertical 3:4" => "vertical",
					"Square" => "square",
					"Origimal dimension" => "original"	
			),
      ),

   array(
        "type" => "dropdown",
        "heading" => __("Display category filter", DPTPLNAME),
        "param_name" => "filter",
        "admin_label" => true,
			"value" => array(
					"No" => "no",
					"Yes" => "yes"	
			),
      ),
   array(
        "type" => "dropdown",
        "heading" => __("Display lightbox icon in overlay", DPTPLNAME),
        "param_name" => "showlightbox",
        "admin_label" => true,
			"value" => array(
					"Yes" => "yes",
				    "No" => "no"
			),
      ),
   array(
        "type" => "dropdown",
        "heading" => __("Display link icon in overlay", DPTPLNAME),
        "param_name" => "showlink",
        "admin_label" => true,
			"value" => array(
					"Yes" => "yes",
				    "No" => "no"
			),
      ),
   array(
        "type" => "dropdown",
        "heading" => __("Display title in overlay", DPTPLNAME),
        "param_name" => "showtitle",
        "admin_label" => true,
			"value" => array(
					"Yes" => "yes",
				    "No" => "no"
			),
      ),   
	  array(
        "type" => "dropdown",
        "heading" => __("Display categories in overlay", DPTPLNAME),
        "param_name" => "showcategories",
        "admin_label" => true,
			"value" => array(
					"No" => "no",
					"Yes" => "yes"	
			),
      ),

   array(
        "type" => "dropdown",
        "heading" => __("Display short description in overlay", DPTPLNAME),
        "param_name" => "showdescription",
        "admin_label" => true,
			"value" => array(
					"No" => "no",
					"Yes" => "yes"	
			),
      ),
  )
));

/* Blog carousel */
vc_map( array(
  "name" => __("Blog carousel", DPTPLNAME),
  "base" => "blog_carousel",
  "icon" => "icon-wpb-blog-carousel",
  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  "description" => __('Portfolio items carousel', DPTPLNAME),
  "params" => array(
   array(
      "type" => "textfield",
      "heading" => __("Items in carousel total", DPTPLNAME),
      "param_name" => "show_items",
      "description" => __("How many items should be included in carousel", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Categories", DPTPLNAME),
      "param_name" => "categories",
      "description" => __("Coma separated list of categories to display. If you leave this field blank all items will be displayed.", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Items", DPTPLNAME),
      "param_name" => "items",
      "description" => __("Items to display on normal screen width > 1200px", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Items on desktop", DPTPLNAME),
      "param_name" => "itemsdesktop",
      "description" => __("Items to display on desktop screen width < 1200px", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Items on small desktop", DPTPLNAME),
      "param_name" => "itemsdesktopsmall",
      "description" => __("Items to display on desktop screen width < 980px. If you leave this field blank will be used setting from first not empty field above.", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Items on tablet", DPTPLNAME),
      "param_name" => "itemstablet",
      "description" => __("Items to display on tablet screen width < 768px. If you leave this field blank will be used setting from first not empty field above.", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Items on mobile devices", DPTPLNAME),
      "param_name" => "itemsmobile",
      "description" => __("Items to display on mobile devices width < 479px. If you leave this field blank will be used setting from first not empty field above.", DPTPLNAME)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Autoplay", DPTPLNAME),
      "param_name" => "autoplay",
      "description" => __("Set autoplay speed in ms. If you leave blank autoplay will be disabled.", DPTPLNAME)
    ),


  )
));

/* Blog grid */
vc_map( array(
  "name" => __("Blog Grid", DPTPLNAME),
  "base" => "blog_grid",
  "icon" => "icon-wpb-blog-grid",
  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  "description" => __('Blog items grid', DPTPLNAME),
  "params" => array(
   array(
        "type" => "dropdown",
        "heading" => __("Columns count", DPTPLNAME),
        "param_name" => "columns",
        "admin_label" => true,
			"value" => array(
					"2" => "2",
					"3" => "3",
					"4" => "4",
					"5" => "5",
					"6" => "6",
					"8" => "8"		
			),
      ),
   array(
      "type" => "textfield",
      "heading" => __("Total items count", DPTPLNAME),
      "param_name" => "items_count"
    ),
    array(
      "type" => "textfield",
      "heading" => __("Categories", DPTPLNAME),
      "param_name" => "categories",
      "description" => __("Coma separated list of categories to display. If you leave this field blank all items will be displayed.", DPTPLNAME)
    ),
   array(
        "type" => "dropdown",
        "heading" => __("Display category filter", DPTPLNAME),
        "param_name" => "filter",
        "admin_label" => true,
			"value" => array(
					"No" => "no",
					"Yes" => "yes"	
			),
      )
  )
));

/* Anchor */
vc_map( array(
  "name" => __("Anchor", DPTPLNAME),
  "base" => "anchor",
  "icon" => "icon-wpb-anchor",
  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
  "description" => __('Anchor in content', DPTPLNAME),
  "params" => array(
   array(
      "type" => "textfield",  
	  "admin_label" => true,
      "heading" => __("Name", DPTPLNAME),
      "param_name" => "name"
    )
  )
));

/* Popup Notification */

            wpb_map( array(
              "name" => __("Popup Notification", DPTPLNAME),
              "base" => "dp-notification",
              "controls" => "full",
              "icon" => "icon-wpb-popup-notify",
  			  "category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
              'description' => __( 'Popup notification on site scrolling', DPTPLNAME ),
              "params" => array(
                array(
                  "type" => "textarea_html",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Notification content", DPTPLNAME),
                  "param_name" => "content",
                  "value" => __("<p>I am test notification text block. Click edit button to change this text.</p>", DPTPLNAME),
                  "description" => __("", DPTPLNAME)
                ),
                array(
                  "type" => "dropdown",
                  "holder" => "",
                  "heading" => __("Display mode", DPTPLNAME),
                  "param_name" => "displaymode",
                  "value" => array(__("Only when user scrolling", DPTPLNAME) => "onscroll", __("When page is loaded", DPTPLNAME) => "onload" ),
                  "description" => __("Select when notification should be displayed", DPTPLNAME)
                ),
				array(
				  "type" => "number",
				  "class" => "",
				  "heading" => __("Scrolling ofset in px", DPTPLNAME),
				  "param_name" => "ofset",
				  "value" => "20",
				  "min"=>"1",
				  "suffix"=>"px",
                  "description" => __("Set ofset from top by wich notification display will be triggered", DPTPLNAME),
				  "dependency" => Array("element" => "displaymode","value" => array("onscroll")),
				),
                array(
                  "type" => "dropdown",
                  "holder" => "",
				  "admin_label" => true,
                  "heading" => __("Position", DPTPLNAME),
                  "param_name" => "position",
                  "value" => array ("Bottom right corner " => "BottomRight",
								    "Bottom left corner " => "BottomLeft",
								    "Top right corner " => "TopRight",
								    "Top left corner " => "TopLeft",
				  					"Top full width " => "OnTop",
				  					"Bottom full width" => "OnBottom"
									),
                  "description" => __("Select notification position on screen", DPTPLNAME)
				),
                array(
                  "type" => "colorpicker",
                  "class" => "",
                  "heading" => __("Notification text color", DPTPLNAME),
                  "param_name" => "textcolor",
                  "value" => '#555',
                  "description" => __("", DPTPLNAME)
                ),
                array(
                  "type" => "colorpicker",
                  "class" => "",
                  "heading" => __("Notification background", DPTPLNAME),
                  "param_name" => "bgcolor",
                  "value" => '#fff',
                  "description" => __("", DPTPLNAME)
                ),
                array(
                  "type" => "textfield",
                  "holder" => "",
                  "heading" => __("Notification box width", DPTPLNAME),
                  "param_name" => "width",
                  "value" => __("300", DPTPLNAME),
                  "description" => __("A fixed value like 400, or a percent value like 40%, or leave it to be blank equal to auto.", DPTPLNAME)
                ),
                array(
                  "type" => "textfield",
                  "holder" => "",
                  "heading" => __("Notification box height", DPTPLNAME),
                  "param_name" => "height",
                  "value" => __("auto", DPTPLNAME),
                  "description" => __("A fixed value like 200, or a percent value like 30%, or leave it to be blank equal to auto.", DPTPLNAME)
                ),
                array(
                  "type" => "dropdown",
                  "holder" => "",
                  "heading" => __("Animation", DPTPLNAME),
                  "param_name" => "animation",
                  "value" => array ("fadeIn " => "fadeIn", "fadeInUp" => "fadeInUp", "fadeInDown" => "fadeInDown", "fadeInLeft" => "fadeInLeft", "fadeInRight" => "fadeInRight", "fadeInUpBig" => "fadeInUpBig","fadeInDownBig" => "fadeInDownBig","fadeInLeftBig" => "fadeInLeftBig","fadeInRightBig" => "fadeInRightBig","lightSpeedRight" => "lightSpeedRight","lightSpeedLeft" => "lightSpeedLeft", "bounceIn" => "bounceIn", "bounceInUp" => "bounceInUp", "bounceInDown" => "bounceInDown", "bounceInLeft" => "bounceInLeft","bounceInRight" => "bounceInRight", "rotateInUpLeft" => "rotateInUpLeft", "rotateInDownLeft" => "rotateInDownLeft", "rotateInUpRight" => "rotateInUpRight", "rotateInDownRight" => "rotateInDownRight", "rollIn" => "rollIn", "pulse" => "pulse", "flipInX" => "flipInX"),
                  "description" => __("Select animation on notification appear", DPTPLNAME)
				),
                array(
                  "type" => "textfield",
                  "holder" => "",
                  "heading" => __("Auto hide delay", DPTPLNAME),
                  "param_name" => "hidedelay",
                  "value" => __("", DPTPLNAME),
                  "description" => __("For example, 5000 stand for 5 seconds, leave it to blank if you do not want it", DPTPLNAME)
                ),
				array(
				"type" => "textfield",
				"heading" => __("Extra class name", DPTPLNAME),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", DPTPLNAME),
      			)              
	  )
            ) );

/**** Vertical Dot Navigation***/

$custom_menus = array();
$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
if ( is_array( $menus ) ) {
	foreach ( $menus as $single_menu ) {
		$custom_menus[ $single_menu->name ] = $single_menu->slug;
	}
}

vc_map( array(
	'name' =>  __( "DP DotMenu" ),
	'base' => 'dp_dotnav',
	'icon' => 'icon-wpb-wp',
  	"category" =>array( __('by Dynamicpress', DPTPLNAME),__('Content', DPTPLNAME)),
	'class' => '',
	'description' => __( 'Use this element to add vertical dot navigation', DPTPLNAME ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Menu', 'js_composer' ),
			'param_name' => 'nav_menu',
			'value' => $custom_menus,
			'description' => empty( $custom_menus ) ? __( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'js_composer' ) : __( 'Select menu', DPTPLNAME ),
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', DPTPLNAME ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

?>