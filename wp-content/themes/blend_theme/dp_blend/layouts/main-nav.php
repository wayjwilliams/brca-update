<?php

// disable direct access to the file	
defined('DYNAMO_WP') or die('Access denied');

global $dynamo_tpl;

?>

        <!--   Begin Navigation area -->
        <?php $headerclass = get_option($dynamo_tpl->name . "_top_main_menu_alignment", 'menu_lefted'); ?>
		<div id="dp-navigation-wrapper" class="clearfix">
        <div class="dp-head-wrap semi-transparent <?php echo $headerclass; ?>">
            <div class="dp-page">
                <header id="dp-head" class="top-navigation">
                <?php if ($headerclass == 'menu_splited') { ?>
                <div class="left_menu_container">
                <?php 
				if(has_nav_menu('mainmenu-left')) {
							dynamo_menu('mainmenu-left', 'dp-main-menu', array('walker' => new DPMenuWalker()),'sf-menu main-top-menu');
						} else {echo 'No menu assigned!';}
				?>
                </div>
                <div class= "logo_center_container">
                    <?php if(get_option($dynamo_tpl->name . "_branding_logo_type", 'css') != 'none') : ?>
                    <h2>
                        <a href="<?php echo home_url(); ?>" class="<?php echo get_option($dynamo_tpl->name . "_branding_logo_type", 'css'); ?>Logo"><?php dp_blog_logo(); ?></a>
                    </h2>
                    <?php endif; ?>
               </div>
                <div class="right_menu_container">
                <?php 
				if(has_nav_menu('mainmenu-right')) {
							dynamo_menu('mainmenu-right', 'dp-main-menu', array('walker' => new DPMenuWalker()),'sf-menu main-top-menu');
						} else {echo 'No menu assigned!';}
				?>
                    <?php if((get_option($dynamo_tpl->name . '_search_link', 'Y') == 'Y') || is_active_sidebar('aside')) : ?>
                    <div class="dp-button-area"> 
                        <?php if(is_active_sidebar('aside')) : ?>
                        <a href="" class="dp-sidebar-button"></a>
                        <?php endif; ?>
						<?php if(get_option($dynamo_tpl->name . '_search_link', 'Y') == 'Y') : ?>
                        <a href="#" class="dp-header-search"></a>
						<?php endif; ?>
                        <?php if(function_exists("is_woocommerce") && get_option($dynamo_tpl->name . "_menu_cart_link", 'css') == 'Y'){
						dp_load('wc_dropdown_cart');
                        } ?>                    

                    </div>                        
                    <?php endif; ?>
                </div>
                <?php } elseif ($headerclass == 'menu_magazine') { ?>
                 	<?php if(get_option($dynamo_tpl->name . "_branding_logo_type", 'css') != 'none') : ?>
                    <h2>
                        <a href="<?php echo home_url(); ?>" class="<?php echo get_option($dynamo_tpl->name . "_branding_logo_type", 'css'); ?>Logo"><?php dp_blog_logo(); ?></a>
                    </h2>
                    <?php endif; ?>
                    <?php if(is_active_sidebar('topmenuadd')) : ?>
                    <div class="magazine-menu-advertisment">
                       <?php dynamic_sidebar('topmenuadd'); ?>
                    </div>
                    <?php endif; ?>
                    
                    <div class="magazine-menu-separator"></div>
                    <?php if((get_option($dynamo_tpl->name . '_search_link', 'Y') == 'Y') || is_active_sidebar('aside') || (get_option($dynamo_tpl->name . '_menu_cart_link', 'N') == 'Y')) : ?>
                    <div class="dp-button-area"> 
                        <?php if(is_active_sidebar('aside')) : ?>
                        <a href="" class="dp-sidebar-button"></a>
                        <?php endif; ?>
						<?php if(get_option($dynamo_tpl->name . '_search_link', 'Y') == 'Y') : ?>
                        <a href="#" class="dp-header-search"></a>
						<?php endif; ?>
						<?php if ( function_exists('icl_object_id') && (get_option($dynamo_tpl->name . "_menu_language_switcher") == 'Y')) {
                        dp_load('wpml_lang_switcher');
                        } ?>
                        <?php if(function_exists("is_woocommerce") && get_option($dynamo_tpl->name . "_menu_cart_link", 'N') == 'Y'){
						dp_load('wc_dropdown_cart');
                        } ?>                    
                    </div>                        
                    <?php endif; ?>
							<?php 
							if(has_nav_menu('mainmenu')) {
							dynamo_menu('mainmenu', 'dp-main-menu', array('walker' => new DPMenuWalker()),'sf-menu main-top-menu');							}
							else {
								echo 'No menu assigned!';
							}
							?>
                <?php } else { ?>
                    <?php if(get_option($dynamo_tpl->name . "_branding_logo_type", 'css') != 'none') : ?>
                    <h2>
                        <a href="<?php echo home_url(); ?>" class="<?php echo get_option($dynamo_tpl->name . "_branding_logo_type", 'css'); ?>Logo"><?php dp_blog_logo(); ?></a>
                    </h2>
                    <?php endif; ?>
                    <?php if ($headerclass == 'menu_centered') { ?>
                    <div class="centered-block-outer">
 						<div class="centered-block-middle">
  							<div class="centered-block-inner">
                    <?php } ?>
                    <?php if((get_option($dynamo_tpl->name . '_search_link', 'N') == 'Y') || is_active_sidebar('aside') || (get_option($dynamo_tpl->name . '_menu_cart_link', 'N') == 'Y')) : ?>
                    <div class="dp-button-area"> 
                        <?php if(is_active_sidebar('aside')) : ?>
                        <a href="" class="dp-sidebar-button"></a>
                        <?php endif; ?>
						<?php if(get_option($dynamo_tpl->name . '_search_link', 'Y') == 'Y') : ?>
                        <a href="#" class="dp-header-search"></a>
						<?php endif; ?>
						<?php if ( function_exists('icl_object_id') && (get_option($dynamo_tpl->name . "_menu_language_switcher") == 'Y')) {
                        dp_load('wpml_lang_switcher');
                        } ?>
                        <?php if(function_exists("is_woocommerce") && get_option($dynamo_tpl->name . "_menu_cart_link", 'N') == 'Y'){
						dp_load('wc_dropdown_cart');
                        } ?>                    
                    </div>                        
                    <?php endif; ?>
							<?php 
							if(has_nav_menu('mainmenu')) {
							dynamo_menu('mainmenu', 'dp-main-menu', array('walker' => new DPMenuWalker()),'sf-menu main-top-menu');							}
							else {
								echo 'No menu assigned!';
							}
							?>
                    <?php if ($headerclass == 'menu_centered') { ?>
		        			</div>
        				</div>
        			</div>
                    <?php } } ?>

                </header>
            </div>
        </div>
        </div>
		<!--   End Navigation area -->
