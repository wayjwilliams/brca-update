<?php
if(!function_exists('dynamo_file')) {
	/**
	 *
	 * Function used to get the file absolute path - useful when child theme is used
	 *
	 * @return file absolute path (in the original theme or in the child theme if file exists)
	 *
	 **/
	function dynamo_file($path) {
		if(is_child_theme()) {
			if($path == false) {
				return get_stylesheet_directory();
			} else {
				if(is_file(get_stylesheet_directory() . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path))) {
					return get_stylesheet_directory() . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path);
				} else {
					return get_template_directory() . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path);
				}
			}
		} else {
			if($path == false) {
				return get_template_directory();
			} else {
				return get_template_directory() . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path);
			}
		}
	}
}

if(!function_exists('dynamo_file_uri')) {
	/**
	 *
	 * Function used to get the file URI - useful when child theme is used
	 *
	 * @return file URI (in the original theme or in the child theme if file exists)
	 *
	 **/
	function dynamo_file_uri($path) {
		if(is_child_theme()) {
			if($path == false) {
				return get_stylesheet_directory_uri();
			} else {
				if(is_file(get_stylesheet_directory() . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path))) {
					return get_stylesheet_directory_uri() . '/' . $path;
				} else {
					return get_template_directory_uri() . '/' . $path;
				}
			}
		} else {
			if($path == false) {
				return get_template_directory_uri();
			} else {
				return get_template_directory_uri() . '/' . $path;
			}
		}
	}
}
//
if(!class_exists('DynamoWP')) {
	// include the framework base class
	require(dynamo_file('dynamo_framework/base.php'));
}
// load and parse template JSON file.
$config_language = 'en_US';
$json_data = wp_remote_get (get_template_directory_uri() . '/dynamo_framework/config/'.$config_language.'/template.json');
$json_data = json_decode( $json_data['body'] );
$dynamo_tpl_name = strtolower(preg_replace("/[^A-Za-z0-9]/", "", $json_data->template->name));
// define constant to use with all __(), _e(), _n(), _x() and _xe() usage
define('DPTPLNAME', $dynamo_tpl_name);
// create the framework object
$dynamo_tpl = new DynamoWP();
// Including file with helper functions
require_once(dynamo_file('dynamo_framework/helpers/helpers.base.php'));
// Including file with template hooks
require_once(dynamo_file('dynamo_framework/hooks.php'));
// Including file with template functions
require_once(dynamo_file('dynamo_framework/functions.php'));
require_once(dynamo_file('dynamo_framework/user.functions.php'));
// Including file with woocommerce functions
if (isset($woocommerce)) : 
	require_once(dynamo_file('woocommerce/woocommerce-functions.php'));
endif;
// Including file with template filters
require_once(dynamo_file('dynamo_framework/filters.php'));
// Including file with template widgets
require_once(dynamo_file('dynamo_framework/widgets.comments.php'));
require_once(dynamo_file('dynamo_framework/widgets.tabs.php'));
require_once(dynamo_file('dynamo_framework/widgets.flickr.php'));
require_once(dynamo_file('dynamo_framework/widgets.recent_portfolio.php'));
require_once(dynamo_file('dynamo_framework/widgets.recent_posts.php'));
require_once(dynamo_file('dynamo_framework/widgets.newsflash.php'));
// Including file with template admin features
require_once(dynamo_file('dynamo_framework/helpers/helpers.features.php'));
// Including file with template layout functions
require_once(dynamo_file('dynamo_framework/helpers/helpers.layout.php'));
// Including file with template layout functions - connected with template fragments
require_once(dynamo_file('dynamo_framework/helpers/helpers.layout.fragments.php'));
// Including file with template branding functions
require_once(dynamo_file('dynamo_framework/helpers/helpers.branding.php'));
// Including file with template customize functions
require_once(dynamo_file('dynamo_framework/helpers/helpers.customizer.php'));
// Including file with dynamic options based CSS 
require_once(dynamo_file('dynamo_framework/helpers/helpers.dynamic.css.php'));
// Including file with widget rules functions
function dynamo_widget_rules() {
	global $dynamo_tpl;
	if (get_option($dynamo_tpl->name . '_widget_rules_state') == 'Y') {
	require_once(dynamo_file('dynamo_framework/widget-rules.php'));
	}
}
add_action('init', 'dynamo_widget_rules');
// initialize the framework
$dynamo_tpl->init();
// add theme setup function
add_action('after_setup_theme', 'dynamo_theme_setup');
// Theme setup function
function dynamo_theme_setup(){
	// access to the global template object
	global $dynamo_tpl;
	// variable used for redirects
	global $pagenow;		
	// check if the themes.php address with goto variable has been used
	if ($pagenow == 'themes.php' && !empty($_GET['goto'])) {
		/**
		 *
		 * IMPORTANT FACT: if you're using few different redirects on a lot of subpages
		 * we recommend to define it as themes.php?goto=X, because if you want to
		 * change the URL for X, then you can change it on one place below :)
		 *
		 **/
		
		// check the goto value
		switch ($_GET['goto']) {
			// make proper redirect
			case 'dynamicpress':
				wp_redirect(get_option($dynamo_tpl->name . '_theme_author_link'));
				break;
			case 'documentation':
				wp_redirect(get_option($dynamo_tpl->name . '_theme_documentation_link'));
				break;
			// or use default redirect
			default:
				wp_safe_redirect('/wp-admin/');
				break;
		}
		exit;
	}
	// if the normal page was requested do following operations:
	
    // load and parse template JSON file.
    $json_data = $dynamo_tpl->get_json('config','template');
    // read the configuration
    $template_config = $json_data->template;
    // save the lowercase non-special characters template name				
    $template_name = strtolower(preg_replace("/[^A-Za-z0-9]/", "", $template_config->name));
    // load the template text_domain
	load_theme_textdomain( $template_name, get_stylesheet_directory() . '/languages' );
}
if (isset($woocommerce)) {
if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
} else {
	define( 'WOOCOMMERCE_USE_CSS', false );
}
}
// style enqueue function
    function dynamo_enqueue_css() {
	global $dynamo_tpl;
	wp_register_style('dp-css', get_template_directory_uri().'/css/basic.css');
	wp_enqueue_style('dp-css');
	if(get_option($dynamo_tpl->name . "_overridecss_state", 'Y') == 'Y') {
	wp_register_style('override-css', get_template_directory_uri().'/css/override.css');
	wp_enqueue_style('override-css');
	}
    if(is_rtl()) {
	wp_register_style('rtl-css', get_template_directory_uri().'/css/rtl.css');
	wp_enqueue_style('rtl-css');
 	}

	preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);
	if(count($matches)<2){
 	 preg_match('/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $_SERVER['HTTP_USER_AGENT'], $matches);
	}
	if (count($matches)>1){
	  //Then we're using IE
	  $version = $matches[1];
	  switch(true){
		case ($version<=8):
		wp_register_style('ie8-css', get_template_directory_uri().'/css/ie8.css');
		  break;
	
		case ($version==9):
		wp_register_style('ie9-css', get_template_directory_uri().'/css/ie9.css');
		  break;
	  }
	}
	}
	add_action('wp_enqueue_scripts', 'dynamo_enqueue_css');
// scripts enqueue function



    function dynamo_enqueue_js() {
	global $dynamo_tpl;
	// Common scripts
	wp_register_script('common-js', get_template_directory_uri().'/js/common_scipts.js', array('jquery'),false,true);
	wp_enqueue_script('common-js');
	// jQuery isotope JS
	wp_register_script( 'jQuery-isotope-js',get_template_directory_uri().'/js/jquery.isotope.min.js', array('jquery'),false,true);
	wp_enqueue_script( 'jQuery-isotope-js' );
	// Flex slider JS
	wp_register_script( 'flexslider-js',get_template_directory_uri().'/js/jquery.flexslider-min.js', array('jquery'), false,false);
	// FSS slider JS
	wp_register_script( 'fss-js',get_template_directory_uri().'/js/fss.js', array('jquery'), false,false);
	wp_register_script( 'fss-config-js',get_template_directory_uri().'/js/fss-config.js', array('jquery'), false,false);
	// jQuery tipsy JS
	wp_register_script( 'jQuery-tipsy-js',get_template_directory_uri().'/js/jquery.tipsy.js', array('jquery'),false,true);
	wp_enqueue_script( 'jQuery-tipsy-js' );
	// Owl carousel 
	wp_register_script('owl-js', get_template_directory_uri().'/js/owl.carousel.min.js', array('jquery'),false,true);
	wp_enqueue_script('owl-js');
	// jQuery selectfix
	wp_register_script('selectfix-js', get_template_directory_uri().'/js/selectFix.js', array('jquery'),false,true);
	wp_enqueue_script('selectfix-js');
	wp_register_script('menu-js', get_template_directory_uri().'/js/dp.menu.js', array('jquery'),  false,true);
	wp_enqueue_script('menu-js');
	if(get_option($dynamo_tpl->name . '_prefixfree_state', 'N') == 'Y') { 
	wp_enqueue_script('dynamo-prefixfree', dynamo_file_uri('js/prefixfree.js'));
	}
	if(get_option($dynamo_tpl->name . '_prefixfree_state', 'N') == 'Y') { 
	wp_enqueue_script('dynamo-prefixfree', dynamo_file_uri('js/prefixfree.js'));
	}
	if ( ! is_admin() ) {
	wp_register_script('frontend-js', get_template_directory_uri().'/js/frontend.js', array('jquery'), false,true);
	wp_enqueue_script('frontend-js');

	}
	}


add_action('wp_enqueue_scripts', 'dynamo_enqueue_js');

// scripts enqueue function
function dynamo_enqueue_admin_js_and_css() {
	// DP scripts 
	wp_enqueue_script('dp_admin_js', dynamo_file_uri('js/back-end/dp_scripts.js'), array('jquery'),'',true);
	// metaboxes scripts 
	wp_enqueue_script('dynamo.metabox.js', dynamo_file_uri('js/back-end/dynamo.metabox.js'), array('jquery'),'',true);
	wp_enqueue_media();
	// metaboxes CSS 
	wp_register_style('dynamo-metabox-css', dynamo_file_uri('css/back-end/metabox.css'));  
    wp_enqueue_style('dynamo-metabox-css');  
	//Color picker
	wp_register_script('spectrum', dynamo_file_uri('js/back-end/libraries/spectrum/spectrum.js'), array('jquery'));
	wp_enqueue_script('spectrum');
	wp_register_style('spectrum-css', dynamo_file_uri('js/back-end/libraries/spectrum/spectrum.css'));
	wp_enqueue_style('spectrum-css');
	// metaboxes CSS
	wp_register_style('metaboxes-css', get_template_directory_uri().'/dynamo_framework/metaboxes/meta.css');
	wp_enqueue_style('metaboxes-css');
	// shortcodes database
	if(
		get_locale() != '' && 
		is_dir(get_template_directory() . '/dynamo_framework/config/'. get_locale()) && 
		is_dir(get_template_directory() . '/dynamo_framework/options/'. get_locale())
	) {
		$language = get_locale();	
	} else {
		$language = 'en_US';
	}
	
}
// this action enqueues scripts and styles: 
add_action('admin_enqueue_scripts', 'dynamo_enqueue_admin_js_and_css');
wp_oembed_add_provider( 'http://soundcloud.com/*', 'http://soundcloud.com/oembed' );
wp_oembed_add_provider( '#http://(www\.)?youtube\.com/watch.*#i', 'http://www.youtube.com/oembed', true );
wp_oembed_add_provider( '#http://(www\.)?vimeo\.com/.*#i', 'http://vimeo.com/api/oembed.{format}', true );

function dp_excerpt($text) {
   return str_replace('[&hellip;]', '<p><a class="readon" href="'.get_permalink().'"><span>'.__( 'read more', DPTPLNAME ).'</span></a></p>', $text); }
add_filter('the_excerpt', 'dp_excerpt');

function dp_excerpt_length($length) {
	global $dynamo_tpl;
 	return get_option($dynamo_tpl->name . "_excerpt_length"); }
add_filter('excerpt_length', 'dp_excerpt_length');

function dynamo_enqueue_icomoon_styles() {
        global $wp_styles;
        wp_enqueue_style( 'dp-icomoon', get_template_directory_uri().'/css/dp_icomoon.css' );
    }
add_action('init', 'dynamo_enqueue_icomoon_styles');


function dynamo_enqueue_woocommerce_css(){
	wp_register_style( 'woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );
	if ( class_exists( 'woocommerce' ) ) {
		wp_enqueue_style( 'woocommerce' );
	}
}
add_action( 'wp_enqueue_scripts', 'dynamo_enqueue_woocommerce_css' );

add_action( 'admin_init', 'dp_theme_check_clean_installation' );
function dp_theme_check_clean_installation(){
	add_action( 'admin_notices', 'dp_theme_options_reminder' );
}

if ( ! function_exists( 'dp_theme_options_reminder' ) ){
	function dp_theme_options_reminder(){
		global $dynamo_tpl; 

		if (get_option($dynamo_tpl->name . '_template_options_saved')!='Y'){
			printf( __('<div class="updated"><p>This is a fresh installation of %1$s theme. Don\'t forget to go to <a href="%2$s">Blend -> Template Options panel</a> to set it up. This message will disappear once you have clicked the Save button within the <a href="%2$s">theme\'s options page</a>.</p></div>','Blend'), wp_get_theme(), network_admin_url( 'admin.php?page=dynamo-menu' ) );
		}
	}
}
function change_mce_options( $init ) {
 $init['theme_advanced_blockformats'] = 'p,address,pre,code,h3,h4,h5,h6';
 $init['theme_advanced_disable'] = 'forecolor';
 return $init;
}
add_filter('tiny_mce_before_init', 'change_mce_options');

/***************************************************************************
* Function: Sets, Tracks and Displays the Count of Post Views (Post View Counter)
*********************************************************************************/
//Set the Post Custom Field in the WP dashboard as Name/Value pair 
function dp_PostViews($post_ID) {
 
    //Set the name of the Posts Custom Field.
    $count_key = 'post_views_count'; 
     
    //Returns values of the custom field with the specified key from the specified post.
    $count = get_post_meta($post_ID, $count_key, true);
     
    //If the the Post Custom Field value is empty. 
    if($count == ''){
        $count = 0; // set the counter to zero.
         
        //Delete all custom fields with the specified key from the specified post. 
        delete_post_meta($post_ID, $count_key);
         
        //Add a custom (meta) field (Name/value)to the specified post.
        add_post_meta($post_ID, $count_key, '0');
        return $count . ' View';
     
    //If the the Post Custom Field value is NOT empty.
    }else{
        $count++; //increment the counter by 1.
        //Update the value of an existing meta key (custom field) for the specified post.
        update_post_meta($post_ID, $count_key, $count);
         
        //If statement, is just to have the singular form 'View' for the value '1'
        if($count == '1'){
        $count = $count .' '. __('View', DPTPLNAME);
        }
        //In all other cases return (count) Views
        else {
        $count = $count .' '. __('Views', DPTPLNAME);
        }
		$output = '<a href="#" class="dp-tipsy1" data-tipcontent="'.$count.'" original-title=""><i class="icon-eye-outline"></i></a>';
		return $output;
    }
}
//Gets the  number of Post Views to be used later.
function get_PostViews($post_ID){
    $count_key = 'post_views_count';
    //Returns values of the custom field with the specified key from the specified post.
    $count = get_post_meta($post_ID, $count_key, true);
 
    return $count;
}
 
//Function that Adds a 'Views' Column to your Posts tab in WordPress Dashboard.
function post_column_views($newcolumn){
    //Retrieves the translated string, if translation exists, and assign it to the 'default' array.
    $newcolumn['post_views'] = __('Views', DPTPLNAME);
    return $newcolumn;
}

//Function that Populates the 'Views' Column with the number of views count.
function post_custom_column_views($column_name, $id){
     
    if($column_name === 'post_views'){
        // Display the Post View Count of the current post.
        // get_the_ID() - Returns the numeric ID of the current post.
        echo get_PostViews(get_the_ID());
    }
}
//Hooks a function to a specific filter action.
//applied to the list of columns to print on the manage posts screen.
add_filter('manage_posts_columns', 'post_column_views');
 
//Hooks a function to a specific action. 
//allows you to add custom columns to the list post/custom post type pages.
//'10' default: specify the function's priority.
//and '2' is the number of the functions' arguments.
add_action('manage_posts_custom_column', 'post_custom_column_views',10,2);

/**
 * Load welcome message.
 */
require get_template_directory() . '/dynamo_framework/theme.welcome.php';


/**
Woocmerce page check
*/
function dp_is_woocommerce_page () {
        if(  function_exists ( "is_woocommerce" ) && is_woocommerce()){
                return true;
        }
        $woocommerce_keys   =   array ( "woocommerce_shop_page_id" ,
                                        "woocommerce_terms_page_id" ,
                                        "woocommerce_cart_page_id" ,
                                        "woocommerce_checkout_page_id" ,
                                        "woocommerce_pay_page_id" ,
                                        "woocommerce_thanks_page_id" ,
                                        "woocommerce_myaccount_page_id" ,
                                        "woocommerce_edit_address_page_id" ,
                                        "woocommerce_view_order_page_id" ,
                                        "woocommerce_change_password_page_id" ,
                                        "woocommerce_logout_page_id" ,
                                        "woocommerce_lost_password_page_id" ) ;
        foreach ( $woocommerce_keys as $wc_page_id ) {
                if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
                        return true ;
                }
        }
        return false;
}
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/dynamo_framework/classes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'dp_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function dp_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'DP Functions', 
			'slug'     				=> 'dp_functions', 
			'source'   				=> get_template_directory() . '/plugins/dp_functions.zip', 
			'required' 				=> true,
			'force_activation' 		=> false, 
			'force_deactivation' 	=> false, 
		),
		array(
			'name'     				=> 'Visual Composer', 
			'slug'     				=> 'js_composer', 
			'source'   				=> 'http://www.dynamicpress.eu/downloads/plugins/visual_composer/4_6_2/js_composer.zip', 
			'required' 				=> true,
			'version' 				=> '', 
			'force_activation' 		=> false, 
			'force_deactivation' 	=> false, 
			'external_url' 			=> 'http://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431', 
		),
		array(
			'name'     				=> 'Revolution Slider', 
			'slug'     				=> 'revslider', 
			'source'   				=> 'http://www.dynamicpress.eu/downloads/plugins/revslider/4_693/revslider.zip',  
			'required' 				=> true,
			'version' 				=> '', 
			'force_activation' 		=> false, 
			'force_deactivation' 	=> false, 
			'external_url' 			=> 'http://codecanyon.net/item/slider-revolution-responsive-wordpress-plugin/2751380', 
		),
		array(
			'name' => 'Contact Form 7',
			'slug' => 'contact-form-7',
			'required' => false
		),
		array(
			'name' => 'Newsletter Sign-Up',
			'slug' => 'newsletter-sign-up',
			'required' => false
		),
		array(
			'name' => 'WooCommerce',
			'slug' => 'woocommerce',
			'required' => false
		),
		array(
			'name' => 'YITH WooCommerce Compare',
			'slug' => 'yith-woocommerce-compare',
			'required' => false
		),
		array(
			'name' => 'YITH WooCommerce Wishlist',
			'slug' => 'yith-woocommerce-wishlist',
			'required' => false
		),
		array(
			'name' => 'YITH WooCommerce Zoom Magnifier',
			'slug' => 'yith-woocommerce-zoom-magnifier',
			'required' => false
		)
	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'DPTPLNAME';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'dynamo-menu', 				// Default parent menu slug
		'parent_url_slug' 	=> 'admin.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '<p>The following plugins are required for the proper functioning of the theme.</p>',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', DPTPLNAME ),
			'menu_title'                       			=> __( 'Install Plugins', DPTPLNAME ),
			'installing'                       			=> __( 'Installing Plugin: %s', DPTPLNAME ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', DPTPLNAME ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', DPTPLNAME ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', DPTPLNAME ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', DPTPLNAME ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}
//Initialiising DP Icon Fonts Manager 
require_once locate_template('dynamo_framework/font_icon_manager/dp_icon_manager.php');
// Initialising Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	function requireVcExtend(){
		require_once locate_template('dynamo_framework/vc_extend/dp-extend-vc.php');
		
	}
	add_action('init', 'requireVcExtend',2);
}
require_once(dynamo_file('dynamo_framework/import/dynamo-demo-import.php'));
