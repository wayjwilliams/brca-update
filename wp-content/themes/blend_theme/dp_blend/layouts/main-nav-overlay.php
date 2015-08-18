<?php

// disable direct access to the file	
defined('DYNAMO_WP') or die('Access denied');

global $dynamo_tpl;

?>

        <!--   Begin Navigation area -->
		<div id="dp-navigation-wrapper">
        <div class="dp-head-wrap semi-transparent">
            <div class="dp-page">
                <header id="dp-head" class="top-navigation">
                    <?php if(get_option($dynamo_tpl->name . "_branding_logo_type", 'css') != 'none') : ?>
                    <h2>
                        <a href="<?php echo home_url(); ?>" class="<?php echo get_option($dynamo_tpl->name . "_branding_logo_type", 'css'); ?>Logo"><?php dp_blog_logo(); ?></a>
                    </h2>
                    <?php endif; ?>                        
                    <a href="#" class="dp-overlay-menu-toggle"><i class="icon-menu51"></i></a>                   
                </header>
            </div>
        </div>
        </div>
        <div class="centered-block-outer">
 			<div class="centered-block-middle">
  				<div class="centered-block-inner">
        <div class="dp-overlay-menu">
		<div class="dp-overlay-menu-close"><i class="icon-times-circle"></i></div>
            <div class="overlay-nav">
							<?php 
							if(has_nav_menu('mainmenu')) {
							dynamo_menu('mainmenu', 'dp-main-menu', array('walker' => new DPMenuWalker()),'overlay-menu');							
							} else {
								echo 'No menu assigned!';
							}
							?>
            </div>
		</div>
        </div>
        </div>
        </div>
        

		<!--   End Navigation area -->
