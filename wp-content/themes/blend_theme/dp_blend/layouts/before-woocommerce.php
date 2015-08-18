<?php 
	
	/**
	 *
	 * Template elements before the page content
	 *
	 **/
	
	// create an access to the template main object
	global $dynamo_tpl,$post;
	$addpageclass = " dp-page";
    $classes = get_body_class();
	$usebreadcrumb = false;
	if(get_option($dynamo_tpl->name . '_breadcrumbs_state', 'Y') == 'Y') $usebreadcrumb = true;
	$usepaspartu = false;
	if (get_option($dynamo_tpl->name . "_paspartu_state",'N') == 'Y') $usepaspartu = true;
	// disable direct access to the file	
	defined('DYNAMO_WP') or die('Access denied');
	
	// check if the sidebar is set to be a left column
	$args_val = $args == null || ($args != null && $args['sidebar'] == true);
	
	$sidebarposition = '';
?>
<body <?php do_action('dynamowp_body_attributes'); ?>>
	<?php if(get_option($dynamo_tpl->name . "_use_page_preloader") == 'Y') : ?>
<div id="dp_preloader">
<div class="spinner_outer">
<div class="spinner_middle">
<div class="spinner_inner">
<div class="spinner">
		  <div class="double-bounce1"></div>
		  <div class="double-bounce2"></div>
	 </div>
</div>
</div>
</div>
</div>
    <?php endif; ?>
    <?php $pasp_style = '';
	if ($usepaspartu) { 
	?>
    <div class="paspartu-outer">
    <div <?php echo $pasp_style; ?> class="paspartu-top"></div>
    <div <?php echo $pasp_style; ?> class="paspartu-left"></div>
    <div <?php echo $pasp_style; ?> class="paspartu-right"></div>
    <div <?php echo $pasp_style; ?> class="paspartu-bottom"></div>
    <div class="paspartu-inner">
    <?php } ?>
<div id="dp-page-box">
		<!--   Begin Top Panel widget area -->
        <?php if(get_option($dynamo_tpl->name . "_top_bar_state") == 'Y') { ?>
        <div id="dp-top-bar" >
        <section class="dp-page pad10">
        <div class="top-contact-bar">
        <?php if(get_option($dynamo_tpl->name . "_top_contact_adress") != '') : ?>
        <div class= "top-bar-adress"><i class="icon-map-marker"></i><span><?php echo get_option($dynamo_tpl->name . "_top_contact_adress")?></span></div>
        <?php endif; ?>
        <?php if(get_option($dynamo_tpl->name . "_top_contact_phone") != '') : ?>
        <div class= "top-bar-phone"><i class="icon-phone16"></i><span><?php echo get_option($dynamo_tpl->name . "_top_contact_phone")?></span></div>
        <?php endif; ?>
        <?php if(get_option($dynamo_tpl->name . "_top_contact_email") != '') : ?>
        <div class= "top-bar-email"><i class="icon-email"></i><span>
        <?php if(get_option($dynamo_tpl->name . "_top_contact_email_link") == 'Y') : ?>
        <a href="mailto:<?php echo get_option($dynamo_tpl->name . "_top_contact_email")?>">
        <?php endif; ?>
        <?php if((get_option($dynamo_tpl->name . "_top_contact_email_link") == 'Y') && (get_option($dynamo_tpl->name . "_top_contact_email_hide") == 'Y')){ 
		echo get_option($dynamo_tpl->name . "_top_contact_email_text");
		 } else { 
		echo get_option($dynamo_tpl->name . "_top_contact_email");
		} ?>
        </span></div>
        <?php if(get_option($dynamo_tpl->name . "_top_contact_email_link") == 'Y') : ?>
        </a>
        <?php endif; ?>
        <?php endif; ?>
        </div>
        <?php if ( get_option($dynamo_tpl->name . "_top_bar_usermenu_state") == 'Y') {
		dp_user_menu(get_option($dynamo_tpl->name . "_top_bar_user_menu"));
		} ?>
        <?php if ( function_exists('icl_object_id') && (get_option($dynamo_tpl->name . "_language_switcher_top_bar_state") == 'Y')) {
     	dp_language_switcher();
		} ?>
        <?php if(function_exists("is_woocommerce") && (get_option($dynamo_tpl->name . "_top_bar_cart_state") == 'Y')){
		dp_load('wc_dropdown_cart');
        } ?>                    
        <?php if(get_option($dynamo_tpl->name . "_social_links_top_bar_state") == 'Y') { ?>
        <ul class="social-bar diamond">
        <?php dp_social_bar_content(); ?>
        </ul>
        <?php } ?>
        </section>
        </div>
        <?php } ?>
		<!--   End Top Panel widget area -->
        <?php dp_load('mobile-header'); ?>
        
		<?php
		 if (get_option($dynamo_tpl->name . '_main_menu_type') == "top")	dp_load('main-nav');  
         if (get_option($dynamo_tpl->name . '_main_menu_type') == "aside") dp_load('main-nav-aside'); 
         if (get_option($dynamo_tpl->name . '_main_menu_type') == "overlay") dp_load('main-nav-overlay'); 
		 ?>                              
        
        <!--   Begin subheader wrapper -->
        <?php if( !is_front_page()) : ?>
        <?php $shimage = $subheaderinnerstyle = "";
		if (get_option($dynamo_tpl->name . '_wc_subheader_area_bgimage') != "") $shimage = get_option($dynamo_tpl->name . '_wc_subheader_area_bgimage');
		if ($shimage != "") {
			$subheaderinnerstyle = 'style="background-image:url('.$shimage.'); background-size:cover;"';
		 } ?>
        <div class="dp-subheader-wraper">
        <div class="subheader-inner" <?php echo $subheaderinnerstyle ?>>
        <div class="dp-page pad10">
        <div class="dp-subheader">
        <div class="subheader-title-holder">
		<h1 class="main-title"><?php echo get_option($dynamo_tpl->name . '_woocommerce_pages_title') ?></h1>
        <p class="sub-title"><?php echo get_option($dynamo_tpl->name . '_woocommerce_pages_subtitle') ?></p>
        <?php endif; ?>
        </div>
        </div>
        </div>
        </div>
        </div>
        <!--   End subheader wrapper -->
				<!-- Mainbody, breadcrumbs -->
                <?php if($usebreadcrumb) : ?>
				<div id="dp-breadcrumb-fontsize">
                <div class="dp-page pad10">
					<?php
                        $breadcrumbsargs = array(
                                'delimiter' => '&nbsp; → &nbsp;'
                        );
                    ?>
					<?php woocommerce_breadcrumb($breadcrumbsargs); ?>
                </div>
				</div>
                <?php endif; ?>
<div class="clearboth"></div>
<section class="dp-page-wrap<?php echo $addpageclass ?>">
               

	<section id="dp-mainbody-columns">			
			<section>
            <div id="dp-content-wrap">