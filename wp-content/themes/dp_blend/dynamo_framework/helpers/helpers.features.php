<?php

// disable direct access to the file	
defined('DYNAMO_WP') or die('Access denied');	

/**
 *
 * DynamoWP admin panel & page features
 *
 * Functions used to create DynamoWP-specific functions 
 *
 **/



/**
 *
 * Code to create custom metaboxes with post additional features (description, keywords, title params)
 *
 **/
global $post;
function add_dynamo_metaboxes() {
	global $dynamo_tpl;	
	add_meta_box( 'dynamo-slide-setting', __('Slide Setting', DPTPLNAME), 'dynamo_slide_setting_callback', 'slide', 'normal', 'high' );
	add_meta_box( 'dynamo-portfolio-setting', __('Portfolio Item Setting', DPTPLNAME), 'dynamo_portfolio_setting_callback', 'portfolio', 'normal', 'high' );
	add_meta_box( 'dynamo-post-params', __('Post additional params', DPTPLNAME), 'dynamo_post_params_callback', 'post', 'normal', 'high' );
	add_meta_box( 'dynamo-post-params', __('Page additional params', DPTPLNAME), 'dynamo_post_params_callback', 'page', 'normal', 'high' );
	add_meta_box( 'dynamo-post-params', __('Page additional params', DPTPLNAME), 'dynamo_post_params_callback', 'portfolio', 'normal', 'high' );
	add_meta_box( 'dynamo-sidebar-setting', __('Sidebar Description', DPTPLNAME), 'dynamo_sidebar_setting_callback', 'sidebar', 'normal', 'high' );

	// post description custom meta box
	if(get_option($dynamo_tpl->name . '_seo_use_dp_seo_settings') == 'Y' && get_option($dynamo_tpl->name . '_seo_post_desc') == 'custom') {
		add_meta_box( 'dynamo-post-desc', __('Post keywords and description', DPTPLNAME), 'dynamo_post_seo_callback', 'post', 'normal', 'high' );
		add_meta_box( 'dynamo-post-desc', __('Page keywords and description', DPTPLNAME), 'dynamo_post_seo_callback', 'page', 'normal', 'high' );
	}
	
}

function dynamo_post_seo_callback($post) { 
	$values = get_post_custom( $post->ID );  
	$value_desc = isset( $values['dynamo-post-desc'] ) ? esc_attr( $values['dynamo-post-desc'][0] ) : '';    
	$value_keywords = isset( $values['dynamo-post-keywords'] ) ? esc_attr( $values['dynamo-post-keywords'][0] ) : ''; 
	// nonce 
	wp_nonce_field( 'dynamo-post-seo-nonce', 'dynamo_meta_box_seo_nonce' ); 
    // output
    echo '<label for="dynamo-post-desc-value">'.__('Description:', DPTPLNAME).'</label>';
    echo '<textarea name="dynamo-post-desc-value" id="dynamo-post-desc-value" rows="5" class="width100percent">'.$value_desc.'</textarea>'; 
    // output
    echo '<label for="dynamo-post-desc-value">'.__('Keywords:', DPTPLNAME).'</label>';
    echo '<textarea name="dynamo-post-keywords-value" id="dynamo-post-keywords-value" rows="5" class="width100percent">'.$value_keywords.'</textarea>';    
} 

function dynamo_post_params_callback($post) {
	global $post; 
	$values = get_post_custom( $post->ID );  
	$value_title = isset( $values['dynamo-post-params-title'] ) ? esc_attr( $values['dynamo-post-params-title'][0] ) : 'Y';
	$value_menutype = isset( $values['dynamo-post-params-menutype'] ) ? esc_attr( $values['dynamo-post-params-menutype'][0] ) : 'default';
	$value_sidebarposition = isset( $values['dynamo-post-params-sidebarposition'] ) ? esc_attr( $values['dynamo-post-params-sidebarposition'][0] ) : 'default';
	$value_headertype = isset( $values['dynamo-post-params-headertype'] ) ? esc_attr( $values['dynamo-post-params-headertype'][0] ) : 'default';
	$value_subheadersize = isset( $values['dynamo-post-params-subheadersize'] ) ? esc_attr( $values['dynamo-post-params-subheadersize'][0] ) : 'default';
	$value_headerstyle = isset( $values['dynamo-post-params-headerstyle'] ) ? esc_attr( $values['dynamo-post-params-headerstyle'][0] ) : 'default';
	$value_breadcrumbuse = isset( $values['dynamo-post-params-breadcrumbuse'] ) ? esc_attr( $values['dynamo-post-params-breadcrumbuse'][0] ) : 'default';
	$value_paspartusetting = isset( $values['dynamo-post-params-paspartusetting'] ) ? esc_attr( $values['dynamo-post-params-paspartusetting'][0] ) : 'default';
	$value_paspartu_use = isset( $values['dynamo-post-params-paspartu-use'] ) ? esc_attr( $values['dynamo-post-params-paspartu-use'][0] ) : 'N';
	$value_paspartu_bg = isset( $values['dynamo-post-params-paspartu-bgcolor'] ) ? esc_attr( $values['dynamo-post-params-paspartu-bgcolor'][0] ) : '#ffffff';
	$value_featured = isset( $values['dynamo-post-params-featuredimg'] ) ? esc_attr( $values['dynamo-post-params-featuredimg'][0] ) : 'Y';
	$value_templates = isset( $values['dynamo-post-params-templates'] ) ? $values['dynamo-post-params-templates'][0] : false;   
    // if the data are JSON  
    if($value_templates) {  
      $value_templates = unserialize(unserialize($value_templates));  
      $value_contact = $value_templates['contact'];  
      if($value_contact != '' && count($value_contact) > 0) {  
         $value_contact = explode(',', $value_contact); // [0] - name, [1] - e-mail, [2] - send copy     
        }  
     }
	$value_category = isset( $values['dynamo-post-params-category'] ) ? esc_attr( $values['dynamo-post-params-category'][0] ) : '';
	$value_perpage = isset( $values['dynamo-post-params-perpage'] ) ? esc_attr( $values['dynamo-post-params-perpage'][0] ) : '';
	$value_columncount = isset( $values['dynamo-portfolio-params-columns'] ) ? esc_attr( $values['dynamo-portfolio-params-columns'][0] ) : '4';
	$value_pagestyle = isset( $values['dynamo-portfolio-params-pagestyle'] ) ? esc_attr( $values['dynamo-portfolio-params-pagestyle'][0] ) : 'white';
	$value_usefilter = isset( $values['dynamo-portfolio-params-usefilter'] ) ? esc_attr( $values['dynamo-portfolio-params-usefilter'][0] ) : 'no';
	$value_gridstyle = isset( $values['dynamo-portfolio-params-gridstyle'] ) ? esc_attr( $values['dynamo-portfolio-params-gridstyle'][0] ) : 'classic';
	$value_pcategory = isset( $values['dynamo-portfolio-params-category'] ) ? esc_attr( $values['dynamo-portfolio-params-category'][0] ) : '';
	$value_pperpage = isset( $values['dynamo-portfolio-params-perpage'] ) ? esc_attr( $values['dynamo-portfolio-params-perpage'][0] ) : ''; 
	$value_thumbsize = isset( $values['dynamo-portfolio-params-thumbsize'] ) ? esc_attr( $values['dynamo-portfolio-params-thumbsize'][0] ) : '';
	$value_lightboxicon = isset( $values['dynamo-portfolio-params-lightboxicon'] ) ? esc_attr( $values['dynamo-portfolio-params-lightboxicon'][0] ) : '';
	$value_linkicon = isset( $values['dynamo-portfolio-params-linkicon'] ) ? esc_attr( $values['dynamo-portfolio-params-linkicon'][0] ) : '';
	$page_template = get_post_meta( $post->ID, '_wp_page_template', true );	
	$subheader_use =  isset( $values['dynamo-post-params-subheader_use'] ) ? esc_attr( $values['dynamo-post-params-subheader_use'][0] ) : 'Y';
	$custom_title =  isset( $values['dynamo-post-params-custom_title'] ) ? esc_attr( $values['dynamo-post-params-custom_title'][0] ) : '';
	$custom_subtitle =  isset( $values['dynamo-post-params-custom_subtitle'] ) ? esc_attr( $values['dynamo-post-params-custom_subtitle'][0] ) : '';
	$custom_subheaderbg_color =  isset( $values['dynamo-post-params-subheader_bgcolor'] ) ? esc_attr( $values['dynamo-post-params-subheader_bgcolor'][0] ) : '';
	$custom_subheaderdbg =  isset( $values['dynamo-post-params-subheader_img'] ) ? esc_attr( $values['dynamo-post-params-subheader_img'][0] ) : '';
	$custom_subheadertxt_color =  isset( $values['dynamo-post-params-subheader_txtcolor'] ) ? esc_attr( $values['dynamo-post-params-subheader_txtcolor'][0] ) : '';
	// nonce 
	wp_nonce_field( 'dynamo-post-params-nonce', 'dynamo_meta_box_params_nonce' ); 
    // output
	echo '<p class="col_onehalf"><label for="dynamo-post-params-title-value">'.__('Show title:', DPTPLNAME).'</label>';
    echo '<select name="dynamo-post-params-title-value" id="dynamo-post-params-title-value">';
    echo '<option value="Y"'.selected($value_title, 'Y', false).'>'.__('Enabled', DPTPLNAME).'</option>';
    echo '<option value="N"'.selected($value_title, 'N', false).'>'.__('Disabled', DPTPLNAME).'</option>';
    echo '</select></p>';
    echo '<p class="col_onehalf">';
    echo '<label for="dynamo-post-params-featuredimg-value">'.__('Featured image:', DPTPLNAME).'</label>';
    echo '<select name="dynamo-post-params-featuredimg-value" id="dynamo-post-params-featuredimg-value">';
    echo '<option value="Y"'.selected($value_featured, 'Y', false).'>'.__('Enabled', DPTPLNAME).'</option>';
    echo '<option value="N"'.selected($value_featured, 'N', false).'>'.__('Disabled', DPTPLNAME).'</option>';
    echo '</select>';
    echo '</p>';
	echo '<p class="col_onehalf"><label for="dynamo-post-params-sidebarposition-value">'.__('Sidebar position:', DPTPLNAME).'</label>';
    echo '<select name="dynamo-post-params-sidebarposition-value" id="dynamo-post-params-sidebarposition-value">';
    echo '<option value="default"'.selected($value_sidebarposition, 'default', false).'>'.__('Default (as in general settings)', DPTPLNAME).'</option>';
    echo '<option value="left"'.selected($value_sidebarposition, 'left', false).'>'.__('Left', DPTPLNAME).'</option>';
    echo '<option value="right"'.selected($value_sidebarposition, 'right', false).'>'.__('Right', DPTPLNAME).'</option>';
    echo '</select></p>';
	echo '<p class="col_onehalf"><label for="dynamo-post-params-menutype-value">'.__('Menu type:', DPTPLNAME).'</label>';
    echo '<select name="dynamo-post-params-menutype-value" id="dynamo-post-params-menutype-value">';
    echo '<option value="default"'.selected($value_menutype, 'default', false).'>'.__('Default (as in general settings)', DPTPLNAME).'</option>';
    echo '<option value="top"'.selected($value_menutype, 'top', false).'>'.__('Top', DPTPLNAME).'</option>';
    echo '<option value="aside"'.selected($value_menutype, 'aside', false).'>'.__('Aside', DPTPLNAME).'</option>';
    echo '<option value="overlay"'.selected($value_menutype, 'overlay', false).'>'.__('Overlay', DPTPLNAME).'</option>';
    echo '</select></p>';
	echo '<p class="col_onehalf"><label for="dynamo-post-params-headertype-value">'.__('Header overlaping:', DPTPLNAME).'</label>';
    echo '<select name="dynamo-post-params-headertype-value" id="dynamo-post-params-headertype-value">';
    echo '<option value="default"'.selected($value_headertype, 'default', false).'>'.__('Default (as in general settings)', DPTPLNAME).'</option>';
    echo '<option value="Y"'.selected($value_headertype, 'Y', false).'>'.__('Yes', DPTPLNAME).'</option>';
    echo '<option value="N"'.selected($value_headertype, 'N', false).'>'.__('No', DPTPLNAME).'</option>';
    echo '</select></p>';
	echo '<p class="col_onehalf"><label for="dynamo-post-params-headerstyle-value">'.__('Header overlapping style:', DPTPLNAME).'</label>';
    echo '<select name="dynamo-post-params-headerstyle-value" id="dynamo-post-params-headerstyle-value">';
    echo '<option value="default"'.selected($value_headerstyle, 'default', false).'>'.__('Default (as in general settings)', DPTPLNAME).'</option>';
    echo '<option value="light"'.selected($value_headerstyle, 'light', false).'>'.__('Light', DPTPLNAME).'</option>';
    echo '<option value="dark"'.selected($value_headerstyle, 'dark', false).'>'.__('Dark', DPTPLNAME).'</option>';
    echo '</select></p>';
	echo '<div class="clearboth"></div>';
	echo '<p class="col_onehalf"><label for="dynamo-post-params-breadcrumbuse-value">'.__('Breadcrumb display:', DPTPLNAME).'</label>';
    echo '<select name="dynamo-post-params-breadcrumbuse-value" id="dynamo-post-params-breadcrumbuse-value">';
    echo '<option value="default"'.selected($value_breadcrumbuse, 'default', false).'>'.__('Default (as in general settings)', DPTPLNAME).'</option>';
    echo '<option value="Y"'.selected($value_breadcrumbuse, 'Y', false).'>'.__('Enable', DPTPLNAME).'</option>';
    echo '<option value="N"'.selected($value_breadcrumbuse, 'N', false).'>'.__('Disable', DPTPLNAME).'</option>';
    echo '</select></p>';
	echo '<div class="clearboth"></div>'; 
	if ($page_template == 'template.latest_small_thumb.php' || $page_template == 'template.latest_big_thumb.php' || $page_template == 'template.latest_small_thumb_full.php' || $page_template == 'template.latest_big_thumb.php') {
	echo '<p class="subsection-title">'.__('Blog pages custom setting', DPTPLNAME).'</p>';
	echo '<p class="dp-indent">';
	echo '<label for="dynamo-post-params-category-value">'.__('Category: &nbsp;', DPTPLNAME).'</label>';
	echo '<input name="dynamo-post-params-category-value" type="text" id="dynamo-post-params-category-value" value="'.$value_category.'">';
	echo '&nbsp;<small>'.__('You can specify category or coma separated list of categories witch will be used on this page. If you leave this field empty will be displayed posts from all categories.', DPTPLNAME).'</small></p>';
	echo '<p class="dp-indent">';
	echo '<label for="dynamo-post-params-perpage-value">'.__('Items per page: &nbsp;', DPTPLNAME).'</label>';
	echo '<input name="dynamo-post-params-perpage-value" type="text" id="dynamo-post-params-perpage-value" value="'.$value_perpage.'">';
	echo '&nbsp;<small>'.__('You can specify items per page witch will be used on this page. If you leave this field empty will be used general setting.', DPTPLNAME).'</small></p>';
	}

	echo '<div class="clearboth"></div>'; 
	if ($page_template == 'template.portfolio-nosidebar.php' || $page_template == 'template.portfolio.php' || $page_template == 'template.portfolio-fullwidth.php') {
	echo '<p class="subsection-title">'.__('Portfolio pages custom setting', DPTPLNAME).'</p>';
	echo '<p class="dp-indent">';
	echo '<label for="dynamo-portfolio-params-columns-value">'.__('Columns count: &nbsp;', DPTPLNAME).'</label>';
    echo '<select name="dynamo-portfolio-params-columns-value" id="dynamo-portfolio-params-columns-value">';
    echo '<option value="2"'.selected($value_columncount, '2', false).'>'.__('2 columns', DPTPLNAME).'</option>';
    echo '<option value="3"'.selected($value_columncount, '3', false).'>'.__('3 columns', DPTPLNAME).'</option>';
    echo '<option value="4"'.selected($value_columncount, '4', false).'>'.__('4 columns', DPTPLNAME).'</option>';
    echo '<option value="5"'.selected($value_columncount, '5', false).'>'.__('5 columns', DPTPLNAME).'</option>';
    echo '<option value="6"'.selected($value_columncount, '6', false).'>'.__('6 columns', DPTPLNAME).'</option>';
    echo '</select>';	
	echo '&nbsp;<small>'.__('You can specify columns count for this portfolio page.', DPTPLNAME).'</small></p>';
	echo '<p class="dp-indent">';
	echo '<label for="dynamo-portfolio-params-pagestyle-value">'.__('Page style: &nbsp;', DPTPLNAME).'</label>';
    echo '<select name="dynamo-portfolio-params-pagestyle-value" id="dynamo-portfolio-params-pagestyle-value">';
    echo '<option value="white"'.selected($value_pagestyle, 'white', false).'>'.__('White background', DPTPLNAME).'</option>';
    echo '<option value="gray"'.selected($value_pagestyle, 'gray', false).'>'.__('Gray background', DPTPLNAME).'</option>';
    echo '</select>';	
	echo '&nbsp;<small>'.__('You can specify page background for this portfolio page.', DPTPLNAME).'</small></p>';
	echo '<p class="dp-indent">';
	echo '<label for="dynamo-portfolio-params-usefilter-value">'.__('Use category filter: &nbsp;', DPTPLNAME).'</label>';
    echo '<select name="dynamo-portfolio-params-usefilter-value" id="dynamo-portfolio-params-usefilter-value">';
    echo '<option value="Y"'.selected($value_usefilter, 'Y', false).'>'.__('Enable', DPTPLNAME).'</option>';
    echo '<option value="N"'.selected($value_usefilter, 'N', false).'>'.__('Disable', DPTPLNAME).'</option>';
    echo '</select>';
	echo '&nbsp;<small>'.__('You can enable fullwidth for this portfolio page.', DPTPLNAME).'</small></p>';
	echo '<p class="dp-indent">';
	echo '<label for="dynamo-portfolio-params-gridstyle-value">'.__('Grid style: &nbsp;', DPTPLNAME).'</label>';
    echo '<select name="dynamo-portfolio-params-gridstyle-value" id="dynamo-portfolio-params-gridstyle-value">';
    echo '<option value="classic"'.selected($value_gridstyle, 'classic', false).'>'.__('Classic', DPTPLNAME).'</option>';
    echo '<option value="grid"'.selected($value_gridstyle, 'grid', false).'>'.__('Thumbnail grid', DPTPLNAME).'</option>';
    echo '<option value="gridnomargin"'.selected($value_gridstyle, 'gridnomargin', false).'>'.__('Thumbnail grid no margin', DPTPLNAME).'</option>';
    echo '</select>';
	echo '&nbsp;<small>'.__('You can style for this portfolio page.', DPTPLNAME).'</small></p>';
	echo '<p class="dp-indent">';
	echo '<label for="dynamo-portfolio-params-category-value">'.__('Category: &nbsp;', DPTPLNAME).'</label>';
	echo '<input name="dynamo-portfolio-params-category-value" type="text" id="dynamo-portfolio-params-category-value" value="'.$value_pcategory.'">';
	echo '&nbsp;<small>'.__('You can specify category or coma separated list of categories witch will be used on this page. If you leave this field empty will be displayed posts from all categories.', DPTPLNAME).'</small></p>';
	echo '<p class="dp-indent">';
	echo '<label for="dynamo-portfolio-params-perpage-value">'.__('Items per page: &nbsp;', DPTPLNAME).'</label>';
	echo '<input name="dynamo-portfolio-params-perpage-value" type="text" id="dynamo-portfolioparams-perpage-value" value="'.$value_pperpage.'">';
	echo '&nbsp;<small>'.__('You can specify items per page witch will be used on this page. If you leave this field empty will be used general setting.', DPTPLNAME).'</small></p>';
	echo '<p class="dp-indent">';
	echo '<label for="dynamo-portfolio-params-thumbsize-value">'.__('Thumb Size:', DPTPLNAME).'</label>';
    echo '<select name="dynamo-portfolio-params-thumbsize-value" id="dynamo-portfolio-params-thumbsize-value">';
    echo '<option value="horizontal"'.selected($value_thumbsize, 'horizontal', false).'>'.__('Horizontal 4:3', DPTPLNAME).'</option>';
    echo '<option value="vertical"'.selected($value_thumbsize, 'vertical', false).'>'.__('Vertical 3:4', DPTPLNAME).'</option>';
    echo '<option value="square"'.selected($value_thumbsize, 'square', false).'>'.__('Square', DPTPLNAME).'</option>';
    echo '<option value="original"'.selected($value_thumbsize, 'original', false).'>'.__('Original dimensions', DPTPLNAME).'</option>';
    echo '</select>';
	echo '&nbsp;<small>'.__('You can specify thumb dimensions used on this page.', DPTPLNAME).'</small></p>';
	echo '<p class="dp-indent">';
	echo '<label for="dynamo-portfolio-params-lightboxicon-value">'.__('Lightbox icon in overlay:', DPTPLNAME).'</label>';
    echo '<select name="dynamo-portfolio-params-lightboxicon-value" id="dynamo-portfolio-params-lightboxicon-value">';
    echo '<option value="N"'.selected($value_lightboxicon, 'N', false).'>'.__('Disabled', DPTPLNAME).'</option>';
    echo '<option value="Y"'.selected($value_lightboxicon, 'Y', false).'>'.__('Enabled', DPTPLNAME).'</option>';
    echo '</select>';
	echo '&nbsp;<small>'.__('If enabled lightbox link icon will be visble in overlay on this page.', DPTPLNAME).'</small></p>';
	echo '<p class="dp-indent">';
	echo '<label for="dynamo-portfolio-params-linkicon-value">'.__('Link icon in overlay:', DPTPLNAME).'</label>';
    echo '<select name="dynamo-portfolio-params-linkicon-value" id="dynamo-portfolio-params-linkicon-value">';
    echo '<option value="N"'.selected($value_linkicon, 'N', false).'>'.__('Disabled', DPTPLNAME).'</option>';
    echo '<option value="Y"'.selected($value_linkicon, 'Y', false).'>'.__('Enabled', DPTPLNAME).'</option>';
    echo '</select>';
	echo '&nbsp;<small>'.__('If enabled link to portfolio item single view icon will be visble in overlay on this page.', DPTPLNAME).'</small></p>';
 	}


	// output for the contact page options
	echo '<p data-template="template.contact.php" class="subsection-title">'.__('Contact page settings', DPTPLNAME).'</p>';
    echo '<p data-template="template.contact.php" class="col_onefourth">';
    echo '<label for="dynamo-post-params-contact-name">'.__('Show name field:', DPTPLNAME).'</label>';
    echo '<select name="dynamo-post-params-contact-name" id="dynamo-post-params-contact-name">';
    echo '<option value="Y"'.((!$value_contact || $value_contact[0] == 'Y') ? ' selected="selected"' : '').'>'.__('Enabled', DPTPLNAME).'</option>';
    echo '<option value="N"'.(($value_contact !== FALSE && $value_contact[0] == 'N') ? ' selected="selected"' : '').'>'.__('Disabled', DPTPLNAME).'</option>';
    echo '</select>';
    echo '</p>';
    echo '<p data-template="template.contact.php" class="col_onefourth">';
    echo '<label for="dynamo-post-params-contact-email">'.__('Show e-mail field:', DPTPLNAME).'</label>';
    echo '<select name="dynamo-post-params-contact-email" id="dynamo-post-params-contact-email">';
    echo '<option value="Y"'.((!$value_contact || $value_contact[1] == 'Y') ? ' selected="selected"' : '').'>'.__('Enabled', DPTPLNAME).'</option>';
    echo '<option value="N"'.(($value_contact != FALSE && $value_contact[1] == 'N') ? ' selected="selected"' : '').'>'.__('Disabled', DPTPLNAME).'</option>';
    echo '</select>';
    echo '</p>';  
    echo '<p data-template="template.contact.php" class="col_onefourth">';
    echo '<label for="dynamo-post-params-contact-copy">'.__('Show "send copy":', DPTPLNAME).'</label>';
    echo '<select name="dynamo-post-params-contact-copy" id="dynamo-post-params-contact-copy">';
    echo '<option value="Y"'.((!$value_contact || $value_contact[2] == 'Y') ? ' selected="selected"' : '').'>'.__('Enabled', DPTPLNAME).'</option>';
    echo '<option value="N"'.(($value_contact !== FALSE && $value_contact[2] == 'N') ? ' selected="selected"' : '').'>'.__('Disabled', DPTPLNAME).'</option>';
    echo '</select>';
    echo '</p>';
	echo '<div class="clearboth"></div>';
	// output for the paspartu setting
	echo '<p class="subsection-title">'.__('Paspartu custom style', DPTPLNAME).'</p>';
	echo '<p class="description">'.__('Here can you set custom layout of paspartu for this post/page', DPTPLNAME).'</p>';
	echo '<p class="col_onehalf"><label for="dynamo-post-params-paspartusetting-value">'.__('Paspartu setting:', DPTPLNAME).'</label>';
    echo '<select name="dynamo-post-params-paspartusetting-value" id="dynamo-post-params-paspartusetting-value">';
    echo '<option value="default"'.selected($value_paspartusetting, 'default', false).'>'.__('Default (as in general settings)', DPTPLNAME).'</option>';
    echo '<option value="custom"'.selected($value_paspartusetting, 'custom', false).'>'.__('Custom', DPTPLNAME).'</option>';
    echo '</select><br clear="all"></p>';
	echo '<div class="clearboth"></div>';
	echo '<div id="paspartu_params_area">';
	echo '<p class="dp-indent"><label for="dynamo-post-params-paspartu-use-value">'.__('Use paspartu:', DPTPLNAME).'</label>';
    echo '<select name="dynamo-post-params-paspartu-use-value" id="dynamo-post-params-paspartu-use-value">';
    echo '<option value="Y"'.selected($value_paspartu_use, 'Y', false).'>'.__('Enabled', DPTPLNAME).'</option>';
    echo '<option value="N"'.selected($value_paspartu_use, 'N', false).'>'.__('Disabled', DPTPLNAME).'</option>';
    echo '</select><br clear="all"><span class="description">Here you can enable or disable paspartu only for this page.</span></p>';
	echo '<p><label for="dynamo-post-params-paspartu-bgcolor-value" class="col_onefourth">'.__('Custom background color for paspartu:', DPTPLNAME).'</label>';
	echo '<input type="text" value="'.$value_paspartu_bg.'" class=" dpColor" name="dynamo-post-params-paspartu-bgcolor-value" id="dynamo-post-params-paspartu-bgcolor-value"><input type="text" class="colorSelector"  /></p>';
	echo '<div class="clearboth"></div>';
	echo '</div>';
	// output for the subheader area
	echo '<p class="subsection-title">'.__('Subheader area custom style', DPTPLNAME).'</p>';
	echo '<p class="description">'.__('Here can you set custom layout of subheader area for this post/page', DPTPLNAME).'</p>';
	echo '<p class="col_onehalf"><label for="dynamo-post-params-subheader_use-value">'.__('Use subheader:', DPTPLNAME).'</label>';
    echo '<select name="dynamo-post-params-subheader_use-value" id="dynamo-post-params-subheader_use-value">';
    echo '<option value="Y"'.selected($subheader_use, 'Y', false).'>'.__('Enabled', DPTPLNAME).'</option>';
    echo '<option value="N"'.selected($subheader_use, 'N', false).'>'.__('Disabled', DPTPLNAME).'</option>';
    echo '</select><br clear="all"><span class="description">If you enable this you can also use custom title and subtitle.</span></p>';
	echo '<p class="col_onehalf"><label for="dynamo-post-params-subheadersize-value">'.__('Subheader size:', DPTPLNAME).'</label>';
    echo '<select name="dynamo-post-params-subheadersize-value" id="dynamo-post-params-subheadersize-value">';
    echo '<option value="default"'.selected($value_subheadersize, 'default', false).'>'.__('Default (as in general settings)', DPTPLNAME).'</option>';
    echo '<option value="small"'.selected($value_subheadersize, 'small', false).'>'.__('Small', DPTPLNAME).'</option>';
    echo '<option value="big"'.selected($value_subheadersize, 'big', false).'>'.__('Big', DPTPLNAME).'</option>';
    echo '</select><br clear="all"><span class="description">Here you can change subheader size for tis page.</span></p>';
	echo '<div class="clearboth"></div>';
	echo '<div id="subheader_params_area">';
	echo '<p class="dp-indent">';
	echo '<label for="dynamo-post-params-custom_title">'.__('Custom title in header:', DPTPLNAME).'</label>';
	echo '<input class="widefat" name="dynamo-post-params-custom_title-value" type="text" id="dynamo-post-params-custom_title-value" value="'.$custom_title.'">';
	echo '</p>';
	echo '<p class="dp-indent">';
	echo '<label for="dynamo-post-params-custom_subtitle">'.__('Custom subtitle in header:', DPTPLNAME).'</label>';
	echo '<input class="widefat" name="dynamo-post-params-custom_subtitle-value" type="text" id="dynamo-post-params-custom_subtitle-value" value="'.$custom_subtitle.'">';
	echo '</p>';
	echo '<p><label for="dynamo-post-params-subheader_bgcolor" class="col_onefourth">'.__('Custom background color for subheader:', DPTPLNAME).'</label>';
	echo '<input type="text" value="'.$custom_subheaderbg_color.'" class=" dpColor" name="dynamo-post-params-subheader_bgcolor-value" id="dynamo-post-params-subheader_bgcolor-value"><input type="text" class="colorSelector"  /></p>';
	echo '<p><label for="dynamo-post-params-subheader_txtcolor" class="col_onefourth">'.__('Custom text color for subheader:', DPTPLNAME).'</label>';
	echo '<input type="text" value="'.$custom_subheadertxt_color.'" class=" dpColor" name="dynamo-post-params-subheader_txtcolor-value" id="dynamo-post-params-subheader_txtcolor-value"><input type="text" class="colorSelector"  /></p>';
	echo '<p class="col_twothird">';
	echo '<label for="dynamo-post-params-subheader_img-value">'.__('Custom background image for subheader area:', DPTPLNAME).'</label>';
	echo '<input class="widefat" name="dynamo-post-params-subheader_img-value" type="text" id="dynamo-post-params-subheader_img-value" value="'.$custom_subheaderdbg.'">';
	echo '<input  class="button uploadbtn" name="dynamo-post-params-subheader_img-button" id="dynamo-post-params-subheader_img-button" value="'.__('Upload image', DPTPLNAME).'" />';
	echo '<small><a  href="#" id="dynamo-post-params-subheader_img-clear" />'.__('Remove Image', DPTPLNAME).'</a></small>';
	echo '<br clear="all"><span class="description">Recomended width 1680 px.</span>';
	echo '</p>';
	echo '<p class="col_onefourth">';	
	echo '<span class="img-holder"><img id="dynamo-post-params-subheader_img-thumb" alt="" src="'.$custom_subheaderdbg.'"></span>';
	echo '</p>';
	echo '</div>';
	echo '<div class="clearboth"></div>';
	?>
    <script type="text/javascript">
	jQuery(document).ready(function($) {
	dpPickerInit();
		//
		function dpPickerInit() {
	jQuery('.colorSelector').spectrum({
    showAlpha: true,
    showInput: true,
	allowEmpty:true,
	preferredFormat: "hex",
	chooseText: "Select"
});
	jQuery('.colorSelector').each(
		function() {
		var initialColor = jQuery(this).prev('input').attr('value');
		jQuery(this).spectrum("set", initialColor);
		jQuery(this).change(function() {
		jQuery(this).prev('input').attr('value',jQuery(this).spectrum("get"));	
		})
		}
	);
	
	jQuery('.dpColor').change(function() {
		newColor = jQuery(this).val();
		jQuery(this).next('.colorSelector').spectrum("set", newColor);
		}
	)
	
}
if (jQuery('#dynamo-post-params-subheader_use-value').val() == 'N') {jQuery('#subheader_params_area').hide(); }
else {jQuery('#subheader_params_area').show();}
jQuery('#dynamo-post-params-subheader_use-value').change(
		function() {
if (jQuery('#dynamo-post-params-subheader_use-value').val() == 'N') {jQuery('#subheader_params_area').hide('slow'); }
else {jQuery('#subheader_params_area').show('slow');}
		}
);

if (jQuery('#dynamo-post-params-paspartusetting-value').val() == 'default') {jQuery('#paspartu_params_area').hide(); }
else {jQuery('#paspartu_params_area').show();}
jQuery('#dynamo-post-params-paspartusetting-value').change(
		function() {
if (jQuery('#dynamo-post-params-paspartusetting-value').val() == 'default') {jQuery('#paspartu_params_area').hide('slow'); }
else {jQuery('#paspartu_params_area').show('slow');}
		}
);

if($('#dynamo-post-params-subheader_img-value').length>0) {
	$('#dynamo-post-params-subheader_img-thumb').show("slow");
	$('#dynamo-post-params-subheader_img-clear').show();
	} 
else {
	$('#dynamo-post-params-subheader_img-thumb').hide();
	$('#dynamo-post-params-subheader_img-clear').hide();
	}
$('#dynamo-post-params-subheader_img-clear').click(function() {
	$('#dynamo-post-params-subheader_img-value').val('');
	$('#dynamo-post-params-subheader_img-clear').hide();
	$('#dynamo-post-params-subheader_img-thumb').hide("slow");
});

	var _custom_media = true,
	_orig_send_attachment = wp.media.editor.send.attachment;
 
	$('#dynamo-post-params-subheader_img-button').click(function(e) {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = $(this);
		_custom_media = true;
		wp.media.editor.send.attachment = function(props, attachment){
			if ( _custom_media ) {
				$('#dynamo-post-params-subheader_img-value').val(attachment.url);
				$('#dynamo-post-params-subheader_img-thumb').attr("src",attachment.url);
				$('#dynamo-post-params-subheader_img-thumb').show("slow");
				$('#dynamo-post-params-subheader_img-clear').show();

			} else {
				return _orig_send_attachment.apply( this, [props, attachment] );
			};
		}
 
		wp.media.editor.open(button);
		return false;
	});
 
	$('.add_media').on('click', function(){
		_custom_media = false;
	});

});
	</script>
    <?php
     
} 

function dynamo_slide_setting_callback($post) { 
include (get_template_directory() . '/dynamo_framework/metaboxes/slide_meta_box.php'); 
} 

function dynamo_portfolio_setting_callback($post) { 
include (get_template_directory() . '/dynamo_framework/metaboxes/portfolio_meta_box.php'); 
}
 
function dynamo_sidebar_setting_callback($post) { 
include (get_template_directory() . '/dynamo_framework/metaboxes/sidebar_meta_box.php'); 
} 
function dynamo_metaboxes_save( $post_id ) {  
    // check the user permissions  
    if( !current_user_can( 'edit_post', $post_id ) ) {
    	return;
    }
    // avoid requests on the autosave 
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    	return; 
    }  
    // check the existing of the fields and save it
    if( isset( $_POST['dynamo-post-desc-value'] ) ) {
        // check the nonce
        if( !isset( $_POST['dynamo_meta_box_seo_nonce'] ) || !wp_verify_nonce( $_POST['dynamo_meta_box_seo_nonce'], 'dynamo-post-seo-nonce' ) ) {
        	return;
        }
        // update post meta
        update_post_meta( $post_id, 'dynamo-post-desc', esc_attr( $_POST['dynamo-post-desc-value'] ) );  
    }
  	//
    if( isset( $_POST['dynamo-post-keywords-value'] ) ) {
    	// check the nonce
    	if( !isset( $_POST['dynamo_meta_box_seo_nonce'] ) || !wp_verify_nonce( $_POST['dynamo_meta_box_seo_nonce'], 'dynamo-post-seo-nonce' ) ) {
    		return;
    	}
    	// update post meta
        update_post_meta( $post_id, 'dynamo-post-keywords', esc_attr( $_POST['dynamo-post-keywords-value'] ) ); 
    }

    //
    if( isset( $_POST['dynamo-post-params-title-value'] ) ) {
    	// check the nonce
    	if( !isset( $_POST['dynamo_meta_box_params_nonce'] ) || !wp_verify_nonce( $_POST['dynamo_meta_box_params_nonce'], 'dynamo-post-params-nonce' ) ) {
    		return;
    	}
    	// update post meta
        update_post_meta( $post_id, 'dynamo-post-params-title', esc_attr( $_POST['dynamo-post-params-title-value'] ) );
        update_post_meta( $post_id, 'dynamo-post-params-sidebarposition', esc_attr( $_POST['dynamo-post-params-sidebarposition-value'] ) );
		update_post_meta( $post_id, 'dynamo-post-params-featuredimg', esc_attr( $_POST['dynamo-post-params-featuredimg-value'] ) );
        update_post_meta( $post_id, 'dynamo-post-params-menutype', esc_attr( $_POST['dynamo-post-params-menutype-value'] ) );
        update_post_meta( $post_id, 'dynamo-post-params-headertype', esc_attr( $_POST['dynamo-post-params-headertype-value'] ) );
		update_post_meta( $post_id, 'dynamo-post-params-headerstyle', esc_attr( $_POST['dynamo-post-params-headerstyle-value'] ) );
		update_post_meta( $post_id, 'dynamo-post-params-breadcrumbuse', esc_attr( $_POST['dynamo-post-params-breadcrumbuse-value'] ) );
		update_post_meta( $post_id, 'dynamo-post-params-subheadersize', esc_attr( $_POST['dynamo-post-params-subheadersize-value'] ) );
		//
    if( isset( $_POST['dynamo-post-params-contact-name'] ) ) {
    	// check the nonce
    	if( !isset( $_POST['dynamo_meta_box_params_nonce'] ) || !wp_verify_nonce( $_POST['dynamo_meta_box_params_nonce'], 'dynamo-post-params-nonce' ) ) {
    		return;
    	}
    	// update post meta
    	$contact_value = esc_attr( $_POST['dynamo-post-params-contact-name'] ) . ',' . esc_attr( $_POST['dynamo-post-params-contact-email'] ) . ',' . esc_attr( $_POST['dynamo-post-params-contact-copy'] );
    	$templates_value = array('contact' => $contact_value);
        update_post_meta( $post_id, 'dynamo-post-params-templates', serialize($templates_value) ); 
    }
		update_post_meta( $post_id, 'dynamo-portfolio-params-columns', esc_attr( $_POST['dynamo-portfolio-params-columns-value'] ) );
		update_post_meta( $post_id, 'dynamo-portfolio-params-pagestyle', esc_attr( $_POST['dynamo-portfolio-params-pagestyle-value'] ) );
		update_post_meta( $post_id, 'dynamo-portfolio-params-usefilter', esc_attr( $_POST['dynamo-portfolio-params-usefilter-value'] ) );
		update_post_meta( $post_id, 'dynamo-portfolio-params-gridstyle', esc_attr( $_POST['dynamo-portfolio-params-gridstyle-value'] ) );
		update_post_meta( $post_id, 'dynamo-portfolio-params-category', esc_attr( $_POST['dynamo-portfolio-params-category-value'] ) );
		update_post_meta( $post_id, 'dynamo-portfolio-params-perpage', esc_attr( $_POST['dynamo-portfolio-params-perpage-value'] ) );
		update_post_meta( $post_id, 'dynamo-post-params-category', esc_attr( $_POST['dynamo-post-params-category-value'] ) );
		update_post_meta( $post_id, 'dynamo-post-params-perpage', esc_attr( $_POST['dynamo-post-params-perpage-value'] ) );
		update_post_meta( $post_id, 'dynamo-portfolio-params-thumbsize', esc_attr( $_POST['dynamo-portfolio-params-thumbsize-value'] ) );
		update_post_meta( $post_id, 'dynamo-portfolio-params-lightboxicon', esc_attr( $_POST['dynamo-portfolio-params-lightboxicon-value'] ) );
		update_post_meta( $post_id, 'dynamo-portfolio-params-linkicon', esc_attr( $_POST['dynamo-portfolio-params-linkicon-value'] ) );
		update_post_meta( $post_id, 'dynamo-post-params-subheader_use', esc_attr( $_POST['dynamo-post-params-subheader_use-value'] ) );
		update_post_meta( $post_id, 'dynamo-post-params-custom_title', esc_attr( $_POST['dynamo-post-params-custom_title-value'] ) );
		update_post_meta( $post_id, 'dynamo-post-params-custom_subtitle', esc_attr( $_POST['dynamo-post-params-custom_subtitle-value'] ) );
		update_post_meta( $post_id, 'dynamo-post-params-subheader_img', esc_attr( $_POST['dynamo-post-params-subheader_img-value'] ) );
		update_post_meta( $post_id, 'dynamo-post-params-subheader_bgcolor', esc_attr( $_POST['dynamo-post-params-subheader_bgcolor-value'] ) );
		update_post_meta( $post_id, 'dynamo-post-params-subheader_txtcolor', esc_attr( $_POST['dynamo-post-params-subheader_txtcolor-value'] ) );
		
		update_post_meta( $post_id, 'dynamo-post-params-paspartusetting', esc_attr( $_POST['dynamo-post-params-paspartusetting-value'] ) );
		update_post_meta( $post_id, 'dynamo-post-params-paspartu-use', esc_attr( $_POST['dynamo-post-params-paspartu-use-value'] ) );
		update_post_meta( $post_id, 'dynamo-post-params-paspartu-bgcolor', esc_attr( $_POST['dynamo-post-params-paspartu-bgcolor-value'] ) );
 
    }
}  
add_action( 'save_post', 'dynamo_portfolio_setting_save' );   
function dynamo_portfolio_setting_save( $post_id ) {  
    // check the user permissions  
    if( !current_user_can( 'edit_post', $post_id ) ) {
    	return;
    }
    // avoid requests on the autosave 
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    	return; 
    }
    // check the existing of the fields and save it
	if( isset( $_POST['item_short_desc'] ) ) {
        update_post_meta( $post_id, 'item_short_desc', esc_attr( $_POST['item_short_desc'] ) );  
    }
	if( isset( $_POST['item_type'] ) ) {
        update_post_meta( $post_id, 'item_type', esc_attr( $_POST['item_type'] ) );  
    }
	if( isset( $_POST['item_layout'] ) ) {
        update_post_meta( $post_id, 'item_layout', esc_attr( $_POST['item_layout'] ) );  
    }
	if( isset( $_POST['item_addimages'] ) ) {
		$datta = htmlspecialchars( $_POST['item_addimages']);
        update_post_meta( $post_id, 'item_addimages',$datta );  
    }
	if( isset( $_POST['item_video'] ) ) {
        update_post_meta( $post_id, 'item_video', esc_attr( $_POST['item_video'] ) );  
    }
	if( isset( $_POST['item_link'] ) ) {
        update_post_meta( $post_id, 'item_link', esc_attr( $_POST['item_link'] ) );  
    }
	if( isset( $_POST['item_date'] ) ) {
        update_post_meta( $post_id, 'item_date', esc_attr( $_POST['item_date'] ) );  
    }
	if( isset( $_POST['item_client'] ) ) {
        update_post_meta( $post_id, 'item_client', esc_attr( $_POST['item_client'] ) );  
    }
	if( isset( $_POST['item_client'] ) ) {
        update_post_meta( $post_id, 'item_www', esc_attr( $_POST['item_www'] ) );  
    }
}   
add_action( 'save_post', 'dynamo_slide_setting_save' );   
function dynamo_slide_setting_save( $post_id ) {  
    // check the user permissions  
    if( !current_user_can( 'edit_post', $post_id ) ) {
    	return;
    }
    // avoid requests on the autosave 
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    	return; 
    }
    // check the existing of the fields and save it
	if( isset( $_POST['slide_type'] ) ) {
    update_post_meta( $post_id, 'slide_type', esc_attr( $_POST['slide_type'] ) );  
    }
	if( isset( $_POST['slide_description'] ) ) {
        update_post_meta( $post_id, 'slide_description', esc_attr( $_POST['slide_description'] ) );  
    }
	if( isset( $_POST['slide_link'] ) ) {
        update_post_meta( $post_id, 'slide_link', esc_attr( $_POST['slide_link'] ) );  
    }
}
add_action( 'save_post', 'dynamo_sidebar_setting_save' );   
function dynamo_sidebar_setting_save( $post_id ) {  
    // check the user permissions  
    if( !current_user_can( 'edit_post', $post_id ) ) {
    	return;
    }
    // avoid requests on the autosave 
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    	return; 
    }
    // check the existing of the fields and save it
	if( isset( $_POST['sidebar_description'] ) ) {
        update_post_meta( $post_id, 'sidebar_description', esc_attr( $_POST['sidebar_description'] ) );  
    }
}   
   
/**
 *
 * Code to create Featured Video metabox
 *
 **/


function dynamo_add_featured_video() {
    add_meta_box( 'dynamo_featured_video', __( 'Featured Video', DPTPLNAME ), 'dynamo_add_featured_video_metabox', 'post', 'side', 'low' );
    add_meta_box( 'dynamo_featured_video', __( 'Featured Video', DPTPLNAME ), 'dynamo_add_featured_video_metabox', 'page', 'side', 'low' );
    add_meta_box( 'dynamo_featured_video', __( 'Featured Video', DPTPLNAME ), 'dynamo_add_featured_video_metabox', 'essential_grid', 'side', 'low' );
}


function dynamo_add_featured_video_metabox() {
    global $post;


    $featured_video = get_post_meta($post->ID, '_dynamo-featured-video', true);
    
    echo '<p>';
    echo '<label>'.__('Featured video link', DPTPLNAME).'</label>';
    echo '<input class=" widefat" name="dynamo_featured_video" type="text" value="'.$featured_video.'">'; ?>
	<span class="description"><?php _e("Just link, not embed code, this field is used for oEmbed.", DPTPLNAME); ?></span>
    <?php echo '<input type="hidden" name="dynamo_featured_video_nonce" id="dynamo_featured_video_nonce" value="'.wp_create_nonce(plugin_basename(__FILE__)).'" />';
    echo '</p>';
}


function dynamo_save_featured_video(){
    global $post;
	// check nonce
    if(!isset($_POST['dynamo_featured_video_nonce']) || !wp_verify_nonce($_POST['dynamo_featured_video_nonce'], plugin_basename(__FILE__))) {
    	return is_object($post) ? $post->ID : $post;
	}
	// autosave
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return is_object($post) ? $post->ID : $post;
	}
	// user permissions
    if( !current_user_can( 'edit_post', $post_id ) ) {
    	return;
    }
	// if the value exists
    if(isset($_POST['dynamo_featured_video'])) {
	    $featured_video = $_POST['dynamo_featured_video'];


	    if($featured_video != '') {
	    	delete_post_meta($post->ID, '_dynamo-featured-video');
	    	add_post_meta($post->ID, '_dynamo-featured-video', $featured_video);
	    } else {
	    	delete_post_meta($post->ID, '_dynamo-featured-video');
	    }
    }
    
	return true;
}




add_action( 'save_post',  'dynamo_save_featured_video' );
add_action( 'admin_menu', 'dynamo_add_featured_video' );


 
// Add the Meta Box
function dynamo_add_og_meta_box() {
    add_meta_box(
		'dynamo_og_meta_box',
		'Open Graph metatags',
		'dynamo_show_og_meta_box',
		'post',
		'normal',
		'high'
	);
	
	add_meta_box(
		'dynamo_og_meta_box',
		'Open Graph metatags',
		'dynamo_show_og_meta_box',
		'page',
		'normal',
		'high'
	);
}
// check if the Open Graph is enabled
if(get_option($dynamo_tpl->name . '_opengraph_use_opengraph') == 'Y') {
    add_action('add_meta_boxes', 'dynamo_add_og_meta_box');
}


// The Callback
function dynamo_show_og_meta_box() {
	global $dynamo_tpl, $post;
	// load custom meta fields
	$custom_meta_fields = $dynamo_tpl->get_json('config', 'opengraph');
	// Use nonce for verification
	echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
	// Begin the field table and loop
	echo '<table class="form-table">';
	foreach ($custom_meta_fields as $field) {
		// get value of this field if it exists for this post
		$meta = get_post_meta($post->ID, $field->id, true);
		// begin a table row with
		echo '<tr>
				<th><label for="'.$field->id.'">'.$field->label.'</label></th>
				<td>';
				switch($field->type) {
					// case items will go here
					// text
					case 'text':
						echo '<input type="text" name="'.$field->id.'" id="'.$field->id.'" value="'.$meta.'" size="30" />
							<br /><span class="description">'.$field->desc.'</span>';
					break;
					
					// textarea
					case 'textarea':
						echo '<textarea name="'.$field->id.'" id="'.$field->id.'" cols="60" rows="4">'.$meta.'</textarea>
							<br /><span class="description">'.$field->desc.'</span>';
					break;
					
					// image
					case 'image':
						$image = 'none';   
    			            if (get_option($dynamo_tpl->name . '_og_default_image', '') != '')  {  
    			              $image = get_option($dynamo_tpl->name . '_og_default_image');   
    			            }  
						echo '<span class="dynamo_opengraph_default_image" style="display:none">'.$image.'</span>';
						if ($meta) { 
							$image = wp_get_attachment_image_src($meta, 'medium');	
							$image = $image[0];
						}
						echo	'<input name="'.$field->id.'" type="hidden" class="dynamo_opengraph_upload_image" value="'.$meta.'" />
									<img src="'.$image.'" class="dynamo_opengraph_preview_image" alt="" /><br />
										<input class="dynamo_opengraph_upload_image_button button" type="button" value="Choose Image" />
										<small><a href="#" class="dynamo_opengraph_clear_image">Remove Image</a></small>
										<br clear="all" /><span class="description">'.$field->desc.'';
					break;
				} //end switch
		echo '</td></tr>';
	} // end foreach
	echo '</table>'; // end table
}
 
// Save the Data
function dynamo_save_custom_meta($post_id) {
    global $dynamo_tpl;
    
    if(isset($post_id)) {
		// load custom meta fields
		$custom_meta_fields = $dynamo_tpl->get_json('config', 'opengraph');
		// verify nonce
		if (isset($_POST['custom_meta_box_nonce']) && !wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
			return $post_id;
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;
		// check permissions
		if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id))
				return $post_id;
			} elseif (!current_user_can('edit_post', $post_id)) {
				return $post_id;
		}
	
		// loop through fields and save the data
		foreach ($custom_meta_fields as $field) {
			$old = get_post_meta($post_id, $field->id, true);
			
			if(isset($_POST[$field->id])) {
				$new = $_POST[$field->id];
				if ($new && $new != $old) {
					update_post_meta($post_id, $field->id, $new);
				} elseif ('' == $new && $old) {
					delete_post_meta($post_id, $field->id, $old);
				}
			}
		} // end foreach
	}
}

add_action('save_post', 'dynamo_save_custom_meta');  

// Add the Meta Box for Twitter cards
function dynamo_add_twitter_meta_box() {
    add_meta_box(
                'dynamo_twitter_meta_box',
                'Twitter Cards metatags',
                'dynamo_show_twitter_meta_box',
                'post',
                'normal',
                'high'
        );
        
        add_meta_box(
                'dynamo_twitter_meta_box',
                'Twitter Cards metatags',
                'dynamo_show_twitter_meta_box',
                'page',
                'normal',
                'high'
        );
}


if(get_option($dynamo_tpl->name . '_twitter_cards') == 'Y') {
        add_action('add_meta_boxes', 'dynamo_add_twitter_meta_box');
}


// The Callback for Twiter metabox
function dynamo_show_twitter_meta_box() {
        global $dynamo_tpl, $post;
        // load custom meta fields
        $custom_meta_fields = $dynamo_tpl->get_json('config', 'twitter');
        // Use nonce for verification
        echo '<input type="hidden" name="custom_meta_box_nonce2" value="'.wp_create_nonce(basename(__FILE__)).'" />';
        // Begin the field table and loop
        echo '<table class="form-table">';
        foreach ($custom_meta_fields as $field) {
                // get value of this field if it exists for this post
                $meta = get_post_meta($post->ID, $field->id, true);
                
                // begin a table row with
                echo '<tr>
                                <th><label for="'.$field->id.'">'.$field->label.'</label></th>
                                <td>';
                                switch($field->type) {
                                        // case items will go here
                                        // text
                                        case 'text':
                                                echo '<input type="text" name="'.$field->id.'" id="'.$field->id.'" value="'.$meta.'" size="30" />
                                                        <br /><span class="description">'.$field->desc.'</span>';
                                        break;
                                        
                                        // textarea
                                        case 'textarea':
                                                echo '<textarea name="'.$field->id.'" id="'.$field->id.'" cols="60" rows="4">'.$meta.'</textarea>
                                                        <br /><span class="description">'.$field->desc.'</span>';
                                        break;
                                        
                                        // image
                                        case 'image':
                                                $image = 'none';
                                                if (get_option($dynamo_tpl->name . '_og_default_image', '') != '')  {
                                                        $image = get_option($dynamo_tpl->name . '_og_default_image'); 
                                                }
                                                echo '<span class="dynamo_opengraph_default_image" style="display:none">'.$image.'</span>';
                                                if ($meta) { 
                                                        $image = wp_get_attachment_image_src($meta, 'medium');        
                                                        $image = $image[0];
                                                }
                                                echo        '<input name="'.$field->id.'" type="hidden" class="dynamo_opengraph_upload_image" value="'.$meta.'" />
                                                                        <img src="'.$image.'" class="dynamo_opengraph_preview_image" alt="" /><br />
                                                                                <input class="dynamo_opengraph_upload_image_button button" type="button" value="Choose Image" />
                                                                                <small><a href="#" class="dynamo_opengraph_clear_image">Remove Image</a></small>
                                                                                <br clear="all" /><span class="description">'.$field->desc.'';
                                        break;
                                } //end switch
                echo '</td></tr>';
        } // end foreach
        echo '</table>'; // end table
}


function dynamo_save_custom__twitter_meta($post_id) {
    global $dynamo_tpl;
    
    if(isset($post_id)) {
                // load custom meta fields
                $custom_meta_fields = $dynamo_tpl->get_json('config', 'twitter');
                // verify nonce
                if (isset($_POST['custom_meta_box_nonce']) && !wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
                        return $post_id;
                // check autosave
                if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                        return $post_id;
                // check permissions
                if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
                        if (!current_user_can('edit_page', $post_id))
                                return $post_id;
                        } elseif (!current_user_can('edit_post', $post_id)) {
                                return $post_id;
                }
        
                // loop through fields and save the data
                foreach ($custom_meta_fields as $field) {
                        $old = get_post_meta($post_id, $field->id, true);
                        
                        if(isset($_POST[$field->id])) {
                                $new = $_POST[$field->id];
                                if ($new && $new != $old) {
                                        update_post_meta($post_id, $field->id, $new);
                                } elseif ('' == $new && $old) {
                                        delete_post_meta($post_id, $field->id, $old);
                                }
                        }
                } // end foreach
        }
}


add_action('save_post', 'dynamo_save_custom__twitter_meta');


/**
 *
 * Code used to implement the OpenSearch
 *
 **/

// function used to put in the page header the link to the opensearch XML description file
function dynamo_opensearch_head() {
	echo '<link href="'. home_url() .'/?opensearch_description=1" title="'.get_bloginfo('name').'" rel="search" type="application/opensearchdescription+xml" />';
}

// function used to add the opensearch_description variable
function dynamo_opensearch_query_vars($vars) {
	$vars[] = 'opensearch_description';
	return $vars;
}

// function used to generate the openserch XML description output 
function dynamo_opensearch() {
	// access to the wp_query variable
	global $wp_query,$dynamo_tpl;
	// check if there was an variable opensearch_description in the query vars
	if (!empty($wp_query->query_vars['opensearch_description']) ) {
		// if yes - return the XML with OpenSearch description
		header('Content-Type: text/xml');
		// the XML content
		echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
		echo "<OpenSearchDescription xmlns=\"http://a9.com/-/spec/opensearch/1.1/\">\n";
		echo "\t<ShortName>".get_bloginfo('name')."</ShortName>\n";
		echo "\t<LongName>".get_bloginfo('name')."</LongName>\n";
		echo "\t<Description>Search &quot;".get_bloginfo('name')."&quot;</Description>\n";
		if (get_option($dynamo_tpl->name . '_branding_favicon', '') !='') {
		echo "\t<Image width=\"16\" height=\"16\" type=\"image/x-icon\">".get_option($dynamo_tpl->name . '_branding_favicon', '')."</Image>\n"; 
		} else {
		echo "\t<Image width=\"16\" height=\"16\" type=\"image/x-icon\">".dynamo_file_uri('favicon.ico')."</Image>\n"; 
		}
		echo "\t<Contact>".get_bloginfo('admin_email')."</Contact>\n";
		echo "\t<Url type=\"text/html\" template=\"". home_url() ."/?s={searchTerms}\"/>\n";
		echo "\t<Url type=\"application/atom+xml\" template=\"". home_url() ."/?feed=atom&amp;s={searchTerms}\"/>\n";
		echo "\t<Url type=\"application/rss+xml\" template=\"". home_url() ."/?feed=rss2&amp;s={searchTerms}\"/>\n";
		echo "\t<Language>".get_bloginfo('language')."</Language>\n";
		echo "\t<OutputEncoding>".get_bloginfo('charset')."</OutputEncoding>\n";
		echo "\t<InputEncoding>".get_bloginfo('charset')."</InputEncoding>\n";
		echo "</OpenSearchDescription>";
		exit;
	}
	// if not just end the function
	return;
}

// add necessary actions and filters if OpenSearch is enabled
if(get_option($dynamo_tpl->name . "_opensearch_use_opensearch", "Y") == "Y") {
	add_action('wp_head', 'dynamo_opensearch_head');
	add_action('template_redirect', 'dynamo_opensearch');
	add_filter('query_vars', 'dynamo_opensearch_query_vars');
}

/**
 * Tests if any of a post's assigned categories are descendants of target categories
 *
 * @param int|array $cats The target categories. Integer ID or array of integer IDs
 * @param int|object $_post The post. Omit to test the current post in the Loop or main query
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @see get_term_by() You can get a category by name or slug, then pass ID to this function
 * @uses get_term_children() Passes $cats
 * @uses in_category() Passes $_post (can be empty)
 * @version 2.7
 * @link http://codex.wordpress.org/Function_Reference/in_category#Testing_if_a_post_is_in_a_descendant_category
 */
if ( ! function_exists( 'post_is_in_descendant_category' ) ) {
        function post_is_in_descendant_category( $cats, $_post = null ) {
                foreach ( (array) $cats as $cat ) {
                        // get_term_children() accepts integer ID only
                        $descendants = get_term_children( (int) $cat, 'category' );
                        if ( $descendants && in_category( $descendants, $_post ) )
                                return true;
                }
                return false;
        }
}


/**
 *
 * Code used to implement parsing shortcodes and emoticons in the text widgets
 *
 **/

if(get_option($dynamo_tpl->name . "_shortcodes_widget_state", "Y") == "Y") {
	add_filter('widget_text', 'do_shortcode');
}
	
if(get_option($dynamo_tpl->name . "_emoticons_widget_state", "Y") == "Y") {
	add_filter('widget_text', 'convert_smilies');
}



/**
 *
 * Code used to shortcode buttons in TinyMCE editor
 *
 **/
function add_dp_shortcode_buttons() {
    // check user permissions
    if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
   	return;
    }
    // verify the post type
	// check if WYSIWYG is enabled
		add_filter("mce_external_plugins", "add_dp_tinymce_plugin");
		add_filter('mce_buttons', 'register_dp_shortcode_buttons');
}
function add_dp_tinymce_plugin($plugin_array) {
   	$plugin_array['DPWPShortcodes'] = get_template_directory_uri() . '/dynamo_framework/tinymce/editor_plugin.js';
   	return $plugin_array;
}

function register_dp_shortcode_buttons($buttons) {
   array_push($buttons, "dp_style","dp_columns","dp_button","dp_icon","dp_map","dp_vimeo","dp_youtube");
   return $buttons;
}

function print_html_images( $content, $num = 1, $width = null, $height = null, $class = 'alignleft', $permalink = true, $echo = true ) {
	
	// Parse all of the defaults and parameters
	if ( is_array( $num ) ) {
		
		$defaults = array(
			'number' => 1,
			'width' => '',
			'height' => '',
			'class' => 'alignleft',
			'permalink' => true,
			'echo' => true	
		);
		
		$args = wp_parse_args( $num, $defaults );
	
		extract( $args, EXTR_OVERWRITE );

	} else {
		
		// Fix for number parameter
		$number = $num;
		
	}
	
	// Set $more variable to retrieve full post content
	global $more;
	$more = 1;

	// Setup variables according to passed parameters
	$size = empty( $width ) ? '' : ' width="' . $width . 'px"';
	$size = empty( $height ) ? $size : $size . ' height="' . $height . 'px"'; 
	$class = empty( $class ) ? '' : ' class="' . $class . '"';
	$link = empty( $permalink ) ? '' : '<a href="' . get_permalink() . '">';
	$linkend = empty( $permalink ) ? '' : '</a>';
	
	
	// Number of images in content
	$count = substr_count( $content, '<img' );
	$start = 0;
	
	// Loop through the images
	for ( $i = 1; $i <= $count; $i++ ) {

		// Get image src
		$imgBeg = strpos( $content, '<img', $start );
		$post = substr( $content, $imgBeg );
		$imgEnd = strpos( $post, '>' );
		$postOutput = substr( $post, 0, $imgEnd + 1 );

		// Replace width || height || class
		
			$replace = array( '/width="[^"]*" /', '/height="[^"]*" /', '/class="[^"]*" /' );
			$postOutput = preg_replace( $replace, '', $postOutput );			
			$replace = '/class="[^"]*" /';
			$postOutput = preg_replace( $replace, '', $postOutput );

		$image[$i] = '<div class="multiple-img-item">'.$postOutput.'</div>';

		$start = $imgBeg + $imgEnd + 1;

	}

	// Go through the images and return/echo according to above parameters
	if ( ! empty( $image ) ) {
	
		if ( 'all' == $number ) {
	
			$x = count( $image );
			$images = '';
			
			for ( $i = 1; $i <= $x; $i++ ) {
	
				if ( stristr( $image[$i], '<img' ) ) {
	
					$theImage = str_replace( '<img', '<img' . $size . $class, $image[$i] );
					$images .= $link . $theImage . $linkend;
				
				}
				
			}
	
		} else {
	
			if ( stristr( $image[$number], '<img' ) ) {
	
				$theImage = str_replace( '<img', '<img' . $size . $class, $image[$number] );
				$images = $link . $theImage . $linkend;
	
			}
			
		}
	
		// Reset the $more tag back to zero
		$more = 0;
	
		// Echo or return 
		if ( ! empty( $echo ) )
	    	echo $images;
	    else
	    	return $images;

	}

}

function get_dp_font_manager()
			{
				$fonts = get_option('dp_font_icons');
				$output = '<p><div class="preview-icon"><i class=""></i></div><input class="search-icon" type="text" placeholder="Search for a suitable icon.." /></p>';
				$output .= '<div id="smile_icon_search">';
				$output .= '<ul class="icons-list smile_icon">';
				foreach($fonts as $font => $info)
				{
					$icon_set = array();
					$icons = array();
					$upload_dir = wp_upload_dir();
					$path		= trailingslashit($upload_dir['basedir']);
					$file = $path.$info['include'].'/'.$info['config'];
					include($file);
					if(!empty($icons))
					{
						$icon_set = array_merge($icon_set,$icons);
					}
					$set_name = ucfirst($font);
					if(!empty($icon_set))
					{
						$output .= '<p><strong>'.$set_name.'</strong></p>';
						foreach($icon_set as $icons)
						{
							foreach($icons as $icon)
							{
								$output .= '<li title="'.$icon['class'].'" data-icon="'.$font.'-'.$icon['class'].'" data-icon-tag="'.$icon['tags'].'">';
								$output .= '<i class="icon '.$font.'-'.$icon['class'].'"></i><label class="icon">'.$icon['class'].'</label></li>';
							}
						}
					}
				}
				$output .'</ul>';
				$output .= '<script type="text/javascript">
				jQuery(document).ready(function(){
							
				jQuery(".search-icon").keyup(function(){
				
				// Retrieve the input field text and reset the count to zero
				var filter = jQuery(this).val(), count = 0;
				
				// Loop through the icon list
				jQuery(".icons-list li").each(function(){
				
				// If the list item does not contain the text phrase fade it out
				if (jQuery(this).attr("data-icon-tag").search(new RegExp(filter, "i")) < 0) {
				jQuery(this).fadeOut();
				} else {
				jQuery(this).show();
				count++;
				}
				});
				});
				});
				
				</script>';
				$output .= '</div>';
				return $output;
			}
			
function add_custom_page_css()
{
global $post;
$output='';
$params = get_post_custom();
$text_color =  isset( $params['dynamo-post-params-subheader_txtcolor'] ) ? esc_attr( $params['dynamo-post-params-subheader_txtcolor'][0] ) : '';
$bg_color =  isset( $params['dynamo-post-params-subheader_bgcolor'] ) ? esc_attr( $params['dynamo-post-params-subheader_bgcolor'][0] ) : '';
if (is_page()) $prefix = '.page-id-'.get_the_ID();
if (is_single()) $prefix = '.postid-'.get_the_ID();
if ($text_color != '' || $bg_color != '') {
$output = "<style>";
if ($text_color != '') { 
$output .= $prefix." .dp-subheader .main-title, ".$prefix." .dp-subheader .sub-title, ".$prefix." .dp-subheader .dp-breadcrumbs a,.dp-subheader .dp-breadcrumbs span { color : ".$text_color." !important; }";
}
if ($bg_color != '') { 
$output .= $prefix." .dp-subheader-wraper {background-color : ".$bg_color." !important; }";
}
$output .= "</style>";
}
echo $output;}
add_action('wp_head','add_custom_page_css');
// 


// Portfolio specific functions
function dp_get_first_embed_shortcode($content) {
    preg_match('/\[embed(.*)](.*)\[\/embed]/', $content, $matches);
	if ($matches)     {
		return $matches[0];} else {
	return ''; }
	
}
	
	// EOF