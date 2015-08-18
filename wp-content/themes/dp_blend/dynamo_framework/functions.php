<?php

// disable direct access to the file	
defined('DYNAMO_WP') or die('Access denied');	

/**
 *
 * Main functions
 *
 * Functions used to creacte dashboard menus.
 *
 **/

// load file with Template Options page
require_once(dynamo_file('dynamo_framework/options.template.php'));
// load file with Import/Export settings page
require_once(dynamo_file('dynamo_framework/options.importexport.php'));
/**
 *
 * Function to add menu items in the admin panel
 *
 **/

if(!function_exists('dynamo_admin_menu')) {
	
	function dynamo_admin_menu() {		
		
		// getting access to the template global object. 
		global $dynamo_tpl;
		// set the default icon path
		$icon_path = dynamo_file_uri('images/back-end/small_logo.png');
		// check if user set his own icon and then replace the default path
		if(get_option($dynamo_tpl->name . "_branding_admin_page_image") != '') {
			$icon_path = get_option($dynamo_tpl->name . "_branding_admin_page_image");
		}
		// creating main menu item for the template settings
		if (get_option($dynamo_tpl->name . "_branding_admin_page_template_name") !='') $templatename = get_option($dynamo_tpl->name . "_branding_admin_page_template_name");
		else $templatename = $dynamo_tpl->config['template']->name;
		$plugin_page = add_object_page(
			'DynamoWP Framework', 
			$templatename, 
			'manage_options',
			'dynamo-menu', 
			'dynamo_template_options', 
			$icon_path );
		
		// checking if showing template options is enabled
		if($dynamo_tpl->config['developer_config']->visibility->template_options == 'true') {
			//
			$plugin_page = add_submenu_page( 
				'dynamo-menu', 
				$dynamo_tpl->config['template']->name, 
				__('Template options', DPTPLNAME), 
				'manage_options', 
				'dynamo-menu',
				'dynamo_template_options' );
			// save callback
			add_action( "admin_head-" . $plugin_page, 'dynamo_template_save_js' );
			// adding scripts and stylesheets
			add_action('admin_enqueue_scripts', 'dynamo_template_options_js');
			dynamo_template_options_css(); 
		}
		
		// checking if showing import/export options is enabled
		if($dynamo_tpl->config['developer_config']->visibility->importexport == 'true') {
			//
			$plugin_page = add_submenu_page( 
				'dynamo-menu', 
				$dynamo_tpl->config['template']->name, 
				__('Import/Export', DPTPLNAME), 
				'manage_options', 
				'importexport_options',
				'dynamo_importexport_options' );
		}
		// checking if showing documentation options is enabled
		if($dynamo_tpl->config['developer_config']->visibility->documentation == 'true') {
			if (get_option($dynamo_tpl->name . '_show_documentation_link') =='Y' && get_option($dynamo_tpl->name . '_theme_documentation_link') !='') {
			$plugin_page = add_submenu_page( 
				'dynamo-menu', 
				$dynamo_tpl->config['template']->name, 
				__('Documentation', DPTPLNAME), 
				'manage_options', 
				'themes.php?goto=documentation' );
			}
		}
		
		// checking if showing DynamicPress information is enabled
		if($dynamo_tpl->config['developer_config']->visibility->dynamicpress_website == 'true') {
			if (get_option($dynamo_tpl->name . '_show_theme_author_link') =='Y' && get_option($dynamo_tpl->name . '_theme_author_link') !='') {
			$plugin_page = add_submenu_page( 
				'dynamo-menu', 
				$dynamo_tpl->config['template']->name, 
				__('Author Website', DPTPLNAME), 
				'manage_options',
				'themes.php?goto=dynamicpress' );
			}
		}
	}
}
/**
 *
 * Function to add widgets areas
 *
 * This function loads widgets areas based on widgets.json file
 *
 **/

if(!function_exists('dynamo_widgets_init')) {
	
	function dynamo_widgets_init() {
		// getting access to the template global object. 
		global $dynamo_tpl;
		// load and parse template JSON file.
		$json_data = $dynamo_tpl->get_json('config','widgets');
		// init the widgets array
		$dynamo_tpl->widgets = array();
		// iterate through all widget areas in the file
		foreach ($json_data as $widget_area) {
			// set the widgets amount
			if(isset($widget_area->amount)) {
				$dynamo_tpl->widgets[(string) $widget_area->id] = (int) $widget_area->amount;
			}
			// register sidebar
			register_sidebar(
				array(
					'name' 			=> (string) $widget_area->name,
					'id' 			=> (string) $widget_area->id,
					'description'   => (string) $widget_area->description,
					'before_widget' => $widget_area->before_widget,
					'after_widget' 	=> $widget_area->after_widget,
					'before_title' 	=> $widget_area->before_title,
					'after_title' 	=> $widget_area->after_title
				)
			);
		}
	}
	
}

if(!function_exists('dynamoPostContent')) {
	function dynamoPostContent() {
		$content = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', get_the_content()));
		return $content;
	}
}
if(!function_exists('dynamoPostExcerpt')) {
	function dynamoPostExcerpt() {
		$content = apply_filters( 'the_excerpt', get_the_excerpt() );
		return $content;
	}
}
if(!function_exists('dynamoPostExcerptbyID')) {
function dynamoPostExcerptbyID($post_id, $excerpt_length = 35, $line_breaks = TRUE){
$the_post = get_post($post_id); //Gets post ID
$the_excerpt = $the_post->post_excerpt ? $the_post->post_excerpt : $the_post->post_content; //Gets post_excerpt or post_content to be used as a basis for the excerpt
$the_excerpt = apply_filters('the_excerpt', $the_excerpt);
$the_excerpt = $line_breaks ? strip_tags(strip_shortcodes($the_excerpt), '<p><br>') : strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
$words = explode(' ', $the_excerpt, $excerpt_length + 1);
if(count($words) > $excerpt_length) :
  array_pop($words);
  array_push($words, '…');
  $the_excerpt = implode(' ', $words);
  $the_excerpt = $line_breaks ? $the_excerpt . '</p>' : $the_excerpt;
endif;
$the_excerpt = trim($the_excerpt);
return $the_excerpt;
}
}
if(!function_exists('dp1_excerpt')) {
	/**
	 * Function that cuts post excerpt to the number of word based on previosly set global
	 * variable $word_count, which is defined in qode_set_blog_word_count function
	 */
	function dp1_excerpt() {
		global $dynamo_tpl, $post;
		$word_count = get_option($dynamo_tpl->name . '_excerpt_len','55');
		if($word_count != '0') {
			remove_filter('the_content', 'wpautop');
			$post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content);
			$clean_excerpt = strlen($post_excerpt) && strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;

			$excerpt_word_array = explode (' ', $clean_excerpt);
			$excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count);
			$excerpt = implode (' ', $excerpt_word_array).'...';

			//is excerpt different than empty string?
			if($excerpt !== '') {
				echo '<p class="post_excerpt">'.$excerpt.'</p>';
			}
		}
	}
}

// EOF