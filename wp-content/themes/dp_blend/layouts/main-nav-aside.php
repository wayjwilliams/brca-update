<?php

// disable direct access to the file	
defined('DYNAMO_WP') or die('Access denied');

global $dynamo_tpl;

?>
        <!--   Begin logo area -->
		<div id="dp-navigation-wrapper" class="clearfix">
        <div class="dp-head-wrap semi-transparent">
            <div class="dp-page">
                <header id="dp-head" class="top-navigation">
                    <div class="centered-block-outer">
 						<div class="centered-block-middle">
  							<div class="centered-block-inner">
                    <?php if(get_option($dynamo_tpl->name . "_branding_logo_type", 'css') != 'none') : ?>
                    <h2>
                        <a href="<?php echo home_url(); ?>" class="<?php echo get_option($dynamo_tpl->name . "_branding_logo_type", 'css'); ?>Logo"><?php dp_blog_logo(); ?></a>
                    </h2>
                    <?php endif; ?>
		        			</div>
        				</div>
        			</div>

                </header>
            </div>
        </div>
        </div>
		<!--   End logo area -->
        <!--   Begin Navigation area -->
        <?php
		$addclass = ' fixedaside';
		if (get_option($dynamo_tpl->name . "_aside_menu_sliding", 'N') == 'Y')  $addclass = ' slidingaside';
		$addstyle= '';
		if(get_option($dynamo_tpl->name . "_aside_mainmenu_bg_color", '') != '') $addstyle= 'style="background-color:'.get_option($dynamo_tpl->name . "_aside_mainmenu_bg_color", '').'"';?>
		<div class="dp-aside-navigation-wrapper <?php echo $addclass; ?>" <?php echo $addstyle; ?> >
        <a href="#" class="dp-aside-menu-toggle"><i class="icon-menu51 "></i></a>
             <div class="dp-aside-navigation-wrapper-inner">
                <div class="dp-aside-navigation-wrapper-inner-content">                
                <header id="dp-head-aside">
                <?php if(get_option($dynamo_tpl->name . "_branding_logo_type", 'css') != 'none') : ?>
                    <h2>
                        <a href="<?php echo home_url(); ?>" class="<?php echo get_option($dynamo_tpl->name . "_branding_logo_type", 'css'); ?>Logo"><?php dp_aside_menu_logo(); ?></a>
                    </h2>
				<?php endif; ?>
                </header>
                   
							<?php 
							if(has_nav_menu('mainmenu')) {
							dynamo_menu('mainmenu', 'dp-main-menu', array('walker' => new DPMenuWalker()),'sf-menu sf-vertical main-aside-menu');							}
							else {
								echo 'No menu assigned!';
							}
							?>
   <div class="clearboth"></div>
   <div class="aside-button-bar">
       <?php if(function_exists("is_woocommerce") && (get_option($dynamo_tpl->name . "_cart_aside_state") == 'Y')){
		dp_load('wc_dropdown_cart');
        } ?> 

        <?php if ( function_exists('icl_object_id') && (get_option($dynamo_tpl->name . "_language_switcher_aside_state") == 'Y')) {
     	dp_language_switcher();
		} ?>
   </div>  
        
        </div>
        <?php if(get_option($dynamo_tpl->name . "_social_links_aside_state") == 'Y') { ?>
<div class="social-bar-container"><div class="centered-block-outer">
 						<div class="centered-block-middle">
  							<div class="centered-block-inner">
                             
                    		<ul class="social-bar rounded">
                    		<?php dp_social_bar_content(); ?>
        					</ul>
        					</div>           
                    		</div>
        				</div>
        			</div>        
        <?php } ?>

                
            </div>
        </div>
		<!--   End Navigation area -->
