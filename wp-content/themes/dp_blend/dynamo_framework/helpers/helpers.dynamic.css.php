<?php

// disable direct access to the file	
defined('DYNAMO_WP') or die('Access denied');	

function CompileOptionsLess($inputFile) {
	global $dynamo_tpl;
    require_once ( get_template_directory() . '/dynamo_framework/lib/lessc.inc.php' );
    $less = new lessc;
    $less->setPreserveComments(true);
	$url = "'".get_template_directory_uri()."'";
	$body_bg_image = "'".get_option($dynamo_tpl->name . '_body_bg_image')."'";
	$page404_bg_image = "'".get_option($dynamo_tpl->name . '_page404_bg_image')."'";
	$subheader_area_bgimage = "'".get_option($dynamo_tpl->name . '_subheader_area_bgimage')."'";
	$branding_logo_image = "'".get_option($dynamo_tpl->name . '_branding_logo_image')."'";
	$expander_bgimage = "'".get_option($dynamo_tpl->name . '_expander_bgimage')."'";
	$footer_bg_image =  "'".get_option($dynamo_tpl->name . '_footer_bg_image')."'";
    $expander_bgimage =  "'".get_option($dynamo_tpl->name . '_expander_bgimage')."'";
	$footerbgtype = 'n';
	if (get_option($dynamo_tpl->name . '_footer_pattern','none') != 'none') $footerbgtype = 'p';
	if (get_option($dynamo_tpl->name . '_footer_bg_image') != '') $footerbgtype = 'i';
	$expanderbgtype = 'n';
	if (get_option($dynamo_tpl->name . '_expander_pattern','none') != 'none') $expanderbgtype = 'p';
	if (get_option($dynamo_tpl->name . '_expander_bgimage') != '') $expanderbgtype = 'i';
	$less->setVariables(array(
		"url" => $url,
		/* Typography */
		"fontsize_body" => get_option($dynamo_tpl->name . '_fontsize_body','13px'),
		"fontsize_h1" => get_option($dynamo_tpl->name . '_fontsize_h1','40px'),
		"fontsize_h2" => get_option($dynamo_tpl->name . '_fontsize_h2','30px'),
		"fontsize_h3" => get_option($dynamo_tpl->name . '_fontsize_h3','18px'),
		"fontsize_h4" => get_option($dynamo_tpl->name . '_fontsize_h4','16px'),
		"fontsize_h5" => get_option($dynamo_tpl->name . '_fontsize_h5','14px'),
		"fontsize_h6" => get_option($dynamo_tpl->name . '_fontsize_h6','12px'),
		/* Main colors */
		"maincontent_accent_color" => get_option($dynamo_tpl->name . '_maincontent_accent_color','#3296dc'),
		"maincontent_secondary_accent_color" => get_option($dynamo_tpl->name . '_maincontent_secondary_accent_color','#000000'),
		/* Page wrap and body */
		"page_wrap_state" => get_option($dynamo_tpl->name . '_page_wrap_state','streched'),
		"page_bgcolor" => get_option($dynamo_tpl->name . '_page_bgcolor','#ffffff'),
		"page_pattern" => get_option($dynamo_tpl->name . '_page_pattern','none'),
		"body_bg_image_state" => get_option($dynamo_tpl->name . '_body_bg_image_state','N'),
		"body_bg_image" => $body_bg_image,
		"body_bgcolor" => get_option($dynamo_tpl->name . '_body_bgcolor','#ffffff'),
		"body_pattern" => get_option($dynamo_tpl->name . '_body_pattern','none'),
		"paspartu_state" => get_option($dynamo_tpl->name . '_paspartu_state','N'),
		"paspartu_bg_color" => get_option($dynamo_tpl->name . '_paspartu_bg_color','#ffffff'),
		"paspartu_width" => get_option($dynamo_tpl->name . '_paspartu_width','30').'px',
		/* Top bar */
        "top_bar_bg_color" => get_option($dynamo_tpl->name . '_top_bar_bg_color','#000000'),
		"top_bar_text_color" => get_option($dynamo_tpl->name . '_top_bar_text_color','#ffffff'),
		"top_bar_link_color" => get_option($dynamo_tpl->name . '_top_bar_link_color','#3296dc'),
		"top_bar_hlink_color" =>get_option($dynamo_tpl->name . '_top_bar_hlink_color','#f2f2f2'),
		"top_bar_icon_color" => get_option($dynamo_tpl->name . '_top_bar_icon_color','#ffffff'),
		/* Main menu and header */
		"branding_logo_type" => get_option($dynamo_tpl->name . '_branding_logo_type'),
		"branding_logo_image" => $branding_logo_image,
		"branding_logo_image_width" => get_option($dynamo_tpl->name . '_branding_logo_image_width','160').'px',
		"branding_logo_image_height" => get_option($dynamo_tpl->name . '_branding_logo_image_height','50').'px',
		"branding_logo_top_margin" => get_option($dynamo_tpl->name . '_branding_logo_top_margin','30').'px',
		"branding_logo_bottom_margin" => get_option($dynamo_tpl->name . '_branding_logo_bottom_margin','10').'px',
		"sticky_logo_top_margin" => get_option($dynamo_tpl->name . '_sticky_logo_top_margin','10').'px',
		"menu_top_bg_color" => get_option($dynamo_tpl->name . '_menu_top_bg_color','transparent'),		
		"top_mainmenu_link_color" => get_option($dynamo_tpl->name . '_top_mainmenu_link_color','#222222'),
		"top_mainmenu_hlink_color" => get_option($dynamo_tpl->name . '_top_mainmenu_hlink_color','#3296dc'),
		"sticky_header_bgcolor" => get_option($dynamo_tpl->name . '_sticky_header_bgcolor', 'rgba(255,255,255,0.95)'),
		"sticky_mainmenu_link_color" => get_option($dynamo_tpl->name . '_sticky_mainmenu_link_color','#222222'),
		"sticky_mainmenu_hlink_color" => get_option($dynamo_tpl->name . '_sticky_mainmenu_hlink_color','#3296dc'),
		"aside_logo_image_width" => get_option($dynamo_tpl->name . '_aside_logo_image_width','101').'px',
		"aside_logo_image_height" => get_option($dynamo_tpl->name . '_aside_logo_image_height','35').'px',
		"aside_mainmenu_bg_color" => get_option($dynamo_tpl->name . '_aside_mainmenu_bg_color', '#ffffff'),
		"aside_mainmenu_link_color" => get_option($dynamo_tpl->name . '_aside_mainmenu_link_color','#222222'),
		"aside_mainmenu_hlink_color" => get_option($dynamo_tpl->name . '_aside_mainmenu_hlink_color','#3296dc'),
		"submenu_bgcolor" => get_option($dynamo_tpl->name . '_submenu_bgcolor','#ffffff'),
		"submenu_link_color" => get_option($dynamo_tpl->name . '_submenu_link_color','#AFB4B9'),
		"submenu_hlink_color" => get_option($dynamo_tpl->name . '_submenu_hlink_color','#AFB4B9'),
		"submenu_hbg_color" => get_option($dynamo_tpl->name . '_submenu_hbg_color','#F6F6F6'),
		"overlay_mainmenu_bg_color" => get_option($dynamo_tpl->name . '_overlay_mainmenu_bg_color', '#ffffff'),
		"overlay_mainmenu_link_color" => get_option($dynamo_tpl->name . '_overlay_mainmenu_link_color','#222222'),
		"overlay_mainmenu_hlink_color" => get_option($dynamo_tpl->name . '_overlay_mainmenu_hlink_color','#3296dc'),
		"overlay_mainmenu_bg_color" => get_option($dynamo_tpl->name . '_overlay_mainmenu_bg_color', '#ffffff'),
		"overlay_mainmenu_link_color" => get_option($dynamo_tpl->name . '_overlay_mainmenu_link_color','#222222'),
		"overlay_mainmenu_hlink_color" => get_option($dynamo_tpl->name . '_overlay_mainmenu_hlink_color','#3296dc'),
		"overlapping_header_bgcolor" => get_option($dynamo_tpl->name . '_overlapping_header_bgcolor', '#ffffff'),
		"overlapping_mainmenu_link_color_light" => get_option($dynamo_tpl->name . '_overlapping_mainmenu_link_color_light','#ffffff'),
		"overlapping_mainmenu_hlink_color_light" => get_option($dynamo_tpl->name . '_overlapping_mainmenu_hlink_color_light','#3296dc'),
		"overlapping_mainmenu_link_color_dark" => get_option($dynamo_tpl->name . '_overlapping_mainmenu_link_color_dark','#222222'),
		"overlapping_mainmenu_hlink_color_dark" => get_option($dynamo_tpl->name . '_overlapping_mainmenu_hlink_color_dark','#3296dc'),
		/* Subheader */
		"subheader_bgcolor" => get_option($dynamo_tpl->name . '_subheader_bgcolor','#F7F8FA'),
		"subheader_pattern" => get_option($dynamo_tpl->name . '_subheader_pattern','none'),
		"subheader_area_bgimage" => $subheader_area_bgimage,
		"subheader_text_color" => get_option($dynamo_tpl->name . '_subheader_text_color', '#ffffff'),
		/* Expandable sidebar */
		"expander_bgcolor" => get_option($dynamo_tpl->name . '_expander_bgcolor','#222222'),
		"expander_bgimage" => $expander_bgimage,
		"expander_pattern" => get_option($dynamo_tpl->name . '_expander_pattern','none'),
		"expander_text_color" => get_option($dynamo_tpl->name . '_eexpander_text_color','#ffffff'),
		"expander_link_color" => get_option($dynamo_tpl->name . '_expander_link_color','#3296dc'),
		"expander_hlink_color" => get_option($dynamo_tpl->name . '_expander_hlink_color','#f6f6f6'),
		"expanderbgtype" => $expanderbgtype,
		/* Main content */
		"maincontent_text_color" => get_option($dynamo_tpl->name . '_maincontent_text_color','#7A7A7A'),
		"maincontent_headers_color" => get_option($dynamo_tpl->name . '_maincontent_headers_color','#7A7A7A'),
		"maincontent_link_color" => get_option($dynamo_tpl->name . '_maincontent_link_color', '#3296dc'),
		"maincontent_hlink_color" => get_option($dynamo_tpl->name . '_maincontent_hlink_color','#76797C'),
		/* Footer */
		"footer_bg_color" => get_option($dynamo_tpl->name . '_footer_bg_color','#232D37'),
		"footer_bg_image" => $footer_bg_image,
		"footer_pattern" => get_option($dynamo_tpl->name . '_footer_pattern','none'),
		"footer_text_color" => get_option($dynamo_tpl->name . '_footer_text_color','#BCC1C5'),
		"footer_header_color" => get_option($dynamo_tpl->name . '_footer_header_color','#ffffff'),
		"footer_link_color" => get_option($dynamo_tpl->name . '_footer_link_color','#ffffff'),
		"footer_hlink_color" => get_option($dynamo_tpl->name . '_footer_hlink_color','#3296dc'),
		"footerbgtype" => $footerbgtype,
		"copyrightbgcolor" => get_option($dynamo_tpl->name . '_copyright_bg_color','rgba(0,0,0,.2)'),
		"copyrightbordercolor" => get_option($dynamo_tpl->name . '_copyright_border_color','rgba(0,0,0,0)'),
		"copyrighttextcolor" => get_option($dynamo_tpl->name . '_copyright_text_color','#A2A2A2'),
		"copyrightlinkcolor" => get_option($dynamo_tpl->name . '_copyright_link_color','#A2A2A2'),
		"copyrighthlinkcolor" => get_option($dynamo_tpl->name . '_copyright_hlink_color','#fff'),
		/* 404 Page */
		"page404_bg_image" => $page404_bg_image,
		"page404_bg_image_state" => get_option($dynamo_tpl->name . '_404_bg_image_state','N'),
    ));

    $less->compileFile(get_template_directory() . '/css/less/' . $inputFile, get_template_directory() . '/css/dynamic.css');
}
function addCustomCSS() {
	global $dynamo_tpl;
	$customcss = get_option($dynamo_tpl->name . '_custom_css_code');
	$output = '';
	if ($customcss != '') {
	$output="<style type='text/css'>".$customcss."</style>";
	}
	echo $output;
}
add_action('wp_head','addCustomCSS');

// EOF