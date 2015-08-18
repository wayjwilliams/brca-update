<?php

// disable direct access to the file	
defined('DYNAMO_WP') or die('Access denied');	

/**
 *
 * Code used to implement theme customizer
 *
 **/
function dynamo_init_customizer() {
	global $dynamo_tpl;
	global $wp_customize;
	
	// read the template styles
	$json_data = $dynamo_tpl->get_json('config', 'styles');
	// iterate through all menus in the file
	foreach ($json_data as $styles) {
		// get option value
		$template_style = get_option($dynamo_tpl->name . '_template_style_'.($styles->family), '');
		// styles array
		$styles_array = array();
		// iterate through styles
		foreach($styles->styles as $style) {
			$styles_array[(string)$style->value] = (string)$style->name;
		}
		// create setting
		$wp_customize->add_setting( 
			$dynamo_tpl->name . '_template_style_'.($styles->family), 
			array(
		    	'default' => $template_style,
		    	'type'	=> 'option',
		    	'capability' => 'edit_theme_options',
				'priority' => 1 ,
			'sanitize_callback' => 'esc_attr'
			) 
		);
		// create control
		$wp_customize->add_control( 
			$dynamo_tpl->name . '_template_style_'.($styles->family), 
			array(
			    'label'   => $styles->family_desc,
			    'section' => 'colors',
			    'type'    => 'select',
			    'choices' => $styles_array,
				'priority' => 2
			) 
		);
	}	
	// creating the sections for other options
	$wp_customize->add_section( 
		$dynamo_tpl->name . '_responsive', 
		array(
	    	'title' => __('Responsive Design Settings', DPTPLNAME),
		    'priority' => 37
		) 
	);
	
	$wp_customize->add_section( 
		$dynamo_tpl->name . '_dimensions', 
		array(
	    	'title' => __('Dimensions', DPTPLNAME),
		    'priority' => 36
		) 
	);
	$wp_customize->add_section( 
		$dynamo_tpl->name . '_layout', 
		array(
	    	'title' => __('Layout', DPTPLNAME),
		    'priority' => 35
		) 
	);
	// creating the necessary settings
	$wp_customize->add_setting( 
		$dynamo_tpl->name . '_sidebar_position', 
		array(
	    	'default' => 'right',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_attr'
		) 
	);
	
	
	$wp_customize->add_setting( 
		$dynamo_tpl->name . '_template_width', 
		array(
	    	'default' => '1230',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_attr'
		) 
	);
	
	$wp_customize->add_setting( 
		$dynamo_tpl->name . '_sidebar_width', 
		array(
	    	'default' => '22',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_attr'
		) 
	);

	$wp_customize->add_setting( 
		$dynamo_tpl->name . '_tablet_width', 
		array(
	    	'default' => '800',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_attr'
		) 
	);
	
	$wp_customize->add_setting( 
		$dynamo_tpl->name . '_small_tablet_width', 
		array(
	    	'default' => '820',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_attr'
		) 
	);
	
	$wp_customize->add_setting( 
		$dynamo_tpl->name . '_mobile_width', 
		array(
	    	'default' => '480',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_attr'
		) 
	);
	// adding necessary controls
	$wp_customize->add_control( 
		$dynamo_tpl->name . '_sidebar_position', 
		array(
		    'label'   => __('Sidebar Position', DPTPLNAME),
		    'section' => $dynamo_tpl->name . '_layout',
		    'type'    => 'select',
		    'choices'    => array(
		        "left" => __("Sidebar on the left", DPTPLNAME),
		        "right"=> __("Sidebar on the right", DPTPLNAME),
		        "none" => __("Sidebar disabled", DPTPLNAME)
		    ),
			'priority' => 1
		) 
	);
	
	
	$wp_customize->add_control( 
		$dynamo_tpl->name . '_template_width', 
		array(
		    'label'   => __('Theme width (px)', DPTPLNAME),
		    'section' => $dynamo_tpl->name . '_dimensions',
		    'type'    => 'text',
			'priority' => 2
		) 
	);
	
	$wp_customize->add_control( 
		$dynamo_tpl->name . '_sidebar_width', 
		array(
		    'label'   => __('Sidebar % width', DPTPLNAME),
		    'section' => $dynamo_tpl->name . '_dimensions',
		    'type'    => 'text'
		) 
	);
	
	
	$wp_customize->add_control( 
		$dynamo_tpl->name . '_tablet_width', 
		array(
		    'label'   => __('Tablet width (px)', DPTPLNAME),
		    'section' => $dynamo_tpl->name . '_responsive',
		    'type'    => 'text',
			'priority' => 3
		) 
	);
	
	$wp_customize->add_control( 
		$dynamo_tpl->name . '_small_tablet_width', 
		array(
		    'label'   => __('Small Tablet width (px)', DPTPLNAME),
		    'section' => $dynamo_tpl->name . '_responsive',
		    'type'    => 'text',
			'priority' => 4
		) 
	);
	
	$wp_customize->add_control( 
		$dynamo_tpl->name . '_mobile_width', 
		array(
		    'label'   => __('Mobile width (px)', DPTPLNAME),
		    'section' => $dynamo_tpl->name . '_responsive',
		    'type'    => 'text',
			'priority' => 5
		) 
	);
}

add_action('customize_register', 'dynamo_init_customizer');

// EOF