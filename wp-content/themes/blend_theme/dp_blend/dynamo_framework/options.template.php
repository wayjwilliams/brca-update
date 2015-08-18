<?php
	
// disable direct access to the file	
defined('DYNAMO_WP') or die('Access denied');	

/**
 *
 * Function to create template options page
 *
 * @return null
 *
 **/
	
function dynamo_template_options() {
	// getting access to the template global object. 
	global $dynamo_tpl;
	
	// check permissions
	if (!current_user_can('manage_options')) {  
	    wp_die(__('You don\'t have sufficient permissions to access this page!', DPTPLNAME));  
	} 
	  
	include_once(dynamo_file('dynamo_framework/layouts/template.php'));
}

/**
 *
 * Function used to load template options page JS code
 *
 * @return null
 * 
 **/
 
function dynamo_template_options_js() {
	// variable used for the page detection
	global $pagenow;
	// template object
	global $dynamo_tpl;
	// check the page
	if($pagenow == 'admin.php' && isset($_GET['page']) && ($_GET['page'] == 'template_options' || $_GET['page'] == 'dynamo-menu')) {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('dp-tips-js', get_template_directory_uri().'/js/back-end/libraries/miniTip/miniTip.min.js', array('jquery'));
		wp_register_script('dp-upload', get_template_directory_uri().'/js/back-end/template.options.js', array('jquery','media-upload','thickbox', 'dp-tips-js'));
		wp_register_script('dp-tips-js', dynamo_file_uri('js/back-end/libraries/miniTip/miniTip.min.js'), array('jquery'));
        wp_register_script('dp-upload', dynamo_file_uri('js/back-end/template.options.js'), array('jquery','media-upload','thickbox', 'gk-tips-js'));
		wp_enqueue_script('dp-upload');
		wp_enqueue_script('dp-tips-js');
		wp_register_script('jquery-ui-js', dynamo_file_uri('js/back-end/libraries/jQueryUI/jquery-ui.js'), array('jquery'));
		wp_enqueue_script('jquery-ui-js');
		wp_register_style('jquery-ui-css', get_template_directory_uri().'/js/back-end/libraries/jQueryUI/jquery-ui.css');
		wp_enqueue_style('jquery-ui-css');

		// register and load external components scripts
		$tabs = $dynamo_tpl->get_json('options','tabs');
		// iterate through tabs
		foreach($tabs as $tab) {
			if($tab[2] == 'enabled') {
				// load file
				$loaded_data = $dynamo_tpl->get_json('options', $tab[1]);	
				// check the loaded JSON data
				if($loaded_data != null && count($loaded_data != 0)) {
					$standard_fields = array('Text', 'Select', 'RawText', 'Switcher', 'Textarea', 'Media', 'WidthHeight', 'Menu', 'TextBlock', 'Color', 'Background', 'Taxonomy', 'HTML', 'Slider', 'Save');
					// iterate through groups
					foreach($loaded_data as $group) {
						// 
						foreach($group->fields as $field) {
							if(!in_array($field->type, $standard_fields)) {
								// load field config
								$file_config = $dynamo_tpl->get_json('form_elements/'.$field->type, 'config', false);
								// check if the file is correct
								if((is_array($file_config) && count($file_config) > 0) || is_object($file_config)) {
									// load the JS file
									if($file_config->js != '') {
										wp_register_script('dp_'.strtolower($file_config->name).'.js', dynamo_file_uri('dynamo_framework/form_elements/').($field->type).'/'.($file_config->js));
										wp_enqueue_script('dp_'.strtolower($file_config->name).'.js');
									}
								}
							}
						}
					}
				}
			}
		}	
	}
}

/**
 *
 * Function used to load template options CSS code
 *
 * @return null
 * 
 **/
 
function dynamo_template_options_css() {
	// variable used for the page detection
	global $pagenow;
	// template object
	global $dynamo_tpl;
	// check the page
	if($pagenow == 'admin.php' && isset($_GET['page']) && ($_GET['page'] == 'template_options' || $_GET['page'] == 'dynamo-menu')) {
		wp_enqueue_style('thickbox');
		wp_register_style('dp-tips-css', dynamo_file_uri('js/back-end/libraries/miniTip/miniTip.css'));
        wp_register_style('dp-template-css', dynamo_file_uri('css/back-end/template.css'));
		wp_enqueue_style('dp-tips-css');
		wp_enqueue_style('dp-template-css');
		// register and load external components scripts
		$tabs = $dynamo_tpl->get_json('options','tabs');
		// iterate through tabs
		foreach($tabs as $tab) {
			if($tab[2] == 'enabled') {
				// load file
				$loaded_data = $dynamo_tpl->get_json('options', $tab[1]);	
				// check the loaded JSON data
				if($loaded_data != null && count($loaded_data != 0)) {
					$standard_fields = array('Text', 'Select', 'RawText', 'Switcher', 'Textarea', 'Media', 'WidthHeight','Menu', 'TextBlock', 'Color', 'Background', 'Taxonomy', 'HTML', 'Slider', 'Save');
					// iterate through groups
					foreach($loaded_data as $group) {
						// 
						foreach($group->fields as $field) {
							if(!in_array($field->type, $standard_fields)) {
								// load field config
								$file_config = $dynamo_tpl->get_json('form_elements/'.$field->type, 'config', false);
								// check if the file is correct
								if((is_array($file_config) && count($file_config) > 0) || is_object($file_config)) {
									// load the CSS file
									if($file_config->css != '') {
										wp_register_style('dp_'.strtolower($file_config->name).'.css', dynamo_file_uri('dynamo_framework/form_elements/').($field->type).'/'.($file_config->css));
										wp_enqueue_style('dp_'.strtolower($file_config->name).'.css');
									}
								}
							}
						}
					}
				}
			}
		}	
	}
}

/**
 *
 * Function used define template JS callback for saving options
 *
 * @return null
 * 
 **/

function dynamo_template_save_js() {
	$ajax_nonce = wp_create_nonce('DynamoWPNonce');
	echo '<script type="text/javascript">$dp_ajax_nonce = "'.$ajax_nonce.'";</script>';
}

/**
 *
 * Function to create callback for template save ajax request
 *
 * @return null
 *
 **/

function dynamo_template_save_callback() {
	// getting access to the template global object. 
	global $dynamo_tpl;
	
	// check user capability to made operation
	if ( current_user_can( 'manage_options' ) ) {
	 	// check security with nonce.
 		if ( function_exists( 'check_ajax_referer' ) ) { 
 			check_ajax_referer( 'DynamoWPNonce', 'security' ); 
 		}
 		// save the settings - iterate throught all $_POST variables
 		foreach($_POST as $key => $value) {
 			if(strpos($key, $dynamo_tpl->name . '_') !== false) {
 				update_option($key, esc_attr($value)); 
 			}
			}
		CompileOptionsLess('options.less'); 
			// return the results
			__('Settings saved', DPTPLNAME);
 		// this is required to return a proper result 
 		die();   
	} else {
		wp_die(__('You don\'t have sufficient permissions to access this page!', DPTPLNAME)); 
	}
}
	
// adding template save callback
add_action( 'wp_ajax_template_save', 'dynamo_template_save_callback' );

// EOF