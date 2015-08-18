<?php 
	
	/**
	 *
	 * Template footer
	 *
	 **/
	
	// create an access to the template main object
	global $dynamo_tpl, $post;
	// disable direct access to the file	
	defined('DYNAMO_WP') or die('Access denied');
	$usepaspartu = false;
	$params_paspartusetting =  isset( $params['dynamo-post-params-paspartusetting'] ) ? esc_attr( $params['dynamo-post-params-paspartusetting'][0] ) : 'default';
	if (get_option($dynamo_tpl->name . "_paspartu_state",'N') == 'Y' || ($params_paspartusetting == 'custom' && $params_paspartu_use == 'Y')) $usepaspartu = true;
?>
<?php $add_footer_class = '';
if(!dp_is_active_sidebar('footer') && !dp_is_active_sidebar('footer1') && !dp_is_active_sidebar('footer2') && !dp_is_active_sidebar('footer3')) {$add_footer_class = ' class="nofooter"';
}
?>
<div id="dp-footer-wrap" <?php echo $add_footer_class;?>>
<?php if(dp_is_active_sidebar('footer')) : ?>
<div id="dp-footer" class="dp-page widget-area">
	<?php dp_dynamic_sidebar('footer'); ?>
</div>
<?php endif; ?>
<?php if(dp_is_active_sidebar('footer1') || dp_is_active_sidebar('footer2') || dp_is_active_sidebar('footer3')) { ?>
<div id="dp-footer" class="dp-page widget-area">	
<div class="one_fourth no-margin-right">
<?php if(dp_is_active_sidebar('footer1')) : ?>
<div id="dp-footer1" class="dp-page widget-area">
	<?php dp_dynamic_sidebar('footer1'); ?>
</div>
<?php endif; ?>
</div>
<div class="one_half no-margin-right">
<?php if(dp_is_active_sidebar('footer2')) : ?>
<div id="dp-footer2" class="dp-page widget-area">
	<?php dp_dynamic_sidebar('footer2'); ?>
</div>
<?php endif; ?>
</div>
<div class="one_fourth  no-margin-right">
<?php if(dp_is_active_sidebar('footer3')) : ?>
<div id="dp-footer3" class="dp-page widget-area">
	<?php dp_dynamic_sidebar('footer3'); ?>
</div>
<?php endif; ?>


</div>
</div>
<?php } ?>
<div class="clearboth"></div>

<?php if(get_option($dynamo_tpl->name . "_copyright_use_state") == 'Y') { 
$iscopyrightcentered = false;
if(get_option($dynamo_tpl->name . "_copyright_style") == 'centered') $iscopyrightcentered = true;
?>
<div id="dp-copyright-wrap">
<div id="dp-copyright"  class="dp-page padding10">
	<?php if($iscopyrightcentered) { ?>
    <div id="dp-copyright-inner" class="centered-copyright">
    
    <div class="centered-block-outer">
 			<div class="centered-block-middle">
  				<div class="centered-block-inner"><div class="space30"></div>
            <?php if ( has_nav_menu( 'footer-menu' ) ) {?>
			<div id="dp-footer-menu"><?php dynamo_menu('footer-menu', 'dp-footer-menu', array('walker' => new DPMenuWalker()), 'footer-menu'); ?></div>
            <?php } ?>
        </div>
       </div>
     </div>
     <div class="clearboth"></div>        
    <div class="centered-block-outer">
                <div class="centered-block-middle">
                    <div class="centered-block-inner">
            <?php if(get_option($dynamo_tpl->name . "_social_icons_footer_state") == 'Y') { ?>
            <ul class="social-bar rounded">
            <?php dp_social_bar_content_footer(); ?>
            </ul>
            <?php } ?>
            </div>
           </div>
         </div>
     <div class="clearboth"></div>        
     <div class="centered-block-outer">
 			<div class="centered-block-middle">
  				<div class="centered-block-inner">
        <div class="dp-copyrights"> 
<div class="dp-copyrights-text"><?php echo str_replace('\\', '', htmlspecialchars_decode(get_option($dynamo_tpl->name . '_template_copyright_text', ''))); ?></div>
        </div>
        </div>
       </div>
     </div>
     <div class="clearboth"></div>        
	</div>
    <?php } else { ?>
    <div id="dp-copyright-inner">        
	<?php if(get_option($dynamo_tpl->name . "_social_icons_footer_state") == 'Y') { ?>
        <ul class="social-bar rounded">
        <?php dp_social_bar_content_footer(); ?>
        </ul>
        <?php } ?>

        <div class="dp-copyrights"> 
        <div class="dp-copyrights-text"><?php echo str_replace('\\', '', htmlspecialchars_decode(get_option($dynamo_tpl->name . '_template_copyright_text', ''))); ?></div>
            <?php if ( has_nav_menu( 'footer-menu' ) ) {?>
			<div id="dp-footer-menu"><?php dynamo_menu('footer-menu', 'dp-footer-menu', array('walker' => new DPMenuWalker()), 'footer-menu'); ?></div>
            <?php } ?>
        </div>
        
	</div>
    <?php } ?>
    </div>
</div>
<?php } ?>
</div>
 
    <div id="back-to-top"></div>
    
    <?php dp_load('social'); 	?>
	<?php dp_load('search'); ?>
	<?php do_action('dynamowp_footer'); ?>
	
	<?php 
		echo stripslashes(
			htmlspecialchars_decode(
				str_replace( '&#039;', "'", get_option($dynamo_tpl->name . '_footer_code', ''))
			)
		); 
	?>
    
	<?php do_action('dynamowp_ga_code'); ?>
<div id="dp-mobile-menu">
<i id="close-mobile-menu" class="icon-times-circle"></i>
<div class="mobile-menu-inner">
<?php 
		if (get_option($dynamo_tpl->name . "_top_main_menu_alignment", 'menu_lefted') == 'menu_splited') {
			dynamo_menu_mobile('mainmenu-left', 'dp-main-menu', array('walker' => new DPMenuWalkerMobile()),'aside-menu');
			dynamo_menu_mobile('mainmenu-right', 'dp-main-menu', array('walker' => new DPMenuWalkerMobile()),'aside-menu');
		} else {
		dynamo_menu_mobile('mainmenu', 'dp-main-menu', array('walker' => new DPMenuWalkerMobile()),'aside-menu'); 
		}
		?>
</div>
</div>    
</div>	
			<?php dp_load('aside'); ?>
    <?php if ($usepaspartu) { ?>
    </div>
    </div>
    <?php } ?>
    <?php wp_footer(); ?>
</body>
</html>
