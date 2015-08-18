<?php

// disable direct access to the file	
defined('DYNAMO_WP') or die('Access denied');

global $dynamo_tpl;

?>

        <!--   Begin Mobile Header area -->
		<div id="dp-mobile-header-wrapper">
			<div class="dp-head-wrap semi-transparent">
            	<div class="dp-page pad10 clearfix">
                
               
                <a href="#" class="dp-mainmenu-toggle"><i class="icon-menu51"></i></a>                   
               
                
                   <?php if(get_option($dynamo_tpl->name . "_branding_logo_type", 'css') != 'none') : ?>
                    <h2>
                        <a href="<?php echo home_url(); ?>" class="<?php echo get_option($dynamo_tpl->name . "_branding_logo_type", 'css'); ?>Logo"><?php dp_blog_logo(); ?></a>
                    </h2>
                    <?php endif; ?>
        		</div>
        	</div>
        </div>
		<!--   End Mobile header -->
